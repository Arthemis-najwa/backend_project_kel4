@extends('layouts.admin')

@section('content')

<!-- CARD TABEL -->
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Lowongan</h2>
        <button id="openTambahBtn"
            class="px-4 py-3 bg-orange-400 text-white rounded-xl hover:bg-orange-500 transition flex items-center shadow">
            <i class="fa fa-plus mr-2"></i> Tambah Lowongan
        </button>
    </div>

    <div class="relative overflow-x-auto rounded-xl">
        <table class="w-full text-sm text-left text-gray-700 border border-gray-200">
            <thead class="bg-green-500 text-white text-xs uppercase">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Perusahaan</th>
                    <th class="px-6 py-3">Posisi</th>
                    <th class="px-6 py-3">Usia Minimum</th>
                    <th class="px-6 py-3">Usia Maksimum</th>
                    <th class="px-6 py-3">Jenis Kelamin</th>
                    <th class="px-6 py-3">Pendidikan</th>
                    <th class="px-6 py-3">Jurusan</th>
                    <th class="px-6 py-3">Tahun Lulus</th>
                    <th class="px-6 py-3">Pengalaman</th>
                    <th class="px-6 py-3">Skill Teknis</th>
                    <th class="px-6 py-3">Skill Non Teknis</th>
                    <th class="px-6 py-3">Vaksin</th>
                    <th class="px-6 py-3">Pernikahan</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vacancies as $vacancy)
                <tr class="bg-white border-b hover:bg-green-50">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 font-semibold" style="min-width: 260px;">{{ $vacancy->company->nama_perusahaan ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->posisi }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->usia_minimum ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->usia_maksimum ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->jenis_kelamin ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->pendidikan_terakhir ?? '-' }}</td>
                    <td class="px-6 py-4" style="min-width: 260px;">{{ $vacancy->qualification->jurusan ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->tahun_lulus ?? '-' }}</td>
                    <td class="px-6 py-4" style="min-width: 260px;">{{ $vacancy->qualification->pengalaman_kerja ?? '-' }}</td>
                    <td class="px-6 py-4" style="min-width: 260px;">{{ $vacancy->qualification->skill_teknis ?? '-' }}</td>
                    <td class="px-6 py-4" style="min-width: 260px;">{{ $vacancy->qualification->skill_non_teknis ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->status_vaksinasi ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $vacancy->qualification->status_pernikahan ?? '-' }}</td>
                    <td class="px-6 py-4">
    <div class="flex justify-center items-center space-x-4 text-lg h-full">
                        <button class="text-blue-600 hover:scale-110 transition edit-btn" title="Edit"
                         data-id="{{ $vacancy->id }}"
                         data-perusahaan="{{ $vacancy->company_id }}"
                         data-nama_perusahaan="{{ $vacancy->company->nama_perusahaan ?? '' }}"
                         data-posisi="{{ $vacancy->posisi }}"
                         data-usia_minimum="{{ $vacancy->qualification->usia_minimum ?? '' }}"
                         data-usia_maksimum="{{ $vacancy->qualification->usia_maksimum ?? '' }}"
                         data-jenis_kelamin="{{ $vacancy->qualification->jenis_kelamin ?? '' }}"
                         data-pendidikan_terakhir="{{ $vacancy->qualification->pendidikan_terakhir ?? '' }}"
                         data-jurusan="{{ $vacancy->qualification->jurusan ?? '' }}"
                         data-tahun_lulus="{{ $vacancy->qualification->tahun_lulus ?? '' }}"
                         data-pengalaman_kerja="{{ $vacancy->qualification->pengalaman_kerja ?? '' }}"
                         data-skill_teknis="{{ $vacancy->qualification->skill_teknis ?? '' }}"
                         data-skill_non_teknis="{{ $vacancy->qualification->skill_non_teknis ?? '' }}"
                         data-status_vaksinasi="{{ $vacancy->qualification->status_vaksinasi ?? '' }}"
                         data-status_pernikahan="{{ $vacancy->qualification->status_pernikahan ?? '' }}">
                            <i class="fa fa-pen"></i>
                        </button>
                        <form action="{{ route('vacancies.destroy', $vacancy->id) }}" method="POST"
                            class="inline delete-vacancy-form" data-id="{{ $vacancy->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" title="Hapus"
                                class="text-red-500 hover:text-red-600 hover:scale-110 transition delete-vacancy-btn"
                                data-id="{{ $vacancy->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                         <a href="{{ route('vacancies.export', $vacancy->id) }}"
   title="Export"
   class="text-blue-500 hover:text-blue-600">
   <i class="fa fa-download text-lg"></i>
