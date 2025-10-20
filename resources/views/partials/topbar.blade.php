<nav class="bg-gray-50 z-10 p-5 px-10 h-[90px] left-[280px] w-[calc(100%-320px)] flex items-center fixed top-0"
    id="topbar">
    <div class="flex flex-col gap-1.5 flex-[1] cursor-pointer" id="hamburger">
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
    <div class="flex-[1] flex justify-end">
        <div class="size-12 bg-gray-300 rounded-full"></div>
    </div>
</nav>
