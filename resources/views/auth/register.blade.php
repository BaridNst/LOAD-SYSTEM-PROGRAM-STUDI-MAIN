<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border-t-4 border-green-600">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Akun Baru</h2>
                <p class="text-sm text-gray-600">Sistem Inventaris Kelompok 4</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <label class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required />
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">Email</label>
                    <input type="email" name="email" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required />
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">Password</label>
                    <input type="password" name="password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required />
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-gray-600 hover:underline" href="{{ route('login') }}">
                        Sudah ada akun? Login
                    </a>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                        Daftar Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>