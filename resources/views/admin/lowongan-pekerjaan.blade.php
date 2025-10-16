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
        <table id="companyTable" class="w-full text-sm text-left text-gray-700 border border-gray-200">
            <thead class="bg-green-500 text-white uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 border-gray-200">No</th>
                    <th class="px-6 py-3 border-gray-200">Nama Perusahaan</th>
                    <th class="px-6 py-3 border-gray-200">Posisi</th>
                    <th class="px-6 py-3 border-gray-200">Usia</th>
                    <th class="px-6 py-3 border-gray-200">Jenis Kelamin</th>
                    <th class="px-6 py-3 border-gray-200">Pendidikan Terakhir</th>
                    <th class="px-6 py-3 border-gray-200">Jurusan</th>
                    <th class="px-6 py-3 border-gray-200">Pengalaman</th>
                    <th class="px-6 py-3 border-gray-200">Skill Teknis</th>
                    <th class="px-6 py-3 border-gray-200">Skill Non-Teknis</th>
                    <th class="px-6 py-3 border-gray-200">Status Vaksinasi</th>
                    <th class="px-6 py-3 border-gray-200">Status Pernikahan</th>
                    <th class="px-6 py-3 border-gray-200">Tahun Lulus</th>
                    <th class="px-6 py-3 border-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vacancies as $index => $vacancy)
                <tr class="bg-white border-b border-gray-200">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $vacancy->company->nama_perusahaan ?? '-' }}
                    </td>
                    <td class="px-6 py-4">{{ $vacancy->posisi }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->usia ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->jenis_kelamin ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->pendidikan_terakhir ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->jurusan ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->pengalaman ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->skill_teknis ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->skill_non_teknis ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->status_vaksinasi ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->status_pernikahan ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->tahun_lulus ?? '-' }}</td>
                    <td class="px-6 py-4 flex gap-2">
                        <!-- Tombol Edit -->
                        <button class="edit-btn text-blue-600 hover:text-blue-800"
                            data-id="{{ $vacancy->id }}"
                            data-posisi="{{ $vacancy->posisi }}"
                            data-company="{{ $vacancy->company_id }}"
                            data-qualification="{{ $vacancy->qualification_id }}">
                            Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('vacancies.destroy', $vacancy->id) }}" method="POST"
                            onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="14" class="text-center py-4">Belum ada data lowongan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



   {{-- Modal Tambah --}}
<div id="tambahLowonganModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl">
        <form id="addForm" method="POST" action="{{ route('vacancies.store') }}">
            @csrf
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Tambah Lowongan</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label for="posisi" class="block text-sm font-medium text-gray-700">Posisi</label>
                    <input type="text" name="posisi" id="posisi"
                        class="w-full border-gray-300 rounded-lg shadow-sm" required>
                </div>
                <div>
                    <label for="company_id" class="block text-sm font-medium text-gray-700">Perusahaan</label>
                    <select name="company_id" id="company_id" class="w-full border-gray-300 rounded-lg" required>
                        <option value="">-- Pilih Perusahaan --</option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->nama_perusahaan }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="qualification_id" class="block text-sm font-medium text-gray-700">Kualifikasi</label>
                    <select name="qualification_id" id="qualification_id" class="w-full border-gray-300 rounded-lg"
                        required>
                        <option value="">-- Pilih Kualifikasi --</option>
                        @foreach ($qualifications as $q)
                        <option value="{{ $q->id }}">{{ $q->pendidikan_terakhir }} - {{ $q->usia }} th</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-end p-4 border-t">
                <button type="button" id="closeTambah"
                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 mr-2">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 border-b">
                <h3 class="text-lg font-semibold">Edit Lowongan</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label for="editPosisi" class="block text-sm font-medium text-gray-700">Posisi</label>
                    <input type="text" name="posisi" id="editPosisi"
                        class="w-full border-gray-300 rounded-lg shadow-sm" required>
                </div>
                <div>
                    <label for="editCompany" class="block text-sm font-medium text-gray-700">Perusahaan</label>
                    <select name="company_id" id="editCompany" class="w-full border-gray-300 rounded-lg" required>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->nama_perusahaan }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="editQualification" class="block text-sm font-medium text-gray-700">Kualifikasi</label>
                    <select name="qualification_id" id="editQualification" class="w-full border-gray-300 rounded-lg"
                        required>
                        @foreach ($qualifications as $q)
                        <option value="{{ $q->id }}">{{ $q->pendidikan_terakhir }} - {{ $q->usia }} th</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-end p-4 border-t">
                <button type="button" id="closeModal"
                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 mr-2">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ✅ DataTable
    const table = document.querySelector('#companyTable');
    if (!$.fn.DataTable.isDataTable(table)) {
        new DataTable(table, {
            paging: true,
            ordering: true,
            info: true,
            autoWidth: false,
            stripeClasses: [],
        });
    }

    // ✅ Tambah Modal
    const tambahModal = $('#tambahLowonganModal');
    $('#btnTambah').on('click', () => tambahModal.removeClass('hidden'));
    $('#closeTambah').on('click', () => tambahModal.addClass('hidden'));

    // ✅ Edit Modal
    const editModal = $('#editModal');
    const editForm = $('#editForm');

    $('.edit-btn').on('click', function() {
        const id = $(this).data('id');
        $('#editPosisi').val($(this).data('posisi'));
        $('#editCompany').val($(this).data('company'));
        $('#editQualification').val($(this).data('qualification'));
        editForm.attr('action', '/vacancies/' + id);
        editModal.removeClass('hidden');
    });

    $('#closeModal').on('click', () => editModal.addClass('hidden'));
});
</script>
@endpush