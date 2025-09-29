<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Login</h1>
                <br>
                <span for="email" :value="__('Use your email password')"></span>
                <input
                    type="email"
                    placeholder="Email"
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus autocomplete="username">
                <input
                    id=""
                    type="password"
                    placeholder="Password"
                    name="password"
                    required autocomplete="current-password">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />

                <div class="d-flex ">
                    <a href="#">Forget Your Password?</a>

                    <label for="remember_me" class="d-flex align-items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 small-checkbox"
                            name="remember">
                        <span class="text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                </div>
                <button>Login</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of the site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <i class="fas fa-user-shield fa-3x mb-3 text-blue-600"></i>
                    <h1>Halo Admin</h1>
                    <p>Silahkan melakukan login dengan memasukkan email dan password</p>
                    
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
