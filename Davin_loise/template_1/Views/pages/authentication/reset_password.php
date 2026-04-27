<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Reset Password' ?></title>

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

        .reset-container {
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            padding: 20px;
        }

        .reset-card {
            background: white;
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.05);
        }

        .reset-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .reset-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .reset-logo i {
            font-size: 28px;
            color: white;
        }

        .reset-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .reset-subtitle {
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

        /* Password Requirements */
        .password-requirements {
            margin-top: 12px;
            padding: 12px;
            background: #f8fafc;
            border-radius: 12px;
        }

        .password-requirements p {
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #475569;
        }

        .requirement {
            font-size: 11px;
            color: #94a3b8;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .requirement i {
            font-size: 10px;
        }

        .requirement.valid {
            color: #10b981;
        }

        .requirement.invalid {
            color: #94a3b8;
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

        .btn-submit:disabled {
            background: #94a3b8;
            cursor: not-allowed;
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
        .reset-footer {
            text-align: center;
            margin-top: 32px;
            font-size: 12px;
            color: #94a3b8;
        }

        .reset-footer a {
            color: #4f46e5;
            text-decoration: none;
        }

        /* Dark Mode */
        body.dark-mode {
            background: #0f172a;
        }

        body.dark-mode .reset-card {
            background: #1e293b;
        }

        body.dark-mode .reset-title {
            color: #e2e8f0;
        }

        body.dark-mode .reset-subtitle {
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

        body.dark-mode .password-requirements {
            background: #0f172a;
        }

        body.dark-mode .password-requirements p {
            color: #cbd5e1;
        }

        body.dark-mode .back-link {
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .reset-card {
                padding: 28px 20px;
            }
            .reset-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

    <div class="reset-container">
        <div class="reset-card">
            <div class="reset-header">
                <div class="reset-logo">
                    <i class="fas fa-lock"></i>
                </div>
                <h1 class="reset-title">Reset Password</h1>
                <p class="reset-subtitle">Buat password baru untuk akun Anda</p>
            </div>

            <form action="<?= base_url('/auth/reset-password') ?>" method="post" id="resetForm">
                <input type="hidden" name="token" value="<?= $token ?? '' ?>">
                
                <div class="form-group">
                    <label class="form-label">Password Baru</label>
                    <div class="input-group-custom">
                       
                        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                        <i class="fas fa-eye-slash password-toggle" id="togglePassword"></i>
                    </div>
                    <div class="password-requirements" id="passwordRequirements">
                        <p>Password harus memiliki:</p>
                        <div class="requirement" id="reqLength">
                            <i class="fas fa-circle"></i> Minimal 8 karakter
                        </div>
                        <div class="requirement" id="reqUpper">
                            <i class="fas fa-circle"></i> Minimal 1 huruf besar
                        </div>
                        <div class="requirement" id="reqLower">
                            <i class="fas fa-circle"></i> Minimal 1 huruf kecil
                        </div>
                        <div class="requirement" id="reqNumber">
                            <i class="fas fa-circle"></i> Minimal 1 angka
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <div class="input-group-custom">
                       
                        <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="••••••••" required>
                        <i class="fas fa-eye-slash password-toggle" id="toggleConfirmPassword"></i>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn" disabled>
                    <i class=" me-2"></i> Reset Password
                </button>

                <div class="back-link">
                    <a href="<?= base_url('/auth/login') ?>">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle Password
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

        // Toggle Confirm Password
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        if (toggleConfirmPassword && confirmPasswordInput) {
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        // Password Validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const submitBtn = document.getElementById('submitBtn');

        const reqLength = document.getElementById('reqLength');
        const reqUpper = document.getElementById('reqUpper');
        const reqLower = document.getElementById('reqLower');
        const reqNumber = document.getElementById('reqNumber');

        function validatePassword() {
            const val = password.value;
            
            // Length check
            if (val.length >= 8) {
                reqLength.classList.add('valid');
                reqLength.classList.remove('invalid');
                reqLength.innerHTML = '<i class="fas fa-check-circle"></i> Minimal 8 karakter';
            } else {
                reqLength.classList.add('invalid');
                reqLength.classList.remove('valid');
                reqLength.innerHTML = '<i class="fas fa-circle"></i> Minimal 8 karakter';
            }
            
            // Uppercase check
            if (/[A-Z]/.test(val)) {
                reqUpper.classList.add('valid');
                reqUpper.classList.remove('invalid');
                reqUpper.innerHTML = '<i class="fas fa-check-circle"></i> Minimal 1 huruf besar';
            } else {
                reqUpper.classList.add('invalid');
                reqUpper.classList.remove('valid');
                reqUpper.innerHTML = '<i class="fas fa-circle"></i> Minimal 1 huruf besar';
            }
            
            // Lowercase check
            if (/[a-z]/.test(val)) {
                reqLower.classList.add('valid');
                reqLower.classList.remove('invalid');
                reqLower.innerHTML = '<i class="fas fa-check-circle"></i> Minimal 1 huruf kecil';
            } else {
                reqLower.classList.add('invalid');
                reqLower.classList.remove('valid');
                reqLower.innerHTML = '<i class="fas fa-circle"></i> Minimal 1 huruf kecil';
            }
            
            // Number check
            if (/[0-9]/.test(val)) {
                reqNumber.classList.add('valid');
                reqNumber.classList.remove('invalid');
                reqNumber.innerHTML = '<i class="fas fa-check-circle"></i> Minimal 1 angka';
            } else {
                reqNumber.classList.add('invalid');
                reqNumber.classList.remove('valid');
                reqNumber.innerHTML = '<i class="fas fa-circle"></i> Minimal 1 angka';
            }
            
            // Enable submit button if all requirements met
            const isValid = val.length >= 8 && /[A-Z]/.test(val) && /[a-z]/.test(val) && /[0-9]/.test(val);
            submitBtn.disabled = !isValid;
            
            return isValid;
        }

        password.addEventListener('input', validatePassword);

        // Form Submit
        const form = document.getElementById('resetForm');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const pass = password.value;
                const confirm = confirmPassword.value;
                
                if (pass !== confirm) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Tidak Cocok',
                        text: 'Password baru dan konfirmasi password harus sama!',
                        confirmButtonColor: '#4f46e5'
                    });
                    return;
                }
                
                if (!validatePassword()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Lemah',
                        text: 'Silakan ikuti persyaratan password yang ditentukan!',
                        confirmButtonColor: '#4f46e5'
                    });
                    return;
                }
                
                // Simulasi loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-pulse me-2"></i> Memproses...';
                
                // Simulasi proses reset password (nanti diganti dengan AJAX ke backend)
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Berhasil Direset!',
                        text: 'Silakan login dengan password baru Anda.',
                        confirmButtonColor: '#4f46e5'
                    }).then(() => {
                        window.location.href = '<?= base_url('/auth/login') ?>';
                    });
                    
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save me-2"></i> Reset Password';
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