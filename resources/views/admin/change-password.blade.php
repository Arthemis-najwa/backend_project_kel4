@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Ganti Password</h1>


    <form action="" method="POST">
        @csrf
        <div class="mb-2">
            <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
            <input type="password" id="password" name="password"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <div class="mb-2">

            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <button type="submit" class="px-3 py-2 bg-indigo-600 text-white rounded-md">Simpan</button>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('password_confirmation');

            form.addEventListener('submit', function(e) {
                if (password.value !== passwordConfirm.value) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak sama!');
                    return false;
                }

                if (password.value.length < 8) {
                    e.preventDefault();
                    alert('Password harus minimal 8 karakter!');
                    return false;
                }
            });
        });
        if (document.getElementById("applicantsTable") && typeof simpleDatatables !== 'undefined') {
            const dataTable = new simpleDatatables.DataTable("#applicantsTable", {
                searchable: true,
                sortable: true
            });
        }
    </script>
@endpush
