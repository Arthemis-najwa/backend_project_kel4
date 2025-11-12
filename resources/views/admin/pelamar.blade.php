@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">
    {{ $title ?? 'Pelamar' }}
</h1>

<!-- CARD TABEL -->
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Pelamar</h2>
        <button id="openTambahBtn"
            class="px-4 py-3 bg-orange-400 text-white rounded-xl hover:bg-orange-500 transition flex items-center shadow">
            <i class="fa fa-plus mr-2"></i> Tambah Pelamar
        </button>
    </div>

    <div class="relative overflow-x-auto rounded-xl">
        <table class="w-full text-sm text-left text-gray-700 border border-gray-200">
            <thead class="bg-green-500 text-white text-xs uppercase">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Lengkap</th>
                    <th class="px-6 py-3">Tanggal Lahir</th>
                    <th class="px-6 py-3">Usia</th>
                    <th class="px-6 py-3">Jenis Kelamin</th>
                    <th class="px-6 py-3">Status Pernikahan</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">No Telepon</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Pendidikan Terakhir</th>
                    <th class="px-6 py-3">Jurusan</th>
                    <th class="px-6 py-3">Tahun Lulus</th>
                    <th class="px-6 py-3">Pengalaman Kerja</th>
                    <th class="px-6 py-3">Skill Teknis</th>
                    <th class="px-6 py-3">Skill Non Teknis</th>
                    <th class="px-6 py-3">Status Vaksinasi</th>
                    <th class="px-6 py-3">Perusahaan Tujuan</th>
                    <th class="px-6 py-3" style="min-width: 200px;">Perusahaan Rekomendasi</th>
                    <th class="px-6 py-3">Link Google Drive</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
    @foreach($applicants as $a)
    <tr class="bg-white border-b hover:bg-green-50">
        <td class="px-6 py-4">{{ $loop->iteration }}</td>
        <td class="px-6 py-4 font-semibold">{{ $a->nama_lengkap }}</td>
        <td class="px-6 py-4">{{ $a->tanggal_lahir }}</td>
        <td class="px-6 py-4">{{ $a->usia }}</td>
        <td class="px-6 py-4">{{ $a->jenis_kelamin }}</td>
        <td class="px-6 py-4">{{ $a->status_pernikahan }}</td>
        <td class="px-6 py-4">{{ $a->alamat }}</td>
        <td class="px-6 py-4">{{ $a->no_telp }}</td>
        <td class="px-6 py-4">{{ $a->email }}</td>
        <td class="px-6 py-4">{{ $a->pendidikan_terakhir }}</td>
        <td class="px-6 py-4">{{ $a->jurusan }}</td>
        <td class="px-6 py-4">{{ $a->tahun_lulus }}</td>
        <td class="px-6 py-4">{{ $a->pengalaman_kerja }}</td>
        <td class="px-6 py-4">{{ $a->skill_teknis }}</td>
        <td class="px-6 py-4">{{ $a->skill_non_teknis }}</td>
        <td class="px-6 py-4">{{ $a->status_vaksinasi }}</td>
        <td class="px-6 py-4">{{ $a->perusahaan_tujuan }}</td>
        <td class="px-6 py-4">
    @forelse($a->recommendations as $rec)
        <span class="px-2 py-1 bg-green-200 rounded">
            {{ $rec->company->nama_perusahaan }}
        </span><br>
    @empty
        <span class="text-gray-500 text-sm italic">Tidak ada</span>
    @endforelse
<td class="px-6 py-4">
    @forelse($a->files as $file)
        <a href="{{ $file->link_dokumen }}" target="_blank" class="text-blue-500 hover:underline">
            Lihat Dokumen
        </a><br>
    @empty
        <span class="text-gray-400 italic">Belum ada</span>
    @endforelse
