<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Verifikasi Kode' ?></title>

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

        .verify-container {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
            padding: 20px;
        }

        .verify-card {
            background: white;
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.05);
        }

        .verify-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .verify-logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .verify-logo i {
            font-size: 28px;
            color: white;
        }

        .verify-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .verify-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        /* Email Info */
        .email-info {
            background: #f8fafc;
            border-radius: 16px;
            padding: 14px 20px;
            text-align: center;
            margin-bottom: 28px;
        }

        .email-info i {
            color: #4f46e5;
            font-size: 18px;
            margin-right: 8px;
        }

        .email-info span {
            font-size: 13px;
            color: #475569;
        }

        .email-info strong {
            color: #1e293b;
        }

        /* OTP Input */
        .otp-container {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-bottom: 28px;
        }

        .otp-input {
            width: 60px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            background: white;
            transition: all 0.2s;
        }

        .otp-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        /* Timer */
        .timer {
            text-align: center;
            margin-bottom: 24px;
        }

        .timer-text {
            font-size: 13px;
            color: #64748b;
        }

        .timer-count {
            font-weight: 700;
            color: #4f46e5;
            font-size: 14px;
        }

        /* Resend Link */
        .resend-link {
            text-align: center;
            margin-bottom: 24px;
        }

        .resend-link a {
            color: #4f46e5;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .resend-link a:hover {
            text-decoration: underline;
        }

        /* Button */
        .btn-verify {
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

        .btn-verify:hover {
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
        .verify-footer {
            text-align: center;
            margin-top: 32px;
            font-size: 12px;
            color: #94a3b8;
        }

        .verify-footer a {
            color: #4f46e5;
            text-decoration: none;
        }

        /* Dark Mode */
        body.dark-mode {
            background: #0f172a;
        }

        body.dark-mode .verify-card {
            background: #1e293b;
        }

        body.dark-mode .verify-title {
            color: #e2e8f0;
        }

        body.dark-mode .verify-subtitle {
            color: #94a3b8;
        }

        body.dark-mode .email-info {
            background: #0f172a;
        }

        body.dark-mode .email-info span {
            color: #94a3b8;
        }

        body.dark-mode .email-info strong {
            color: #e2e8f0;
        }

        body.dark-mode .otp-input {
            background: #0f172a;
            border-color: #334155;
            color: #e2e8f0;
        }

        body.dark-mode .otp-input:focus {
            border-color: #4f46e5;
        }

        body.dark-mode .timer-text {
            color: #94a3b8;
        }

        body.dark-mode .back-link {
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .verify-card {
                padding: 28px 20px;
            }
            .verify-title {
                font-size: 24px;
            }
            .otp-container {
                gap: 8px;
            }
            .otp-input {
                width: 48px;
                height: 48px;
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="verify-container">
        <div class="verify-card">
            <div class="verify-header">
                <div class="verify-logo">
                    <i class="fas fa-envelope"></i>
                </div>
                <h1 class="verify-title">Verifikasi Kode</h1>
                <p class="verify-subtitle">Masukkan kode verifikasi yang dikirim ke email Anda</p>
            </div>

            <div class="email-info">
                <i class="fas fa-envelope"></i>
                <span>Kode telah dikirim ke </span>
                <strong id="userEmail"><?= $email ?? 'davin****@Gmail.com' ?></strong>
            </div>

            <form action="<?= base_url('/auth/verify') ?>" method="post" id="verifyForm">
                <div class="otp-container">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric" autofocus>
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                    <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                </div>
                <input type="hidden" name="otp_code" id="otpCode">

                <div class="timer" id="timer">
                    <span class="timer-text">Kode berlaku selama </span>
                    <span class="timer-count" id="timerCount">05:00</span>
                </div>

                <div class="resend-link">
                    <a href="#" id="resendCode">Tidak menerima kode? Kirim ulang</a>
                </div>

                <button type="submit" class="btn-verify" id="verifyBtn">
                    <i class="fas fa-check-circle me-2"></i> Verifikasi
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
        // OTP Input Auto-focus
        const otpInputs = document.querySelectorAll('.otp-input');
        
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;
                
                // Hanya angka yang diperbolehkan
                if (value && !/^\d+$/.test(value)) {
                    e.target.value = '';
                    return;
                }
                
                // Pindah ke input berikutnya jika terisi
                if (value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });
            
            input.addEventListener('keydown', (e) => {
                // Pindah ke input sebelumnya jika backspace dan input kosong
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
            
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').slice(0, otpInputs.length);
                if (/^\d+$/.test(pastedData)) {
                    const digits = pastedData.split('');
                    digits.forEach((digit, i) => {
                        if (otpInputs[i]) otpInputs[i].value = digit;
                    });
                    if (digits.length === otpInputs.length) {
                        otpInputs[otpInputs.length - 1].focus();
                    }
                }
            });
        });

        // Menggabungkan OTP
        function getOtpCode() {
            let code = '';
            otpInputs.forEach(input => {
                code += input.value;
            });
            return code;
        }

        // Timer
        let timeLeft = 300; // 5 menit dalam detik
        const timerCount = document.getElementById('timerCount');
        const resendLink = document.getElementById('resendCode');
        let timerInterval;
        
        function updateTimerDisplay() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerCount.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        
        function startTimer() {
            if (timerInterval) clearInterval(timerInterval);
            timerInterval = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerCount.textContent = '00:00';
                    resendLink.style.opacity = '1';
                    resendLink.style.pointerEvents = 'auto';
                } else {
                    timeLeft--;
                    updateTimerDisplay();
                }
            }, 1000);
        }
        
        function resetTimer() {
            timeLeft = 300;
            updateTimerDisplay();
            startTimer();
            resendLink.style.opacity = '0.5';
            resendLink.style.pointerEvents = 'none';
        }
        
        // Mulai timer
        startTimer();
        
        // Resend Code
        resendLink.addEventListener('click', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Kirim Ulang Kode?',
                text: 'Kode verifikasi baru akan dikirim ke email Anda',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Kirim Ulang',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simulasi pengiriman ulang
                    Swal.fire({
                        title: 'Kode Terkirim!',
                        text: 'Kode verifikasi baru telah dikirim ke email Anda',
                        icon: 'success',
                        confirmButtonColor: '#4f46e5'
                    });
                    resetTimer();
                    
                    // Reset OTP inputs
                    otpInputs.forEach(input => input.value = '');
                    otpInputs[0].focus();
                }
            });
        });
        
        // Form Submit
        const form = document.getElementById('verifyForm');
        const otpCodeInput = document.getElementById('otpCode');
        const verifyBtn = document.getElementById('verifyBtn');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const otpCode = getOtpCode();
            otpCodeInput.value = otpCode;
            
            if (otpCode.length !== 6) {
                Swal.fire({
                    icon: 'error',
                    title: 'Kode Tidak Lengkap',
                    text: 'Silakan masukkan 6 digit kode verifikasi',
                    confirmButtonColor: '#4f46e5'
                });
                return;
            }
            
            // Simulasi loading
            verifyBtn.disabled = true;
            verifyBtn.innerHTML = '<i class="fas fa-spinner fa-pulse me-2"></i> Memverifikasi...';
            
            // Simulasi verifikasi (nanti diganti dengan AJAX ke backend)
            setTimeout(() => {
                // Anggap kode "123456" adalah kode yang benar untuk demo
                if (otpCode === '123456') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Verifikasi Berhasil!',
                        text: 'Akun Anda telah berhasil diverifikasi.',
                        confirmButtonColor: '#4f46e5'
                    }).then(() => {
                        window.location.href = '<?= base_url('/auth/login') ?>';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kode Salah',
                        text: 'Kode verifikasi yang Anda masukkan tidak valid. Silakan coba lagi.',
                        confirmButtonColor: '#4f46e5'
                    });
                }
                
                verifyBtn.disabled = false;
                verifyBtn.innerHTML = '<i class="fas fa-check-circle me-2"></i> Verifikasi';
            }, 1500);
        });
        
        // Dark Mode
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
        }
    </script>
</body>
</html>