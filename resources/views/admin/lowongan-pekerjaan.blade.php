@extends('layouts.admin')

@section('content')
    <h1 class="text-xl">Lowongan Pekerjaan</h1>

    <div class="bg-white rounded-xl shadow-md p-6 mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Lowongan Pekerjaan</h2>
            <button class="px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
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
@endsection
