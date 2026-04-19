<section>
    <header>
        <h2 class="text-lg font-black text-gray-800 uppercase tracking-tight">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-500 font-medium">
            {{ __("Perbarui informasi profil akun dan alamat email Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Input Nama --}}
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="font-bold text-gray-700" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Input Email --}}
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="font-bold text-gray-700" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-gray-200 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-orange-600 hover:text-orange-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 font-bold">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Tombol Simpan (Update Sesuai Request Anda) --}}
        <div class="flex items-center gap-4">
            <x-primary-button class="bg-orange-600 hover:bg-orange-700 active:bg-orange-800 transition duration-300 ease-in-out shadow-lg shadow-orange-200 py-3 px-6 rounded-xl font-black uppercase tracking-widest text-xs">
                {{ __('Simpan Perubahan') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-bold flex items-center"
                >
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ __('Berhasil Disimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>