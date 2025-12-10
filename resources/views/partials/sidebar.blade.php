
<aside class="bg-blue-100 w-[280px] fixed left-0 top-0 h-dvh shadow-lg" id="sidebar">
    <div class="flex justify-center items-center gap-3 p-5 border-b border-blue-200">
        <img class="size-12" src="/imgs/logo.png" alt="">
        <span class="text-orange-400 text-2xl poppins-semibold">CIPTA KARIR</span>
    </div>

    <div class="mt-5">
        <a href="{{ route('dashboard') }}"
            class="{{ request()->is('dashboard') ? 'bg-gray-50 text-orange-400' : 'text-blue-600 hover:bg-blue-50 hover:text-blue-800' }} ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5 relative transition-all duration-200 group">
            <i class="fa-regular fa-house w-[20px] group-hover:scale-110 transition-transform"></i>
            <span class="poppins-medium">Dashboard</span>

            @php
                $isActive = request()->is('dashboard');
            @endphp

            @if ($isActive)
                <div class="size-10 bg-blue-100 rounded-full absolute -top-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -top-5 -right-2 z-10"></div>

                <div class="size-10 bg-blue-100 rounded-full absolute -bottom-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -bottom-5 -right-2 z-10"></div>
            @endif
        </a>
        <a href="{{ route('perusahaan') }}"
            class="{{ request()->is('perusahaan') ? 'bg-gray-50 text-orange-400' : 'text-blue-600 hover:bg-blue-50 hover:text-blue-800' }} ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5 relative transition-all duration-200 group">
            <i class="fa-regular fa-building w-[20px] group-hover:scale-110 transition-transform"></i>
            <span class="poppins-medium">Perusahaan</span>

            @php
                $isActive = request()->is('perusahaan');
            @endphp

            @if ($isActive)
                <div class="size-10 bg-blue-100 rounded-full absolute -top-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -top-5 -right-2 z-10"></div>

                <div class="size-10 bg-blue-100 rounded-full absolute -bottom-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -bottom-5 -right-2 z-10"></div>
            @endif
        </a>
         <a href="{{ route('lowongan-pekerjaan') }}"
            class="{{ request()->is('lowongan-pekerjaan') ? 'bg-gray-50 text-orange-400' : 'text-blue-600 hover:bg-blue-50 hover:text-blue-800' }} ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5 relative transition-all duration-200 group">
            <i class="fa-regular fa-magnifying-glass w-[20px] group-hover:scale-110 transition-transform"></i>
            <span class="poppins-medium">Lowongan Pekerjaan</span>

            @php
                $isActive = request()->is('lowongan-pekerjaan');
            @endphp

            @if ($isActive)
                <div class="size-10 bg-blue-100 rounded-full absolute -top-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -top-5 -right-2 z-10"></div>

                <div class="size-10 bg-blue-100 rounded-full absolute -bottom-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -bottom-5 -right-2 z-10"></div>
            @endif
        </a>
        <a href="{{ route('pelamar') }}"
            class="{{ request()->is('pelamar') ? 'bg-gray-50 text-orange-400' : 'text-blue-600 hover:bg-blue-50 hover:text-blue-800' }} ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5 relative transition-all duration-200 group">
            <i class="fa-regular fa-users w-[20px] group-hover:scale-110 transition-transform"></i>
            <span class="poppins-medium">Pelamar</span>

            @php
                $isActive = request()->is('pelamar');
            @endphp

            @if ($isActive)
                <div class="size-10 bg-blue-100 rounded-full absolute -top-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -top-5 -right-2 z-10"></div>

                <div class="size-10 bg-blue-100 rounded-full absolute -bottom-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -bottom-5 -right-2 z-10"></div>
            @endif
        </a>
        <a href="{{ route('arsip-data-pelamar') }}"
            class="{{ request()->is('arsip-data-pelamar') ? 'bg-gray-50 text-orange-400' : 'text-blue-600 hover:bg-blue-50 hover:text-blue-800' }} ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5 relative transition-all duration-200 group">
            <i class="fa-regular fa-box-archive w-[20px] group-hover:scale-110 transition-transform"></i>
            <span class="poppins-medium">Arsip Data Pelamar</span>

            @php
                $isActive = request()->is('arsip-data-pelamar');
            @endphp

            @if ($isActive)
                <div class="size-10 bg-blue-100 rounded-full absolute -top-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -top-5 -right-2 z-10"></div>

                <div class="size-10 bg-blue-100 rounded-full absolute -bottom-10 right-0 z-20"></div>
                <div class="size-8 bg-gray-50 absolute -bottom-5 -right-2 z-10"></div>
            @endif
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
    <a href="#" id="btn-logout"
   class="ms-4 ps-6 p-5 rounded-tl-full rounded-bl-full flex gap-3 items-center mb-5 text-blue-600 hover:bg-blue-50 hover:text-blue-800 transition-all duration-200 group">
    <i class="fa-regular fa-left-from-bracket w-[20px] group-hover:scale-110 transition-transform"></i>
    <span class="poppins-medium">Keluar</span>
</a>
</form>
    </div>
</aside>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('btn-logout').addEventListener('click', function(e) {
        e.preventDefault();

        Swal.fire({
            title: "Keluar?",
            text: "Apakah Anda yakin ingin logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Logout",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>
