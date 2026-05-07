<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Laporan Terapi – Osteobike</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        @page {
            margin: 0;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #000;
            background: #fff;
            margin: 0;
            padding: 0;
            margin-top: 120px;
            margin-bottom: 70px;
        }

        /* ─── WATERMARK ─── */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-35deg);
            font-size: 80px;
            font-weight: 900;
            color: rgba(0, 0, 0, 0.04);
            letter-spacing: 8px;
            text-transform: uppercase;
            white-space: nowrap;
            z-index: 0;
        }

        /* ─── KOP SURAT ─── */
        .kop {
            border-bottom: 3px double #000;
            padding: 16px 36px 12px;
            display: table;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;

        }

        .kop-logo {
            display: table-cell;
            vertical-align: middle;
            width: 70px;
        }

        .kop-logo-box {
            width: 56px;
            height: 56px;
            border-radius: 6px;
            text-align: center;
            line-height: 1;
            padding-top: 8px;
            background-image: url('{{ public_path('images/logo.jpeg') }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }

        .kop-logo-icon {
            font-size: 20px;
        }

        .kop-logo-text {
            font-size: 7px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .kop-info {
            display: table-cell;
            vertical-align: middle;
            padding-left: 12px;
        }

        .kop-nama {
            font-size: 20px;
            font-weight: 900;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .kop-tagline {
            font-size: 9.5px;
            color: #444;
            margin-top: 2px;
        }

        .kop-kontak {
            font-size: 8.5px;
            color: #666;
            margin-top: 5px;
        }

        /* ─── JUDUL DOKUMEN ─── */
        .doc-title-wrap {
            text-align: center;
            padding: 16px 36px 0;
        }

        .doc-title-line {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .doc-periode {
            font-size: 10px;
            color: #555;
            margin-top: 4px;
        }

        /* ─── KONTEN ─── */
        .content {
            padding: 14px 36px;
            position: relative;
            z-index: 1;
        }

        .pembuka {
            margin-bottom: 14px;
            line-height: 1.8;
            text-align: justify;
        }

        /* ─── INFO PASIEN ─── */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .info-table .lbl {
            width: 130px;
            font-weight: 600;
        }

        .info-table .sep {
            width: 16px;
        }

        /* ─── PEMBATAS ─── */
        .divider {
            border: none;
            border-top: 1px solid #bbb;
            margin: 12px 0;
        }

        /* ─── SUB JUDUL ─── */
        .sub-title {
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        /* ─── GRAFIK ─── */
        .chart-img {
            width: 100%;
            display: block;
            border: 1px solid #ccc;
        }

        .chart-caption {
            font-size: 9px;
            color: #555;
            text-align: center;
            margin: 3px 0 10px;
        }

        /* ─── TABEL DATA ─── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            font-size: 10px;
        }

        .data-table thead tr {
            background: #d8d8d8;
            color: #111;
        }

        .data-table thead th {
            padding: 5px 7px;
            text-align: center;
            font-weight: 700;
            border: 1px solid #a3a3a3;
        }

        .data-table tbody tr:nth-child(even) {
            background: #f5f5f5;
        }

        .data-table tbody tr:nth-child(odd) {
            background: #fff;
        }

        .data-table tbody td {
            padding: 4px 7px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .data-table tbody td.left {
            text-align: left;
        }

        .data-table tfoot td {
            padding: 4px 7px;
            border: 1px solid #aaa;
            background: #eee;
            font-weight: 700;
            text-align: center;
        }

        .tfoot-label {
            text-align: right !important;
        }

        /* ─── TTD ─── */
        .penutup {
            margin-top: 16px;
            line-height: 1.8;
            text-align: justify;
        }

        .ttd-wrap {
            margin-top: 20px;
            display: table;
            width: 100%;
        }

        .ttd-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .ttd-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: center;
        }

        .ttd-nama {
            font-weight: 700;
            border-top: 1px solid #000;
            display: inline-block;
            min-width: 160px;
            padding-top: 3px;
        }

        /* ─── FOOTER ─── */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            border-top: 1px solid #999;
            padding: 5px 36px;
            display: table;
            width: 100%;
            background: #fff;
        }

        .footer-left {
            display: table-cell;
            vertical-align: middle;
            width: 60%;
        }

        .footer-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 40%;
        }

        .footer-text {
            font-size: 8.5px;
            color: #666;
        }

        .footer-spacer {
            height: 32px;
        }
    </style>
</head>

<body>

    <div class="watermark">Osteobike</div>

    {{-- KOP --}}
    <div class="kop">
        <div class="kop-logo">
            <div class="kop-logo-box">
                {{-- <div class="kop-logo-icon">🚲</div>
                <div class="kop-logo-text">OB</div> --}}
            </div>
        </div>
        <div class="kop-info">
            <div class="kop-nama">Osteobike</div>
            <div class="kop-tagline">Sistem Monitoring Terapi Sepeda Stasioner</div>
            {{-- <div class="kop-kontak">Telp. (0274) 000-000 &nbsp;|&nbsp; Email: info@osteobike.id &nbsp;|&nbsp; --}}
            {{-- www.osteobike.id</div> --}}
        </div>
    </div>

    {{-- JUDUL --}}
    <div class="doc-title-wrap">
        <div class="doc-title-line">Laporan Rekap Terapi Pasien</div>
        <div class="doc-periode">
            Periode &nbsp;
            {{ \Carbon\Carbon::parse($tanggal_start)->isoFormat('D MMMM YYYY') }}
            &nbsp;s.d.&nbsp;
            {{ \Carbon\Carbon::parse($tanggal_akhir)->isoFormat('D MMMM YYYY') }}
        </div>
    </div>

    <div class="content">

        {{-- Pembuka --}}
        <div class="pembuka">
            Berikut ini adalah laporan rekap hasil terapi yang telah dilakukan oleh pasien yang bersangkutan
            berdasarkan data yang tercatat dalam sistem Osteobike pada periode yang tertera di atas.
        </div>

        {{-- I. Identitas Pasien --}}
        <div class="sub-title">I.&nbsp;&nbsp;Identitas Pasien</div>
        <table class="info-table">
            <tr>
                <td class="lbl">Nama Lengkap</td>
                <td class="sep">:</td>
                <td><strong>{{ $pasien->nama_lengkap }}</strong></td>
            </tr>
            <tr>
                <td class="lbl">Kode Pasien</td>
                <td class="sep">:</td>
                <td>{{ $pasien->kode_pasien }}</td>
            </tr>
            <tr>
                <td class="lbl">Umur</td>
                <td class="sep">:</td>
                <td>
                    @if (!empty($pasien->tanggal_lahir))
                        {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->age }} tahun
                    @else
                        {{ $pasien->umur ?? '-' }} tahun
                    @endif
                </td>
            </tr>
            <tr>
                <td class="lbl">Jenis Kelamin</td>
                <td class="sep">:</td>
                <td>{{ $pasien->jenis_kelamin ?? '-' }}</td>
            </tr>
            <tr>
                <td class="lbl">Alamat</td>
                <td class="sep">:</td>
                <td>{{ $pasien->alamat ?? '-' }}</td>
            </tr>
        </table>

        <hr class="divider">

        {{-- II. Grafik & Tabel Durasi --}}
        <div class="sub-title">II.&nbsp;&nbsp;Grafik Durasi Terapi</div>
        <img class="chart-img" src="{{ $chart_durasi_img }}" alt="Grafik Durasi">
        <div class="chart-caption">Gambar 1. Grafik rata-rata durasi terapi per tanggal (menit)</div>

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:32px;">No.</th>
                    <th>Nama Pasien</th>
                    <th>Kode</th>
                    <th>ROM (°)</th>
                    <th>RPM</th>
                    <th>Durasi (mnt)</th>
                    <th>Berat (kg)</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($terapiData as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="left">{{ $pasien->nama_lengkap }}</td>
                        <td>{{ $pasien->kode_pasien }}</td>
                        <td>{{ $item->rom ?? '-' }}</td>
                        <td>{{ $item->rpm ?? '-' }}</td>
                        <td>{{ $item->durasi ?? '-' }}</td>
                        <td>{{ $item->berat_badan ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_terapi)->isoFormat('D MMM YYYY') }}</td>
                    </tr>
                @endforeach
            </tbody>
            {{-- <tfoot>
                <tr>
                    <td colspan="5" class="tfoot-label">Rata-rata Durasi</td>
                    <td>{{ round($terapiData->avg('durasi'), 1) }} mnt</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot> --}}
        </table>

        <hr class="divider">

        {{-- III. Grafik & Tabel RPM --}}
        <div class="sub-title">III.&nbsp;&nbsp;Grafik RPM Terapi</div>
        <img class="chart-img" src="{{ $chart_rpm_img }}" alt="Grafik RPM">
        <div class="chart-caption">Gambar 2. Grafik rata-rata RPM terapi per tanggal (rotasi per menit)</div>

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:32px;">No.</th>
                    <th>Nama Pasien</th>
                    <th>Kode</th>
                    <th>ROM (°)</th>
                    <th>RPM</th>
                    <th>Durasi (mnt)</th>
                    <th>Berat (kg)</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($terapiData as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="left">{{ $pasien->nama_lengkap }}</td>
                        <td>{{ $pasien->kode_pasien }}</td>
                        <td>{{ $item->rom ?? '-' }}</td>
                        <td>{{ $item->rpm ?? '-' }}</td>
                        <td>{{ $item->durasi ?? '-' }}</td>
                        <td>{{ $item->berat_badan ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_terapi)->isoFormat('D MMM YYYY') }}</td>
                    </tr>
                @endforeach
            </tbody>
            {{-- <tfoot>
                <tr>
                    <td colspan="4" class="tfoot-label">Rata-rata RPM</td>
                    <td>{{ round($terapiData->avg('rpm'), 1) }}</td>
                    <td colspan="3"></td>
                </tr>
            </tfoot> --}}
        </table>

        <hr class="divider">

        {{-- Penutup --}}
        <div class="penutup">
            Demikian laporan rekap terapi ini dibuat berdasarkan data yang tercatat dalam sistem.
            Laporan ini diterbitkan secara otomatis dan dapat digunakan sebagai dokumentasi resmi perkembangan terapi
            pasien.
        </div>

        {{-- TTD --}}
        <div class="ttd-wrap">
            <div class="ttd-left"></div>
            <div class="ttd-right">
                <div style="">
                    Semarang, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
                </div>
                <div>Diterbitkan oleh,</div>
                <br><br><br>
                <div class="ttd-nama">Tim Osteobike</div>
            </div>
        </div>

        <div class="footer-spacer"></div>
    </div>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-left">
            <div class="footer-text">Osteobike – Sistem Monitoring Terapi Sepeda Stasioner</div>
            <div class="footer-text">Dicetak: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, HH:mm') }} WIB</div>
        </div>
        <div class="footer-right">
            <div class="footer-text">Dokumen ini diterbitkan secara otomatis oleh sistem.</div>
            <div class="footer-text">Kerahasiaan data pasien dijaga sesuai ketentuan yang berlaku.</div>
        </div>
    </footer>

</body>

</html>
