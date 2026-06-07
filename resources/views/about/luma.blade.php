@extends('layouts.app')

@section('title', 'Լումա')

@section('head')
    @vite('resources/css/luma.css')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.5.1/css/all.min.css') }}">
@endsection

@section('body')
    <img src="{{ asset('storage/images/atenk/mer1.jpg') }}" class="body_img" width="100%">

    @include('partials.header')

    <section class="luma_container">
        <div class="luma-container">
            <div class="luma-info">
                <div class="luma-top-line"></div>
                <span class="luma_littletext">Premium Meat Selection</span>
                <h2 class="luma-main-title">ԼՈՒՄԱ <span>ԱՐՏԱԴՐԱՄԱՍ</span></h2>

                <div class="luma-description-box">
                    <p class="luma-lead">Համ, որ միշտ մնում է հիշվող:</p>
                    <p class="luma-text">
                        «Լումա» մսամթերքի ընկերությունը հիմնադրվել է բնական հումքով և մաքուր տեխնոլոգիաներով շուկային
                        բարձրորակ մսամթերք առաջարկելու նպատակով։ Մենք ստեղծում ենք որակ, որը հիմնված է վստահության և
                        տեղական լավագույն ավանդույթների վրա։
                    </p>
                </div>

                <div class="luma-footer">
                    <div class="badge-line"></div>
                    <span>SINCE 1995</span>
                </div>
            </div>

            <div class="luma-visual">
                <div class="luma-img-wrapper">
                    <img src="{{ asset('storage/images/luma/լումա.jpg') }}" alt="Luma Production">
                    <div class="img-overlay-border"></div>
                </div>
            </div>
        </div>
    </section>

    <div class="paralex_section"></div>

    <div class="containerr">
        <div class="containerr_row">
            <div class="reveal-left">
                <span class="vault-tag">Տեխնոլոգիա և Որակ</span>
                <h2 class="vault-title">Պատասխանատու <br><span>Արտադրություն</span></h2>
                <div class="vault-divider"></div>
                <p class="vault-p">«Լումա» ընկերությունում մենք հավատում ենք, որ բարձր որակի մսամթերքը սկսվում է
                    պատասխանատու արտադրությունից։ Մեր արտադրամասերը համալրված են նոր սերնդի սարքավորումներով, որոնք
                    ապահովում են մաքուր և անվտանգ գործընթաց։</p>
                <div class="iso-certificates">
                    <div class="cert-box luxury"><span>ISO 22000</span></div>
                    <div class="cert-box luxury"><span>HACCP</span></div>
                </div>

            </div>
            <div class="reveal-right">
                <div class="vault-frame">
                    <img src="{{ asset('storage/images/luma/unnamed.jpg') }}" alt="Production Line">
                    <div class="frame-decoration"></div>
                </div>
            </div>
        </div>

        <div class=" containerr_row2">
            <div class="containerr_roww">
                <h3 class="our_join">Մեր Առաքելությունը</h3>
                <ul class="resors">
                    <li>
                        <span class="goal-num">01</span>
                        <div class="goal-content">
                            <h4>Որակի երաշխիք</h4>
                            <p>Ձեր սեղանին հայտնվի միայն թարմ, բնական և անվտանգ միս:</p>
                        </div>
                    </li>
                    <li>
                        <span class="goal-num">02</span>
                        <div class="goal-content">
                            <h4>Համայնքի զարգացում</h4>
                            <p>Աշխատատեղեր ստեղծվեն ու զարգանան տեղական համայնքները:</p>
                        </div>
                    </li>
                    <li>
                        <span class="goal-num">03</span>
                        <div class="goal-content">
                            <h4>Հայկական բրենդ</h4>
                            <p>Հայկական մսամթերքն արժանապատվությամբ ներկայանա աշխարհին:</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="containerr_row_img">
                <div>
                    <img src="{{ asset('storage/images/luma/Bratwurstseminar - Metzgerei Meyer.jpg') }}" alt="Quality Control">
                    <div class=""></div>
                </div>
            </div>
        </div>

        <div class="div2_uper">
            <div class="line_into"></div>
            <p>Մեր նպատակն է պահպանել ազգային համը և ամրապնդել հայկական արտադրանքի դիրքերը միջազգային շուկայում:</p>
            <div class="under_opaci">LUMA QUALITY</div>
        </div>
    </div>

    <div class="paralax_sectionn"></div>

    <section class="luma-final-reveal">
        <div class="reveal-wrapper">
            <h2 class="big-text-back">TRADITION</h2>

            <div class="reveal-container">
                <div class="reveal-image">
                    <img src="{{ asset('storage/images/luma/luma_end_logo2.jpg') }}" alt="Luma Quality">
                    <div class="reveal-overlay-text">
                        <span class="since">SINCE 1995</span>
                        <h3>ԼՈՒՄԱՆ ԻՍԿԱԿԱՆԸ ՀԱՅԿԱԿԱՆՆ Է</h3>
                        <div class="small-line"></div>
                    </div>
                </div>
            </div>

            <h2 class="big-text-front">QUALITY</h2>
        </div>
    </section>

    <div class="https://www.embed-map.com/">
        <div class="map_wrapper">
            <iframe
                src="https://www.google.com/maps?q=Հայաստան,+Կոտայքի+մարզ,+Աբովյան,+Է.+Պետրոսյան+փող.,+1/21+շենք&output=embed"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>

    @include('partials.footer')

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite('resources/js/luma.js')
@endsection
