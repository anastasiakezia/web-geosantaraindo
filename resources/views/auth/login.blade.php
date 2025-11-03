<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <link href="{{ asset('admin/assets/img/logo_favicon.png') }}" rel="icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #3b82f6;
            --dark-bg: #111827;
            --card-bg: #1f2937;
            --border-color: #4b5563;
            --text-light: #d1d5db;
            --text-extra-light: #9ca3af;
            --light-text-color: #e0e7ff;
            --link-color: #a78bfa;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Inter', sans-serif;
            background-color: var(--dark-bg);
            overflow-x: hidden;
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        /* Autofill handling */
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 40px var(--card-bg) inset !important;
            box-shadow: 0 0 0 40px var(--card-bg) inset !important;
            -webkit-text-fill-color: var(--text-light) !important;
            caret-color: white !important;
        }

        /* Layout utama */
        .login-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Panel kiri (visual) */
        .visual-panel {
            width: 50%;
            position: relative;
            background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2070');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .visual-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(17, 24, 39, 0.9), rgba(29, 78, 216, 0.7));
            z-index: 1;
        }

        .visual-panel-content {
            position: relative;
            z-index: 3;
            text-align: center;
            color: white;
            padding: 2rem;
        }

        .logo-container {
            width: 140px;
            height: 140px;
            margin: 0 auto 2rem;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .logo-container img {
            width: 90%;
            height: 90%;
            object-fit: contain;
        }

        .visual-panel-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.4);
            margin-bottom: 0.5rem;
        }

        .tagline {
            font-size: 1.125rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2rem;
            font-style: italic;
            opacity: 0.9;
        }

        #realtime-clock {
            font-size: 1.5rem;
            font-weight: 500;
            color: #fff;
            letter-spacing: 2px;
            opacity: 0.9;
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        /* Panel kanan (form login) */
        .form-panel {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background-color: var(--dark-bg);
        }

        .form-card {
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            background: var(--card-bg);
        }

        .form-header h2 {
            font-size: 1.875rem;
            color: white;
            font-weight: 700;
            text-align: center;
        }

        .form-header p {
            color: var(--text-extra-light);
            margin-bottom: 2.5rem;
            text-align: center;
        }

        /* Input dan label */
        .form-group {
            position: relative;
            margin-bottom: 2rem;
        }

        .form-input {
            width: 100%;
            background-color: transparent;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 16px 14px;
            font-size: 1rem;
            color: white;
            transition: border-color 0.3s;
        }

        /* Beri ruang untuk ikon mata */
        #password.form-input {
            padding-right: 40px;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-label {
            position: absolute;
            top: 17px;
            left: 15px;
            color: var(--text-extra-light);
            pointer-events: none;
            transition: all 0.2s ease-out;
            background-color: var(--card-bg);
            padding: 0 5px;
        }

        .form-input:focus~.form-label,
        .form-input.has-value~.form-label {
            top: -10px;
            left: 10px;
            font-size: 0.85rem;
            color: var(--primary-color);
        }

        /* Toggle password */
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            color: var(--text-extra-light);
            padding: 0;
            display: flex;
            align-items: center;
            line-height: 0;
            /* [BARU] Atur ukuran font untuk ikon */
            font-size: 1.1rem;
            /* Sesuaikan ukuran ikon jika perlu */
        }

        .password-toggle:hover {
            color: white;
        }

        /* Hapus style SVG lama */
        /* .password-toggle svg { ... } */

        .extra-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            font-size: 0.8rem;
        }

        /* Checkbox custom */
        .remember-me {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            width: 16px;
            height: 16px;
            border: 1px solid var(--border-color);
            background-color: var(--card-bg);
            margin-right: 0.5rem;
            appearance: none;
            border-radius: 4px;
            position: relative;
        }

        .remember-me input[type="checkbox"]:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .remember-me input[type="checkbox"]:checked::after {
            content: '✔';
            color: white;
            font-size: 12px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .remember-me span {
            color: var(--light-text-color);
        }

        .forgot-password {
            text-decoration: none;
            color: var(--link-color);
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            padding: 0.875rem 1rem;
            border: none;
            border-radius: 8px;
            background-color: var(--primary-color);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.2s, box-shadow 0.2s;
        }

        .submit-btn:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .input-error-message {
            color: #f87171;
            font-size: 0.875rem;
            position: absolute;
            top: 105%;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .login-wrapper {
                flex-direction: column;
            }

            .visual-panel {
                display: none;
            }

            .form-panel {
                width: 100%;
                min-height: 100vh;
            }
        }

        @media (max-width: 425px) {
            .form-card {
                padding: 2rem 1.5rem;
            }

            .extra-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="visual-panel">
            <div class="visual-panel-content">
                <div class="logo-container">
                    <img src="{{ asset('admin/assets/img/logo_geo.png') }}" alt="Company Logo">
                </div>
                <h1 id="welcome-greeting">Admin Panel</h1>
                <p class="tagline">Geo Santara Indo</p>
                <p id="realtime-clock"></p>
            </div>
        </div>

        <div class="form-panel">
            <div class="form-card">
                <div class="form-header">
                    <h2>Welcome Back</h2>
                    <p>Enter your credentials to access your account.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                @if ($errors->any())
                    <div
                        style="
                            background-color: rgba(239, 68, 68, 0.1);
                            color: #f87171;
                            border: 1px solid rgba(239, 68, 68, 0.3);
                            padding: 12px 16px;
                            border-radius: 8px;
                            text-align: center;
                            margin-bottom: 1.5rem;
                            font-weight: 500;
                            animation: fadeIn 0.3s ease-in-out;
                    ">
                        {{ $errors->first() }}
                    </div>
                @endif

                <style>
                    @keyframes fadeIn {
                        from {
                            opacity: 0;
                            transform: translateY(-5px);
                        }

                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                </style>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <input id="username" class="form-input" type="text" name="username"
                            value="{{ old('username') }}" required autofocus placeholder=" " />
                        <label for="username" class="form-label">Username</label>
                        @error('username')
                            <p class="input-error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" class="form-input" type="password" name="password" required
                            autocomplete="current-password" placeholder=" " />
                        <label for="password" class="form-label">Password</label>
                        <button type="button" id="togglePassword" class="password-toggle">
                            {{-- [REVISI] Menggunakan Bootstrap Icons --}}
                            <i id="eyeIcon" class="bi bi-eye-fill"></i>
                            <i id="eyeSlashIcon" class="bi bi-eye-slash-fill" style="display: none;"></i>
                        </button>
                        @error('password')
                            <p class="input-error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="extra-options">
                        <label for="remember_me" class="remember-me">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            {{-- <a class="forgot-password" href="{{ route('password.request') }}">Forgot password?</a> --}}
                        @endif
                    </div>

                    <button type="submit" class="submit-btn">Log In</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            if (togglePassword && passwordInput && eyeIcon && eyeSlashIcon) {
                togglePassword.addEventListener('click', () => {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    // Logika toggle ikon
                    if (type === 'password') {
                        eyeIcon.style.display = 'block';
                        eyeSlashIcon.style.display = 'none';
                    } else {
                        eyeIcon.style.display = 'none';
                        eyeSlashIcon.style.display = 'block';
                    }
                });
            }

            // Floating label logic
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                const updateLabelState = () => {
                    if (input.value) {
                        input.classList.add('has-value');
                    } else {
                        input.classList.remove('has-value');
                    }
                };
                input.addEventListener('input', updateLabelState);
                input.addEventListener('blur', updateLabelState);
                setTimeout(updateLabelState, 100);
            });

            // Greeting + realtime clock
            const greetingElement = document.getElementById('welcome-greeting');
            if (greetingElement) {
                const hour = new Date().getHours();
                let greetingText = 'Selamat Datang, Admin!';
                if (hour < 11) {
                    greetingText = 'Selamat Pagi, Admin!';
                } else if (hour < 15) {
                    greetingText = 'Selamat Siang, Admin!';
                } else if (hour < 19) {
                    greetingText = 'Selamat Sore, Admin!';
                } else {
                    greetingText = 'Selamat Malam, Admin!';
                }
                greetingElement.textContent = greetingText;
            }

            const clockElement = document.getElementById('realtime-clock');
            if (clockElement) {
                const updateClock = () => {
                    const now = new Date();
                    clockElement.textContent =
                        `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}:${String(now.getSeconds()).padStart(2, '0')}`;
                };
                updateClock();
                setInterval(updateClock, 1000);
            }
        });
    </script>
</body>

</html>
