<nav class="bg-gray-50 z-10 p-5 px-10 h-[90px] left-[320px] w-[calc(100%-320px)] flex items-center fixed top-0">
    <div class="flex flex-col gap-1.5 flex-[1]">
        <hr class="border-2 border-blue-500 w-[25px]">
        <hr class="border-2 border-blue-500 w-[25px]">
        <hr class="border-2 border-blue-500 w-[25px]">
    </div>
    <div class="flex-[10]">
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <i class="fa-regular fa-magnifying-glass text-gray-400"></i>
            </div>
            <input type="text" id="simple-search"
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block ps-10 p-2.5 w-full"
                placeholder="Cari disini..." required />
        </div>
    </div>

    <!-- Profil dropdown -->
    <div class="flex-[1] flex justify-end relative">
        <button id="profileButton" class="size-12 bg-gray-300 rounded-full flex items-center justify-center focus:outline-none">
            <i class="fa-regular fa-user text-gray-600"></i>
        </button>

        <!-- Dropdown Menu -->
        <div id="dropdownMenu"
            class="hidden absolute top-[70px] right-0 w-48 bg-white border border-gray-200 rounded-lg shadow-md py-2 z-20">
            <a href="{{ route('password.request') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 text-sm">
                <i class="fa-regular fa-key mr-2"></i> Ganti Password
            </a>
>>>>>>> Stashed changes
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const profileButton = document.getElementById('profileButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    profileButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    // Tutup dropdown jika klik di luar area
    document.addEventListener('click', (e) => {
        if (!profileButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});
</script>

</nav>
