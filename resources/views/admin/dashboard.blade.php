@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-3 gap-5">
    <!-- Pelamar -->
    <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center justify-center border hover:shadow-lg transition">
        <img src="/imgs/candidate.png" class="w-14 h-14 mb-2 opacity-90">
        <div class="text-center">
            <span class="text-orange-500 poppins-medium text-4xl">{{ $totalPelamar }}</span>
            <p class="text-gray-600 text-sm poppins-semibold">Total Pelamar</p>
        </div>
    </div>

    <!-- Lowongan -->
    <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center justify-center border hover:shadow-lg transition">
        <img src="/imgs/Job-search.png" class="w-14 h-14 mb-2 opacity-90">
        <div class="text-center">
            <span class="text-orange-500 poppins-medium text-4xl">{{ $totalLowongan }}</span>
            <p class="text-gray-600 text-sm poppins-semibold">Lowongan Aktif</p>
        </div>
    </div>

    <!-- Perusahaan -->
    <div class="bg-white rounded-xl shadow p-6 flex flex-col items-center justify-center border hover:shadow-lg transition">
        <img src="/imgs/office-building.png" class="w-14 h-14 mb-2 opacity-90">
        <div class="text-center">
            <span class="text-orange-500 poppins-medium text-4xl">{{ $totalPerusahaan }}</span>
            <p class="text-gray-600 text-sm poppins-semibold">Perusahaan Partner</p>
        </div>
    </div>
</div>

    {{-- ============================== --}}
    {{-- DATA PELAMAR TERBARU --}}
    {{-- ============================== --}}
    <div class="mt-10 bg-white rounded-md shadow-sm p-5">
        <h1 class="text-lg text-gray-800 poppins-semibold border-b-2 border-gray-200 pb-3">Data Pelamar Terbaru</h1>
        <div class="relative overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-700">
                <thead class="text-xs text-white uppercase bg-green-500">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-4" >Nama Lengkap</th>
                        <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                        <th scope="col" class="px-6 py-3">Usia</th>
                        <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                        <th scope="col" class="px-6 py-3">Status Pernikahan</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 240px;">Alamat</th>
                        <th scope="col" class="px-6 py-3">NO Telepon</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Pendidikan Terakhir</th>
                        <th scope="col" class="px-6 py-3">Jurusan</th>
                        <th scope="col" class="px-6 py-3">Tahun Lulus</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 240px;" >Pengalaman Kerja</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 240px;">Skill Teknis</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 240px;">Skill Non Teknis</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 200px;">Status Vaksinasi</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 200px;">Status</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 200px;">Perusahaan Tujuan</th>
                    </tr>
                </thead>
                <tbody>
@foreach($pelamarTerbaru as $i => $p)
<tr class="bg-white border-b">
    <td class="px-6 py-3">{{ $i+1 }}</td>
    <td class="px-6 py-3 font-semibold">{{ $p->nama_lengkap }}</td>
    <td class="px-6 py-3">{{ $p->tanggal_lahir }}</td>
    <td class="px-6 py-3">{{ $p->usia }}</td>
    <td class="px-6 py-3">{{ $p->jenis_kelamin }}</td>
    <td class="px-6 py-3">{{ $p->status_pernikahan }}</td>
    <td class="px-6 py-3">{{ $p->alamat }}</td>
    <td class="px-6 py-3">{{ $p->no_telp }}</td>
    <td class="px-6 py-3">{{ $p->email }}</td>
    <td class="px-6 py-3">{{ $p->pendidikan_terakhir }}</td>
    <td class="px-6 py-3">{{ $p->jurusan }}</td>
    <td class="px-6 py-3">{{ $p->tahun_lulus }}</td>
    <td class="px-6 py-3">{{ $p->pengalaman_kerja }}</td>
    <td class="px-6 py-3">{{ $p->skill_teknis }}</td>
    <td class="px-6 py-3">{{ $p->skill_non_teknis }}</td>
    <td class="px-6 py-3">
        <span class="status-vaksinasi px-2 py-1 rounded-full text-white text-xs font-medium shadow">
            {{ $p->status_vaksinasi }}
        </span>
    </td>
    <td class="px-6 py-3">
        <span class="status-proses px-2 py-1 rounded-full text-white text-xs font-medium shadow">
            {{ $p->status }}
        </span>
    </td>
    <td class="px-6 py-3 font-semibold">{{ $p->perusahaan_tujuan }}</td>
</tr>
@endforeach
</tbody>
            </table>
        </div>
    </div>

    {{-- ============================== --}}
    {{-- DATA LOWONGAN TERBARU --}}
    {{-- ============================== --}}
    <div class="mt-10 bg-white rounded-md shadow-sm p-5">
        <h1 class="text-lg text-gray-800 poppins-semibold border-b-2 border-gray-200 pb-3">Data Lowongan Pekerjaan Terbaru</h1>
        <div class="relative overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-700">
                <thead class="text-xs text-white uppercase bg-green-500">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 240px;">Perusahaan</th>
                        <th scope="col" class="px-6 py-3">Posisi</th>
                        <th scope="col" class="px-6 py-3">Usia Minimum</th>
                        <th scope="col" class="px-6 py-3">Usia Maksimum</th>
                        <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                        <th scope="col" class="px-6 py-3">Pendidikan</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 200px;">Jurusan</th>
                        <th scope="col" class="px-6 py-3">Tahun Lulus</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 240px;">Pengalaman</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 240px;">Skill Teknik</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 240px;">Skill Non Teknik</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 200px;">Vaksinasi</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 200px;">Pernikahan</th>
                    </tr>
                </thead>
              <tbody>
