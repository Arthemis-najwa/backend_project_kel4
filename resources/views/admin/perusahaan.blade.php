@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-semibold text-gray-800 mb-6">Pendataan Perusahaan Mitra yang Bekerja Sama</h1>

<!-- Card Utama -->
<div class="bg-white rounded-xl shadow-md p-6 mt-10 border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Perusahaan Mitra</h2>
        <button id="openTambahBtn"
            class="px-4 py-3 bg-orange-400 text-white rounded-lg hover:bg-orange-500 transition flex items-center">
            <i class="fa fa-plus mr-2"></i> Tambah Perusahaan
        </button>
    </div>

    <div class="relative overflow-x-auto rounded-xl">
        <table id="companiesTable" class="w-full text-sm text-left text-gray-700 border border-gray-200">
            <thead class="bg-green-500 text-white uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 border-gray-200">No</th>
                    <th class="px-6 py-3 border-gray-200">Nama Perusahaan</th>
                    <th class="px-6 py-3 border-gray-200">Bidang Usaha</th>
                    <th class="px-6 py-3 border-gray-200">Kontak</th>
                    <th class="px-6 py-3 border-gray-200">Lokasi</th>
                    <th class="px-6 py-3 border-gray-200">Status Lowongan</th>
                    <th class="px-6 py-3 border-gray-200 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-200 bg-white hover:bg-green-50 transition">
                    <td class="px-6 py-4">1</td>
                    <td class="px-6 py-4 font-medium text-gray-900">PT ABC</td>
                    <td class="px-6 py-4">Spare Part</td>
                    <td class="px-6 py-4">0854545656</td>
                    <td class="px-6 py-4">KIIC</td>
                    <td class="px-6 py-4">
                        <select class="status-lowongan text-white text-xs px-2 py-1 rounded-full shadow focus:outline-none">
                            <option>Dibuka</option>
                            <option>Ditutup</option>
                        </select>
                    </td>
                    <td class="px-6 py-4 flex justify-center space-x-4 text-lg">
                        <button class="text-blue-600 hover:scale-110 transition" title="Edit" onclick="openEditModal(this)">
                            <i class="fa fa-pen"></i>
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
    $modalClasses = "bg-white w-full max-w-md p-6 rounded-2xl shadow-lg relative overflow-y-auto max-h-[80vh]";
    $inputClasses = "w-full border rounded px-2 py-1 text-sm";
@endphp

