<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl text-gray-800 tracking-tight flex items-center">
                <img src="{{ asset('HIMA-TI.png?v=1') }}" class="h-10 w-auto mr-3" alt="Logo HIMA-TI">
                {{ __('Pengaturan Akun Prodi Teknologi Informasi') }}
            </h2>
            <div class="hidden md:flex bg-orange-500 text-white px-5 py-2 rounded-full shadow-lg shadow-orange-200 items-center animate-pulse">
                <span class="text-xs font-black uppercase tracking-widest">TEKNOKOGI INFORMASI ADMINISTRATOR</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-[#fdfdfd]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative mb-24">
                <div class="h-56 w-full bg-[#f39200] rounded-[3rem] shadow-2xl relative overflow-hidden">
                    <div class="absolute -right-20 -top-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute -left-10 -bottom-10 w-60 h-60 bg-black/5 rounded-full blur-2xl"></div>
                </div>
                
                <div class="absolute -bottom-16 left-12 flex items-end">
                    <div class="relative group">
                        <div class="h-40 w-40 bg-white rounded-[2.5rem] p-3 shadow-2xl">
                            <div class="h-full w-full bg-gray-50 rounded-[1.8rem] flex items-center justify-center border-4 border-orange-100 overflow-hidden">
                                <img src="{{ asset('HIMA-TI.png?v='.time()) }}" class="w-24 h-24 object-contain" alt="HIMA-TI">
                            </div>
                        </div>
                        <div class="absolute bottom-2 right-2 bg-green-500 h-8 w-8 rounded-2xl border-4 border-white shadow-xl"></div>
                    </div>
                    
                    <div class="ml-8 mb-6">
                        <h1 class="text-4xl font-black text-gray-900 tracking-tighter uppercase leading-none">{{ Auth::user()->name }}</h1>
                        <div class="flex space-x-3 mt-3">
                            <span class="px-4 py-1.5 bg-orange-600 text-white text-[10px] font-black rounded-xl shadow-md uppercase tracking-wider italic">INVENTARIS OFFICER</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <div class="lg:col-span-4">
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-gray-100/50 border border-gray-50">
                        <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-10">Kontrol Panel</h3>
                        <nav class="space-y-3">
                            <a href="#info" class="flex items-center justify-between p-4 bg-orange-600 text-white rounded-2xl shadow-lg shadow-orange-200">
                                <span class="font-black text-sm uppercase">Identitas Diri</span>
                            </a>
                        </nav>
                    </div>
                </div>

                <div class="lg:col-span-8 space-y-10">
                    <div id="info" class="bg-white rounded-[3rem] shadow-sm border border-gray-100 p-10">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                    <div id="password" class="bg-white rounded-[3rem] shadow-sm border border-gray-100 p-10">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>