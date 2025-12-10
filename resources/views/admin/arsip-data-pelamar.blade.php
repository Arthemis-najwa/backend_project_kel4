@extends('layouts.admin')

@section('content')

<!-- Tabel Pelamar -->
<div class="bg-white rounded-xl shadow-md p-6 mt-10 border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Arsip Data Pelamar</h2>
    </div>

    <div class="relative overflow-x-auto rounded-xl">
        <table id="applicantsTable" class="w-full text-sm text-left text-gray-700 border border-gray-200">
            <thead class="bg-green-500 text-white uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 border-gray-200">No</th>
                    <th class="px-6 py-3 border-gray-200">Nama</th>
                    <th class="px-6 py-3 border-gray-200">Usia</th>
                    <th class="px-6 py-3 border-gray-200">Jenis Kelamin</th>
                    <th class="px-6 py-3 border-gray-200">Pendidikan Terakhir</th>
                    <th class="px-6 py-3 border-gray-200">Jurusan</th>
                    <th class="px-6 py-3 border-gray-200">Skill Teknis</th>
                    <th class="px-6 py-3 border-gray-200">Skill Non Teknis</th>
                    <th class="px-6 py-3 border-gray-200">Status Vaksinasi</th>
                    <th class="px-6 py-3 border-gray-200">Perusahaan Tujuan</th>
                    <th class="px-6 py-3 border-gray-200 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
@foreach ($archives as $key => $archive)
<tr class="border-b">
    <td class="px-6 py-3">{{ $key + 1 }}</td>
    <td class="px-6 py-3">{{ $archive->applicant->nama_lengkap ?? '-' }}</td>
    <td class="px-6 py-3">{{ $archive->applicant->usia ?? '-' }}</td>
    <td class="px-6 py-3">{{ $archive->applicant->jenis_kelamin ?? '-' }}</td>
    <td class="px-6 py-3">{{ $archive->applicant->pendidikan_terakhir ?? '-' }}</td>
    <td class="px-6 py-3">{{ $archive->applicant->jurusan ?? '-' }}</td>
    <td class="px-6 py-3" style="min-width: 260px;">{{ $archive->applicant->skill_teknis ?? '-' }}</td>
    <td class="px-6 py-3" style="min-width: 260px;">{{ $archive->applicant->skill_non_teknis ?? '-' }}</td>
    <td class="px-6 py-3">{{ $archive->applicant->status_vaksinasi ?? '-' }}</td>
    <td class="px-6 py-3" style="min-width: 260px;">{{ $archive->applicant->perusahaan_tujuan ?? '-' }}</td>
    <td class="px-6 py-4">
        <div class="flex justify-center items-center space-x-4 text-lg h-full">
            <!-- Restore -->
            <form action="{{ route('applicants.restore', $archive->applicant->id) }}" method="POST" 
                class="inline restore-applicant-form" data-id="{{ $archive->applicant->id }}">
                @csrf
                <button type="button" title="Pulihkan"
                    class="text-green-500 hover:text-green-600 restore-btn"
                    data-id="{{ $archive->applicant->id }}">
                    <i class="fa fa-undo text-lg"></i>
                </button>
            </form>

            <!-- Hapus Permanen -->
            <form action="{{ route('applicants.permanentDelete', $archive->applicant->id) }}" method="POST" 
                class="inline permanent-delete-form" data-id="{{ $archive->applicant->id }}">
                @csrf
                @method('DELETE')
                <button type="button" title="Hapus Permanen"
                    class="text-red-500 hover:text-red-600 permanent-delete-btn"
                    data-id="{{ $archive->applicant->id }}">
                    <i class="fa fa-trash text-lg"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
@endforeach
            </tbody>


        </table>
    </div>
</div>

@php
    $modalClasses = "bg-white w-full max-w-sm p-4 rounded-2xl shadow-lg relative overflow-y-auto max-h-[80vh]";
    $inputClasses = "w-full border rounded px-2 py-1 text-sm";
@endphp
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Handler untuk restore
$(document).on('click', '.restore-btn', function(e) {
    e.preventDefault();
    const applicantId = $(this).data('id');
    const form = $(`.restore-applicant-form[data-id="${applicantId}"]`);
    
    Swal.fire({
        icon: 'question',
        title: 'Pulihkan Pelamar?',
        text: 'Pelamar akan kembali ke status aktif.',
        showCancelButton: true,
        confirmButtonText: 'Ya, Pulihkan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#6b7280',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        confirmButtonColor: '#10b981',
                        allowOutsideClick: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message,
                        confirmButtonColor: '#ef4444'
                    });
                }
            });
        }
    });
});

// Handler untuk hapus permanen
$(document).on('click', '.permanent-delete-btn', function(e) {
    e.preventDefault();
    const applicantId = $(this).data('id');
    const form = $(`.permanent-delete-form[data-id="${applicantId}"]`);
    
    Swal.fire({
        icon: 'warning',
        title: 'Hapus Permanen?',
        html: '<span class="text-red-600"><b>⚠️ Data tidak dapat dipulihkan!</b></span>',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus Permanen',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: form.attr('action'),
                method: 'DELETE',
                data: form.serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        confirmButtonColor: '#10b981',
                        allowOutsideClick: false
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message,
                        confirmButtonColor: '#ef4444'
                    });
                }
            });
        }
    });
});
</script>


@endsection
