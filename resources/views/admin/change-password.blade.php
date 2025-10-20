@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-semibold text-center text-blue-600 mb-5">Ganti Password</h2>

    @if (session('status'))
        <div class="p-3 bg-green-100 text-green-700 rounded mb-3">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('update-password') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Password Lama</label>
            <input type="password" name="current_password" class="w-full border p-2 rounded" required>
            @error('current_password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Password Baru</label>
            <input type="password" name="new_password" class="w-full border p-2 rounded" required>
            @error('new_password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
