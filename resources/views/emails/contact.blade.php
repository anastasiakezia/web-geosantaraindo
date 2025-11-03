<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pesan Baru dari Website Geo Santara</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding: 30px;
        }

        .email-container {
            max-width: 600px;
            background-color: #ffffff;
            margin: 0 auto;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            padding: 25px 30px;
            border-top: 5px solid #007bff;
        }

        h2 {
            color: #007bff;
            font-size: 20px;
            margin-bottom: 10px;
        }

        p {
            font-size: 15px;
            line-height: 1.6;
            margin: 8px 0;
        }

        .label {
            color: #6c757d;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
            width: 120px;
        }

        .message-box {
            background-color: #f1f5ff;
            border-left: 4px solid #007bff;
            padding: 10px 15px;
            border-radius: 6px;
            margin-top: 10px;
            white-space: pre-line;
        }

        .footer {
            font-size: 12px;
            color: #888;
            text-align: center;
            margin-top: 25px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>Pesan Baru dari Form Kontak</h2>

        <p><span class="label">Nama</span>: {{ $data['name'] }}</p>
        <p><span class="label">Email</span>: {{ $data['email'] ?? '-' }}</p>
        <p><span class="label">Nomor HP</span>: {{ $data['phone'] ?? '-' }}</p>
        <p><span class="label">Perusahaan</span>: {{ $data['company'] ?? '-' }}</p>
        <p><span class="label">Jasa</span>: {{ $data['service_name'] ?? '-' }}</p>
        <p><span class="label">Lokasi</span>: {{ $data['location'] ?? '-' }}</p>

        <p><span class="label">Kebutuhan</span>:</p>
        <div class="message-box">
            {{ $data['needs'] }}
        </div>

        <div class="footer">
            Email ini dikirim otomatis dari website Geo Santara Indo.
        </div>
    </div>
</body>

</html>
