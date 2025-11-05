<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - CIPTA KARIR</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        
        .poppins-semibold {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
    <div class="w-full h-dvh relative bg-gradient-to-tr from-green-200 via-green-400 to-blue-500">
        <div class="absolute top-10 left-10 z-20 flex items-center gap-3">
            <img src="/imgs/logo.png" alt="Logo" class="h-12 w-auto">
           <span class="text-orange-400 text-2xl poppins-semibold">CIPTA KARIR</span>
        </div>

        <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center bg-white bg-opacity-90 backdrop-blur-md shadow-lg">
            <div class="bg-white p-12 rounded-xl shadow-lg w-[450px]">
                <h1 class="text-blue-600 font-poppins-semibold text-center text-3xl mb-4 tracking-wide">Reset Password</h1>
                <p class="text-gray-600 text-center text-sm mb-8">Buat password baru untuk akun Anda</p>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-full text-sm text-center">
                        @foreach ($errors->all() as $error)
                            {{ $error }}@if (!$loop->last)<br>@endif
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.reset.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div>
                        <label for="password" class="block text-gray-700 text-sm font-semibold mb-1">Password Baru</label>
                        <input id="password" type="password" name="password" 
                            class="w-full bg-gray-100 border border-gray-300 rounded-full px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition" 
                            required placeholder="Masukkan password baru">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-gray-700 text-sm font-semibold mb-1">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" 
                            class="w-full bg-gray-100 border border-gray-300 rounded-full px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition" 
                            required placeholder="Konfirmasi password baru">
                    </div>

                    <div class="text-center">
                        <p class="text-gray-600 text-sm mb-4">
                            Reset password untuk: <br>
                            <span class="font-semibold text-blue-600">{{ $email }}</span>
                        </p>
                    </div>

                    <div>
                        <button type="submit" class="p-3 w-full bg-green-500 hover:bg-green-600 text-white rounded-full font-semibold transition">Ubah Password</button>
                    </div>
                </form>

                <!-- Back Link -->
                <div class="text-center mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-green-600 hover:underline">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Password Input -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            
            // Input focus effect
            [passwordInput, confirmPasswordInput].forEach(input => {
                input.addEventListener('focus', function() {
                    this.classList.add('ring-2', 'ring-green-400');
                });
                
                input.addEventListener('blur', function() {
                    this.classList.remove('ring-2', 'ring-green-400');
                });
            });

            // Real-time password validation
            confirmPasswordInput.addEventListener('input', function() {
                if (passwordInput.value !== this.value && this.value !== '') {
                    this.classList.add('border-red-300');
                    this.classList.remove('border-gray-300');
                } else {
                    this.classList.remove('border-red-300');
                    this.classList.add('border-gray-300');
                }
            });

            passwordInput.addEventListener('input', function() {
                if (confirmPasswordInput.value !== '' && passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.classList.add('border-red-300');
                    confirmPasswordInput.classList.remove('border-gray-300');
                } else {
                    confirmPasswordInput.classList.remove('border-red-300');
                    confirmPasswordInput.classList.add('border-gray-300');
                }
            });
        });
    </script>
</body>
</html>