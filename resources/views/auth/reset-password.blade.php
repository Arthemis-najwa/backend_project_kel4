<x-guest-layout>
    <form method="POST" action="{{ route('password.reset.store') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">

        <div>
            <label for="password">Password Baru</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div class="mt-3">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ubah Password</button>
    </form>
</x-guest-layout>
