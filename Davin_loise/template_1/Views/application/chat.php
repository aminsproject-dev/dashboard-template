<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?= $title ?? 'Chat' ?></title>

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
        }

        /* Main Content */
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

        /* Breadcrumb */
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

        /* Chat Container */
        .chat-container {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02), 0 1px 3px rgba(0, 0, 0, 0.03);
            height: calc(100vh - 160px);
            min-height: 550px;
        }

        /* Contacts Sidebar */
        .contacts-sidebar {
            background: white;
            border-right: 1px solid #eef2ff;
            height: 100%;
            overflow-y: auto;
        }

        .contacts-header {
            padding: 20px;
            border-bottom: 1px solid #eef2ff;
        }

        .search-contact {
            background: #f1f5f9;
            border: none;
            border-radius: 30px;
            padding: 10px 15px;
            font-size: 0.85rem;
        }
        .search-contact:focus {
            box-shadow: none;
            background: #ffffff;
            border: 1px solid #4f46e5;
        }

        .contact-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            cursor: pointer;
            transition: all 0.2s ease;
            border-bottom: 1px solid #f1f5f9;
        }
        .contact-item:hover {
            background: #f8fafc;
        }
        .contact-item.active {
            background: #eef2ff;
            border-left: 3px solid #4f46e5;
        }

        .contact-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            flex-shrink: 0;
        }
        .contact-avatar-sm {
            width: 40px;
            height: 40px;
            font-size: 0.9rem;
        }

        .contact-info {
            flex: 1;
            margin-left: 12px;
            min-width: 0;
        }
        .contact-name {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 3px;
            color: #1e293b;
        }
        .contact-message {
            font-size: 0.75rem;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .contact-time {
            font-size: 0.7rem;
            color: #94a3b8;
            white-space: nowrap;
        }
        .contact-badge {
            background: #4f46e5;
            color: white;
            border-radius: 20px;
            padding: 2px 8px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        /* Chat Area */
        .chat-area {
            display: flex;
            flex-direction: column;
            height: 100%;
            background: #fafcff;
        }

        .chat-header {
            padding: 15px 25px;
            border-bottom: 1px solid #eef2ff;
            background: white;
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px 25px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .message {
            display: flex;
            max-width: 70%;
        }
        .message.received {
            align-self: flex-start;
        }
        .message.sent {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .message-bubble {
            padding: 10px 16px;
            border-radius: 20px;
            position: relative;
        }
        .message.received .message-bubble {
            background: white;
            border: 1px solid #eef2ff;
            border-top-left-radius: 4px;
            color: #1e293b;
        }
        .message.sent .message-bubble {
            background: #4f46e5;
            border-top-right-radius: 4px;
            color: white;
        }

        .message-time {
            font-size: 0.65rem;
            margin-top: 5px;
            display: block;
            color: #94a3b8;
        }
        .message.sent .message-time {
            text-align: right;
            color: #a5b4fc;
        }

        .chat-input-area {
            padding: 15px 25px;
            border-top: 1px solid #eef2ff;
            background: white;
        }

        .chat-input {
            background: #f1f5f9;
            border: none;
            border-radius: 30px;
            padding: 12px 20px;
            font-size: 0.9rem;
        }
        .chat-input:focus {
            box-shadow: none;
            background: #ffffff;
            border: 1px solid #4f46e5;
        }

        .send-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #4f46e5;
            border: none;
            color: white;
            transition: all 0.2s;
        }
        .send-btn:hover {
            background: #7c3aed;
            transform: scale(1.05);
        }

        /* Typing Indicator */
        .typing-indicator {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 8px 16px;
            background: white;
            border: 1px solid #eef2ff;
            border-radius: 20px;
            width: fit-content;
        }
        .typing-indicator span {
            width: 8px;
            height: 8px;
            background: #94a3b8;
            border-radius: 50%;
            animation: typing 1.4s infinite ease-in-out;
        }
        .typing-indicator span:nth-child(1) { animation-delay: 0s; }
        .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
        .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
            30% { transform: translateY(-10px); opacity: 1; }
        }

        /* Dark Mode */
        body.dark-mode {
            background: #0f172a;
        }
        body.dark-mode .chat-container {
            background: #1e293b;
        }
        body.dark-mode .contacts-sidebar {
            background: #1e293b;
            border-right-color: #334155;
        }
        body.dark-mode .contacts-header {
            border-bottom-color: #334155;
        }
        body.dark-mode .search-contact {
            background: #334155;
            color: #e2e8f0;
        }
        body.dark-mode .search-contact:focus {
            background: #0f172a;
            border-color: #4f46e5;
        }
        body.dark-mode .contact-item {
            border-bottom-color: #334155;
        }
        body.dark-mode .contact-item:hover {
            background: #334155;
        }
        body.dark-mode .contact-item.active {
            background: #334155;
        }
        body.dark-mode .contact-name {
            color: #e2e8f0;
        }
        body.dark-mode .contact-message {
            color: #94a3b8;
        }
        body.dark-mode .chat-area {
            background: #0f172a;
        }
        body.dark-mode .chat-header {
            border-bottom-color: #334155;
            background: #1e293b;
        }
        body.dark-mode .message.received .message-bubble {
            background: #334155;
            border-color: #475569;
            color: #e2e8f0;
        }
        body.dark-mode .chat-input-area {
            border-top-color: #334155;
            background: #1e293b;
        }
        body.dark-mode .chat-input {
            background: #334155;
            color: #e2e8f0;
        }
        body.dark-mode .chat-input:focus {
            background: #0f172a;
        }
        body.dark-mode .typing-indicator {
            background: #334155;
            border-color: #475569;
        }

        /* Scrollbar */
        .contacts-sidebar::-webkit-scrollbar,
        .chat-messages::-webkit-scrollbar {
            width: 5px;
        }
        .contacts-sidebar::-webkit-scrollbar-track,
        .chat-messages::-webkit-scrollbar-track {
            background: #e2e8f0;
            border-radius: 10px;
        }
        .contacts-sidebar::-webkit-scrollbar-thumb,
        .chat-messages::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        body.dark-mode .contacts-sidebar::-webkit-scrollbar-track,
        body.dark-mode .chat-messages::-webkit-scrollbar-track {
            background: #334155;
        }
        body.dark-mode .contacts-sidebar::-webkit-scrollbar-thumb,
        body.dark-mode .chat-messages::-webkit-scrollbar-thumb {
            background: #475569;
        }

        @media (max-width: 768px) {
            .message {
                max-width: 85%;
            }
            .contact-name {
                font-size: 0.85rem;
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
                    <li class="breadcrumb-item"><a href="#">Aplikasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Obrolan</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="mb-4">
                <h2 class="fw-bold mb-0">Obrolan</h2>
                <p class="text-muted">Hubungi dan kelola percakapan dengan customer Anda.</p>
            </div>

            <!-- Chat Container -->
            <div class="chat-container">
                <div class="row g-0 h-100">
                    <!-- Contacts Sidebar -->
                    <div class="col-md-4 col-lg-3 h-100">
                        <div class="contacts-sidebar">
                            <div class="contacts-header">
                                <h5 class="fw-bold mb-3"><i class="fas fa-comments me-2 text-primary"></i>Percakapan</h5>
                                <div class="position-relative">
                                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="font-size: 0.8rem; z-index: 1;"></i>
                                    <input type="text" class="form-control search-contact ps-5" id="searchContact" placeholder="Cari kontak atau pesan...">
                                </div>
                            </div>
                            <div id="contactsList">
                                <!-- Contacts will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>

                    <!-- Chat Area -->
                    <div class="col-md-8 col-lg-9 h-100">
                        <div class="chat-area">
                            <div class="chat-header d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-3" id="chatHeaderInfo">
                                    <div class="contact-avatar contact-avatar-sm bg-primary" id="selectedAvatar">JD</div>
                                    <div>
                                        <h5 class="fw-bold mb-0" id="selectedName">Davin Loise</h5>
                                        <small class="text-muted" id="selectedStatus"><i class="fas fa-circle text-success me-1" style="font-size: 0.5rem;"></i> Online</small>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light rounded-circle" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-info-circle me-2"></i> Detail Kontak</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-ban me-2"></i> Blokir</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-trash-alt me-2"></i> Hapus Percakapan</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="chat-messages" id="chatMessages">
                                <!-- Messages will be populated by JavaScript -->
                            </div>

                            <div class="chat-input-area">
                                <div class="row g-2">
                                    <div class="col">
                                        <input type="text" class="form-control chat-input" id="messageInput" placeholder="Ketik pesan...">
                                    </div>
                                    <div class="col-auto">
                                        <button class="send-btn" id="sendBtn">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="mt-4 pt-3 pb-3 text-center">
                <p class="mb-0 text-muted" style="font-family: 'Inter', sans-serif; font-size: 0.8rem;">
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
        // Data Contacts & Messages
        const contacts = [
            { id: 1, name: 'Davin Loise', avatar: 'DL', avatarColor: 'primary', status: 'online', lastMessage: 'Oke, nanti saya cek dulu', time: '09:41', unread: 2, role: 'Administrator' },
            { id: 2, name: 'Sarah Johnson', avatar: 'SJ', avatarColor: 'success', status: 'online', lastMessage: 'Terima kasih informasinya!', time: '09:15', unread: 0, role: 'Customer' },
            { id: 3, name: 'Michael Chen', avatar: 'MC', avatarColor: 'warning', status: 'offline', lastMessage: 'Kapan estimasi selesainya?', time: 'Kemarin', unread: 0, role: 'Customer' },
            { id: 4, name: 'Jessica Williams', avatar: 'JW', avatarColor: 'info', status: 'online', lastMessage: 'Saya setuju dengan proposalnya', time: 'Kemarin', unread: 1, role: 'Customer' },
            { id: 5, name: 'Robert Taylor', avatar: 'RT', avatarColor: 'danger', status: 'offline', lastMessage: 'Mohon dikirimkan dokumennya', time: '2 hari lalu', unread: 0, role: 'Customer' },
            { id: 6, name: 'Amanda Lee', avatar: 'AL', avatarColor: 'secondary', status: 'online', lastMessage: 'Baik, akan saya follow up', time: '2 hari lalu', unread: 0, role: 'Customer' },
            { id: 7, name: 'James Wilson', avatar: 'JW', avatarColor: 'dark', status: 'offline', lastMessage: 'Terima kasih bantuannya', time: '3 hari lalu', unread: 0, role: 'Customer' }
        ];

        const messagesData = {
            1: [
                { id: 1, text: 'Halo Davin, apakah project sudah selesai?', sender: 'received', time: '09:00' },
                { id: 2, text: 'Halo, untuk project utama sudah selesai. Tinggal beberapa revisi kecil.', sender: 'sent', time: '09:05' },
                { id: 3, text: 'Oke, revisi apa saja yang perlu diperbaiki?', sender: 'received', time: '09:10' },
                { id: 4, text: 'Ada beberapa bug di bagian dashboard dan perlu penyesuaian UI.', sender: 'sent', time: '09:15' },
                { id: 5, text: 'Oke, nanti saya cek dulu', sender: 'received', time: '09:41' }
            ],
            2: [
                { id: 1, text: 'Selamat pagi, saya ingin menanyakan tentang promo terbaru', sender: 'received', time: '08:30' },
                { id: 2, text: 'Selamat pagi! Saat ini ada promo diskon 20% untuk pembelian pertama', sender: 'sent', time: '08:35' },
                { id: 3, text: 'Terima kasih informasinya!', sender: 'received', time: '09:15' }
            ],
            3: [
                { id: 1, text: 'Kapan estimasi selesainya?', sender: 'received', time: 'Kemarin' },
                { id: 2, text: 'Estimasi selesai minggu depan, minggu ke-3 bulan ini', sender: 'sent', time: 'Kemarin' }
            ],
            4: [
                { id: 1, text: 'Saya setuju dengan proposalnya', sender: 'received', time: 'Kemarin' },
                { id: 2, text: 'Terima kasih, akan kami proses segera', sender: 'sent', time: 'Kemarin' }
            ],
            5: [
                { id: 1, text: 'Mohon dikirimkan dokumennya', sender: 'received', time: '2 hari lalu' },
                { id: 2, text: 'Dokumen sudah kami kirim ke email Anda', sender: 'sent', time: '2 hari lalu' }
            ],
            6: [
                { id: 1, text: 'Baik, akan saya follow up', sender: 'received', time: '2 hari lalu' },
                { id: 2, text: 'Terima kasih atas kerjasamanya', sender: 'sent', time: '2 hari lalu' }
            ],
            7: [
                { id: 1, text: 'Terima kasih bantuannya', sender: 'received', time: '3 hari lalu' },
                { id: 2, text: 'Sama-sama, senang bisa membantu', sender: 'sent', time: '3 hari lalu' }
            ]
        };

        let currentContactId = 1;
        let typingTimeout = null;

        // Render Contacts List
        function renderContacts() {
            const searchTerm = document.getElementById('searchContact')?.value.toLowerCase() || '';
            const filteredContacts = contacts.filter(contact => 
                contact.name.toLowerCase().includes(searchTerm)
            );

            const container = document.getElementById('contactsList');
            if (!container) return;

            container.innerHTML = filteredContacts.map(contact => `
                <div class="contact-item ${currentContactId === contact.id ? 'active' : ''}" data-id="${contact.id}">
                    <div class="contact-avatar bg-${contact.avatarColor}">${contact.avatar}</div>
                    <div class="contact-info">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="contact-name">${contact.name}</div>
                            <div class="contact-time">${contact.time}</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="contact-message">${contact.lastMessage}</div>
                            ${contact.unread > 0 ? `<div class="contact-badge">${contact.unread}</div>` : ''}
                        </div>
                    </div>
                </div>
            `).join('');

            // Add click event listeners
            document.querySelectorAll('.contact-item').forEach(item => {
                item.addEventListener('click', () => {
                    const id = parseInt(item.dataset.id);
                    changeContact(id);
                });
            });
        }

        // Render Messages
        function renderMessages() {
            const messages = messagesData[currentContactId] || [];
            const container = document.getElementById('chatMessages');
            if (!container) return;

            container.innerHTML = messages.map(msg => `
                <div class="message ${msg.sender}">
                    <div class="message-bubble">
                        ${msg.text}
                        <span class="message-time">${msg.time}</span>
                    </div>
                </div>
            `).join('');

            // Scroll to bottom
            container.scrollTop = container.scrollHeight;
        }

        // Update Chat Header
        function updateChatHeader() {
            const contact = contacts.find(c => c.id === currentContactId);
            if (!contact) return;

            document.getElementById('selectedName').innerHTML = contact.name;
            document.getElementById('selectedAvatar').innerHTML = contact.avatar;
            document.getElementById('selectedAvatar').className = `contact-avatar contact-avatar-sm bg-${contact.avatarColor}`;
            
            const statusText = contact.status === 'online' ? '<i class="fas fa-circle text-success me-1" style="font-size: 0.5rem;"></i> Online' : '<i class="fas fa-circle text-secondary me-1" style="font-size: 0.5rem;"></i> Offline';
            document.getElementById('selectedStatus').innerHTML = statusText;
        }

        // Change Contact
        function changeContact(id) {
            currentContactId = id;
            
            // Update active class
            document.querySelectorAll('.contact-item').forEach(item => {
                const contactId = parseInt(item.dataset.id);
                if (contactId === id) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
            
            updateChatHeader();
            renderMessages();
            
            // Update unread count
            const contact = contacts.find(c => c.id === id);
            if (contact && contact.unread > 0) {
                contact.unread = 0;
                renderContacts();
            }
        }

        // Send Message
        function sendMessage() {
            const input = document.getElementById('messageInput');
            const text = input.value.trim();
            if (!text) return;

            // Add message to data
            const newMessage = {
                id: (messagesData[currentContactId]?.length || 0) + 1,
                text: text,
                sender: 'sent',
                time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })
            };
            
            if (!messagesData[currentContactId]) {
                messagesData[currentContactId] = [];
            }
            messagesData[currentContactId].push(newMessage);
            
            // Update last message in contact
            const contact = contacts.find(c => c.id === currentContactId);
            if (contact) {
                contact.lastMessage = text;
                contact.time = newMessage.time;
            }
            
            renderMessages();
            renderContacts();
            
            // Clear input
            input.value = '';
            
            // Simulate typing indicator and reply
            showTypingIndicator();
            setTimeout(() => {
                simulateReply();
            }, 1500);
        }

        // Show Typing Indicator
        function showTypingIndicator() {
            const container = document.getElementById('chatMessages');
            const typingDiv = document.createElement('div');
            typingDiv.className = 'message received typing-message';
            typingDiv.id = 'typingIndicator';
            typingDiv.innerHTML = `
                <div class="typing-indicator">
                    <span></span><span></span><span></span>
                </div>
            `;
            container.appendChild(typingDiv);
            container.scrollTop = container.scrollHeight;
        }

        // Hide Typing Indicator
        function hideTypingIndicator() {
            const indicator = document.getElementById('typingIndicator');
            if (indicator) indicator.remove();
        }

        // Simulate Reply
        function simulateReply() {
            hideTypingIndicator();
            
            const replies = [
                'Baik, akan saya proses segera.',
                'Terima kasih informasinya!',
                'Oke, saya mengerti.',
                'Nanti saya cek dulu ya.',
                'Terima kasih bantuannya.',
                'Siap, akan saya follow up.'
            ];
            
            const randomReply = replies[Math.floor(Math.random() * replies.length)];
            const newMessage = {
                id: (messagesData[currentContactId]?.length || 0) + 1,
                text: randomReply,
                sender: 'received',
                time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })
            };
            
            messagesData[currentContactId].push(newMessage);
            
            // Update last message
            const contact = contacts.find(c => c.id === currentContactId);
            if (contact) {
                contact.lastMessage = randomReply;
                contact.time = newMessage.time;
            }
            
            renderMessages();
            renderContacts();
        }

        // Search Contact
        document.getElementById('searchContact')?.addEventListener('input', () => {
            renderContacts();
        });

        // Send message on Enter key
        document.getElementById('messageInput')?.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                sendMessage();
            }
        });

        // Send message on button click
        document.getElementById('sendBtn')?.addEventListener('click', sendMessage);

        // Initialize
        renderContacts();
        updateChatHeader();
        renderMessages();

        // Dark Mode Toggle (if exists in navbar)
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
    </script>
</body>
</html>