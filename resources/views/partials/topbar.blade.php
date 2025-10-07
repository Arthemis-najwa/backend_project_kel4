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
    <div class="flex-[1] flex justify-end">
        <div class="relative">
            <button id="dropdownButton" data-dropdown-toggle="dropdown"
                class="size-12 bg-gray-300 rounded-full cursor-pointer" type="button"></button>
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownButton">
                    <li>
                        <a href="/change-password" class="block px-4 py-2 hover:bg-gray-100">Change Password</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
