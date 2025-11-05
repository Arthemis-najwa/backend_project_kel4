<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - CIPTA KARIR</title>
    
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
                <h1 class="text-blue-600 font-poppins-semibold text-center text-3xl mb-4 tracking-wide">Reset Kata Sandi</h1>
                <p class="text-gray-600 text-center text-sm mb-8">Masukkan email untuk reset kata sandi</p>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-full text-sm text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-full text-sm text-center">
                        @foreach ($errors->all() as $error)
                            {{ $error }}@if (!$loop->last)<br>@endif
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('password.email') }}" class="space-y-6" method="POST">
                    @csrf

                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-semibold mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full bg-gray-100 border border-gray-300 rounded-full px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition" 
                            placeholder="Masukkan email" required autofocus>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-right">
                        <a href="{{ route('login') }}" class="text-sm text-green-600 hover:underline">Kembali ke Login</a>
                    </div>

                    <div>
                        <button type="submit" class="p-3 w-full bg-green-500 hover:bg-green-600 text-white rounded-full font-semibold transition">
                            Kirim Link Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            
            // Input focus effect
            emailInput.addEventListener('focus', function() {
                this.classList.add('ring-2', 'ring-green-400');
            });
            
            emailInput.addEventListener('blur', function() {
                this.classList.remove('ring-2', 'ring-green-400');
            });
        });
    </script>
</body>
</html>