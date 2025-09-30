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
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            Renjana Putra Wicaksono
                        </td>
                        <td class="px-6 py-4">
                            25
                        </td>
                        <td class="px-6 py-4">
                            Laki-laki
                        </td>
                        <td class="px-6 py-4">
                            S1
                        </td>
                        <td class="px-6 py-4">
                            Psikologi
                        </td>
                        <td class="px-6 py-4">
                            PT Unilever Indonesia Tbk
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            Saga Mahawira
                        </td>
                        <td class="px-6 py-4">
                            27
                        </td>
                        <td class="px-6 py-4">
                            Laki-laki
                        </td>
                        <td class="px-6 py-4">
                            S1
                        </td>
                        <td class="px-6 py-4">
                            Teknik Mesin
                        </td>
                        <td class="px-6 py-4">
                            PT United Tractors Tbk
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            Jeano Aldebaran
                        </td>
                        <td class="px-6 py-4">
                            25
                        </td>
                        <td class="px-6 py-4">
                            Laki-laki
                        </td>
                        <td class="px-6 py-4">
                            S1
                        </td>
                        <td class="px-6 py-4">
                            Teknik Sipil
                        </td>
                        <td class="px-6 py-4">
                            Dian Swastatika Sentosa Tbk
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            Nilano Wijaya Kusumo
                        </td>
                        <td class="px-6 py-4">
                            28
                        </td>
                        <td class="px-6 py-4">
                            Laki-laki
                        </td>
                        <td class="px-6 py-4">
                            S1
                        </td>
                        <td class="px-6 py-4">
                            Sastra Inggris
                        </td>
                        <td class="px-6 py-4">
                            PT Erajaya Swasembada Tbk
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            Theodore Dirgantara
                        </td>
                        <td class="px-6 py-4">
                            21
                        </td>
                        <td class="px-6 py-4">
                            Laki-laki
                        </td>
                        <td class="px-6 py-4">
                            S1
                        </td>
                        <td class="px-6 py-4">
                            Teknik Informatika
                        </td>
                        <td class="px-6 py-4">
                            PT Astra Internasional Tbk
                        </td>
                    </tr>
                </tbody>
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
                <tbody>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            Staff Marketing
                        </td>
                        <td class="px-6 py-4">
                            PT Unilever Indonesia Tbk
                        </td>
                        <td class="px-6 py-4">
                            15 September 2025
                        </td>
                        <td class="px-6 py-4">
                            30 September 2025
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            Operator Produksi
                        </td>
                        <td class="px-6 py-4">
                            PT United Tractors Tbk
                        </td>
                        <td class="px-6 py-4">
                            15 September 2025
                        </td>
                        <td class="px-6 py-4">
                            30 September 2025
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            Software Engineer
                        </td>
                        <td class="px-6 py-4">
                            Dian Swastatika Sentosa Tbk
                        </td>
                        <td class="px-6 py-4">
                            15 September 2025
                        </td>
                        <td class="px-6 py-4">
                            28 September 2025
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            Staff Administrasi
                        </td>
                        <td class="px-6 py-4">
                            PT Erajaya Swasembada Tbk
                        </td>
                        <td class="px-6 py-4">
                            15 September 2025
                        </td>
                        <td class="px-6 py-4">
                            28 September 2025
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            Manager Keuangan
                        </td>
                        <td class="px-6 py-4">
                            PT Astra Internasional Tbk
                        </td>
                        <td class="px-6 py-4">
                            15 September 2025
                        </td>
                        <td class="px-6 py-4">
                            30 September 2025
                        </td>
                    </tr>
                </tbody>
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
                <tbody>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            PT Unilever Indonesia Tbk
                        </td>
                        <td class="px-6 py-4">
                            Manufaktur, & Pemasaran
                        </td>
                        <td class="px-6 py-4">
                            0123-4567-8910
                        </td>
                        <td class="px-6 py-4">
                            Kota bekasi, jawa barat
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            PT United Tractors Tbk
                        </td>
                        <td class="px-6 py-4">
                            Pertambangan, & Konstruksi
                        </td>
                        <td class="px-6 py-4">
                            emailperusahaan@gmail.com
                        </td>
                        <td class="px-6 py-4">
                            Kota jakarta timur, jakarta
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            Dian Swastatika Sentosa Tbk
                        </td>
                        <td class="px-6 py-4">
                            Pertambangan & Perdagangan
                        </td>
                        <td class="px-6 py-4">
                            0123-4567-8910
                        </td>
                        <td class="px-6 py-4">
                            Kota jakarta Pusat, jakarta
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            PT Erajaya Swasembada Tbk
                        </td>
                        <td class="px-6 py-4">
                            Distribusi & Ritel produk
                        </td>
                        <td class="px-6 py-4">
                            0123-4567-8910
                        </td>
                        <td class="px-6 py-4">
                            Kota jakarta Barat, jakarta
                        </td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            PT Astra Internasional Tbk
                        </td>
                        <td class="px-6 py-4">
                            Otomotif & Infrastruktur
                        </td>
                        <td class="px-6 py-4">
                            emailperusahaan@gmail.com
                        </td>
                        <td class="px-6 py-4">
                            Kota karawang, jawa barat
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
