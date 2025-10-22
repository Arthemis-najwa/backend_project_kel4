@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Pendataan Perusahaan Yang Bekerja Sama</h1>

    {{-- <div class="flex justify-end">
        <a href=""
            class="px-8 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-400 hover:text-neutral-600 hover:border-orange-600 transition">Export</a>
    </div> --}}

    <!-- Tabel Perusahaan -->
    <div class="bg-white rounded-xl shadow-md p-6 mt-6 border border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Menampilkan Semua Data Perusahaan</h2>
            <div>
                <button data-modal-target="tambahPerusahaanModal" data-modal-toggle="tambahPerusahaanModal"
                    class="px-4 py-3 bg-orange-400 text-white rounded-lg hover:bg-orange-500 transition">
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
                <th scope="col" class="px-6 py-3 border-gray-200">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($companies as $index => $company)
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $company->nama_perusahaan }}</td>
                    <td class="px-6 py-4">{{ $company->bidang_usaha }}</td>
                    <td class="px-6 py-4">{{ $company->kontak }}</td>
                    <td class="px-6 py-4">{{ $company->alamat }}</td>
                    <td class="px-6 py-4">
                        <select class="status-lowongan text-white text-xs px-2 py-1 rounded-full shadow focus:outline-none">
                            <option>Dibuka</option>
                            <option>Ditutup</option>
                        </select>
                    </td>
                    <td class="px-6 py-4 flex gap-2">
                        <!-- Tombol Edit -->
                        <button 
                            type="button" 
                            class="text-blue-600 hover:text-blue-800 edit-btn"
                            data-id="{{ $company->id }}"
                            data-nama="{{ $company->nama_perusahaan }}"
                            data-bidang="{{ $company->bidang_usaha }}"
                            data-kontak="{{ $company->kontak }}"
                            data-alamat="{{ $company->alamat }}">
                            Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>

                        <!-- Tombol Export -->
                        <a href="{{ route('companies.export', $company->id) }}" 
                           class="text-green-600 hover:text-green-800">
                            Export
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Belum ada data perusahaan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Edit Data Perusahaan</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-3">
                <div>
                    <label class="block text-sm text-gray-600">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" id="editNama" class="w-full border rounded-lg p-2" required>
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Bidang Usaha</label>
                    <input type="text" name="bidang_usaha" id="editBidang" class="w-full border rounded-lg p-2" required>
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Kontak</label>
                    <input type="text" name="kontak" id="editKontak" class="w-full border rounded-lg p-2" required>
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Alamat</label>
                    <textarea name="alamat" id="editAlamat" class="w-full border rounded-lg p-2" required></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="closeModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

    <div id="tambahPerusahaanModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Tambah Perusahaan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="tambahPerusahaanModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6-6M7 7l6 6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <!-- Body -->
                <form action="{{ route('companies.store') }}" method="POST" class="p-4 space-y-4">
    @csrf
    <div>
        <label for="nama_perusahaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Nama Perusahaan
        </label>
        <input type="text" id="nama_perusahaan" name="nama_perusahaan"
            placeholder="Contoh: PT Maju Jaya Abadi"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
            required>
    </div>
    <div>
        <label for="bidang_usaha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Bidang Usaha
        </label>
        <input type="text" id="bidang_usaha" name="bidang_usaha"
            placeholder="Contoh: Teknologi Informasi, Manufaktur, Retail..."
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
            required>
    </div>
    <div>
        <label for="kontak" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Kontak
        </label>
        <input type="text" id="kontak" name="kontak"
            placeholder="Contoh: 0812-3456-7890 / email@perusahaan.com"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
            required>
    </div>
    <div>
        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Alamat / Lokasi
        </label>
        <textarea id="alamat" name="alamat" rows="3"
            placeholder="Alamat lengkap perusahaan..."
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white"
            required></textarea>
    </div>
                <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="tambahPerusahaanModal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">
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
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('#companyTable');
    if (!$.fn.DataTable.isDataTable(table)) {
        new DataTable(table, {
            paging: true,
            ordering: true,
            info: true,
            autoWidth: false,
            stripeClasses: [],
            classes: { sTable: 'w-full border' },
            initComplete: function() {
                const thead = table.querySelector('thead');
                if (thead) {
                    thead.classList.add('bg-green-500', 'text-white', 'uppercase', 'text-xs');
                }
            }
        });
    }

    // === Modal Edit Logic ===
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
   $(document).on('click', '#closeModal', function() {
        editModal.addClass('hidden');
    });
});
</script>
@endpush
