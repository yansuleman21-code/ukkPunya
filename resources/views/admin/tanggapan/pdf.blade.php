<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengaduan Siswa</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header table {
            width: 100%;
            border-collapse: collapse;
        }
        .header td {
            vertical-align: middle;
        }
        .logo {
            width: 80px;
            height: auto;
        }
        .school-info {
            text-align: center;
        }
        .school-info h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .school-info p {
            margin: 2px 0;
            font-size: 12px;
        }
        .report-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
            text-decoration: underline;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            text-align: center;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            padding: 3px 6px;
            border-radius: 3px;
            color: white;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .bg-orange { background-color: #f97316; }
        .bg-pink { background-color: #ec4899; }
        .bg-green { background-color: #22c55e; }
        
        .footer {
            margin-top: 50px;
            width: 100%;
        }
        .ttd {
            float: right;
            text-align: center;
            width: 250px;
        }
        .ttd p {
            margin: 0 0 60px 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <table>
            <tr>
                @php
                    $leftLogoPath = public_path('images/gtlo.png');
                    $rightLogoPath = public_path('images/logo.png');
                    
                    $leftLogoData = '';
                    if(file_exists($leftLogoPath)) {
                        $leftLogoData = 'data:image/png;base64,' . base64_encode(file_get_contents($leftLogoPath));
                    }
                    
                    $rightLogoData = '';
                    if(file_exists($rightLogoPath)) {
                        $rightLogoData = 'data:image/png;base64,' . base64_encode(file_get_contents($rightLogoPath));
                    }
                @endphp
                <td width="15%" style="text-align: left;">
                    @if($leftLogoData)
                        <img src="{{ $leftLogoData }}" class="logo" alt="Logo Kiri">
                    @endif
                </td>
                <td width="70%" class="school-info">
                    <h1>PEMERINTAH PROVINSI GORONTALO</h1><br>
                    <h1>DINAS PENDIDIKAN DAN KEBUDAYAAN</h1><br>
                    <h1><b>SMK NEGERI 1 LIMBOTO</b></h1>
                    <p>Jalan Abdulrahman Moito, Nomor 117, Dutulanaa, Limboto, Gorontalo, 96213</p>
                    <p>Telepon: (1435) 2012001 | Email: info@smkn1limboto.sch.id | Laman: http://smkn1limboto.sch.id</p>
                </td>
                <td width="15%" style="text-align: right;">
                    @if($rightLogoData)
                        <img src="{{ $rightLogoData }}" class="logo" alt="Logo Kanan">
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="report-title">
        LAPORAN PENGADUAN SISWA
        <br>
        <span style="font-size: 12px; font-weight: normal; text-decoration: none;">
            @if($bulan && $tahun)
                Periode: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}
            @elseif($bulan)
                Bulan: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }}
            @elseif($tahun)
                Tahun: {{ $tahun }}
            @else
                Keseluruhan
            @endif
        </span>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="15%">NIS - Nama Siswa</th>
                <th width="15%">Kategori</th>
                <th width="35%">Isi Pengaduan</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $d)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $d->created_at->format('d/m/Y') }}</td>
                <td>
                    <b>{{ $d->siswa->nis ?? '-' }}</b><br>
                    {{ $d->siswa->user->username ?? '-' }}
                </td>
                <td>{{ $d->kategori->ket_kategori ?? '-' }}</td>
                <td>
                    <b>Lokasi:</b> {{ $d->lokasi }}<br>
                    {{ Str::limit($d->ket_aspirasi, 100) }}
                </td>
                <td class="text-center">
                    @php
                        $badgeClass = '';
                        if($d->status == 'menunggu') $badgeClass = 'bg-orange';
                        elseif($d->status == 'proses') $badgeClass = 'bg-pink';
                        elseif($d->status == 'selesai') $badgeClass = 'bg-green';
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ strtoupper($d->status) }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pengaduan untuk periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="ttd">
            <p>Limboto, {{ date('d F Y') }}<br>Operator,</p>
            <br>
            <strong>RIYAN R. SULEMAN</strong>
            <br>NIP. 1234567890123456
        </div>
    </div>

</body>
</html>
