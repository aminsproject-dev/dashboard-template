<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Lupa Password' ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .forgot-container {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            padding: 20px;
        }

        .forgot-card {
            background: white;
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.05);
        }

        .forgot-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .forgot-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .forgot-logo i {
            font-size: 28px;
            color: white;
        }

        .forgot-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .forgot-subtitle {
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

        /* Info Alert */
        .info-alert {
            background: #eef2ff;
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .info-alert i {
            color: #4f46e5;
            font-size: 18px;
            margin-top: 2px;
        }

        .info-alert p {
            font-size: 12px;
            color: #475569;
            margin: 0;
            line-height: 1.5;
        }

        /* Button */
        .btn-submit {
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
            margin-bottom: 20px;
        }

        .btn-submit:hover {
            background: #4338ca;
        }

        /* Back to Login Link */
        .back-link {
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }

        .back-link a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        /* Footer */
        .forgot-footer {
            text-align: center;
            margin-top: 32px;
            font-size: 12px;
            color: #94a3b8;
        }

        .forgot-footer a {
            color: #4f46e5;
            text-decoration: none;
        }

        /* Dark Mode */
        body.dark-mode {
            background: #0f172a;
        }

        body.dark-mode .forgot-card {
            background: #1e293b;
        }

        body.dark-mode .forgot-title {
            color: #e2e8f0;
        }

        body.dark-mode .forgot-subtitle {
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

        body.dark-mode .info-alert {
            background: #334155;
        }

        body.dark-mode .info-alert p {
            color: #cbd5e1;
        }

        body.dark-mode .back-link {
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .forgot-card {
                padding: 28px 20px;
            }
            .forgot-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

    <div class="forgot-container">
        <div class="forgot-card">
            <div class="forgot-header">
                <div class="forgot-logo">
                    <i class="fas fa-key"></i>
                </div>
                <h1 class="forgot-title">Lupa Password?</h1>
                <p class="forgot-subtitle">Masukkan email Anda untuk mereset password</p>
            </div>

            <form action="<?= base_url('/auth/forgot-password') ?>" method="post" id="forgotForm">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-group-custom">
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control" id="email" name="email" placeholder="admin@Gmail.com" required>
                    </div>
                </div>

                <div class="info-alert">
                    <i class="fas fa-info-circle"></i>
                    <p>Kami akan mengirimkan link reset password ke email Anda. Pastikan email yang Anda masukkan terdaftar.</p>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="fas fa-paper-plane me-2"></i> Kirim Link Reset
                </button>

                <div class="back-link">
                    <a href="<?= base_url('/auth/login') ?>">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Login
                    </a>
                </div>
            </form>
        </div>

        <div class="forgot-footer">
            <p>Made with <i class="fas fa-heart text-danger"></i> by <a href="#">Team Light Able</a></p>
        </div>
    </div>

    <script>
        // Form Submit dengan SweetAlert
        const form = document.getElementById('forgotForm');
        const submitBtn = document.getElementById('submitBtn');
        const emailInput = document.getElementById('email');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const email = emailInput.value.trim();
                
                if (!email) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Email harus diisi!',
                        confirmButtonColor: '#4f46e5'
                    });
                    return;
                }
                
                // Simulasi loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-pulse me-2"></i> Mengirim...';
                
                // Simulasi pengiriman email (nanti diganti dengan AJAX ke backend)
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Link Terkirim!',
                        text: 'Silakan cek email Anda untuk mereset password.',
                        confirmButtonColor: '#4f46e5'
                    }).then(() => {
                        // Redirect ke halaman login setelah sukses
                        window.location.href = '<?= base_url('/auth/login') ?>';
                    });
                    
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Kirim Link Reset';
                }, 1500);
            });
        }

        // Dark Mode
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
        }
    </script>
</body>
</html>