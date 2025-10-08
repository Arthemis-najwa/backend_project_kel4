<x-guest-layout>
    <h2 class="text-lg font-bold mb-4">Verifikasi OTP</h2>

    <form action="{{ route('password.verify.otp') }}" method="POST">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <div class="mb-3">
        <label for="otp">Masukkan Kode OTP</label>
        <input type="text" name="otp" id="otp" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Verifikasi</button>
</form>

</x-guest-layout>
