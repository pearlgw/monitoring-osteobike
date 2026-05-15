<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengingat Jadwal Terapi</title>
</head>

<body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding: 32px 16px;">
        <tr>
            <td align="center">
                <table width="520" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:12px; overflow:hidden; border: 1px solid #e5e7eb;">

                    {{-- Header --}}
                    <tr>
                        <td style="background:#0EA5A4; padding: 28px 32px;">
                            <span
                                style="font-size:15px; font-weight:600; color:white; letter-spacing:0.01em;">Osteobike</span>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 28px 32px;">

                            {{-- Badge --}}
                            <table cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                                <tr>
                                    <td style="background:#E1F5EE; border-radius:8px; padding: 8px 14px;">
                                        <span style="font-size:13px; font-weight:500; color:#0F6E56;">🕐 Pengingat
                                            Jadwal Terapi</span>
                                    </td>
                                </tr>
                            </table>

                            {{-- Greeting --}}
                            <p style="font-size:15px; font-weight:600; color:#111827; margin:0 0 8px;">
                                Halo, {{ $user->nama_lengkap }}
                            </p>

                            {{-- Message --}}
                            <p style="font-size:14px; color:#6b7280; line-height:1.7; margin:0 0 20px;">
                                Kami ingin mengingatkan bahwa jadwal terapi Anda telah tiba.
                                Silakan melakukan terapi kembali sesuai jadwal yang telah ditentukan.
                            </p>

                            {{-- Schedule box --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:20px;">
                                <tr>
                                    <td
                                        style="background:#f9fafb; border-radius:8px; padding:14px 16px; border:1px solid #e5e7eb;">
                                        <p
                                            style="font-size:11px; color:#9ca3af; margin:0 0 4px; text-transform:uppercase; letter-spacing:0.06em;">
                                            Jadwal Anda</p>
                                        <p style="font-size:14px; font-weight:500; color:#111827; margin:0;">
                                            Hari ini - Sesi terapi rutin fisioterapis menggunakan osteobike
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            {{-- Closing --}}
                            <p style="font-size:14px; color:#6b7280; line-height:1.7; margin:0 0 24px;">
                                Terima kasih telah menggunakan layanan kami. Semoga terapi berjalan lancar.
                            </p>

                            {{-- Signature --}}
                            <table cellpadding="0" cellspacing="0"
                                style="border-top:1px solid #e5e7eb; padding-top:20px; width:100%;">
                                <tr>
                                    <td>
                                        <p style="font-size:13px; color:#9ca3af; margin:0;">Salam,</p>
                                        <p style="font-size:13px; font-weight:500; color:#6b7280; margin:2px 0 0;">Tim
                                            Monitoring Osteobike</p>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background:#f9fafb; border-top:1px solid #e5e7eb; padding:14px 32px;">
                            <p style="font-size:11px; color:#9ca3af; margin:0; text-align:center;">
                                Email ini dikirim secara otomatis oleh sistem Osteobike. Mohon tidak membalas email ini.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
