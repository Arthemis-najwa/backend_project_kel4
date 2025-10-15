@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Pelamar</h1>

    <!-- Statistik Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
            <h5 class="text-lg font-medium text-gray-700 mb-2">Pending</h5>
            <p class="text-gray-600">5 Pelamar</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
            <h5 class="text-lg font-medium text-gray-700 mb-2">Rejected</h5>
            <p class="text-gray-600">2 Pelamar</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
            <h5 class="text-lg font-medium text-gray-700 mb-2">Interview</h5>
            <p class="text-gray-600">3 Pelamar</p>
        </div>
    </div>

    <!-- Tabel Pelamar -->
    <div class="bg-white rounded-xl shadow-md p-6 mt-10 border border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Pelamar</h2>
            <button data-modal-target="tambahPelamarModal" data-modal-toggle="tambahPelamarModal"
                class="px-4 py-3 bg-orange-400 text-white rounded-lg hover:bg-orange-500 transition">
                <i class="fa fa-plus"></i> Tambah Pelamar
            </button>

        </div>

        <div class="relative overflow-x-auto rounded-xl">
            <table id="applicantsTable" class="w-full text-sm text-left text-gray-700 border border-gray-200">
                <thead class="bg-green-500 text-white uppercase text-xs">
                    <tr>
                        <th scope="col" class="px-6 py-3 border-gray-200">No</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Nama</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Usia</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Jenis Kelamin</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Pendidikan Terakhir</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Jurusan</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Perusahaan Tujuan</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Status</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">1</td>
                        <td class="px-6 py-4 font-medium text-gray-900">John Doe</td>
                        <td class="px-6 py-4">25</td>
                        <td class="px-6 py-4">Laki-laki</td>
                        <td class="px-6 py-4">S1</td>
                        <td class="px-6 py-4">Teknik Informatika</td>
                        <td class="px-6 py-4">PT ABC Technology</td>
                        <td class="px-6 py-4">
                            <span class="bg-yellow-400 text-white px-4 py-1 rounded-full text-xs font-semibold shadow-md">
                                Waiting List
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>




    <!-- Modal -->
    <div id="tambahPelamarModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Pelamar
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="tambahPelamarModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6-6M7 7l6 6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <form class="p-4 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="nama"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                            <input type="text" id="nama" name="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label for="usia"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usia</label>
                            <input type="number" id="usia" name="usia"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="jenis_kelamin"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                <option value="">-- Pilih --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label for="pendidikan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan
                                Terakhir</label>
                            <input type="text" id="pendidikan" name="pendidikan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="jurusan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                            <input type="text" id="jurusan" name="jurusan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        </div>
                        <div>
                            <label for="perusahaan"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Perusahaan
                                Tujuan</label>
                            <input type="text" id="perusahaan" name="perusahaan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        </div>
                    </div>

                    <div>
                        <label for="status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="">-- Pilih --</option>
                            <option value="Proses">Proses</option>
                            <option value="Diterima">Diterima</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                </form>

                <!-- Footer -->
                <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="tambahPelamarModal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Batal</button>
                    <button type="submit"
                        class="ms-3 text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>

@push('scripts')
    <script>
        if (document.getElementById("applicantsTable") && typeof simpleDatatables !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#applicantsTable", {
                searchable: true,
                sortable: true
            });
        }
    </script>
@endpush