</a>
</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@php
    $modalClasses = "relative p-4 w-full max-w-2xl max-h-full";
    $inputClasses = "bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm";
@endphp

<!-- MODAL TAMBAH -->
<div id="tambahModal" tabindex="-1"
    class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
    <div class="{{ $modalClasses }}">
        <div class="relative bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Lowongan</h3>
                <button type="button" id="closeTambahBtn"
                    class="text-gray-500 hover:text-gray-700 transition">
                    <i class="fa fa-times text-lg"></i>
                </button>
            </div>

            <!-- Body -->
            <form action="{{ route('vacancies.store') }}" method="POST" class="px-6 py-5">
                @csrf
                <div class="grid grid-cols-2 gap-4 max-h-[60vh] overflow-y-auto pr-2">
                    <input type="text" name="posisi" placeholder="Posisi"
                        class="{{ $inputClasses }}" required>
                    <select name="company_id"
                        class="{{ $inputClasses }}" required>
                        <option value="">-- Pilih Perusahaan --</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->nama_perusahaan }}</option>
                        @endforeach
                    </select>

                    <input type="number" name="usia_minimum" placeholder="Usia Minimum"
                        class="{{ $inputClasses }}">
                    <input type="number" name="usia_maksimum" placeholder="Usia Maksimum"
                        class="{{ $inputClasses }}">
                    <!-- Jenis kelamin dropdown -->
                    <select name="jenis_kelamin"
                        class="{{ $inputClasses }}">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Tidak Ditentukan">Tidak ditentukan</option>
                    </select>
                    <input type="text" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir"
                        class="{{ $inputClasses }}">
                    <input type="text" name="jurusan" placeholder="Jurusan"
                        class="{{ $inputClasses }}">
                    <input type="number" name="tahun_lulus" placeholder="Tahun Lulus"
                        class="{{ $inputClasses }}">
                    <input type="text" name="pengalaman_kerja" placeholder="Pengalaman Kerja"
                        class="{{ $inputClasses }}">
                    <input type="text" name="skill_teknis" placeholder="Skill Teknis"
                        class="{{ $inputClasses }}">
                    <input type="text" name="skill_non_teknis" placeholder="Skill Non Teknis"
                        class="{{ $inputClasses }}">

                    <select name="status_vaksinasi"
                        class="{{ $inputClasses }}">
                        <option value="">-- Pilih Status Vaksinasi --</option>
                        <option value="Lengkap">Lengkap</option>
                        <option value="Belum Lengkap">Belum Lengkap</option>
                        <option value="Belum Vaksin">Belum Vaksin</option>
                    </select>

                    <select name="status_pernikahan"
                        class="{{ $inputClasses }}">
                        <option value="">-- Pilih Status Pernikahan --</option>
                        <option value="Sudah menikah">Sudah menikah</option>
                        <option value="Belum menikah">Belum menikah</option>
                    </select>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 pt-5 mt-5 border-t border-gray-200">
                    <button type="button" id="closeTambahBtn2"
                        class="px-5 py-2.5 text-sm rounded-lg border border-gray-300 bg-white text-gray-600 hover:bg-gray-100 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm rounded-lg bg-green-600 text-white hover:bg-green-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="editModal" tabindex="-1"
    class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
    <div class="{{ $modalClasses }}">
        <div class="relative bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Edit Lowongan</h3>
                <button type="button" id="closeEditBtn"
                    class="text-gray-500 hover:text-gray-700 transition">
                    <i class="fa fa-times text-lg"></i>
                </button>
            </div>

            <!-- Body -->
            <form id="editForm" method="POST" class="px-6 py-5">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4 max-h-[60vh] overflow-y-auto pr-2">
                    <select id="editPerusahaan" name="company_id" class="{{ $inputClasses }}">
                        <option value="">-- Pilih Perusahaan --</option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->nama_perusahaan }}</option>
                        @endforeach
                    </select>
                    <input type="text" id="editPosisi" name="posisi" class="{{ $inputClasses }}" placeholder="Posisi">
                    <input type="number" id="editUsiaMin" name="usia_minimum" class="{{ $inputClasses }}" placeholder="Usia Minimum">
                    <input type="number" id="editUsiaMax" name="usia_maksimum" class="{{ $inputClasses }}" placeholder="Usia Maksimum">

                    <!-- Jenis kelamin dropdown -->
                    <select id="editJenisKelamin" name="jenis_kelamin" class="{{ $inputClasses }}">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <input type="text" id="editPendidikan" name="pendidikan_terakhir" class="{{ $inputClasses }}" placeholder="Pendidikan Terakhir">
                    <input type="text" id="editJurusan" name="jurusan" class="{{ $inputClasses }}" placeholder="Jurusan">
                    <input type="number" id="editTahunLulus" name="tahun_lulus" class="{{ $inputClasses }}" placeholder="Tahun Lulus">
                    <input type="text" id="editPengalaman" name="pengalaman_kerja" class="{{ $inputClasses }}" placeholder="Pengalaman Kerja">
                    <input type="text" id="editSkillTeknis" name="skill_teknis" class="{{ $inputClasses }}" placeholder="Skill Teknis">
                    <input type="text" id="editSkillNonTeknis" name="skill_non_teknis" class="{{ $inputClasses }}" placeholder="Skill Non Teknis">

                    <select id="editVaksin" name="status_vaksinasi" class="{{ $inputClasses }}">
                        <option value="">-- Pilih Status Vaksinasi --</option>
                        <option value="Lengkap">Lengkap</option>
                        <option value="Belum Lengkap">Belum Lengkap</option>
                        <option value="Belum Vaksin">Belum Vaksin</option>
                    </select>
                    <select id="editPernikahan" name="status_pernikahan" class="{{ $inputClasses }}">
                        <option value="">-- Pilih Status Pernikahan --</option>
                        <option value="Sudah menikah">Sudah menikah</option>
                        <option value="Belum menikah">Belum menikah</option>
                    </select>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 pt-5 mt-5 border-t border-gray-200">
                    <button type="button" id="closeEditBtn2"
                        class="px-5 py-2.5 text-sm rounded-lg border border-gray-300 bg-white text-gray-600 hover:bg-gray-100 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm rounded-lg bg-green-600 text-white hover:bg-green-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const tambahModal = document.getElementById("tambahModal");
    const openTambahBtn = document.getElementById("openTambahBtn");
    const closeTambahBtn = document.getElementById("closeTambahBtn");
    const closeTambahBtn2 = document.getElementById("closeTambahBtn2");

    const editModal = document.getElementById("editModal");
    const closeEditBtn = document.getElementById("closeEditBtn");
    const closeEditBtn2 = document.getElementById("closeEditBtn2");

    openTambahBtn.addEventListener("click", () => tambahModal.classList.remove("hidden"));
    [closeTambahBtn, closeTambahBtn2].forEach(btn => btn.addEventListener("click", () => tambahModal.classList.add("hidden")));

    [closeEditBtn, closeEditBtn2].forEach(btn => btn.addEventListener("click", () => editModal.classList.add("hidden")));

    function openDeleteModal() {
        alert('Hapus dummy');
    }

    function updateVaksinasiColor(sel) {
        switch(sel.value) {
            case 'Lengkap': 
                sel.style.backgroundColor = '#0EDA52'; 
                break;
            case 'Belum Lengkap': 
                sel.style.backgroundColor = '#FFC107'; 
                break;
            case 'Belum Vaksin': 
                sel.style.backgroundColor = '#EF4444'; 
                break;
            default: 
                sel.style.backgroundColor = '#6B7280';
        }
        sel.style.color = 'white';
    }

    function updatePernikahanColor(sel) {
        switch(sel.value) {
            case 'Sudah menikah': 
                sel.style.backgroundColor = '#3B82F6'; 
                break;
            case 'Belum menikah': 
                sel.style.backgroundColor = '#52D8A7'; 
                break;
            default: 
                sel.style.backgroundColor = '#6B7280';
        }
        sel.style.color = 'white';
    }

    
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.status-vaksinasi-dropdown').forEach(sel => {
            updateVaksinasiColor(sel);
            sel.addEventListener('change', () => updateVaksinasiColor(sel));
        });

        document.querySelectorAll('.status-pernikahan-dropdown').forEach(sel => {
            updatePernikahanColor(sel);
            sel.addEventListener('change', () => updatePernikahanColor(sel));
        });
    });

    $(document).ready(function () {
        const editModal = $('#editModal');
        const editForm = $('#editForm');

        $(document).on('click', '.edit-btn', function () {
            const id = $(this).data('id');
            $('#editPerusahaan').val($(this).data('company_id'));
            $('#editPosisi').val($(this).data('posisi'));
            $('#editUsiaMin').val($(this).data('usia_minimum'));
            $('#editUsiaMax').val($(this).data('usia_maksimum'));
            $('#editJenisKelamin').val($(this).data('jenis_kelamin'));
            $('#editPendidikan').val($(this).data('pendidikan_terakhir'));
            $('#editJurusan').val($(this).data('jurusan'));
            $('#editTahunLulus').val($(this).data('tahun_lulus'));
            $('#editPengalaman').val($(this).data('pengalaman_kerja'));
            $('#editSkillTeknis').val($(this).data('skill_teknis'));
            $('#editSkillNonTeknis').val($(this).data('skill_non_teknis'));
            $('#editVaksin').val($(this).data('status_vaksinasi'));
            $('#editPernikahan').val($(this).data('status_pernikahan'));
            editForm.attr('action', '/vacancies/' + id);
            editModal.removeClass('hidden').hide().fadeIn(200);
        });

        $(document).on('click', '#closeEditBtn, #closeEditBtn2', function () {
            editModal.fadeOut(200, function () {
                editModal.addClass('hidden');
            });
        });

        // Handler untuk tombol hapus lowongan dengan SweetAlert
        $(document).on('click', '.delete-vacancy-btn', function(e) {
            e.preventDefault();
            const vacancyId = $(this).data('id');
            const form = $(`.delete-vacancy-form[data-id="${vacancyId}"]`);
            
            Swal.fire({
                icon: 'warning',
                title: 'Hapus Lowongan?',
                html: '⚠️ Pastikan Anda telah <b>mengarsipkan semua pelamar</b> yang melamar untuk posisi ini.<br><br>Data yang dihapus tidak dapat dipulihkan.',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                    confirmButtonColor: '#10b981',
                                    allowOutsideClick: false
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr) {
                            const response = xhr.responseJSON;
                            let errorDetails = '';
                            
                            if (response.applicants && response.applicants.length > 0) {
                                errorDetails += `<p class="text-left mt-3"><b>👤 Pelamar yang masih terdaftar:</b></p>
                                               <ul class="text-left ml-4 mt-2">`;
                                response.applicants.forEach(applicant => {
                                    errorDetails += `<li class="text-sm text-gray-700">• ${applicant.nama_lengkap}</li>`;
                                });
                                errorDetails += `</ul>`;
                            }
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Penghapusan Gagal!',
                                html: response.message + errorDetails,
                                confirmButtonText: 'Oke',
                                confirmButtonColor: '#ef4444',
                                allowOutsideClick: false,
                                didOpen: function() {
                                    const popup = Swal.getPopup();
                                    popup.style.maxWidth = '500px';
                                }
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endsection