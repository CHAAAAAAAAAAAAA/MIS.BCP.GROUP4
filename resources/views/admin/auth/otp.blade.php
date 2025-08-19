    <x-guest-layout>
        <div class="min-h-[60vh] flex items-center justify-center bg-slate-100 px-4 py-8 rounded-md shadow-sm">
            <form 
                method="POST" 
                action="{{ route('admin.otp.check') }}"
                class="bg-white border border-slate-200 shadow-sm rounded-md p-4 w-full max-w-sm space-y-4 text-sm"
            >
                @csrf

                <!-- Hidden email from session -->
                <input type="hidden" name="email" value="{{ session('email') }}">

                <!-- Heading -->
                <h2 class="text-center text-base font-semibold text-slate-700">
                    🔐 Enter the OTP sent to your email
                </h2>

                <!-- Display the OTP (for development/demo purposes) -->
                <p class="text-center text-xs text-slate-500">
                    Your OTP: <span class="font-medium text-slate-700">XXXXXX</span>
                </p>

                <!-- OTP Input -->
                <div>
                    <label 
                        for="otp" 
                        class="block text-xs font-medium text-slate-600 mb-1"
                    >
                        Enter OTP
                    </label>
                    <input 
                        type="text" 
                        name="otp" 
                        id="otp" 
                        required 
                        autocomplete="one-time-code" 
                        aria-label="One-time password"
                        placeholder="••••••"
                        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-inner 
                            focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 
                            text-sm placeholder-slate-400"
                    >
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-blue-600 text-white font-medium py-2 rounded-md 
                        hover:bg-blue-700 transition-colors duration-150"
                >
                    ✅ Verify
                </button>

                <!-- Resend OTP -->
                <div class="text-[11px] text-center text-slate-500 space-y-1">
                    <p>Didn't receive the code?</p>
                    <button 
                        type="button"
                        class="text-blue-600 hover:underline focus:outline-none focus:ring-1 
                            focus:ring-blue-300 rounded"
                    >
                        Resend OTP
                    </button>
                </div>
            </form>
        </div>
    </x-guest-layout>