@foreach($lowonganTerbaru as $i => $l)
    @php $q = $l->qualification; @endphp
    <tr class="bg-white border-b">
        <td class="px-6 py-3">{{ $i + 1 }}</td>
        <td class="px-6 py-3 font-semibold">{{ $l->company->nama_perusahaan ?? '-' }}</td>
        <td class="px-6 py-3">{{ $l->posisi }}</td>

        <!-- Usia -->
        <td class="px-6 py-3">
            {{ $q && $q->usia_minimum ? $q->usia_minimum : '-' }}
        </td>
        <td class="px-6 py-3">
            {{ $q && $q->usia_maksimum ? $q->usia_maksimum : '-' }}
        </td>

        <!-- Jenis Kelamin -->
        <td class="px-6 py-3">{{ $q->jenis_kelamin ?? '-' }}</td>

        <!-- Pendidikan -->
        <td class="px-6 py-3">{{ $q->pendidikan_terakhir ?? '-' }}</td>
        <td class="px-6 py-3">{{ $q->jurusan ?? '-' }}</td>
        <td class="px-6 py-3">{{ $q->tahun_lulus ?? '-' }}</td>

        <!-- Pengalaman -->
        <td class="px-6 py-3" style="min-width:150px;">
            {!! nl2br(e($q->pengalaman_kerja ?? '-')) !!}
        </td>

        <!-- Skill Teknik -->
        <td class="px-6 py-3" style="min-width:150px;">
            {!! nl2br(e($q->skill_teknis ?? '-')) !!}
        </td>

        <!-- Skill Non Teknik -->
        <td class="px-6 py-3" style="min-width:150px;">
            {!! nl2br(e($q->skill_non_teknis ?? '-')) !!}
        </td>

        <!-- Vaksinasi -->
        <td class="px-6 py-3">
            <span class="status-vaksinasi px-2 py-1 rounded-full text-white text-xs font-medium shadow">
                {{ $q->status_vaksinasi ?? 'Tidak Ditentukan' }}
            </span>
        </td>

        <!-- Pernikahan -->
        <td class="px-6 py-3">{{ $q->status_pernikahan ?? '-' }}</td>
    </tr>
@endforeach
</tbody>


            </table>
        </div>
    </div>

    {{-- ============================== --}}
    {{-- DATA PERUSAHAAN TERBARU --}}
    {{-- ============================== --}}
    <div class="mt-10 bg-white rounded-md shadow-sm p-5">
        <h1 class="text-lg text-gray-800 poppins-semibold border-b-2 border-gray-200 pb-3">Data Perusahaan Terbaru</h1>
        <div class="relative overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-700">
                <thead class="text-xs text-white uppercase bg-green-500">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 200px;">Nama Perusahaan</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 240px;">Bidang Usaha</th>
                        <th scope="col" class="px-6 py-3">Kontak</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 260px;">Lokasi</th>
                    </tr>
                </thead>
               <tbody>
@foreach($perusahaanTerbaru as $i => $c)
<tr class="bg-white border-b">
    <td class="px-6 py-3">{{ $i+1 }}</td>
    <td class="px-6 py-3 font-semibold">{{ $c->nama_perusahaan }}</td>
    <td class="px-6 py-3">{{ $c->bidang_usaha }}</td>
    <td class="px-6 py-3">{{ $c->kontak }}</td>
    <td class="px-6 py-3">{{ $c->alamat}}</td>
</tr>
@endforeach
</tbody>

            </table>
        </div>
    </div>

    <script>
        function setColorBasedOnText() {
            document.querySelectorAll('.status-vaksinasi').forEach(span => {
                const text = span.textContent.trim();
                switch(text) {
                    case 'Lengkap':
                        span.style.backgroundColor = '#0EDA52'; // Hijau
                        break;
                    case 'Belum Lengkap':
                        span.style.backgroundColor = '#FACC15'; // Kuning
                        break;
                    case 'Belum Vaksin':
                        span.style.backgroundColor = '#EF4444'; // Merah
                        break;
                    default:
                        span.style.backgroundColor = '#6B7280'; // Abu-abu jika tidak cocok
                }
                span.style.color = 'white';
            });

            // Untuk Status Proses
            document.querySelectorAll('.status-proses').forEach(span => {
                const text = span.textContent.trim();
                switch(text) {
                    case 'Waiting List':
                        span.style.backgroundColor = '#FACC15'; // Kuning
                        break;
                    case 'Medical Check Up':
                        span.style.backgroundColor = '#3B82F6'; // Biru
                        break;
                    case 'Pelatihan':
                        span.style.backgroundColor = '#FB923C'; // Orange
                        break;
                    case 'Interview':
                        span.style.backgroundColor = '#8B5CF6'; // Ungu
                        break;
                    case 'Diterima':
                        span.style.backgroundColor = '#22C55E'; // Hijau
                        break;
                    case 'Ditolak':
                        span.style.backgroundColor = '#EF4444'; // Merah
                        break;
                    default:
                        span.style.backgroundColor = '#6B7280'; // Abu-abu jika tidak cocok
                }
                span.style.color = 'white';
            });

            // Untuk Status Lowongan
            document.querySelectorAll('.status-lowongan').forEach(span => {
                const text = span.textContent.trim();
                switch(text) {
                    case 'Aktif':
                        span.style.backgroundColor = '#22C55E'; // Hijau
                        break;
                    case 'Tidak Aktif':
                        span.style.backgroundColor = '#EF4444'; // Merah
                        break;
                    case 'Pending':
                        span.style.backgroundColor = '#FACC15'; // Kuning
                        break;
                    default:
                        span.style.backgroundColor = '#6B7280'; // Abu-abu jika tidak cocok
                }
                span.style.color = 'white';
            });
        }

        document.addEventListener('DOMContentLoaded', setColorBasedOnText);
    </script>
@endsection