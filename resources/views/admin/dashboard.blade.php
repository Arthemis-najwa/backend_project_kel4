@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-3 gap-5">
        <div class="bg-white rounded-md shadow-sm p-5 flex flex-col items-center justify-center">
            <img src="/imgs/candidate.png" alt="" class="w-16 h-16 mb-2">
            <div class="flex flex-col gap-1 text-center">
                <span class="text-orange-500 poppins-medium text-3xl">58</span>
                <span class="text-orange-500">Pelamar</span>
            </div>
        </div>
        <div class="bg-white rounded-md shadow-sm p-5 flex flex-col items-center justify-center">
            <img src="/imgs/Job-search.png" alt="" class="w-16 h-16 mb-2">
            <div class="flex flex-col gap-1 text-center">
                <span class="text-orange-500 poppins-medium text-3xl">18</span>
                <span class="text-orange-500">Lowongan Pekerjaan</span>
            </div>
        </div>
        <div class="bg-white rounded-md shadow-sm p-5 flex flex-col items-center justify-center">
            <img src="/imgs/office-building.png" alt="" class="w-16 h-16 mb-2">
            <div class="flex flex-col gap-1 text-center">
                <span class="text-orange-500 poppins-medium text-3xl">58</span>
                <span class="text-orange-500">Perusahaan</span>
            </div>
        </div>
    </div>

    {{-- ============================== --}}
    {{-- DATA PELAMAR TERBARU --}}
    {{-- ============================== --}}
    <div class="mt-10 bg-white rounded-md shadow-sm p-5">
        <h1 class="text-lg text-gray-400 poppins-medium border-b-2 border-gray-200 pb-3">Data Pelamar Terbaru</h1>
        <div class="relative overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-green-500">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                        <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                        <th scope="col" class="px-6 py-3">Usia</th>
                        <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                        <th scope="col" class="px-6 py-3">Status Pernikahan</th>
                        <th scope="col" class="px-6 py-3">Alamat</th>
                        <th scope="col" class="px-6 py-3">NO Telepon</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3" >Pendidikan Terakhir</th>
                        <th scope="col" class="px-6 py-3">Jurusan</th>
                        <th scope="col" class="px-6 py-3">Tahun Lulus</th>
                        <th scope="col" class="px-6 py-3">Pengalaman Kerja</th>
                        <th scope="col" class="px-6 py-3">Skill Teknis</th>
                        <th scope="col" class="px-6 py-3">Skill Non Teknis</th>
                        <th scope="col" class="px-6 py-3">Status Vaksinasi</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3" style="min-width: 200px;">Perusahaan Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-3">1</td>
                        <td class="px-6 py-3">Andi Saputra</td>
                        <td class="px-6 py-3">1999-05-15</td>
                        <td class="px-6 py-3">25</td>
                        <td class="px-6 py-3">Laki-laki</td>
                        <td class="px-6 py-3">Belum Menikah</td>
                        <td class="px-6 py-3">Jl. Sudirman No. 10, Jakarta</td>
                        <td class="px-6 py-3">081234567890</td>
                        <td class="px-6 py-3">andi@example.com</td>
                        <td class="px-6 py-3">S1</td>
                        <td class="px-6 py-3">Teknik Informatika</td>
                        <td class="px-6 py-3">2021</td>
                        <td class="px-6 py-3">2 tahun sebagai Developer</td>
                        <td class="px-6 py-3">PHP, Laravel, MySQL</td>
                        <td class="px-6 py-3">Komunikasi, Timwork</td>
                        <td class="px-6 py-3">
                            <span class="status-vaksinasi px-2 py-1 rounded-full text-white text-xs font-medium shadow">Lengkap</span>
                        </td>
                        <td class="px-6 py-3">
                            <span class="status-proses px-2 py-1 rounded-full text-white text-xs font-medium shadow">Pelatihan</span>
                        </td>
                        <td class="px-6 py-3" style="line-height: 1.8;">PT Maju Bersama<br>PT Jaya Abadi<br>PT Sejahtera</td>
                    </tr>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-3">2</td>
                        <td class="px-6 py-3">Siti Aminah</td>
                        <td class="px-6 py-3">1998-03-20</td>
                        <td class="px-6 py-3">26</td>
                        <td class="px-6 py-3">Perempuan</td>
                        <td class="px-6 py-3">Menikah</td>
                        <td class="px-6 py-3">Jl. Thamrin No. 5, Jakarta</td>
                        <td class="px-6 py-3">081987654321</td>
                        <td class="px-6 py-3">siti@example.com</td>
                        <td class="px-6 py-3">S1</td>
                        <td class="px-6 py-3">Manajemen Bisnis</td>
                        <td class="px-6 py-3">2020</td>
                        <td class="px-6 py-3">3 tahun sebagai Manager</td>
                        <td class="px-6 py-3">Excel, PowerPoint</td>
                        <td class="px-6 py-3">Leadership, Problem Solving</td>
                        <td class="px-6 py-3">
                            <span class="status-vaksinasi px-2 py-1 rounded-full text-white text-xs font-medium shadow">Lengkap</span>
                        </td>
                        <td class="px-6 py-3">
                            <span class="status-proses px-2 py-1 rounded-full text-white text-xs font-medium shadow">Diterima</span>
                        </td>
                        <td class="px-6 py-3" style="line-height: 1.8;">PT Sukses Abadi<br>PT Sampoerna<br>PT Semangat Abadi</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- ============================== --}}
    {{-- DATA LOWONGAN TERBARU --}}
    {{-- ============================== --}}
    <div class="mt-10 bg-white rounded-md shadow-sm p-5">
        <h1 class="text-lg text-gray-400 poppins-medium border-b-2 border-gray-200 pb-3">Data Lowongan Pekerjaan Terbaru</h1>
        <div class="relative overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-green-500">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Perusahaan</th>
                        <th scope="col" class="px-6 py-3">Posisi</th>
                        <th scope="col" class="px-6 py-3">Usia Minimum</th>
                        <th scope="col" class="px-6 py-3">Usia Maksimum</th>
                        <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                        <th scope="col" class="px-6 py-3">Pendidikan</th>
                        <th scope="col" class="px-6 py-3">Jurusan</th>
                        <th scope="col" class="px-6 py-3">Tahun Lulus</th>
                        <th scope="col" class="px-6 py-3">Pengalaman</th>
                        <th scope="col" class="px-6 py-3">Skill Teknik</th>
                        <th scope="col" class="px-6 py-3">Skill Non Teknik</th>
                        <th scope="col" class="px-6 py-3">Vaksinasi</th>
                        <th scope="col" class="px-6 py-3">Pernikahan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-3">1</td>
                        <td class="px-6 py-3">PT Maju Bersama</td>
                        <td class="px-6 py-3">Staff Administrasi</td>
                        <td class="px-6 py-3">20</td>
                        <td class="px-6 py-3">30</td>
                        <td class="px-6 py-3">Perempuan</td>
                        <td class="px-6 py-3">D3</td>
                        <td class="px-6 py-3">Administrasi</td>
                        <td class="px-6 py-3">2020</td>
                        <td class="px-6 py-3">1 tahun</td>
                        <td class="px-6 py-3">Microsoft Office</td>
                        <td class="px-6 py-3">Komunikasi</td>
                        <td class="px-6 py-3">Belum Vaksin</td>
                        <td class="px-6 py-3">Sudah Menikah</td>
                    </tr>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-3">2</td>
                        <td class="px-6 py-3">PT Sukses Abadi</td>
                        <td class="px-6 py-3">Software Engineer</td>
                        <td class="px-6 py-3">22</td>
                        <td class="px-6 py-3">35</td>
                        <td class="px-6 py-3">Laki Laki</td>
                        <td class="px-6 py-3">S1</td>
                        <td class="px-6 py-3">Teknik Informatika</td>
                        <td class="px-6 py-3">2019</td>
                        <td class="px-6 py-3">2 tahun</td>
                        <td class="px-6 py-3">Java, Spring Boot</td>
                        <td class="px-6 py-3">Problem Solving</td>
                        <td class="px-6 py-3">Wajib</td>
                        <td class="px-6 py-3">Laki Laki</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- ============================== --}}
    {{-- DATA PERUSAHAAN TERBARU --}}
    {{-- ============================== --}}
    <div class="mt-10 bg-white rounded-md shadow-sm p-5">
        <h1 class="text-lg text-gray-400 poppins-medium border-b-2 border-gray-200 pb-3">Data Perusahaan Terbaru</h1>
        <div class="relative overflow-x-auto mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-green-500">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama Perusahaan</th>
                        <th scope="col" class="px-6 py-3">Bidang Usaha</th>
                        <th scope="col" class="px-6 py-3">Kontak</th>
                        <th scope="col" class="px-6 py-3">Lokasi</th>
                        <th scope="col" class="px-6 py-3">Status Lowongan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-3">1</td>
                        <td class="px-6 py-3">PT Maju Bersama</td>
                        <td class="px-6 py-3">Manufaktur</td>
                        <td class="px-6 py-3">021-555-7890</td>
                        <td class="px-6 py-3">Jakarta Barat</td>
                        <td class="px-6 py-3">
                            <span class="status-lowongan px-2 py-1 rounded-full text-white text-xs font-medium shadow">Aktif</span>
                        </td>
                    </tr>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-3">2</td>
                        <td class="px-6 py-3">PT Sukses Abadi</td>
                        <td class="px-6 py-3">Teknologi</td>
                        <td class="px-6 py-3">021-444-1234</td>
                        <td class="px-6 py-3">Jakarta Selatan</td>
                        <td class="px-6 py-3">
                            <span class="status-lowongan px-2 py-1 rounded-full text-white text-xs font-medium shadow">Aktif</span>
                        </td>
                    </tr>
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