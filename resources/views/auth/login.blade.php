<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
        
        <div class="mb-8 flex flex-col items-center">
            <div class="bg-orange-600 p-4 rounded-2xl shadow-lg shadow-orange-200 mb-4">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-black tracking-tighter text-gray-800">
                LOAD<span class="text-orange-600">SYSTEM</span>
            </h1>
            <p class="text-gray-500 text-sm font-medium mt-1">Sistem Inventaris & Peminjaman Prodi</p>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-xl rounded-3xl border border-gray-100">
            
            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-800">Selamat Datang Kembali</h2>
                <p class="text-gray-500 text-sm">Silakan masuk untuk mengelola data barang.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block font-bold text-xs uppercase text-gray-500 tracking-wider mb-2 ml-1">Email Pengguna</label>
                    <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-200 focus:border-orange-500 focus:ring-orange-500 p-3 shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <label for="password" class="block font-bold text-xs uppercase text-gray-500 tracking-wider mb-2 ml-1">Kata Sandi</label>
                    <x-text-input id="password" class="block mt-1 w-full rounded-xl border-gray-200 focus:border-orange-500 focus:ring-orange-500 p-3 shadow-sm"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mt-4 ml-1">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded-md border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600 italic">Ingat akun saya</span>
                    </label>
                </div>

                <div class="flex flex-col gap-4 mt-8">
                    <x-primary-button class="w-full justify-center py-3 bg-orange-600 hover:bg-orange-700 rounded-xl shadow-lg shadow-orange-200 text-base font-bold transition">
                        {{ __('Masuk Ke Sistem') }}
                    </x-primary-button>
                    
                    @if (Route::has('register'))
                        <a class="text-sm text-center text-orange-600 font-bold hover:text-orange-800 transition" href="{{ route('register') }}">
                            {{ __('Belum punya akun? Daftar Sekarang') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="mt-8 text-center">
            <p class="text-xs text-gray-400 font-medium tracking-widest uppercase">© 2025 Kelompok 4 UAS Laravel</p>
        </div>
    </div>
</x-guest-layout>