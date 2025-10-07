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
            <button class="px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    <i class="fa fa-plus"></i>                 Tambah Pelamar
            </button>
        </div>

        <div class="relative overflow-x-auto rounded-xl">
            <table class="w-full text-sm text-left text-gray-700 border border-gray-200">
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
                            <span
                                class="bg-yellow-400 text-white px-4 py-1 rounded-full text-xs font-semibold shadow-md">Waiting
                                List</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>

                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">2</td>
                        <td class="px-6 py-4 font-medium text-gray-900">Jane Smith</td>
                        <td class="px-6 py-4">28</td>
                        <td class="px-6 py-4">Perempuan</td>
                        <td class="px-6 py-4">S1</td>
                        <td class="px-6 py-4">Desain Komunikasi Visual</td>
                        <td class="px-6 py-4">PT XYZ Creative</td>
                        <td class="px-6 py-4">
                            <span
                                class="bg-purple-500 text-white px-4 py-1 rounded-full text-xs font-semibold shadow-md">Interview</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>

                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">3</td>
                        <td class="px-6 py-4 font-medium text-gray-900">Mike Johnson</td>
                        <td class="px-6 py-4">30</td>
                        <td class="px-6 py-4">Laki-laki</td>
                        <td class="px-6 py-4">S2</td>
                        <td class="px-6 py-4">Teknik Informatika</td>
                        <td class="px-6 py-4">PT DEF Solutions</td>
                        <td class="px-6 py-4">
                            <span
                                class="bg-green-500 text-white px-4 py-1 rounded-full text-xs font-semibold shadow-md">Diterima</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>

                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">4</td>
                        <td class="px-6 py-4 font-medium text-gray-900">Sarah Wilson</td>
                        <td class="px-6 py-4">32</td>
                        <td class="px-6 py-4">Perempuan</td>
                        <td class="px-6 py-4">S2</td>
                        <td class="px-6 py-4">Manajemen Bisnis</td>
                        <td class="px-6 py-4">PT GHI Corp</td>
                        <td class="px-6 py-4">
                            <span
                                class="bg-orange-400 text-white px-4 py-1 rounded-full text-xs font-semibold shadow-md">Pelatihan</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>

                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">5</td>
                        <td class="px-6 py-4 font-medium text-gray-900">Alex Brown</td>
                        <td class="px-6 py-4">27</td>
                        <td class="px-6 py-4">Laki-laki</td>
                        <td class="px-6 py-4">S1</td>
                        <td class="px-6 py-4">Sistem Informasi</td>
                        <td class="px-6 py-4">PT JKL Systems</td>
                        <td class="px-6 py-4">
                            <span
                                class="bg-blue-500 text-white px-4 py-1 rounded-full text-xs font-semibold shadow-md">Medical
                                Check Up</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                </tbody>

            </table>
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
