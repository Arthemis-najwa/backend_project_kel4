@extends('layouts.auth')

@section('content')
    <div class="w-full h-dvh relative bg-gradient-to-tr from-green-200 via-green-400 to-blue-500">
        <div class="absolute top-10 left-10 z-20 flex items-center gap-3">
            <img src="/imgs/logo.png" alt="Logo" class="h-12 w-auto">
           <span class="text-orange-400 text-2xl poppins-semibold">CIPTA KARIR</span>
        </div>

        <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center bg-white bg-opacity-90 backdrop-blur-md shadow-lg">
            <div class="bg-white p-12 rounded-xl shadow-lg w-[450px]">
                <h1 class="text-blue-600 font-poppins-semibold text-center text-3xl mb-4 tracking-wide">Login</h1>
                <p class="text-gray-600 text-center text-sm mb-8">Silakan login untuk mengakses dashboard admin</p>

                <form action="{{ route('login.post') }}" class="space-y-6" method="POST">
                    @csrf

                    <div>
                        <label for="username" class="block text-gray-700 text-sm font-semibold mb-1">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            class="w-full bg-gray-100 border border-gray-300 rounded-full px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition" placeholder="Masukkan username">
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-1">Kata Sandi</label>
                        <input type="password" id="password" name="password"
                            class="w-full bg-gray-100 border border-gray-300 rounded-full px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition" placeholder="Masukkan Kata Sandi">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-right">
                        <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">Lupa Kata Sandi?</a>
                    </div>

                    <div>
                        <button type="submit" class="p-3 w-full bg-green-500 hover:bg-green-600 text-white rounded-full font-semibold transition">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection