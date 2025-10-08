<x-guest-layout>
    <h2 class="text-lg font-bold mb-4">Verifikasi OTP</h2>

    <form method="POST" action="{{ route('password.verify.otp') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <div>
            <x-input-label for="otp_code" :value="__('Kode OTP')" />
            <x-text-input id="otp_code" class="block mt-1 w-full" type="text" name="otp_code" required autofocus />
            <x-input-error :messages="$errors->get('otp_code')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button>{{ __('Verifikasi') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
