@extends('layouts.auth')

@section('content')
    <div class="w-full h-dvh relative">
        <img src="/imgs/logo.png" class="absolute top-10 left-10 z-10" alt="">
        <img class="fixed top-0 left-0 w-full h-full" src="/imgs/bg.png" alt="">

        <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center">

            <div class="bg-white p-10 rounded-md shadow-md w-[500px]">
                <h1 class="text-blue-600 poppins-semibold text-center text-2xl mb-2">Login</h1>
                <p class="text-gray-500 text-center text-sm">Silakan login untuk mengakses dashboard admin</p>

                <form action="{{ route('login.post') }}" class="mt-10" method="POST">
    @csrf

    <div class="mb-5 flex flex-col gap-3">
        <label for="username" class="text-sm text-gray-800">Username</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}"
            class="bg-gray-200 border-none rounded-full px-5 py-3 text-sm" placeholder="Masukkan username">
        @error('username')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-5 flex flex-col gap-3">
        <label for="password" class="text-sm text-gray-800">Kata Sandi</label>
        <input type="password" id="password" name="password"
            class="bg-gray-200 border-none rounded-full px-5 py-3 text-sm" placeholder="Masukkan Kata Sandi">
        @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="text-right mb-5">
        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Lupa Kata Sandi?</a>
    </div>

    <div>
        <button class="p-3 w-full bg-green-400 hover:bg-green-500 text-white rounded-full">Masuk</button>
    </div>
</form>

            </div>
        </div>
    </div>
@endsection