@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Pendataan Perusahaan Yang Bekerja Sama</h1>


    <div class="flex justify-end">
        <a href=""
            class="px-8 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-400 hover:text-neutral-600 hover:border-orange-600 transition">Export</a>

    </div>
    <!-- Tabel Perusahaan -->
    <div class="bg-white rounded-xl shadow-md p-6 mt-6 border border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Menampilkan Semua Data Perusahaan</h2>
            <div>
                <button class="px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    <i class="fa fa-plus"></i> Tambah Perusahaan
                </button>
            </div>

        </div>

        <div class="relative overflow-x-auto rounded-xl">
            <table id="companyTable" class="w-full text-sm text-left text-gray-700 border border-gray-200">
                <thead class="bg-green-500 text-white uppercase text-xs">
                    <tr>
                        <th scope="col" class="px-6 py-3 border-gray-200">No</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Nama Perusahaan</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Bidang Usaha</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Kontak</th>
                        <th scope="col" class="px-6 py-3 border-gray-200">Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">1</td>
                        <td class="px-6 py-4 font-medium text-gray-900">PT Unilever Indonesia Tbk</td>
                        <td class="px-6 py-4">Manufaktur & Pemasaran</td>
                        <td class="px-6 py-4">0123-4567-8910</td>
                        <td class="px-6 py-4">Kota Bekasi, Jawa Barat</td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">2</td>
                        <td class="px-6 py-4 font-medium text-gray-900">PT United Tractors Tbk</td>
                        <td class="px-6 py-4">Pertambangan & Konstruksi</td>
                        <td class="px-6 py-4">Emailperusahaan@gmail.com</td>
                        <td class="px-6 py-4">Kota Jakarta Timur, DKI Jakarta</td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">3</td>
                        <td class="px-6 py-4 font-medium text-gray-900">Dian Swastatika Sentosa Tbk</td>
                        <td class="px-6 py-4">Pertambangan & Perdagangan</td>
                        <td class="px-6 py-4">0123-4567-8910</td>
                        <td class="px-6 py-4">Kota Jakarta Pusat, DKI Jakarta</td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">4</td>
                        <td class="px-6 py-4 font-medium text-gray-900">PT Erajaya Swasembada Tbk</td>
                        <td class="px-6 py-4">Distribusi & Ritel Produk</td>
                        <td class="px-6 py-4">0123-4567-8910</td>
                        <td class="px-6 py-4">Kota Jakarta Barat, DKI Jakarta</td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">5</td>
                        <td class="px-6 py-4 font-medium text-gray-900">PT Astra Internasional Tbk</td>
                        <td class="px-6 py-4">Otomotif & Infrastruktur</td>
                        <td class="px-6 py-4">Emailperusahaan@gmail.com</td>
                        <td class="px-6 py-4">Kota Karawang, Jawa Barat</td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">6</td>
                        <td class="px-6 py-4 font-medium text-gray-900">PT Unilever Indonesia Tbk</td>
                        <td class="px-6 py-4">Manufaktur & Pemasaran</td>
                        <td class="px-6 py-4">0123-4567-8910</td>
                        <td class="px-6 py-4">Kota Bekasi, Jawa Barat</td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">7</td>
                        <td class="px-6 py-4 font-medium text-gray-900">PT United Tractors Tbk</td>
                        <td class="px-6 py-4">Pertambangan & Konstruksi</td>
                        <td class="px-6 py-4">Emailperusahaan@gmail.com</td>
                        <td class="px-6 py-4">Kota Jakarta Timur, DKI Jakarta</td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">8</td>
                        <td class="px-6 py-4 font-medium text-gray-900">Dian Swastatika Sentosa Tbk</td>
                        <td class="px-6 py-4">Pertambangan & Perdagangan</td>
                        <td class="px-6 py-4">0123-4567-8910</td>
                        <td class="px-6 py-4">Kota Jakarta Pusat, DKI Jakarta</td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">9</td>
                        <td class="px-6 py-4 font-medium text-gray-900">PT Erajaya Swasembada Tbk</td>
                        <td class="px-6 py-4">Distribusi & Ritel Produk</td>
                        <td class="px-6 py-4">0123-4567-8910</td>
                        <td class="px-6 py-4">Kota Jakarta Barat, DKI Jakarta</td>
                    </tr>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">10</td>
                        <td class="px-6 py-4 font-medium text-gray-900">PT Astra Internasional Tbk</td>
                        <td class="px-6 py-4">Otomotif & Infrastruktur</td>
                        <td class="px-6 py-4">Emailperusahaan@gmail.com</td>
                        <td class="px-6 py-4">Kota Karawang, Jawa Barat</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.querySelector('#companyTable');

            // Inisialisasi DataTables tanpa jQuery
            new DataTable(table, {
                // ⚙️ Matikan styling bawaan
                paging: true,
                ordering: true,
                info: true,
                autoWidth: false,
                stripeClasses: [], // biar tidak menimpa warna baris
                classes: {
                    sTable: 'w-full border'
                },
                initComplete: function() {
                    // tambahkan ulang kelas tailwind (jaga-jaga)
                    const thead = table.querySelector('thead');
                    if (thead) {
                        thead.classList.add('bg-green-500', 'text-white', 'uppercase', 'text-xs');
                    }
                }
            });
        });
    </script>
@endpush
