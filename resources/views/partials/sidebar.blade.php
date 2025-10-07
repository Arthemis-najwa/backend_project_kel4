<aside class="bg-blue-500 w-[320px] fixed left-0 top-0 h-dvh">
    <div class="flex justify-center items-center gap-3 p-5">
        <img class="size-12" src="/imgs/logo.png" alt="">
        <span class="text-orange-400 text-2xl poppins-semibold">CIPTA KARIR</span>
    </div>

    <div class="mt-5">
        <a href="{{ route('dashboard') }}"
            class="{{ request()->is('dashboard') ? 'bg-gray-50 text-orange-400' : 'text-white' }} ms-5 ps-8 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5">
            {{-- <img class="w-[20px]" src="/imgs/home.png" alt=""> --}}
            <i class="fa-regular fa-house w-[20px]"></i>
            <span class="poppins-medium">Dashboard</span>
        </a>
        <a href="{{ route('pelamar') }}"
            class="{{ request()->is('pelamar') ? 'text-orange-400 bg-gray-50' : 'text-white' }} ms-5 ps-8 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5">
            <div class="w-[20px]"></div>
            <span class="poppins-medium">Pelamar</span>
        </a>
        <a href="{{ route('lowongan-pekerjaan') }}"
            class="{{ request()->is('lowongan-pekerjaan') ? 'bg-gray-50 text-orange-400' : 'text-white' }} ms-5 ps-8 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5">
            <div class="w-[20px]"></div>
            <span class="poppins-medium">Lowongan Pekerjaan</span>
        </a>
        <a href="{{ route('perusahaan') }}"
            class="{{ request()->is('perusahaan') ? 'bg-gray-50 text-orange-400' : 'text-white' }} ms-5 ps-8 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5">
            <div class="w-[20px]"></div>
            <span class="poppins-medium">Perusahaan</span>
        </a>
        <a href="{{ route('arsip-data-pelamar') }}"
            class="{{ request()->is('arsip-data-pelamar') ? 'bg-gray-50 text-orange-400' : 'text-white' }} ms-5 ps-8 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5">
            <div class="w-[20px]"></div>
            <span class="poppins-medium">Arsip Data Pelamar</span>
        </a>
         <a href="{{ route('change-password') }}"
            class="{{ request()->is('change-password') ? 'bg-gray-50 text-orange-400' : 'text-white' }} ms-5 ps-8 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5">
            <div class="w-[20px]"></div>
            <span class="poppins-medium">Ganti Password</span>
        </a>
        <a href="{{ route('logout') }}"
            class="ms-5 ps-8 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5">
            <div class="w-[20px]"></div>
            <span class="poppins-medium text-white">Keluar</span>
        </a>
    </div>
</aside>