</td>


        <td class="px-6 py-4">  
            <select class="status-proses px-2 py-1 rounded-full text-white text-xs font-medium shadow focus:outline-none"> 
            <option>Waiting List</option> 
            <option>Medical Check Up</option> 
            <option>Pelatihan</option> 
            <option>Interview</option> 
            <option>Diterima</option> 
            <option>Ditolak</option> 
            </select> 
        </td>
        <td class="px-6 py-4 flex justify-center space-x-4 text-lg"> 
            <button class="text-blue-600 hover:scale-110 transition" title="Edit" onclick="openEditModal(this)"> 
                <i class="fa fa-pen"></i> 
            </button> 
            <button class="text-green-600 hover:scale-110 transition" title="Arsipkan"> 
                <i class="fa fa-download"></i> 
            </button> 
            <button class="text-yellow-500 hover:scale-110 transition" title="Kirim"> 
                <i class="fa fa-paper-plane"></i> 
            </button> 
           <form action="{{ route('applicants.destroy', $a->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus data ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus"
                                        class="text-red-500 hover:text-red-600">
                                        <i class="fa fa-trash text-lg"></i>
                                    </button>
            </form> 
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
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Data Pelamar</h3>
                <button type="button" id="closeTambahBtn"
                    class="text-gray-500 hover:text-gray-700 transition">
                    <i class="fa fa-times text-lg"></i>
                </button>
            </div>

            <!-- Body -->
            <form id="tambahForm" class="px-6 py-5" action="{{ route('applicants.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4 max-h-[60vh] overflow-y-auto pr-2">
                    
                    <!-- Nama Lengkap -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                            placeholder="Masukkan nama lengkap"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500 " required>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Usia -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Usia</label>
                        <input type="number" name="usia" value="{{ old('usia') }}" placeholder="Masukkan usia"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <!-- Status Pernikahan -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Status Pernikahan</label>
                        <select name="status_pernikahan"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Belum Menikah" {{ old('status_pernikahan') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="Menikah" {{ old('status_pernikahan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                        </select>
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" placeholder="Masukkan alamat lengkap" rows="2"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>{{ old('alamat') }}</textarea>
                    </div>

                    <!-- No Telepon -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">No Telepon</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp') }}" placeholder="Contoh: 081234567890"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Email -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Contoh: email@example.com"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Pendidikan Terakhir -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir') }}" placeholder="Contoh: S1, SMA, D3"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Jurusan -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Jurusan</label>
                        <input type="text" name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: Teknik Informatika"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Tahun Lulus -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Tahun Lulus</label>
                        <input type="number" name="tahun_lulus" value="{{ old('tahun_lulus') }}" placeholder="Contoh: 2020"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Pengalaman Kerja -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Pengalaman Kerja</label>
                        <input type="text" name="pengalaman_kerja" value="{{ old('pengalaman_kerja') }}" placeholder="Contoh: 2 tahun di PT XYZ"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">
                    </div>

                    <!-- Skill Teknis -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Skill Teknis</label>
                        <textarea name="skill_teknis" placeholder="Contoh: PHP, Laravel, MySQL" rows="2"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">{{ old('skill_teknis') }}</textarea>
                    </div>

                    <!-- Skill Non Teknis -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Skill Non Teknis</label>
                        <textarea name="skill_non_teknis" placeholder="Contoh: Komunikasi, Leadership" rows="2"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">{{ old('skill_non_teknis') }}</textarea>
                    </div>
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Status Vaksinasi</label>
                        <select name="status_vaksinasi"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">
                            <option value="">-- Pilih Status Vaksinasi --</option>
                            <option value="Lengkap" {{ old('status_vaksinasi') == 'Lengkap' ? 'selected' : '' }}>Lengkap</option>
                            <option value="Belum Lengkap" {{ old('status_vaksinasi') == 'Belum Lengkap' ? 'selected' : '' }}>Belum Lengkap</option>
                            <option value="Belum Vaksin" {{ old('status_vaksinasi') == 'Belum Vaksin' ? 'selected' : '' }}>Belum Vaksin</option>
                        </select>
                    </div>
                    <!-- Perusahaan Tujuan -->
                    <div class="space-y-1 col-span-2">
                        <label class="text-sm font-medium text-gray-700">Perusahaan Tujuan</label>
                        <input type="text" name="perusahaan_tujuan" value="{{ old('perusahaan_tujuan') }}" placeholder="Contoh: PT ABC Technology"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div class="space-y-1 col-span-2">
                        <label class="text-sm font-medium text-gray-700">Link Google Drive</label>
                        <input type="url" name="link_dokumen" value="{{ old('link_dokumen') }}" 
                            placeholder="Contoh: https://drive.google.com/drive/..."
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">
                        <p class="text-xs text-gray-500">Link untuk mengakses dokumen pelamar di Google Drive</p>
                    </div>
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
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Edit Data Pelamar</h3>
                 <button type="button" id="closeEditBtn" onclick="closeEditModal()"
                    class="text-gray-500 hover:text-gray-700 transition">
                    <i class="fa fa-times text-lg"></i>
                </button>
            </div>

            <!-- Body -->
            <form id="editForm" class="px-6 py-5" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4 max-h-[60vh] overflow-y-auto pr-2">
                    
                    <!-- Nama Lengkap -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" id="editNamaLengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" id="editTanggalLahir" name="tanggal_lahir"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Usia -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Usia</label>
                        <input type="number" id="editUsia" name="usia" placeholder="Masukkan usia"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select id="editJenisKelamin" name="jenis_kelamin"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <!-- Status Pernikahan -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Status Pernikahan</label>
                        <select id="editStatusPernikahan" name="status_pernikahan"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="Menikah">Menikah</option>
                        </select>
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Alamat</label>
                        <textarea id="editAlamat" name="alamat" placeholder="Masukkan alamat lengkap" rows="2"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required></textarea>
                    </div>

                    <!-- No Telepon -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">No Telepon</label>
                        <input type="text" id="editNoTelepon" name="no_telp" placeholder="Contoh: 081234567890"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Email -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="editEmail" name="email" placeholder="Contoh: email@example.com"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Pendidikan Terakhir -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                        <input type="text" id="editPendidikanTerakhir" name="pendidikan_terakhir" placeholder="Contoh: S1, SMA, D3"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Jurusan -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Jurusan</label>
                        <input type="text" id="editJurusan" name="jurusan" placeholder="Contoh: Teknik Informatika"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Tahun Lulus -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Tahun Lulus</label>
                        <input type="number" id="editTahunLulus" name="tahun_lulus" placeholder="Contoh: 2020"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <!-- Pengalaman Kerja -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Pengalaman Kerja</label>
                        <input type="text" id="editPengalamanKerja" name="pengalaman_kerja" placeholder="Contoh: 2 tahun di PT XYZ"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">
                    </div>

                    <!-- Skill Teknis -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Skill Teknis</label>
                        <textarea id="editSkillTeknis" name="skill_teknis" placeholder="Contoh: PHP, Laravel, MySQL" rows="2"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>

                    <!-- Skill Non Teknis -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Skill Non Teknis</label>
                        <textarea id="editSkillNonTeknis" name="skill_non_teknis" placeholder="Contoh: Komunikasi, Leadership" rows="2"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>

                    <!-- Status Vaksinasi -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Status Vaksinasi</label>
                        <select id="editStatusVaksinasi" name="status_vaksinasi"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">
                            <option value="">-- Pilih Status Vaksinasi --</option>
                            <option value="Lengkap">Lengkap</option>
                            <option value="Belum Lengkap">Belum Lengkap</option>
                            <option value="Belum Vaksin">Belum Vaksin</option>
                        </select>
                    </div>

                    <!-- Perusahaan Tujuan -->
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Perusahaan Tujuan</label>
                        <input type="text" id="editPerusahaanTujuan" name="perusahaan_tujuan" placeholder="Contoh: PT ABC Technology"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">
                    </div>

                    <!-- Google Drive -->
                    <div class="space-y-1 col-span-2">
                        <label class="text-sm font-medium text-gray-700">Link Google Drive</label>
                        <input type="url" id="editLinkDokumen" name="link_dokumen" 
                            placeholder="Contoh: https://drive.google.com/drive/..."
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500">
                        <p class="text-xs text-gray-500">Link untuk mengakses dokumen pelamar di Google Drive</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 pt-5 mt-5 border-t border-gray-200">
                    <button type="button" id="closeEditBtn2" onclick="closeEditModal()"
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
<script>
    // Modal Tambah
    const tambahModal = document.getElementById("tambahModal");
    const openTambahBtn = document.getElementById("openTambahBtn");
    const closeTambahBtn = document.getElementById("closeTambahBtn");
    const closeTambahBtn2 = document.getElementById("closeTambahBtn2");
    openTambahBtn.addEventListener("click", () => tambahModal.classList.remove("hidden"));
    [closeTambahBtn, closeTambahBtn2].forEach(btn => btn.addEventListener("click", () => tambahModal.classList.add("hidden")));

    // Modal Edit
    function openEditModal(data) {
    document.getElementById("editNamaLengkap").value = data.nama_lengkap;
    document.getElementById("editTanggalLahir").value = data.tanggal_lahir;
    document.getElementById("editUsia").value = data.usia;
    document.getElementById("editJenisKelamin").value = data.jenis_kelamin;
    document.getElementById("editStatusPernikahan").value = data.status_pernikahan;
    document.getElementById("editAlamat").value = data.alamat;
    document.getElementById("editNoTelepon").value = data.no_telp;
    document.getElementById("editEmail").value = data.email;
    document.getElementById("editPendidikanTerakhir").value = data.pendidikan_terakhir;
    document.getElementById("editJurusan").value = data.jurusan;
    document.getElementById("editTahunLulus").value = data.tahun_lulus;
    document.getElementById("editPengalamanKerja").value = data.pengalaman_kerja;
    document.getElementById("editSkillTeknis").value = data.skill_teknis;
    document.getElementById("editSkillNonTeknis").value = data.skill_non_teknis;
    document.getElementById("editPerusahaanTujuan").value = data.perusahaan_tujuan;

    // set form action
    document.getElementById('editForm').action = `/applicants/${data.id}`;

    editModal.classList.remove("hidden");
    
}
function closeEditModal() {
    const modal = document.getElementById('editModal');
    modal.classList.add('hidden');
}

    // Dropdown warna
    function updateVaksinColor(sel){
        switch(sel.value){
            case 'Lengkap': sel.style.backgroundColor='#0EDA52'; break;
            case 'Belum Lengkap': sel.style.backgroundColor='#FACC15'; break;
            case 'Belum Vaksin': sel.style.backgroundColor='#EF4444'; break;
        }
        sel.style.color='white';
    }
    document.querySelectorAll('.status-vaksinasi').forEach(sel=>{
        updateVaksinColor(sel);
        sel.addEventListener('change',()=>updateVaksinColor(sel));
    });

    function updateStatusColor(sel){
        switch(sel.value){
            case 'Waiting List': sel.style.backgroundColor='#FACC15'; break;
            case 'Medical Check Up': sel.style.backgroundColor='#3B82F6'; break;
            case 'Pelatihan': sel.style.backgroundColor='#FB923C'; break;
            case 'Interview': sel.style.backgroundColor='#8B5CF6'; break;
            case 'Diterima': sel.style.backgroundColor='#22C55E'; break;
            case 'Ditolak': sel.style.backgroundColor='#EF4444'; break;
        }
        sel.style.color='white';
    }
    document.querySelectorAll('.status-proses').forEach(sel=>{
        updateStatusColor(sel);
        sel.addEventListener('change',()=>updateStatusColor(sel));
    });
</script>
@endsection