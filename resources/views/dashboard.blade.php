<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Alert Notifikasi --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r-lg text-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 shadow-sm rounded-r-lg text-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            {{-- Welcome Banner --}}
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 overflow-hidden shadow-xl sm:rounded-2xl mb-8">
                <div class="p-6 md:p-10 text-white flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl md:text-4xl font-extrabold tracking-tight">Halo, {{ Auth::user()->name }}!</h1>
                        <p class="mt-2 md:mt-3 text-sm md:text-lg opacity-90 text-orange-50">
                            Selamat datang di <span class="font-bold">LOADSYSTEM</span>. 
                            Role: <span class="uppercase px-2 py-0.5 bg-orange-700 rounded text-xs font-bold">{{ Auth::user()->role }}</span>
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-24 h-24 opacity-20" fill="currentColor" viewBox="0 0 20 20"><path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 000.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 000.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-0.553-.894l-4-2z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                
                {{-- Bagian Inventaris --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">Daftar Inventaris</h3>
                        <span class="px-3 py-1 bg-orange-100 text-orange-600 text-[10px] font-bold rounded-full tracking-widest uppercase">Live Data</span>
                    </div>

                    {{-- TAMPILAN MOBILE (Card Layout) --}}
                    <div class="md:hidden divide-y divide-gray-100">
                        @foreach($barangs as $b)
                        <div class="p-5 hover:bg-orange-50 transition duration-150">
                            <div class="flex justify-between items-start mb-3">
                                <div class="pr-2">
                                    <h4 class="font-bold text-gray-900 text-base leading-tight">{{ $b->nama_barang }}</h4>
                                    <div class="flex items-center text-xs text-gray-500 mt-2">
                                        <svg class="w-3.5 h-3.5 mr-1.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        {{ $b->nama_tempat }}
                                    </div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <span class="px-3 py-1 {{ $b->stok > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded-full text-[10px] font-extrabold uppercase whitespace-nowrap">
                                        {{ $b->stok }} Unit
                                    </span>
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                @if(Auth::user()->role == 'user')
                                    @if($b->stok > 0)
                                        <form action="{{ route('pinjam.barang', $b->id) }}" method="POST" onsubmit="return confirm('Pinjam barang ini?')">
                                            @csrf
                                            <button type="submit" class="w-full py-3 bg-orange-600 text-white text-xs font-bold rounded-xl hover:bg-orange-700 active:scale-[0.98] transition shadow-md shadow-orange-200 uppercase tracking-widest">
                                                Klik Untuk Pinjam
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="w-full py-3 bg-gray-200 text-gray-500 text-xs font-bold rounded-xl cursor-not-allowed uppercase">
                                            Stok Habis
                                        </button>
                                    @endif
                                @else
                                    <div class="w-full py-2.5 bg-gray-50 text-center rounded-xl border border-dashed border-gray-200">
                                        <span class="text-[10px] text-gray-400 italic font-medium uppercase tracking-tighter">Admin Mode: Viewing Only</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- TAMPILAN DESKTOP (Table Layout) --}}
                    <div class="hidden md:block">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50 text-gray-600 uppercase text-[10px] font-bold tracking-wider">
                                    <tr>
                                        <th class="px-6 py-4">Nama Barang</th>
                                        <th class="px-6 py-4">Lokasi Gedung</th>
                                        <th class="px-6 py-4 text-center">Tersedia</th>
                                        <th class="px-6 py-4 text-right">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-gray-700">
                                    @foreach($barangs as $b)
                                    <tr class="hover:bg-orange-50 transition duration-150">
                                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $b->nama_barang }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="inline-flex items-center text-gray-500">
                                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                                {{ $b->nama_tempat }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 {{ $b->stok > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded-full text-xs font-bold">
                                                {{ $b->stok }} Unit
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if(Auth::user()->role == 'user')
                                                @if($b->stok > 0)
                                                    <form action="{{ route('pinjam.barang', $b->id) }}" method="POST" onsubmit="return confirm('Pinjam barang ini?')">
                                                        @csrf
                                                        <button type="submit" class="px-4 py-2 bg-orange-600 text-white text-[10px] font-bold rounded-lg hover:bg-orange-700 transition shadow-sm">
                                                            PINJAM
                                                        </button>
                                                    </form>
                                                @else
                                                    <button disabled class="px-4 py-2 bg-gray-200 text-gray-400 text-[10px] font-bold rounded-lg cursor-not-allowed">
                                                        HABIS
                                                    </button>
                                                @endif
                                            @else
                                                <span class="text-[10px] text-gray-400 italic">Admin Access</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Tabel Riwayat --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">Riwayat</h3>
                        @if($histories->count() > 0)
                            <form action="{{ route('riwayat.bersihkan') }}" method="POST" onsubmit="return confirm('Bersihkan riwayat?')">
                                @csrf
                                <button type="submit" class="text-[10px] bg-red-50 text-red-600 px-2 py-1 rounded-md hover:bg-red-100 transition font-bold uppercase tracking-widest border border-red-100">
                                    Clear
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="max-h-[600px] overflow-y-auto">
                        <div class="divide-y divide-gray-100">
                            @forelse($histories as $h)
                                <div class="p-4 hover:bg-gray-50 transition">
                                    <div class="flex justify-between items-start mb-1">
                                        <span class="text-sm font-bold text-gray-800">{{ $h->user->name }}</span>
                                        <span class="text-[10px] text-gray-400 uppercase">{{ $h->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-600">Peminjaman: <span class="font-semibold text-gray-900">{{ $h->barang->nama_barang }}</span></p>
                                    
                                    <div class="flex flex-wrap items-center gap-2 mt-3">
                                        @if($h->status == 'pending')
                                            <span class="px-2 py-1 bg-orange-50 text-orange-600 text-[9px] font-bold rounded border border-orange-200 uppercase">PENDING</span>
                                        @elseif($h->status == 'dipinjam')
                                            <span class="px-2 py-1 bg-blue-50 text-blue-600 text-[9px] font-bold rounded border border-blue-200 uppercase">DIPINJAM</span>
                                        @elseif($h->status == 'ditolak')
                                            <span class="px-2 py-1 bg-red-50 text-red-600 text-[9px] font-bold rounded border border-red-200 uppercase">DITOLAK</span>
                                        @else
                                            <span class="px-2 py-1 bg-green-50 text-green-600 text-[9px] font-bold rounded border border-green-200 uppercase">KEMBALI</span>
                                        @endif

                                        @if(Auth::user()->role == 'admin' && $h->status == 'pending')
                                            <div class="flex gap-1 ml-auto">
                                                <form action="{{ route('admin.setujui', $h->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-2 py-1 bg-green-600 text-white text-[9px] font-bold rounded hover:bg-green-700 shadow-sm">ACC</button>
                                                </form>
                                                <form action="{{ route('admin.tolak', $h->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white text-[9px] font-bold rounded hover:bg-red-700 shadow-sm">NO</button>
                                                </form>
                                            </div>
                                        @endif

                                        @if($h->status == 'dipinjam')
                                            <form action="{{ route('kembali.barang', $h->id) }}" method="POST" class="ml-auto">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Kembalikan barang ini?')" class="text-[10px] font-bold text-orange-600 hover:text-orange-800 underline uppercase italic">
                                                    Return
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-10 text-center text-gray-400">
                                    <p class="text-sm italic">Kosong.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Status Sistem --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center md:text-left">
                <div class="flex flex-col md:flex-row items-center md:space-x-4">
                    <div class="bg-blue-100 p-3 rounded-2xl text-blue-600 mb-4 md:mb-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Sistem Terproteksi</h3>
                        <p class="text-sm text-gray-600">Akses hanya tersedia untuk personil terverifikasi.</p>
                    </div>
                </div>
                
                <div class="mt-6 flex items-center justify-center md:justify-start text-[10px] font-bold text-green-600 bg-green-50 px-4 py-2 rounded-xl inline-flex">
                    <span class="flex h-2 w-2 relative mr-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    DATABASE CONNECTED (STUDY PROGRAM ROOM)
                </div>
            </div>
        </div>
    </div>
</x-app-layout>