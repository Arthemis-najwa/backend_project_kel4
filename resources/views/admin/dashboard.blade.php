@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-3 gap-5">
        <div class="bg-white rounded-md shadow-sm p-5 flex items-center justify-between">
            <div class="flex flex-col gap-1">
                <span class="text-orange-500 poppins-medium text-3xl">58</span>
                <span class="text-orange-500">Pelamar</span>
            </div>
            <img src="/imgs/candidate (1) 1.png" alt="">
        </div>
        <div class="bg-white rounded-md shadow-sm p-5 flex items-center justify-between">
            <div class="flex flex-col gap-1">
                <span class="text-orange-500 poppins-medium text-3xl">18</span>
                <span class="text-orange-500">Lowongan Pekerjaan</span>
            </div>
            <img src="/imgs/Job Seeker.png" alt="">
        </div>
        <div class="bg-white rounded-md shadow-sm p-5 flex items-center justify-between">
            <div class="flex flex-col gap-1">
                <span class="text-orange-500 poppins-medium text-3xl">58</span>
                <span class="text-orange-500">Perusahaan</span>
            </div>
            <img src="/imgs/Company.png" alt="">
        </div>
    </div>

    <div class="mt-10 bg-white rounded-md shadow-sm p-5">
        <h1 class="text-lg text-gray-400 poppins-medium border-b-2 border-gray-200 pb-3">Data Pelamar Terbaru</h1>
        <div class="relative overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-[#52D8A7]">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Usia
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jenis Kelamin
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pendidikan Terakhir
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jurusan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Perusahaan Tujuan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="mt-10 bg-white rounded-md shadow-sm p-5">
        <h1 class="text-lg text-gray-400 poppins-medium border-b-2 border-gray-200 pb-3">Data Lowongan Pekerjaan Terbaru
        </h1>
        <div class="relative overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-[#52D8A7]">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Posisi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Perusahaan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Dibuka
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Ditutup
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="mt-10 bg-white rounded-md shadow-sm p-5">
        <h1 class="text-lg text-gray-400 poppins-medium border-b-2 border-gray-200 pb-3">Data Perusahaan Terbaru
        </h1>
        <div class="relative overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-[#52D8A7]">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama Perusahaan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Bidang Usaha
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kontak
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lokasi
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
