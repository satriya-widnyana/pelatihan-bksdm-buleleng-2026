<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem SDM - Portofolio BNSP</title>
    <!-- Modern Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient-start: #0f172a;
            --bg-gradient-end: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent-primary: #3b82f6;
            --accent-secondary: #8b5cf6;
            --card-bg: rgba(255, 255, 255, 0.05);
            --card-border: rgba(255, 255, 255, 0.1);
        }

        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--bg-gradient-start), var(--bg-gradient-end));
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 900px;
            width: 90%;
            margin: 2rem auto;
            padding: 3rem;
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s ease-out;
        }

        h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(to right, #60a5fa, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            letter-spacing: -1px;
        }

        .subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-bottom: 3rem;
            font-weight: 300;
        }

        .modules {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .card {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        /* Micro-animation border top on hover */
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, var(--accent-primary), var(--accent-secondary));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px -10px rgba(0,0,0,0.6);
        }

        .card:hover::before {
            opacity: 1;
        }

        .card-code {
            font-family: 'Courier New', Courier, monospace;
            background: rgba(147, 197, 253, 0.1);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #93c5fd;
            display: inline-block;
            margin-bottom: 1rem;
            border: 1px solid rgba(147, 197, 253, 0.2);
        }

        .card h2 {
            font-size: 1.25rem;
            margin-top: 0;
            margin-bottom: 1rem;
            color: #f1f5f9;
        }

        .card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        .action-container {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--card-border);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1.2rem 3rem;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            color: white;
            text-decoration: none;
            font-weight: 600;
            border-radius: 999px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px -10px rgba(59, 130, 246, 0.5);
            position: relative;
            overflow: hidden;
        }

        /* Efek kilau pada tombol */
        .btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255,255,255,0.1);
            transform: rotate(45deg) translateY(-100%);
            transition: transform 0.6s ease;
        }

        .btn:hover {
            transform: scale(1.03) translateY(-2px);
            box-shadow: 0 15px 25px -10px rgba(139, 92, 246, 0.7);
        }

        .btn:hover::after {
            transform: rotate(45deg) translateY(100%);
        }

        .btn svg {
            width: 24px;
            height: 24px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsif untuk HP */
        @media (max-width: 768px) {
            .modules {
                grid-template-columns: 1fr;
            }
            .container {
                padding: 2rem;
                width: 85%;
            }
            h1 {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistem SDM Buleleng</h1>
        <div class="subtitle">Platform Demonstrasi Sertifikasi Kompetensi BNSP</div>

        <div class="modules">
            <!-- Modul 1 -->
            <div class="card">
                <div class="card-code">J.620100.022.02</div>
                <h2>Implementasi Algoritma</h2>
                <p>Mendemonstrasikan penerapan algoritma pemrograman secara *Service-Oriented*. Mencakup simulasi <strong>Sorting</strong> (O(N) vs O(N²)), <strong>Searching</strong> (Linear, Binary, Hash Table), <strong>Rekursi DP</strong> (Memoization), dan evaluasi memori dengan struktur data <strong>Queue</strong> & <strong>Generator</strong>.</p>
            </div>

            <!-- Modul 2 -->
            <div class="card">
                <div class="card-code">J.620100.023.02</div>
                <h2>Dokumentasi Kode Program</h2>
                <p>Implementasi standar industri dalam penulisan dokumentasi kode. Meliputi penulisan komentar fungsional (Prinsip <i>WHY</i>), penamaan <strong>PHPDoc PSR-5</strong> yang komprehensif, serta pembentukan <i>blueprint</i> <strong>OpenAPI 3.0</strong> secara *real-time* menggunakan anotasi modern.</p>
            </div>
        </div>

        <div class="action-container">
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="/pegawai" class="btn" style="background: linear-gradient(135deg, #10b981, #059669); box-shadow: 0 10px 20px -10px rgba(16, 185, 129, 0.5);">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Lihat Data Pegawai (Web)
                </a>
                
                <a href="/api/documentation" class="btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                    Dokumentasi API (Swagger)
                </a>
            </div>
            <p style="margin-top: 1.5rem; color: var(--text-muted); font-size: 0.95rem;">
                Akses portal Swagger UI untuk melihat spesifikasi API secara visual dan melakukan pengujian *endpoint* (Try It Out) secara langsung tanpa perangkat pihak ketiga.
            </p>
        </div>
    </div>
</body>
</html>
