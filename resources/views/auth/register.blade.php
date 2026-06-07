<!DOCTYPE html>
<html lang="hy">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Գրանցում և Մուտք - ԱԼՄԱ Մսամթերք</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.5.1/css/all.min.css') }}">
    @vite('resources/css/register.css')
    <link rel="stylesheet" href="{{ asset('vendor/google-fonts/noto-sans-armenian/noto-sans-armenian.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/google-fonts/noto-serif-armenian/noto-serif-armenian.css') }}">
    @vite('resources/css/polish.css')
</head>

<body class="page-register">
    <a href="{{ route('home') }}" id="return_main" title="Դուրս գալ և վերադառնալ գլխավոր էջ">
        <i class="fa-solid fa-xmark"></i>
        <span>Գլխավոր</span>
    </a>

    <div class="registration_blok">
        <img src="{{ asset('storage/images/register/Our meat boxes are still available_ Ready for pick….jpg') }}" id="bod_img" alt="">

        <div id="login_text">
            <div class="top">
                <img id="logo_img" src="{{ asset('storage/images/atenk/cow_red.png') }}" alt="logo">
                <p class="p1">Բարև ձեզ!</p>
                <div class="together">
                    <p class="p2">Ձեր հաշիվ մուտք գործելու համար մուտքագրեք</p>
                    <p class="p2">Ձեր էլ.փոստի հասցեն և գաղտնաբառը:</p>
                </div>

                <div class="forms">
                    <div class="reg_log_sig">
                        <form id="login_form" method="post">
                            <input type="email" id="login_e-mail" placeholder="Ձեր էլ.փոստի հասցեն" required>
                            <input type="password" id="login_pwd" placeholder="Ձեր գաղտնաբառը" required>
                            <button id="next_login">Անցնել առաջ</button>
                        </form>
                    </div>
                </div>
            </div>
            <a href="" id="dont_sign">Դեռ գրանցվա՞ծ չեք</a>
            <img id="log_img" src="{{ asset('storage/images/register/Home _ Bravo Studio.jpg') }}" alt="">
        </div>

        <div id="signup_text">
            <img id="siglogo_img" src="{{ asset('storage/images/atenk/cow_red.png') }}" alt="logo">
            <div class="together2">
                <p class="p11">Բարև ձեզ!</p>
                <p class="p22">Ստեղծեք ձեր հաշիվը և սկսեք գնումը:</p>
            </div>
            <div class="forms">
                <div class="reg_sig_log">
                    <form id="signup_form" method="post">
                        <input type="text" id="sig_name" placeholder="Ձեր անունը" required>
                        <input type="text" id="sig_uid" placeholder="Օգտատիրոջ անունը" required>
                        <input type="email" id="sig_e-mail" placeholder="Ձեր էլ.փոստի հասցեն" required>
                        <input type="password" id="sig_pwd" placeholder="Ձեր գաղտնաբառը" required>
                        <input type="password" id="sig_conf" placeholder="Կրկնեք գաղտնաբառը" required>
                        <div class="gender_box">
                            <label><input type="radio" name="gender" value="male" required>Արական</label>
                            <label><input type="radio" name="gender" value="female">Իգական</label>
                        </div>
                        <button id="next_sig">Անցնել առաջ</button>
                    </form>
                </div>
            </div>
            <a href="" id="are_log">Դուք արդեն ունեք հաշիվ? Մուտք գործեք</a>
            <img id="sig_img"src="{{ asset('storage/images/register/Wild meat cuts Vol_2 - Food Photography - Kareem El Sabaa ✪.jpg') }}" alt="">
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite('resources/js/register.js')
</body>

</html>
