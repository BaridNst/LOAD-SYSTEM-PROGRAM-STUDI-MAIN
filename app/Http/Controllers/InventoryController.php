<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    // 1. Tampilan Dashboard Utama
    public function index()
    {
        $barangs = Barang::all();
        
        // Admin bisa melihat semua riwayat, User hanya melihat riwayat miliknya sendiri
        if (Auth::user()->role == 'admin') {
            $histories = Peminjaman::with(['user', 'barang'])->latest()->get();
        } else {
            $histories = Peminjaman::with(['user', 'barang'])
                ->where('user_id', Auth::id())
                ->latest()
                ->get();
        }

        return view('dashboard', compact('barangs', 'histories'));
    }

    // 2. Fungsi Ajukan Pinjaman (User)
    public function pinjam(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        // Validasi jika stok di database kosong
        if ($barang->stok < 1) {
            return redirect()->back()->with('error', 'Maaf, stok barang sedang habis!');
        }

        // Simpan data ke tabel peminjaman dengan status 'pending'
        Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $barang->id,
            'jumlah' => 1,
            'tanggal_pinjam' => now(),
            'status' => 'pending', 
        ]);

        return redirect()->back()->with('success', 'Permintaan pinjam dikirim! Menunggu konfirmasi admin.');
    }

    // 3. Fungsi Konfirmasi/Setujui Pinjaman (Hanya Admin)
    public function setujuiPinjaman($id)
    {
        // PENGAMAN: Jika yang klik bukan admin, usir balik
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses admin!');
        }

        $history = Peminjaman::findOrFail($id);
        $barang = Barang::findOrFail($history->barang_id);

        if ($barang->stok < 1) {
            return redirect()->back()->with('error', 'Gagal setuju, stok barang sudah habis!');
        }

        // Update status menjadi 'dipinjam'
        $history->update([
            'status' => 'dipinjam'
        ]);

        // Kurangi stok barang
        $barang->decrement('stok');

        return redirect()->back()->with('success', 'Peminjaman telah disetujui.');
    }

    // 4. Fungsi Tolak Pinjaman (Hanya Admin)
    public function tolakPinjaman($id)
    {
        // PENGAMAN: Jika yang klik bukan admin, usir balik
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses admin!');
        }

        $history = Peminjaman::findOrFail($id);
        $history->update(['status' => 'ditolak']);

        return redirect()->back()->with('success', 'Permintaan peminjaman ditolak.');
    }

    // 5. Fungsi Kembalikan Barang
    public function kembali($id)
    {
        $history = Peminjaman::findOrFail($id);
        
        if ($history->status !== 'dipinjam') {
            return redirect()->back()->with('error', 'Barang ini tidak dalam status dipinjam.');
        }

        $history->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        $barang = Barang::find($history->barang_id);
        if ($barang) {
            $barang->increment('stok');
        }

        return redirect()->back()->with('success', 'Barang ' . $barang->nama_barang . ' telah dikembalikan.');
    }

    // 6. Fungsi Bersihkan Riwayat
    public function bersihkanRiwayat()
    {
        // User hanya menghapus riwayat miliknya, Admin bisa menghapus semua yang selesai
        $query = Peminjaman::whereIn('status', ['dikembalikan', 'ditolak']);
        
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $query->delete();

        return redirect()->back()->with('success', 'Riwayat berhasil dibersihkan.');
    }
}