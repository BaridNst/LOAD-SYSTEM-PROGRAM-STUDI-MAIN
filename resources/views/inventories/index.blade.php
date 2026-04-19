<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sistem Peminjaman Inventaris Prodi') }}
            </h2>
            <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-xl shadow-lg transition font-bold">
                + Tambah Barang
            </button>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-200">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="p-4 text-xs font-bold uppercase text-gray-500">Kode</th>
                            <th class="p-4 text-xs font-bold uppercase text-gray-500">Nama Barang</th>
                            <th class="p-4 text-xs font-bold uppercase text-gray-500">Kategori</th>
                            <th class="p-4 text-xs font-bold uppercase text-gray-500">Status</th>
                            <th class="p-4 text-xs font-bold uppercase text-gray-500 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($items as $item)
                        <tr class="hover:bg-orange-50/50 transition">
                            <td class="p-4 font-bold text-orange-600 font-mono">{{ $item->item_code }}</td>
                            <td class="p-4 font-semibold text-gray-800">{{ $item->name }}</td>
                            <td class="p-4 text-gray-600">{{ $item->category }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase">Tersedia</span>
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('inventories.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus data peminjaman ini?')" class="text-red-500 font-bold hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-400 font-bold italic underline">Data Inventaris Masih Kosong! Silakan Tambah Data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modalTambah" class="fixed inset-0 z-50 hidden bg-gray-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8">
            <h3 class="text-2xl font-black text-gray-800 mb-6">Tambah Inventaris</h3>
            <form action="{{ route('inventories.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <input type="text" name="item_code" placeholder="Kode Barang (Contoh: BRG-01)" class="w-full rounded-xl border-gray-200 p-3" required>
                    <input type="text" name="name" placeholder="Nama Barang" class="w-full rounded-xl border-gray-200 p-3" required>
                    <input type="text" name="category" placeholder="Kategori (Elektronik/Meja/Kursi)" class="w-full rounded-xl border-gray-200 p-3" required>
                </div>
                <div class="mt-8 flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-gray-400 font-bold">Batal</button>
                    <button type="submit" class="bg-orange-600 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-orange-200 hover:bg-orange-700 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>