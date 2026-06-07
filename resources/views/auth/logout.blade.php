<!DOCTYPE html>
<html lang="hy">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5;url={{ route('home') }}">
    <title>Դուրս եք եկել</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.5.1/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/google-fonts/noto-sans-armenian/noto-sans-armenian.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/google-fonts/noto-serif-armenian/noto-serif-armenian.css') }}">
    @vite('resources/css/polish.css')
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
            background: radial-gradient(circle at top, #f7e8e8 0%, #e7d5d5 45%, #b67272 100%);
            color: #2f1a1a;
            text-align: center;
        }
        .logout-container {
            width: min(520px, 90vw);
            padding: 36px 34px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(255,255,255,0.85);
            box-shadow: 0 30px 60px rgba(79, 23, 23, 0.16);
            backdrop-filter: blur(12px);
        }
        .logout-icon {
            font-size: 68px;
            color: #a02f2f;
            background: rgba(160, 47, 47, 0.13);
            width: 120px;
            height: 120px;
            line-height: 120px;
            border-radius: 50%;
            margin: 0 auto 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(160, 47, 47, 0.18);
        }
        h1 {
            font-size: clamp(1.9rem, 2.6vw, 2.7rem);
            margin-bottom: 18px;
            letter-spacing: -0.03em;
        }
        p {
            font-size: 1rem;
            color: #5d3c3c;
            line-height: 1.7;
            margin-bottom: 24px;
        }
        .btn-group {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 24px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
            letter-spacing: 0.4px;
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }
        .btn-primary {
            background: linear-gradient(135deg, #a02f2f, #df7272);
            color: #fff;
            box-shadow: 0 18px 28px rgba(160, 47, 47, 0.28);
        }
        .btn-secondary {
            background: rgba(232, 210, 210, 0.8);
            color: #4f2b2b;
            border: 1px solid rgba(160, 47, 47, 0.12);
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .note {
            margin-top: 22px;
            font-size: 0.95rem;
            color: #7a4e4e;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-icon">
            <i class="fa-solid fa-right-from-bracket"></i>
        </div>
        <h1>Դուրս եք եկել</h1>
        <p>Ձեր ելքը հաջողվեց։ Դուք կվերադառնաք գլխավոր էջ ավտոմատ կերպով մեկ քանի վայրկյան հետո։</p>
        <div class="btn-group">
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fa-solid fa-house"></i>
                Վերադառնալ գլխավոր
            </a>
            <a href="{{ route('register') }}" class="btn btn-secondary">
                <i class="fa-solid fa-right-to-bracket"></i>
                Մուտք գործել նորից
            </a>
        </div>
    </div>
</body>
</html>
