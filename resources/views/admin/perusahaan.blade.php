@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Pendataan Perusahaan Yang Bekerja Sama</h1>

    <!-- Tabel Perusahaan -->
    <div class="bg-white rounded-2xl shadow-md p-6 mt-6 border border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Menampilkan Semua Data Perusahaan</h2>
            <div>
                <button data-modal-target="tambahPerusahaanModal" data-modal-toggle="tambahPerusahaanModal"
                    class="px-4 py-3 bg-orange-400 text-white rounded-lg hover:bg-orange-500 transition">
                    <i class="fa fa-plus mr-1"></i> Tambah Perusahaan
                </button>
            </div>
        </div>

        <!-- Tabel -->
        <div class="relative overflow-x-auto rounded-xl">
            <table id="companyTable"
                class="w-full text-sm text-left text-gray-700 border border-gray-200 rounded-xl overflow-hidden">
                <thead class="bg-green-500 text-white uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 text-center">No</th>
                        <th class="px-6 py-4">Nama Perusahaan</th>
                        <th class="px-6 py-4">Bidang Usaha</th>
                        <th class="px-6 py-4">Kontak</th>
                        <th class="px-6 py-4">Lokasi</th>
                        <th class="px-6 py-4 text-center">Status Lowongan</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataTableBody">
                    @forelse ($companies as $index => $company)
                        <tr class="bg-white border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $company->nama_perusahaan }}</td>
                            <td class="px-6 py-4">{{ $company->bidang_usaha }}</td>
                            <td class="px-6 py-4">{{ $company->kontak }}</td>
                            <td class="px-6 py-4">{{ $company->alamat }}</td>

                            <!-- Status Lowongan dengan Dropdown -->
                            <td class="px-6 py-4 text-center">
                                <select class="status-dropdown px-2 py-1 rounded-full text-white text-xs font-medium shadow focus:outline-none" 
                                        data-id="{{ $company->id }}"
                                        onchange="updateStatusColor(this)">
                                    <option value="Buka" {{ $company->status_lowongan == 'Buka' ? 'selected' : '' }}>Buka</option>
                                    <option value="Tutup" {{ $company->status_lowongan == 'Tutup' ? 'selected' : '' }}>Tutup</option>
                                </select>
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4 text-center flex items-center justify-center gap-3">
                                <!-- Edit -->
                                <button type="button" title="Edit"
                                    class="text-orange-500 hover:text-orange-600 edit-btn"
                                    data-id="{{ $company->id }}"
                                    data-nama="{{ $company->nama_perusahaan }}"
                                    data-bidang="{{ $company->bidang_usaha }}"
                                    data-kontak="{{ $company->kontak }}"
                                    data-alamat="{{ $company->alamat }}">
                                    <i class="fa fa-pen text-lg"></i>
                                </button>

                                <!-- Hapus -->
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus data ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus"
                                        class="text-red-500 hover:text-red-600">
                                        <i class="fa fa-trash text-lg"></i>
                                    </button>
                                </form>

                                <!-- Export -->
                                <a href="{{ route('companies.export', $company->id) }}" title="Export"
                                    class="text-blue-500 hover:text-blue-600">
                                    <i class="fa fa-download text-lg"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500">
                                Belum ada data perusahaan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" tabindex="-1"
        class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">

                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Edit Data Perusahaan
                    </h3>
                    <button type="button" id="closeModal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6-6M7 7l6 6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <form id="editForm" method="POST" class="p-4 space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="editNama"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Nama Perusahaan
                        </label>
                        <input type="text" id="editNama" name="nama_perusahaan"
                            placeholder="Contoh: PT Maju Jaya Abadi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                            required>
                    </div>
                    <div>
                        <label for="editBidang"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Bidang Usaha
                        </label>
                        <input type="text" id="editBidang" name="bidang_usaha"
                            placeholder="Contoh: Teknologi Informasi, Manufaktur, Retail..."
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                            required>
                    </div>
                    <div>
                        <label for="editKontak"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Kontak
                        </label>
                        <input type="text" id="editKontak" name="kontak"
                            placeholder="Contoh: 0812-3456-7890 / email@perusahaan.com"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                            required>
                    </div>
                    <div>
                        <label for="editAlamat"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Alamat / Lokasi
                        </label>
                        <textarea id="editAlamat" name="alamat" rows="3" placeholder="Alamat lengkap perusahaan..."
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                            required></textarea>
                    </div>
                    <div
                        class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b">
                        <button type="button" id="closeModalBtn"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                            Batal
                        </button>
                        <button type="submit"
                            class="ms-3 text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div id="tambahPerusahaanModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">

                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Tambah Perusahaan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="tambahPerusahaanModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6-6M7 7l6 6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <form action="{{ route('companies.store') }}" method="POST" class="p-4 space-y-4">
                    @csrf
                    <div>
                        <label for="nama_perusahaan"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Nama Perusahaan
                        </label>
                        <input type="text" id="nama_perusahaan" name="nama_perusahaan"
                            placeholder="Contoh: PT Maju Jaya Abadi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                            required>
                    </div>
                    <div>
                        <label for="bidang_usaha"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Bidang Usaha
                        </label>
                        <input type="text" id="bidang_usaha" name="bidang_usaha"
                            placeholder="Contoh: Teknologi Informasi, Manufaktur, Retail..."
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                            required>
                    </div>
                    <div>
                        <label for="kontak"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Kontak
                        </label>
                        <input type="text" id="kontak" name="kontak"
                            placeholder="Contoh: 0812-3456-7890 / email@perusahaan.com"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                            required>
                    </div>
                    <div>
                        <label for="alamat"
                            class="block mb-2 text-sm font-medium text-gray-900">
                            Alamat / Lokasi
                        </label>
                        <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap perusahaan..."
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5"
                            required></textarea>
                    </div>
                    <div
                        class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b">
                        <button data-modal-hide="tambahPerusahaanModal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                            Batal
                        </button>
                        <button type="submit"
                            class="ms-3 text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        // Fungsi untuk update warna dropdown status lowongan
        function updateStatusColor(sel) {
            switch(sel.value) {
                case 'Buka': 
                    sel.style.backgroundColor = '#0EDA52'; 
                    break;
                case 'Tutup': 
                    sel.style.backgroundColor = '#EF4444'; 
                    break;
                default: 
                    sel.style.backgroundColor = '#6B7280';
            }
            sel.style.color = 'white';
        }

        // Inisialisasi warna dropdown saat halaman dimuat
        function initializeDropdownColors() {
            document.querySelectorAll('.status-dropdown').forEach(sel => {
                updateStatusColor(sel);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi warna dropdown
            initializeDropdownColors();

            const table = document.querySelector('#companyTable');
            if (!$.fn.DataTable.isDataTable(table)) {
                new DataTable(table, {
                    paging: false,
                    ordering: false,
                    searching: false,
                    info: false,
                    autoWidth: false,
                    stripeClasses: [],
                });
            }

            const editModal = $('#editModal');
            const editForm = $('#editForm');

            $(document).on('click', '.edit-btn', function() {
                const id = $(this).data('id');
                $('#editNama').val($(this).data('nama'));
                $('#editBidang').val($(this).data('bidang'));
                $('#editKontak').val($(this).data('kontak'));
                $('#editAlamat').val($(this).data('alamat'));
                editForm.attr('action', '/companies/' + id);
                editModal.removeClass('hidden');
            });

            $(document).on('click', '#closeModal, #closeModalBtn', function() {
                editModal.addClass('hidden');
            });

            // Handler untuk dropdown status lowongan
            $(document).on('change', '.status-dropdown', function() {
                const companyId = $(this).data('id');
                const newStatus = $(this).val();
                const dropdown = $(this);
                
                // Update warna terlebih dahulu
                updateStatusColor(this);
                
                // Tampilkan loading state
                dropdown.prop('disabled', true);
                dropdown.addClass('opacity-50');
                
                $.ajax({
                    url: `/companies/${companyId}/status`,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status_lowongan: newStatus
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Status berhasil diupdate');
                            dropdown.removeClass('border-red-500').addClass('border-green-500');
                            
                            setTimeout(() => {
                                dropdown.removeClass('border-green-500');
                            }, 2000);
                        }
                    },
                    error: function(xhr) {
                        console.error('Gagal mengupdate status');
                        dropdown.removeClass('border-green-500').addClass('border-red-500');
                        
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    },
                    complete: function() {
                        dropdown.prop('disabled', false);
                        dropdown.removeClass('opacity-50');
                    }
                });
            });
        });
    </script>
@endsection