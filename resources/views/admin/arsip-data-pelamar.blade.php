@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">
    {{ $title ?? 'Arsip Data Pelamar' }}
</h1>

<!-- Tabel Pelamar -->
<div class="bg-white rounded-xl shadow-md p-6 mt-10 border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Pelamar</h2>
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
                        <button class="text-green-600 hover:scale-110 transition restore-btn" title="Restore" data-id="{{ $archive->applicant_id }}">
                            <i class="fa fa-rotate-left"></i>
                        </button>
                        <button class="text-red-500 hover:scale-110 transition delete-btn" title="Hapus" data-id="{{ $archive->applicant_id }}">
                            <i class="fa fa-trash"></i>
                        </button>
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
<script>
$(document).on('click', '.restore-btn', function() {
    const id = $(this).data('id');
    if (!confirm('Pulihkan pelamar ini ke daftar utama?')) return;

    $.ajax({
        url: `/archives/${id}/restore`,
        method: 'POST',
        data: {_token: '{{ csrf_token() }}'},
        success(res) {
            alert(res.message || 'Data berhasil dipulihkan!');
            location.reload();
        },
        error(xhr) {
            const msg = xhr.responseJSON?.message || 'Gagal memulihkan data.';
            alert(msg);
        }
    });
});

$(document).on('click', '.delete-btn', function() {
    const id = $(this).data('id');
    if (!confirm('Hapus arsip ini secara permanen?')) return;

    $.ajax({
        url: `/archives/${id}/hapus`,
        method: 'DELETE',
        data: {_token: '{{ csrf_token() }}'},
        success(res) {
            alert(res.message || 'Data berhasil dihapus permanen!');
            location.reload();
        },
        error(xhr) {
            const msg = xhr.responseJSON?.message || 'Gagal menghapus data.';
            alert(msg);
        }
    });
});
</script>


@endsection
