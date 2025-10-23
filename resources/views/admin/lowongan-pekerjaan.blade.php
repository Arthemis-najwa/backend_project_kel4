@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ $title }}</h1>

<!-- Tabel Lowongan -->
<div class="bg-white rounded-2xl shadow-md p-6 mt-4 border border-gray-200">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold text-gray-800">Daftar Lowongan</h2>
        <button id="openTambahBtn"
            class="px-4 py-2 bg-orange-400 text-white rounded-lg hover:bg-orange-500 transition flex items-center text-sm">
            <i class="fa fa-plus mr-1"></i> Tambah Lowongan
        </button>
    </div>

    <div class="relative overflow-x-auto rounded-2xl">
        <table id="vacancyTable" class="w-full text-sm text-left text-gray-700 border border-gray-200">
            <thead class="bg-green-500 text-white uppercase">
                <tr>
                    <th class="px-4 py-2 border-gray-200">No</th>
                    <th class="px-4 py-2 border-gray-200">Perusahaan</th>
                    <th class="px-4 py-2 border-gray-200">Posisi</th>
                    <th class="px-4 py-2 border-gray-200">Usia Minimum</th>
                    <th class="px-4 py-2 border-gray-200">Usia Maksimum</th>
                    <th class="px-4 py-2 border-gray-200">Jenis Kelamin</th>
                    <th class="px-4 py-2 border-gray-200">Pendidikan</th>
                    <th class="px-4 py-2 border-gray-200">Jurusan</th>
                    <th class="px-4 py-2 border-gray-200">Tahun Lulus</th>
                    <th class="px-4 py-2 border-gray-200">Pengalaman</th>
                    <th class="px-4 py-2 border-gray-200">Skill Teknis</th>
                    <th class="px-4 py-2 border-gray-200">Skill Non Teknis</th>
                    <th class="px-4 py-2 border-gray-200">Vaksin</th>
                    <th class="px-4 py-2 border-gray-200">Pernikahan</th>
                    <th class="px-4 py-2 border-gray-200">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($vacancies as $vacancy)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $vacancy->company->nama_perusahaan ?? '-' }}</td>
                    <td>{{ $vacancy->posisi }}</td>
                    <td>{{ $vacancy->qualification->usia_minimum ?? '-' }}</td>
                    <td>{{ $vacancy->qualification->usia_maksimum ?? '-' }}</td>
                    <td>{{ $vacancy->qualification->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $vacancy->qualification->pendidikan_terakhir ?? '-' }}</td>
                    <td>{{ $vacancy->qualification->jurusan ?? '-' }}</td>
                    <td>{{ $vacancy->qualification->tahun_lulus ?? '-' }}</td>
                    <td>{{ $vacancy->qualification->pengalaman_kerja ?? '-' }}</td>
                    <td>{{ $vacancy->qualification->skill_teknis ?? '-' }}</td>
                    <td>{{ $vacancy->qualification->skill_non_teknis ?? '-' }}</td>
                    <td>{{ $vacancy->qualification->status_vaksinasi ?? '-' }}</td>
                    <td>{{ $vacancy->qualification->status_pernikahan ?? '-' }}</td>
                    <td class="px-4 py-2 flex space-x-3 text-lg">
                        <button class="text-blue-600 hover:scale-110 transition" title="Edit" onclick="openEditModal()">
                            <i class="fa fa-pen"></i>
                        </button>
                        <button class="text-red-500 hover:scale-110 transition" title="Hapus" onclick="openDeleteModal()">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div id="tambahModal" tabindex="-1"
    class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">Tambah Lowongan</h3>
                <button type="button" id="closeTambahBtn"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6-6M7 7l6 6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
            <form action="{{ route('vacancies.store') }}" method="POST" class="p-4 space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="posisi" placeholder="Posisi"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm" required>

                    <select name="company_id"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm" required>
                        <option value="">-- Pilih Perusahaan --</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->nama_perusahaan }}</option>
                        @endforeach
                    </select>

                    <input type="number" name="usia_minimum" placeholder="Usia Minimum"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm">
                    <input type="number" name="usia_maksimum" placeholder="Usia Maksimum"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm">

                    <!-- Jenis kelamin dropdown -->
                    <select name="jenis_kelamin"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    <input type="text" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm">
                    <input type="text" name="jurusan" placeholder="Jurusan"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm">
                    <input type="number" name="tahun_lulus" placeholder="Tahun Lulus"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm">
                    <input type="text" name="pengalaman_kerja" placeholder="Pengalaman Kerja"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm">
                    <input type="text" name="skill_teknis" placeholder="Skill Teknis"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm">
                    <input type="text" name="skill_non_teknis" placeholder="Skill Non Teknis"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm">

                    <select name="status_vaksinasi"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm">
                        <option value="Lengkap">Lengkap</option>
                        <option value="Belum Lengkap">Belum Lengkap</option>
                        <option value="Belum Vaksin">Belum Vaksin</option>
                    </select>

                    <select name="status_pernikahan"
                        class="bg-gray-50 border border-gray-300 rounded-lg p-2.5 text-sm">
                        <option value="Sudah menikah">Sudah menikah</option>
                        <option value="Belum menikah">Belum menikah</option>
                    </select>
                </div>

                <!-- Footer -->
                <div class="flex justify-end border-t border-gray-200 pt-4">
                    <button type="button" id="closeTambahBtn2"
                        class="text-gray-500 bg-white hover:bg-gray-100 border border-gray-200 rounded-lg text-sm px-4 py-2 mr-2">Batal</button>
                    <button type="submit"
                        class="text-white bg-green-600 hover:bg-green-700 rounded-lg text-sm px-5 py-2.5">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" tabindex="-1"
    class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">Edit Lowongan</h3>
                <button type="button" id="closeEditBtn"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6-6M7 7l6 6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <form id="editForm" class="p-4 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" id="editPosisi" class="border p-2 rounded" placeholder="Posisi">
                    <input type="number" id="editUsiaMin" class="border p-2 rounded" placeholder="Usia Minimum">
                    <input type="number" id="editUsiaMax" class="border p-2 rounded" placeholder="Usia Maksimum">

                    <!-- Jenis kelamin dropdown -->
                    <select id="editJenisKelamin" class="border p-2 rounded">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>

                    <input type="text" id="editPendidikan" class="border p-2 rounded" placeholder="Pendidikan Terakhir">
                    <input type="text" id="editJurusan" class="border p-2 rounded" placeholder="Jurusan">
                    <input type="number" id="editTahunLulus" class="border p-2 rounded" placeholder="Tahun Lulus">
                    <input type="text" id="editPengalaman" class="border p-2 rounded" placeholder="Pengalaman Kerja">
                    <input type="text" id="editSkillTeknis" class="border p-2 rounded" placeholder="Skill Teknis">
                    <input type="text" id="editSkillNonTeknis" class="border p-2 rounded" placeholder="Skill Non Teknis">

                    <select id="editVaksin" class="border p-2 rounded">
                        <option>Lengkap</option>
                        <option>Belum Lengkap</option>
                        <option>Belum Vaksin</option>
                    </select>

                    <select id="editPernikahan" class="border p-2 rounded">
                        <option>Sudah menikah</option>
                        <option>Belum menikah</option>
                    </select>
                </div>

                <div class="flex justify-end border-t border-gray-200 pt-4">
                    <button type="button" id="closeEditBtn2"
                        class="text-gray-500 bg-white hover:bg-gray-100 border border-gray-200 rounded-lg text-sm px-4 py-2 mr-2">Batal</button>
                    <button type="submit"
                        class="text-white bg-green-600 hover:bg-green-700 rounded-lg text-sm px-5 py-2.5">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const tambahModal = document.getElementById("tambahModal");
    const openTambahBtn = document.getElementById("openTambahBtn");
    const closeTambahBtn = document.getElementById("closeTambahBtn");
    const closeTambahBtn2 = document.getElementById("closeTambahBtn2");

    openTambahBtn.addEventListener("click", () => tambahModal.classList.remove("hidden"));
    [closeTambahBtn, closeTambahBtn2].forEach(btn => btn.addEventListener("click", () => tambahModal.classList.add("hidden")));

    const editModal = document.getElementById("editModal");
    const closeEditBtn = document.getElementById("closeEditBtn");
    const closeEditBtn2 = document.getElementById("closeEditBtn2");

    function openEditModal() {
        editModal.classList.remove("hidden");
    }
    [closeEditBtn, closeEditBtn2].forEach(btn => btn.addEventListener("click", () => editModal.classList.add("hidden")));

    function openDeleteModal() {
        alert('Hapus dummy');
    }
</script>
@endsection
