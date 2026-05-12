<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai - Sistem SDM</title>
    <!-- Modern Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --primary: #3b82f6;
            --primary-hover: #2563eb;
            --card-bg: #ffffff;
            --border-color: #e2e8f0;
        }

        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
        }

        .navbar {
            background-color: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }

        .navbar h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(to right, var(--primary), #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .navbar a {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar a:hover {
            color: var(--primary);
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
            animation: fadeIn 0.5s ease-out;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        h2 {
            font-size: 1.8rem;
            margin: 0;
            color: var(--text-main);
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .search-box {
            display: flex;
            gap: 0.5rem;
        }

        .search-input {
            padding: 0.6rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.95rem;
            font-family: inherit;
            width: 300px;
            outline: none;
            transition: all 0.2s;
            background: #fff;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .btn {
            padding: 0.6rem 1.2rem;
            background: linear-gradient(135deg, var(--primary), #60a5fa);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 10px -1px rgba(59, 130, 246, 0.4);
        }

        .table-container {
            background: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background-color: #f8fafc;
            padding: 1.2rem 1rem;
            font-weight: 600;
            color: var(--text-muted);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 1.2rem 1rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            font-size: 0.95rem;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr {
            transition: background-color 0.15s;
        }

        tr:hover td {
            background-color: #f1f5f9;
        }

        .badge {
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        .badge-pns { background-color: #dbeafe; color: #1e3a8a; border: 1px solid #bfdbfe; }
        .badge-pppk { background-color: #fce7f3; color: #9d174d; border: 1px solid #fbcfe8; }
        .badge-default { background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 1.5rem;
            background: #f8fafc;
            border-top: 1px solid var(--border-color);
        }

        .pagination-info {
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .pagination-links {
            display: flex;
            gap: 0.4rem;
        }

        .pagination-links a, .pagination-links span {
            padding: 0.5rem 1rem;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            text-decoration: none;
            color: var(--text-main);
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);
        }

        .pagination-links a:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .header-actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .search-input {
                width: 100%;
            }
            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>SDM Buleleng</h1>
        <a href="/">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Home
        </a>
    </nav>

    <div class="container">
        <div class="header-actions">
            <h2>Daftar Pegawai & Unit Kerja</h2>
            
            <form action="/pegawai" method="GET" class="search-box">
                <input type="text" name="search" class="search-input" placeholder="Cari NIP atau Nama..." value="{{ $search }}">
                <button type="submit" class="btn">Cari</button>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th width="8%">ID</th>
                        <th width="25%">Nama Pegawai</th>
                        <th width="15%">NIP</th>
                        <th width="12%">Status</th>
                        <th width="10%">Golongan</th>
                        <th width="30%">Unit Kerja</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paginatedData as $pegawai)
                    <tr>
                        <td style="color: var(--text-muted);">#{{ $pegawai->id }}</td>
                        <td style="font-weight: 600;">{{ $pegawai->nama }}</td>
                        <td style="font-family: 'Courier New', Courier, monospace; color: var(--text-muted); font-size: 1rem;">
                            {{ $pegawai->nip }}
                        </td>
                        <td>
                            @php
                                $badgeClass = 'badge-default';
                                if($pegawai->status_kepegawaian == 'PNS') $badgeClass = 'badge-pns';
                                elseif($pegawai->status_kepegawaian == 'PPPK') $badgeClass = 'badge-pppk';
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $pegawai->status_kepegawaian }}</span>
                        </td>
                        <td><span style="font-weight: 500;">{{ $pegawai->golongan ?? '-' }}</span></td>
                        <td>
                            @if($pegawai->unitKerja)
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color: var(--text-muted);"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    {{ $pegawai->unitKerja->nama_unit }}
                                </div>
                            @else
                                <span style="color: var(--text-muted); font-style: italic;">Belum Diatur</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 4rem 1rem; color: var(--text-muted);">
                            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24" style="margin-bottom: 1rem; opacity: 0.5;"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <br>
                            Tidak ada data pegawai yang sesuai dengan pencarian Anda.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="pagination">
                <div class="pagination-info">
                    Menampilkan <span style="font-weight: 700; color: var(--text-main);">{{ $paginatedData->firstItem() ?? 0 }}</span> s/d <span style="font-weight: 700; color: var(--text-main);">{{ $paginatedData->lastItem() ?? 0 }}</span> dari total {{ $paginatedData->total() }} data
                </div>
                
                <div class="pagination-links">
                    @if ($paginatedData->onFirstPage())
                        <span style="opacity: 0.5; cursor: not-allowed; background: #f8fafc;">&laquo; Prev</span>
                    @else
                        <a href="{{ $paginatedData->previousPageUrl() }}">&laquo; Prev</a>
                    @endif

                    @if ($paginatedData->hasMorePages())
                        <a href="{{ $paginatedData->nextPageUrl() }}">Next &raquo;</a>
                    @else
                        <span style="opacity: 0.5; cursor: not-allowed; background: #f8fafc;">Next &raquo;</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
