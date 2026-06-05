<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekrutmen Pegawai Kab. Jember</title>
    <link rel="icon" href="{{ asset('Lambang-kabupaten-jember.png') }}" type="image/x-icon">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            background: linear-gradient(135deg, #0d4f35, #2ecc7a);
            color: #fff;
        }

        .container {
            width: 100%;
            max-width: 850px;
        }

        .card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
            text-align: center;
            animation: fadeIn 1s ease;
        }

        h1 {
            font-size: clamp(2rem, 5vw, 4rem);
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .dot {
            animation: blink 1.5s infinite;
        }

        .dot:nth-child(2) {
            animation-delay: .2s;
        }

        .dot:nth-child(3) {
            animation-delay: .4s;
        }

        .subtitle {
            margin-bottom: 30px;
            opacity: .9;
            font-size: 1rem;
        }

        .announcement {
            text-align: left;
            line-height: 1.9;
            font-size: 1rem;
            color: #f5f5f5;
        }

        .announcement strong {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 12px;
            color: #fff;
        }

        .jadwal {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 15px;
            margin: 18px 0;
        }

        .footer {
            margin-top: 25px;
            font-weight: 600;
            text-align: center;
        }

        @keyframes blink {

            0%,
            80%,
            100% {
                opacity: .2;
            }

            40% {
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile */
        @media (max-width:768px) {

            body {
                padding: 15px;
                align-items: flex-start;
            }

            .card {
                padding: 25px 20px;
                border-radius: 16px;
            }

            h1 {
                font-size: 2rem;
            }

            .announcement {
                font-size: .95rem;
                line-height: 1.8;
            }

            .jadwal {
                padding: 12px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card">

            <h1>
                TUTUP
                <span class="dot">.</span>
                <span class="dot">.</span>
                <span class="dot">.</span>
            </h1>

            {{-- <p class="subtitle">
                Rekrutmen Pegawai RSD Kabupaten Jember
            </p> --}}

            <div class="announcement">

                <strong>PENGUMUMAN</strong>

                Sehubungan dengan proses Rekrutmen SDM RSD Tahun 2026,
                disampaikan kepada seluruh pelamar bahwa pendaftaran
                hanya dilakukan melalui website resmi RSD.

                <div class="jadwal">
                    <b>Jadwal Pendaftaran</b><br><br>

                    📅 <b>Dibuka:</b> 3 Juni 2026 — 00.00 WIB <br>
                    📅 <b>Ditutup:</b> 5 Juni 2026 — 23.59 WIB
                </div>

                Bagi pelamar yang telah melakukan pendaftaran sebelum jadwal
                pembukaan atau melalui tautan/website yang bukan merupakan
                website resmi RSD, maka pendaftaran tersebut tidak dapat
                diproses dan dianggap tidak sah.

                Oleh karena itu, pelamar dimohon untuk melakukan pendaftaran
                ulang melalui website resmi RSD pada periode pendaftaran
                sebagaimana jadwal yang telah ditetapkan.

                <div class="footer">
                    Panitia Rekrutmen SDM<br>
                    RSD Jember Tahun 2026
                </div>

            </div>

        </div>

    </div>

    <script>
        console.log("Coming Soon Loaded");
    </script>

</body>

</html>
