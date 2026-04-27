<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Login' ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fc;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        /* Login Container */
        .login-container {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.05);
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .login-logo i {
            font-size: 28px;
            color: white;
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .login-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        /* Form Input */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #1e293b;
            margin-bottom: 8px;
            display: block;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
            z-index: 1;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            font-size: 14px;
            transition: all 0.2s;
            background: #ffffff;
        }

        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
            z-index: 1;
        }

        /* Checkbox & Forgot */
        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin: 0;
            cursor: pointer;
            accent-color: #4f46e5;
        }

        .form-check-label {
            font-size: 13px;
            color: #475569;
            cursor: pointer;
        }

        .forgot-link {
            font-size: 13px;
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 12px;
            background: #4f46e5;
            border: none;
            border-radius: 14px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 24px;
        }

        .btn-login:hover {
            background: #4338ca;
        }

        /* Divider */
        .divider {
            text-align: center;
            position: relative;
            margin: 24px 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: white;
            padding: 0 16px;
            position: relative;
            font-size: 13px;
            color: #94a3b8;
        }

        /* Social Buttons */
        .social-buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }

        .btn-social {
            flex: 1;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-social:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-social i {
            font-size: 18px;
        }

        .btn-social span {
            font-size: 13px;
            font-weight: 500;
            color: #475569;
        }

        /* Register Link */
        .register-link {
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }

        .register-link a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 32px;
            font-size: 12px;
            color: #94a3b8;
        }

        .login-footer a {
            color: #4f46e5;
            text-decoration: none;
        }

        /* Dark Mode */
        body.dark-mode {
            background: #0f172a;
        }

        body.dark-mode .login-card {
            background: #1e293b;
        }

        body.dark-mode .login-title {
            color: #e2e8f0;
        }

        body.dark-mode .login-subtitle {
            color: #94a3b8;
        }

        body.dark-mode .form-label {
            color: #e2e8f0;
        }

        body.dark-mode .form-control {
            background: #0f172a;
            border-color: #334155;
            color: #e2e8f0;
        }

        body.dark-mode .form-control:focus {
            border-color: #4f46e5;
        }

        body.dark-mode .form-check-label {
            color: #cbd5e1;
        }

        body.dark-mode .divider::before {
            background: #334155;
        }

        body.dark-mode .divider span {
            background: #1e293b;
            color: #94a3b8;
        }

        body.dark-mode .btn-social {
            background: #1e293b;
            border-color: #334155;
        }

        body.dark-mode .btn-social:hover {
            background: #334155;
        }

        body.dark-mode .btn-social span {
            color: #cbd5e1;
        }

        body.dark-mode .register-link {
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                padding: 28px 20px;
            }
            .login-title {
                font-size: 24px;
            }
            .social-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h1 class="login-title">Selamat Datang</h1>
                <p class="login-subtitle">Silakan masuk ke akun Anda</p>
            </div>

            <form action="<?= base_url('/auth/login') ?>" method="post">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-group-custom">
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control"  >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-group-custom">
                        
                        <input type="password" class="form-control" id="password" >
                        <i class="fas fa-eye-slash password-toggle" id="togglePassword"></i>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    <a href="<?= base_url('/auth/forgot-password') ?>" class="forgot-link">Lupa Password?</a>
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>

            <div class="divider">
                <span>atau masuk dengan</span>
            </div>

            <div class="social-buttons">
                <button class="btn-social">
                    <i class="fab fa-google" style="color: #ea4335;"></i>
                    <span>Google</span>
                </button>
                <button class="btn-social">
                    <i class="fab fa-facebook-f" style="color: #1877f2;"></i>
                    <span>Facebook</span>
                </button>
                <button class="btn-social">
                    <i class="fab fa-apple" style="color: #000;"></i>
                    <span>Apple</span>
                </button>
            </div>

            <div class="register-link">
                Belum punya akun? <a href="<?= base_url('/auth/register') ?>">Buat akun</a>
            </div>
        </div>

       
    </div>

    <script>
        // Password Toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        // Dark Mode Toggle (jika ada dari navbar, tapi halaman login terpisah)
        // Cek localStorage untuk dark mode
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
        }

        // Optional: Tambahkan toggle dark mode manual untuk halaman login
        // Bisa ditambahkan jika ingin user bisa ganti mode di halaman login
    </script>
</body>
</html>