<!-- MODAL TAMBAH -->
<div id="tambahModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
    <div class="{{ $modalClasses }}">
        <h2 class="text-base font-semibold mb-4 text-gray-800">Tambah Perusahaan</h2>
        <form id="tambahForm">
            <div class="grid grid-cols-1 gap-3">
                @foreach(['Nama Perusahaan','Bidang Usaha','Kontak','Lokasi','Status Lowongan'] as $field)
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">{{ $field }}</label>
                        @if($field == 'Status Lowongan')
                            <select class="{{ $inputClasses }}" name="status_lowongan">
                                <option>Dibuka</option>
                                <option>Ditutup</option>
                            </select>
                        @else
                            <input type="text" class="{{ $inputClasses }}" name="{{ str_replace(' ','_',strtolower($field)) }}">
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-4 flex justify-end space-x-2">
                <button type="button" id="closeTambahBtn" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400 text-sm">Batal</button>
                <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50">
    <div class="{{ $modalClasses }}">
        <h2 class="text-base font-semibold mb-4 text-gray-800">Edit Perusahaan</h2>
        <form id="editForm">
            <div class="grid grid-cols-1 gap-3">
                @foreach(['Nama Perusahaan','Bidang Usaha','Kontak','Lokasi','Status Lowongan'] as $field)
                    @php $id = 'edit'.str_replace(' ','',$field); @endphp
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">{{ $field }}</label>
                        @if($field == 'Status Lowongan')
                            <select id="{{ $id }}" class="{{ $inputClasses }}">
                                <option>Dibuka</option>
                                <option>Ditutup</option>
                            </select>
                        @else
                            <input type="text" id="{{ $id }}" class="{{ $inputClasses }}">
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-4 flex justify-end space-x-2">
                <button type="button" id="closeEditBtn" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400 text-sm">Batal</button>
                <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // ====== Modal Tambah ======
    const tambahModal = document.getElementById("tambahModal");
    const openTambahBtn = document.getElementById("openTambahBtn");
    const closeTambahBtn = document.getElementById("closeTambahBtn");
    const tambahForm = document.getElementById("tambahForm");
    const companiesTable = document.getElementById("companiesTable").querySelector("tbody");

    openTambahBtn.addEventListener("click", () => tambahModal.classList.remove("hidden"));
    closeTambahBtn.addEventListener("click", () => tambahModal.classList.add("hidden"));

    tambahForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const formData = new FormData(tambahForm);
        const values = Object.fromEntries(formData.entries());
        const rowCount = companiesTable.children.length + 1;

        const newRow = document.createElement("tr");
        newRow.className = "border-b border-gray-200 bg-white hover:bg-green-50 transition";
        newRow.innerHTML = `
            <td class='px-6 py-4'>${rowCount}</td>
            <td class='px-6 py-4 font-medium text-gray-900'>${values.nama_perusahaan}</td>
            <td class='px-6 py-4'>${values.bidang_usaha}</td>
            <td class='px-6 py-4'>${values.kontak}</td>
            <td class='px-6 py-4'>${values.lokasi}</td>
            <td class='px-6 py-4'>
                <select class='status-lowongan text-white text-xs px-2 py-1 rounded-full shadow focus:outline-none'>
                    <option ${values.status_lowongan === 'Dibuka' ? 'selected' : ''}>Dibuka</option>
                    <option ${values.status_lowongan === 'Ditutup' ? 'selected' : ''}>Ditutup</option>
                </select>
            </td>
            <td class='px-6 py-4 flex justify-center space-x-4 text-lg'>
                <button class='text-blue-600 hover:scale-110 transition' title='Edit' onclick='openEditModal(this)'><i class='fa fa-pen'></i></button>
                <button class='text-red-500 hover:scale-110 transition' title='Hapus' onclick='openDeleteModal()'><i class='fa fa-trash'></i></button>
            </td>
        `;

        companiesTable.appendChild(newRow);
        tambahForm.reset();
        tambahModal.classList.add("hidden");
        initStatusColors();
    });

    // ====== Modal Edit ======
    const editModal = document.getElementById("editModal");
    const closeEditBtn = document.getElementById("closeEditBtn");
    const fields = ["NamaPerusahaan","BidangUsaha","Kontak","Lokasi","StatusLowongan"];

    function openEditModal(btn) {
        const row = btn.closest("tr");
        const cells = row.querySelectorAll("td");
        document.getElementById("editNamaPerusahaan").value = cells[1].innerText.trim();
        document.getElementById("editBidangUsaha").value = cells[2].innerText.trim();
        document.getElementById("editKontak").value = cells[3].innerText.trim();
        document.getElementById("editLokasi").value = cells[4].innerText.trim();
        document.getElementById("editStatusLowongan").value = cells[5].querySelector("select").value;
        editModal.classList.remove("hidden");
    }

    closeEditBtn.addEventListener("click", () => editModal.classList.add("hidden"));

    // ====== Delete Dummy ======
    function openDeleteModal() {
        alert("Fitur hapus belum diaktifkan.");
    }

    // ====== Warna Dropdown ======
    function updateLowonganColor(select) {
        switch (select.value) {
            case "Dibuka":
                select.style.backgroundColor = "#22C55E";
                select.style.color = "white";
                break;
            case "Ditutup":
                select.style.backgroundColor = "#EF4444";
                select.style.color = "white";
                break;
        }
    }

    function initStatusColors() {
        document.querySelectorAll(".status-lowongan").forEach(sel => {
            updateLowonganColor(sel);
            sel.addEventListener("change", () => updateLowonganColor(sel));
        });
    }

    initStatusColors();
</script>
@endsection
