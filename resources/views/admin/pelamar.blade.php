@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">
    Pendataan Pelamar yang telah mendaftar
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
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b border-gray-200 hover:bg-green-50 transition">
                    <td class="px-6 py-4">1</td>
                    <td class="px-6 py-4 font-semibold text-gray-900">John Doe</td>
                    <td class="px-6 py-4">1998-10-17</td>
                    <td class="px-6 py-4">25</td>
                    <td class="px-6 py-4">Laki-laki</td>
                    <td class="px-6 py-4">Belum Menikah</td>
                    <td class="px-6 py-4">Jl. Merdeka No.10</td>
                    <td class="px-6 py-4">081234567890</td>
                    <td class="px-6 py-4">john@example.com</td>
                    <td class="px-6 py-4">S1</td>
                    <td class="px-6 py-4">Teknik Informatika</td>
                    <td class="px-6 py-4">2020</td>
                    <td class="px-6 py-4">2 tahun di PT XYZ</td>
                    <td class="px-6 py-4">ReactJS, MySQL, Git</td>
                    <td class="px-6 py-4">Komunikatif, Leadership</td>
                    <td class="px-6 py-4">
                        <select class="status-vaksinasi px-2 py-1 rounded-full text-white text-xs font-medium shadow focus:outline-none">
                            <option>Lengkap</option>
                            <option>Belum Lengkap</option>
                            <option>Belum Vaksin</option>
                        </select>
                    </td>
                    <td class="px-6 py-4">PT ABC Technology</td>
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
                        <button class="text-green-600 hover:scale-110 transition" title="Download CV">
                            <i class="fa fa-download"></i>
                        </button>
                        <button class="text-yellow-500 hover:scale-110 transition" title="Kirim">
                            <i class="fa fa-paper-plane"></i>
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
    $modalClasses = "bg-white w-full max-w-3xl p-6 rounded-2xl shadow-xl relative overflow-y-auto max-h-[85vh]";
    $inputClasses = "w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-400 outline-none";
@endphp

<!-- MODAL TAMBAH -->
<div id="tambahModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="{{ $modalClasses }}">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Tambah Data Pelamar</h2>
        <form id="tambahForm">
            <div class="grid grid-cols-2 gap-4">
                @foreach(['Nama Lengkap','Tanggal Lahir','Usia','Jenis Kelamin','Status Pernikahan','Alamat','No Telepon','Email','Pendidikan Terakhir','Jurusan','Tahun Lulus','Pengalaman Kerja','Skill Teknis','Skill Non Teknis','Perusahaan Tujuan'] as $field)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $field }}</label>
                        @if($field=='Jenis Kelamin' || $field=='Status Pernikahan')
                        <select class="{{ $inputClasses }}">
                            @if($field=='Jenis Kelamin')
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                            @else
                            <option>Belum Menikah</option>
                            <option>Menikah</option>
                            @endif
                        </select>
                        @elseif(str_contains($field,'Skill') || $field=='Alamat')
                        <textarea class="{{ $inputClasses }}" rows="2"></textarea>
                        @elseif($field=='Usia' || $field=='Tahun Lulus')
                        <input type="number" class="{{ $inputClasses }}">
                        @elseif($field=='Tanggal Lahir')
                        <input type="date" class="{{ $inputClasses }}">
                        @else
                        <input type="text" class="{{ $inputClasses }}">
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" id="closeTambahBtn" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 text-sm">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="{{ $modalClasses }}">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Edit Data Pelamar</h2>
        <form id="editForm">
            <div class="grid grid-cols-2 gap-4">
                @foreach(['Nama Lengkap','Tanggal Lahir','Usia','Jenis Kelamin','Status Pernikahan','Alamat','No Telepon','Email','Pendidikan Terakhir','Jurusan','Tahun Lulus','Pengalaman Kerja','Skill Teknis','Skill Non Teknis','Perusahaan Tujuan'] as $field)
                    @php $id = 'edit'.str_replace(' ','',$field); @endphp
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $field }}</label>
                        @if($field=='Jenis Kelamin' || $field=='Status Pernikahan')
                        <select id="{{ $id }}" class="{{ $inputClasses }}">
                            @if($field=='Jenis Kelamin')
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                            @else
                            <option>Belum Menikah</option>
                            <option>Menikah</option>
                            @endif
                        </select>
                        @elseif(str_contains($field,'Skill') || $field=='Alamat')
                        <textarea id="{{ $id }}" class="{{ $inputClasses }}" rows="2"></textarea>
                        @elseif($field=='Usia' || $field=='Tahun Lulus')
                        <input type="number" id="{{ $id }}" class="{{ $inputClasses }}">
                        @elseif($field=='Tanggal Lahir')
                        <input type="date" id="{{ $id }}" class="{{ $inputClasses }}">
                        @else
                        <input type="text" id="{{ $id }}" class="{{ $inputClasses }}">
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" id="closeEditBtn" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400 text-sm">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 text-sm">Simpan</button>
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

    // Modal Edit
    const editModal = document.getElementById("editModal");
    const closeEditBtn = document.getElementById("closeEditBtn");
    function openEditModal(btn){
        editModal.classList.remove("hidden");
    }
    closeEditBtn.addEventListener("click", () => editModal.classList.add("hidden"));

    // Delete dummy
    function openDeleteModal(){ alert('Fungsi hapus belum diaktifkan'); }

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
