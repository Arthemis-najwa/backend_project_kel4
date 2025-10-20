@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">Pendataan arsip riwayat Pelamar yang pernah mendaftar</h1>

<!-- Tabel Pelamar -->
<div class="bg-white rounded-xl shadow-md p-6 mt-10 border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Pelamar</h2>
        <button id="openTambahBtn"
            class="px-4 py-3 bg-orange-400 text-white rounded-lg hover:bg-orange-500 transition flex items-center">
            <i class="fa fa-plus mr-2"></i> Tambah Pelamar
        </button>
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
                    <th class="px-6 py-3 border-gray-200">Status</th>
                    <th class="px-6 py-3 border-gray-200 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <tr class="border-b border-gray-200 bg-white hover:bg-green-50 transition">
                    <td class="px-6 py-4">1</td>
                    <td class="px-6 py-4 font-medium text-gray-900">John Doe</td>
                    <td class="px-6 py-4">25</td>
                    <td class="px-6 py-4">Laki-laki</td>
                    <td class="px-6 py-4">S1</td>
                    <td class="px-6 py-4">Teknik Informatika</td>
                    <td class="px-6 py-4">ReactJS, MySQL, Git</td>
                    <td class="px-6 py-4">Komunikatif, Leadership</td>
                    <td class="px-6 py-4">
                        <select class="status-vaksinasi bg-green-500 text-white text-xs px-2 py-1 rounded-full shadow focus:outline-none">
                            <option>Lengkap</option>
                            <option>Belum Lengkap</option>
                            <option>Belum Vaksin</option>
                        </select>
                    </td>
                    <td class="px-6 py-4">PT ABC Technology</td>
                    <td class="px-6 py-4">
                        <select class="status-proses bg-yellow-400 text-white text-xs px-2 py-1 rounded-full shadow focus:outline-none">
                            <option>Waiting List</option>
                            <option>Medical Check Up</option>
                            <option>Pelatihan</option>
                            <option>Interview</option>
                            <option>Diterima</option>
                            <option>Ditolak</option>
                        </select>
                    </td>
                    <td class="px-6 py-4 flex justify-center space-x-4 text-lg">
                        <button class="text-green-600 hover:scale-110 transition" title="Restore">
                            <i class="fa fa-rotate-left"></i>
                        </button>
                        <button class="text-red-500 hover:scale-110 transition" title="Hapus" onclick="openDeleteModal()">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@php
    $modalClasses = "bg-white w-full max-w-sm p-4 rounded-2xl shadow-lg relative overflow-y-auto max-h-[80vh]";
    $inputClasses = "w-full border rounded px-2 py-1 text-sm";
@endphp

<!-- MODAL TAMBAH -->
<div id="tambahModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
    <div class="{{ $modalClasses }}">
        <h2 class="text-base font-semibold mb-2 text-gray-800">Tambah Pelamar</h2>
        <form id="tambahForm">
            <div class="grid grid-cols-2 gap-2">
                @foreach(['Nama','Usia','Jenis Kelamin','Pendidikan','Jurusan','Skill Teknis','Skill Non Teknis','Perusahaan Tujuan'] as $field)
                    <div>
                        <label class="block text-xs font-medium text-gray-700">{{ $field }}</label>
                        @if($field=='Jenis Kelamin')
                        <select class="{{ $inputClasses }}">
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                        @elseif(str_contains($field,'Skill'))
                        <textarea class="{{ $inputClasses }}" rows="2"></textarea>
                        @elseif($field=='Usia')
                        <input type="number" class="{{ $inputClasses }}">
                        @else
                        <input type="text" class="{{ $inputClasses }}">
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="mt-2 flex justify-end space-x-2">
                <button type="button" id="closeTambahBtn" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400 text-sm">Batal</button>
                <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Modal Tambah
    const tambahModal = document.getElementById("tambahModal");
    const openTambahBtn = document.getElementById("openTambahBtn");
    const closeTambahBtn = document.getElementById("closeTambahBtn");
    openTambahBtn.addEventListener("click", () => tambahModal.classList.remove("hidden"));
    closeTambahBtn.addEventListener("click", () => tambahModal.classList.add("hidden"));

    // Dummy delete
    function openDeleteModal(){ alert('Hapus data pelamar ini?'); }

    // Warna dropdown vaksinasi
    function updateVaksinColor(select){
        switch(select.value){
            case 'Lengkap': select.style.backgroundColor='#0EDA52'; select.style.color='white'; break;
            case 'Belum Lengkap': select.style.backgroundColor='#FFC107'; select.style.color='black'; break;
            case 'Belum Vaksin': select.style.backgroundColor='#EF4444'; select.style.color='white'; break;
        }
    }
    document.querySelectorAll('.status-vaksinasi').forEach(sel=>{
        updateVaksinColor(sel);
        sel.addEventListener('change', ()=>updateVaksinColor(sel));
    });

    // Warna dropdown status proses
    function updateStatusColor(select){
        switch(select.value){
            case 'Waiting List': select.style.backgroundColor='#FACC15'; select.style.color='black'; break;
            case 'Medical Check Up': select.style.backgroundColor='#3B82F6'; select.style.color='white'; break;
            case 'Pelatihan': select.style.backgroundColor='#FB923C'; select.style.color='white'; break;
            case 'Interview': select.style.backgroundColor='#8B5CF6'; select.style.color='white'; break;
            case 'Diterima': select.style.backgroundColor='#22C55E'; select.style.color='white'; break;
            case 'Ditolak': select.style.backgroundColor='#EF4444'; select.style.color='white'; break;
        }
    }
    document.querySelectorAll('.status-proses').forEach(sel=>{
        updateStatusColor(sel);
        sel.addEventListener('change', ()=>updateStatusColor(sel));
    });
</script>
@endsection
