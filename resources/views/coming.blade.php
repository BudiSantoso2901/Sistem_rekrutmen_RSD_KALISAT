<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekrutmen Pegawai Kab. Jember</title>

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
            background: linear-gradient(135deg, #0d4f35, #2ecc7a);
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            width: 100%;
        }

        .logo {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        h1 {
            font-size: clamp(2rem, 5vw, 4rem);
            margin-bottom: 15px;
            animation: fadeIn 1.2s ease;
        }

        p {
            font-size: 1rem;
            opacity: 0.85;
        }

        .dot {
            animation: blink 1.5s infinite;
        }

        .dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes blink {

            0%,
            80%,
            100% {
                opacity: 0.2;
            }

            40% {
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container">
        {{-- <div class="logo">
            REKRUTMEN PEGAWAI KABUPATEN JEMBER
        </div> --}}

        <h1>
            Coming Soon
            <span class="dot">.</span>
            <span class="dot">.</span>
            <span class="dot">.</span>
        </h1>

        {{-- <p>Sistem sedang dipersiapkan.</p> --}}
    </div>

    <script>
        // Optional JS
        console.log("Coming Soon Page Loaded");
    </script>

</body>

</html>
