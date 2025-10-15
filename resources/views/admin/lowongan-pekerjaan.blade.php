@extends('layouts.admin')

@section('content')
    <h1 class="text-xl">Lowongan Pekerjaan</h1>

    <div class="bg-white rounded-xl shadow-md p-6 mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Lowongan Pekerjaan</h2>
            <button data-modal-target="tambahLowonganModal" data-modal-toggle="tambahLowonganModal"
                class="px-4 py-3 bg-orange-400 text-white rounded-lg hover:bg-orange-500 transition">
                <i class="fa fa-plus"></i> Tambah Lowongan
            </button>
        </div>

        <div class="relative overflow-x-auto rounded-xl">
            <table class="w-full text-sm text-left text-gray-700 border border-gray-200">
                <thead class="bg-green-500 text-white uppercase text-xs">
                    <tr>
                        <th scope="col" class="px-6 py-3 border-gray-200">Posisi</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Perusahaan</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Tanggal Dibuka</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Tanggal Ditutup</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">Staff Marketing</td>
                        <td class="px-6 py-4">PT Unilever Indonesia Tbk</td>
                        <td class="px-6 py-4">15 September 2025</td>
                        <td class="px-6 py-4">30 September 2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <div id="tambahLowonganModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Lowongan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="tambahLowonganModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6-6M7 7l6 6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <form class="p-4 space-y-4">
                    <div>
                        <label for="posisi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Posisi</label>
                        <input type="text" id="posisi" name="posisi" placeholder="Contoh: Staff Administrasi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            required>
                    </div>

                    <div>
                        <label for="companies"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Perusahaan</label>
                        <input type="text" id="companies" name="companies" placeholder="Contoh: PT Maju Jaya"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                            required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="tanggal_dibuka"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Dibuka</label>
                            <input type="date" id="tanggal_dibuka" name="tanggal_dibuka"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label for="tanggal_ditutup"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Ditutup</label>
                            <input type="date" id="tanggal_ditutup" name="tanggal_ditutup"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                required>
                        </div>
                    </div>

                    {{-- <div>
                        <label for="deskripsi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Pekerjaan</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Tulis deskripsi pekerjaan..."
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"></textarea>
                    </div> --}}
                </form>

                <!-- Footer -->
                <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="tambahLowonganModal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">
                        Batal
                    </button>
                    <button type="submit"
                        class="ms-3 text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
