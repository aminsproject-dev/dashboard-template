<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Hubungi Kami' ?></title>

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
        }

        .main-content {
            margin-left: 280px;
            padding: 0;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            margin-top: 70px;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0 0 20px 0;
        }
        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: #4f46e5;
            font-weight: 500;
        }
        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            color: #adb5bd;
            font-size: 18px;
        }

        .card {
            border: none;
            border-radius: 24px;
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02), 0 1px 3px rgba(0, 0, 0, 0.03);
        }

        /* Contact Info Card */
        .contact-info-card {
            text-align: center;
            padding: 30px 20px;
            border-radius: 20px;
            background: white;
            transition: all 0.3s;
            height: 100%;
        }
        .contact-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.1);
        }
        .contact-icon {
            width: 60px;
            height: 60px;
            background: #eef2ff;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .contact-icon i {
            font-size: 24px;
            color: #4f46e5;
        }

        /* Form Input */
        .form-control, .form-select {
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.2s;
            background: #ffffff;
        }
        .form-control:focus, .form-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        textarea.form-control {
            resize: none;
        }

        .form-label {
            font-weight: 600;
            font-size: 13px;
            color: #1e293b;
            margin-bottom: 8px;
        }

        /* Map */
        .map-container {
            border-radius: 20px;
            overflow: hidden;
            height: 300px;
        }
        .map-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Button */
        .btn-submit {
            background: #4f46e5;
            border: none;
            border-radius: 14px;
            padding: 12px 28px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-submit:hover {
            background: #4338ca;
            transform: translateY(-2px);
        }

        /* Dark Mode */
        body.dark-mode {
            background: #0f172a;
        }
        body.dark-mode .card {
            background: #1e293b !important;
        }
        body.dark-mode .contact-info-card {
            background: #1e293b;
        }
        body.dark-mode .contact-icon {
            background: #334155;
        }
        body.dark-mode .form-label {
            color: #e2e8f0;
        }
        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background: #0f172a;
            border-color: #334155;
            color: #e2e8f0;
        }
        body.dark-mode .form-control:focus {
            border-color: #4f46e5;
        }
        body.dark-mode .text-muted {
            color: #94a3b8 !important;
        }

        @media (max-width: 768px) {
            .contact-info-card {
                padding: 20px;
            }
            .btn-submit {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <?= view('layout/navbar') ?>
    <?= view('layout/sidebar_new') ?>

    <div class="main-content">
        <div class="container-fluid px-4 py-4">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hubungi Kami</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="mb-4 text-center">
                <h2 class="fw-bold mb-2">Hubungi Kami</h2>
                <p class="text-muted">Ada pertanyaan? Tim kami siap membantu Anda</p>
            </div>

            <!-- Contact Info Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Telepon</h5>
                        <p class="text-muted mb-1">+62 21 1234 5678</p>
                        <p class="text-muted">+62 812 3456 7890</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Email</h5>
                        <p class="text-muted mb-1">info@Outlook.com</p>
                        <p class="text-muted">support@Gmail.com</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Alamat</h5>
                        <p class="text-muted mb-1">Jl. Raya Ponorogo - Madiun</p>
                        <p class="text-muted">Jawa Timur, Indonesia</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form & Map -->
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card p-4">
                        <h5 class="fw-bold mb-4"><i class="fas fa-paper-plane text-primary me-2"></i>Kirim Pesan</h5>
                        
                        <form id="contactForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Depan</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="John" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Belakang</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Doe" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="email@example.com" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Subjek</label>
                                    <input type="text" class="form-control" id="subject" placeholder="Subjek pesan" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Pesan</label>
                                    <textarea class="form-control" id="message" rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-submit" id="submitBtn">
                                        <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card p-4">
                        <h5 class="fw-bold mb-4"><i class="fas fa-map text-primary me-2"></i>Lokasi Kami</h5>
                        <div class="map-container">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126580.69533647324!2d111.4868512!3d-7.6299749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79be537c813a33%3A0xafe2f173545a53ae!2sMadiun%2C%20Kota%20Madiun%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1745200000000!5m2!1sid!2sid"
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        
                        <!-- Social Media -->
                        <div class="mt-4">
                            <h5 class="fw-bold mb-3">Ikuti Kami</h5>
                            <div class="d-flex gap-3">
                                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="mt-5 pt-3 pb-3 text-center">
                <p class="mb-0 text-muted">
                    © 2026
                    <strong class="text-primary">Davin Loise</strong>
                    <span class="mx-2">•</span>
                    All rights reserved.
                </p>
            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Form Submit
        const form = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Get form values
                const firstName = document.getElementById('firstName').value;
                const lastName = document.getElementById('lastName').value;
                const email = document.getElementById('email').value;
                const subject = document.getElementById('subject').value;
                const message = document.getElementById('message').value;
                
                // Simple validation
                if (!firstName || !lastName || !email || !subject || !message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Tidak Lengkap',
                        text: 'Silakan isi semua field yang diperlukan!',
                        confirmButtonColor: '#4f46e5'
                    });
                    return;
                }
                
                // Email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Email Tidak Valid',
                        text: 'Silakan masukkan alamat email yang benar!',
                        confirmButtonColor: '#4f46e5'
                    });
                    return;
                }
                
                // Simulasi loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-pulse me-2"></i> Mengirim...';
                
                // Simulasi pengiriman (nanti diganti dengan AJAX ke backend)
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pesan Terkirim!',
                        text: 'Terima kasih, tim kami akan segera merespon pesan Anda.',
                        confirmButtonColor: '#4f46e5'
                    }).then(() => {
                        form.reset();
                    });
                    
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Kirim Pesan';
                }, 1500);
            });
        }

        // Dark Mode Toggle
        const themeToggle = document.getElementById('themeToggleCheckbox');
        if (themeToggle) {
            if (localStorage.getItem('darkMode') === 'enabled') {
                document.body.classList.add('dark-mode');
                themeToggle.checked = true;
            }
            themeToggle.addEventListener('change', function() {
                if (this.checked) {
                    document.body.classList.add('dark-mode');
                    localStorage.setItem('darkMode', 'enabled');
                } else {
                    document.body.classList.remove('dark-mode');
                    localStorage.setItem('darkMode', 'disabled');
                }
            });
        }

        // Scroll to Top Button
        const scrollBtn = document.createElement('div');
        scrollBtn.className = 'scroll-top-btn';
        scrollBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        document.body.appendChild(scrollBtn);
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollBtn.classList.add('show');
            } else {
                scrollBtn.classList.remove('show');
            }
        });
        
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        const style = document.createElement('style');
        style.textContent = `
            .scroll-top-btn {
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 45px;
                height: 45px;
                background: #4f46e5;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                cursor: pointer;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                z-index: 1000;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            .scroll-top-btn.show {
                opacity: 1;
                visibility: visible;
            }
            .scroll-top-btn:hover {
                background: #4338ca;
                transform: translateY(-3px);
            }
            body.dark-mode .scroll-top-btn {
                background: #4f46e5;
            }
            body.dark-mode .scroll-top-btn:hover {
                background: #4338ca;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>