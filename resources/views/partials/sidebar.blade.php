<aside class="bg-blue-500 w-[280px] fixed left-0 top-0 h-dvh" id="sidebar">
    <div class="flex justify-center items-center gap-3 p-5">
        <img class="size-12" src="/imgs/logo.png" alt="">
        <span class="text-orange-400 text-2xl poppins-semibold">CIPTA KARIR</span>
    </div>

    <div class="mt-5">
        <a href="{{ route('dashboard') }}"
            class="{{ request()->is('dashboard') ? 'bg-gray-50 text-orange-400' : 'text-white' }} ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5 relative">
            <i class="fa-regular fa-house w-[20px]"></i>
            <span class="poppins-medium">Dashboard</span>

            @php
                $isActive = request()->is('dashboard');
            @endphp

            @if ($isActive)
                <div class="size-10 bg-blue-500 rounded-full absolute -top-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -top-5 -right-2 z-10"></div>

                <div class="size-10 bg-blue-500 rounded-full absolute -bottom-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -bottom-5 -right-2 z-10"></div>
            @endif
        </a>
        <a href="{{ route('pelamar') }}"
            class="{{ request()->is('pelamar') ? 'text-orange-400 bg-gray-50' : 'text-white' }} ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5 relative">
            <i class="fa-regular fa-users w-[20px]"></i>
            <span class="poppins-medium">Pelamar</span>

            @php
                $isActive = request()->is('pelamar');
            @endphp

            @if ($isActive)
                <div class="size-10 bg-blue-500 rounded-full absolute -top-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -top-5 -right-2 z-10"></div>

                <div class="size-10 bg-blue-500 rounded-full absolute -bottom-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -bottom-5 -right-2 z-10"></div>
            @endif
        </a>
        <a href="{{ route('lowongan-pekerjaan') }}"
            class="{{ request()->is('lowongan-pekerjaan') ? 'bg-gray-50 text-orange-400' : 'text-white' }} ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5 relative">
            <i class="fa-regular fa-magnifying-glass w-[20px]"></i>
            <span class="poppins-medium">Lowongan Pekerjaan</span>

            @php
                $isActive = request()->is('lowongan-pekerjaan');
            @endphp

            @if ($isActive)
                <div class="size-10 bg-blue-500 rounded-full absolute -top-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -top-5 -right-2 z-10"></div>

                <div class="size-10 bg-blue-500 rounded-full absolute -bottom-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -bottom-5 -right-2 z-10"></div>
            @endif
        </a>
        <a href="{{ route('perusahaan') }}"
            class="{{ request()->is('perusahaan') ? 'bg-gray-50 text-orange-400' : 'text-white' }} ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5 relative">
            <i class="fa-regular fa-building w-[20px]"></i>
            <span class="poppins-medium">Perusahaan</span>

            @php
                $isActive = request()->is('perusahaan');
            @endphp

            @if ($isActive)
                <div class="size-10 bg-blue-500 rounded-full absolute -top-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -top-5 -right-2 z-10"></div>

                <div class="size-10 bg-blue-500 rounded-full absolute -bottom-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -bottom-5 -right-2 z-10"></div>
            @endif
        </a>
        <a href="{{ route('arsip-data-pelamar') }}"
            class="{{ request()->is('arsip-data-pelamar') ? 'bg-gray-50 text-orange-400' : 'text-white' }} ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5 relative">
            <i class="fa-regular fa-box-archive w-[20px]"></i>
            <span class="poppins-medium">Arsip Data Pelamar</span>

            @php
                $isActive = request()->is('arsip-data-pelamar');
            @endphp

            @if ($isActive)
                <div class="size-10 bg-blue-500 rounded-full absolute -top-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -top-5 -right-2 z-10"></div>

                <div class="size-10 bg-blue-500 rounded-full absolute -bottom-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -bottom-5 -right-2 z-10"></div>
            @endif
        </a>
        <a href="{{ route('logout') }}"
            class="ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5">
            <i class="fa-regular fa-left-from-bracket w-[20px] text-white"></i>
            <span class="poppins-medium text-white">Keluar</span>
        </a>
    </div>
</aside>
