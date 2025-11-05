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
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Usia</label>
                        <input type="number" name="usia" placeholder="Masukkan usia"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="jenis_kelamin"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Status Pernikahan</label>
                        <select name="status_pernikahan"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="Menikah">Menikah</option>
                        </select>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" placeholder="Masukkan alamat lengkap"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" rows="2" required></textarea>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">No Telepon</label>
                        <input type="text" name="no_telp" placeholder="Contoh: 081234567890"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" placeholder="Contoh: email@example.com"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan_terakhir" placeholder="Contoh: S1, SMA, D3"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Jurusan</label>
                        <input type="text" name="jurusan" placeholder="Contoh: Teknik Informatika"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Tahun Lulus</label>
                        <input type="number" name="tahun_lulus" placeholder="Contoh: 2020"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Pengalaman Kerja</label>
                        <input type="text" name="pengalaman_kerja" placeholder="Contoh: 2 tahun di PT XYZ"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Skill Teknis</label>
                        <textarea name="skill_teknis" placeholder="Contoh: PHP, Laravel, MySQL"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" rows="2" required></textarea>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="text-sm font-medium text-gray-700">Skill Non Teknis</label>
                        <textarea name="skill_non_teknis" placeholder="Contoh: Komunikasi, Leadership"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" rows="2" required></textarea>
                    </div>
                    
                    <div class="space-y-1 col-span-2">
                        <label class="text-sm font-medium text-gray-700">Perusahaan Tujuan</label>
                        <input type="text" name="perusahaan_tujuan" placeholder="Contoh: PT ABC Technology"
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-green-500 focus:border-green-500" required>
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
    <div class="{{ $modalClasses }}">
        <div class="relative bg-white rounded-lg shadow">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">Edit Data Pelamar</h3>
                <button type="button" id="closeEditBtn"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6-6M7 7l6 6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <!-- Body -->
           <form id="editForm" class="p-4 space-y-4" method="POST">
    @csrf
    @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" id="editNamaLengkap" name="nama_lengkap" placeholder="Nama Lengkap"
                        class="{{ $inputClasses }}" required>
                    <input type="date" id="editTanggalLahir" name="tanggal_lahir" placeholder="Tanggal Lahir"
                        class="{{ $inputClasses }}" required>
                    <input type="number" id="editUsia" name="usia" placeholder="Usia"
                        class="{{ $inputClasses }}" required>
                    <select id="editJenisKelamin" name="jenis_kelamin"
                        class="{{ $inputClasses }}" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <select id="editStatusPernikahan" name="status_pernikahan"
                        class="{{ $inputClasses }}" required>
                        <option value="">-- Pilih Status Pernikahan --</option>
                        <option value="Belum Menikah">Belum Menikah</option>
                        <option value="Menikah">Menikah</option>
                    </select>
                    <textarea id="editAlamat" name="alamat" placeholder="Alamat"
                        class="{{ $inputClasses }}" rows="2" required></textarea>
                    <input type="text" id="editNoTelepon" name="no_telp" placeholder="No Telepon"
                        class="{{ $inputClasses }}" required>
                    <input type="email" id="editEmail" name="email" placeholder="Email"
                        class="{{ $inputClasses }}" required>
                    <input type="text" id="editPendidikanTerakhir" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir"
                        class="{{ $inputClasses }}" required>
                    <input type="text" id="editJurusan" name="jurusan" placeholder="Jurusan"
                        class="{{ $inputClasses }}" required>
                    <input type="number" id="editTahunLulus" name="tahun_lulus" placeholder="Tahun Lulus"
                        class="{{ $inputClasses }}" required>
                    <input type="text" id="editPengalamanKerja" name="pengalaman_kerja" placeholder="Pengalaman Kerja"
                        class="{{ $inputClasses }}" required>
                    <textarea id="editSkillTeknis" name="skill_teknis" placeholder="Skill Teknis"
                        class="{{ $inputClasses }}" rows="2" required></textarea>
                    <textarea id="editSkillNonTeknis" name="skill_non_teknis" placeholder="Skill Non Teknis"
                        class="{{ $inputClasses }}" rows="2" required></textarea>
                    <input type="text" id="editPerusahaanTujuan" name="perusahaan_tujuan" placeholder="Perusahaan Tujuan"
                        class="{{ $inputClasses }}" required>
                </div>

                <!-- Footer -->
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