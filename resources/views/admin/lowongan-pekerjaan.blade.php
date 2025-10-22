@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ $title }}</h1>

<!-- Tabel Pelamar -->
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
                    <th class="px-4 py-2 border-gray-200">Usia</th>
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
    <td>{{ $vacancy->company->nama_perusahaan?? '-' }}</td>
    <td>{{ $vacancy->posisi }}</td>
    <td>{{ $vacancy->qualification->usia ?? '-' }}</td>
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
        <button class="text-blue-600 hover:scale-110 transition" title="Edit" onclick="openEditModal(this)">
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

@php
    $modalClasses = "bg-white w-full max-w-md p-6 rounded-2xl shadow-lg relative overflow-y-auto max-h-[80vh]";
    $inputClasses = "w-full border rounded px-2 py-1 text-sm";
@endphp

<!-- MODAL TAMBAH -->
<div id="tambahModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
    <div class="{{ $modalClasses }}">
        <h2 class="text-base font-semibold mb-2 text-gray-800">Tambah Lowongan</h2>
        <form action="{{ route('vacancies.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-2 gap-4">
       
        <input type="text" name="posisi" placeholder="Posisi" class="border p-2 rounded" required>

        <!-- Dropdown perusahaan -->
        <select name="company_id" class="border p-2 rounded" required>
            <option value="">-- Pilih Perusahaan --</option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->nama_perusahaan }}</option>
            @endforeach
        </select>

        <input type="number" name="usia" placeholder="Usia" class="border p-2 rounded">
        <input type="text" name="jenis_kelamin" placeholder="Jenis Kelamin" class="border p-2 rounded">
        <input type="text" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir" class="border p-2 rounded">
        <input type="text" name="jurusan" placeholder="Jurusan" class="border p-2 rounded">
        <input type="number" name="tahun_lulus" placeholder="Tahun Lulus" class="border p-2 rounded">
        <input type="text" name="pengalaman_kerja" placeholder="Pengalaman Kerja" class="border p-2 rounded">
        <input type="text" name="skill_teknis" placeholder="Skill Teknis" class="border p-2 rounded">
        <input type="text" name="skill_non_teknis" placeholder="Skill Non Teknis" class="border p-2 rounded">
        <select name="status_vaksinasi" class="border p-2 rounded">
            <option value="Lengkap">Lengkap</option>
            <option value="Belum Lengkap">Belum Lengkap</option>
            <option value="Belum Vaksin">Belum Vaksin</option>
        </select>
        <select name="status_pernikahan" class="border p-2 rounded">
            <option value="Sudah menikah">Sudah menikah</option>
            <option value="Belum menikah">Belum menikah</option>
        </select>
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded mt-4">Simpan</button>
</form>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
    <div class="{{ $modalClasses }}">
        <h2 class="text-base font-semibold mb-2 text-gray-800">Edit Pelamar</h2>
        <form id="editForm">
            <div class="grid grid-cols-2 gap-2">
                @foreach(['Nama','Perusahaan','Posisi','Usia','Jenis Kelamin','Pendidikan Terakhir','Jurusan','Tahun Lulus','Pengalaman Kerja','Skill Teknis','Skill Non Teknis'] as $field)
                    <div>
                        <label class="block text-xs font-medium text-gray-700">{{ $field }}</label>
                        @if($field=='Jenis Kelamin')
                            <select id="edit{{ str_replace(' ','',$field) }}" class="{{ $inputClasses }}">
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                            </select>
                        @elseif(str_contains($field,'Skill'))
                            <textarea id="edit{{ str_replace(' ','',$field) }}" class="{{ $inputClasses }}" rows="2"></textarea>
                        @elseif($field=='Usia' || $field=='Tahun Lulus')
                            <input type="number" id="edit{{ str_replace(' ','',$field) }}" class="{{ $inputClasses }}">
                        @else
                            <input type="text" id="edit{{ str_replace(' ','',$field) }}" class="{{ $inputClasses }}">
                        @endif
                    </div>
                @endforeach

                <div>
                    <label class="block text-xs font-medium text-gray-700">Vaksin</label>
                    <select id="editVaksin" class="{{ $inputClasses }}">
                        <option>Lengkap</option>
                        <option>Belum Lengkap</option>
                        <option>Belum Vaksin</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700">Pernikahan</label>
                    <select id="editPernikahan" class="{{ $inputClasses }}">
                        <option>Sudah menikah</option>
                        <option>Belum menikah</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 flex justify-end space-x-2">
                <button type="button" id="closeEditBtn" class="px-4 py-1 bg-gray-300 rounded hover:bg-gray-400 text-sm">Batal</button>
                <button type="submit" class="px-4 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Modal Tambah
    const tambahModal = document.getElementById("tambahModal");
    const openTambahBtn = document.getElementById("openTambahBtn");
    const closeTambahBtn = document.getElementById("closeTambahBtn");
    openTambahBtn.addEventListener("click", ()=> tambahModal.classList.remove("hidden"));
    closeTambahBtn.addEventListener("click", ()=> tambahModal.classList.add("hidden"));

    // Modal Edit
    const editModal = document.getElementById("editModal");
    const closeEditBtn = document.getElementById("closeEditBtn");

    function openEditModal(btn){
        const row = btn.closest("tr");
        const cells = row.children;

        document.getElementById("editNama").value = cells[1].innerText;
        document.getElementById("editPerusahaan").value = cells[2].innerText;
        document.getElementById("editPosisi").value = cells[3].innerText;
        document.getElementById("editUsia").value = cells[4].innerText;
        document.getElementById("editJenisKelamin").value = cells[5].innerText;
        document.getElementById("editPendidikanTerakhir").value = cells[6].innerText;
        document.getElementById("editJurusan").value = cells[7].innerText;
        document.getElementById("editTahunLulus").value = cells[8].innerText;
        document.getElementById("editPengalamanKerja").value = cells[9].innerText;
        document.getElementById("editSkillTeknis").value = cells[10].innerText;
        document.getElementById("editSkillNonTeknis").value = cells[11].innerText;
        document.getElementById("editVaksin").value = cells[12].children[0].value;
        document.getElementById("editPernikahan").value = cells[13].children[0].value;

        updateVaksinColor(document.getElementById("editVaksin"));
        updatePernikahanColor(document.getElementById("editPernikahan"));

        editModal.classList.remove("hidden");
    }

    closeEditBtn.addEventListener("click", ()=> editModal.classList.add("hidden"));

    // Hapus dummy
    function openDeleteModal(){ alert('Hapus dummy'); }

    // Dropdown warna
    function updateVaksinColor(sel){
        switch(sel.value){
            case 'Lengkap': sel.style.backgroundColor='#0EDA52'; sel.style.color='white'; break;
            case 'Belum Lengkap': sel.style.backgroundColor='#FFC107'; sel.style.color='black'; break;
            case 'Belum Vaksin': sel.style.backgroundColor='#EF4444'; sel.style.color='white'; break;
        }
    }
    function updatePernikahanColor(sel){
        switch(sel.value){
            case 'Sudah menikah': sel.style.backgroundColor='#3B82F6'; sel.style.color='white'; break;
            case 'Belum menikah': sel.style.backgroundColor='#52D8A7'; sel.style.color='black'; break;
        }
    }

    document.querySelectorAll('.status-vaksinasi').forEach(s=>{
        updateVaksinColor(s);
        s.addEventListener('change', ()=> updateVaksinColor(s));
    });
    document.querySelectorAll('.status-pernikahan').forEach(s=>{
        updatePernikahanColor(s);
        s.addEventListener('change', ()=> updatePernikahanColor(s));
    });
</script>
@endsection