@extends('layouts.app')

@section('title', 'Մարիլա')

@section('head')
    @vite('resources/css/marila.css')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.5.1/css/all.min.css') }}">
@endsection

@section('body')
    <img src="{{ asset('storage/images/atenk/mer1.jpg') }}" class="body_img" width="100%">

    @include('partials.header')

    <div class="main_container">
        <div class="premium_wrapper">
            <div class="content_box">
                <span class="brand_label">ESTABLISHED QUALITY</span>
                <h3 class="title">Մարիլա</h3>
                <p class="slogan">Լավագույնը ձեր սեղանին</p>

                <p class="desc_text">
                    «Մարիլա» մսամթերքի ընկերությունը ստեղծվել է՝ առաջարկելու թարմ, անվտանգ և բարձրորակ մսամթերք։
                    Սկսելով փոքր արտադրամասից՝ ընկերությունը արագ զարգացավ՝ ներդնելով ժամանակակից սարքավորումներ
                </p>
                <p class="dess_text">
                    Այսօր «Մարիլա»-ն համարվում է վստահելի բրենդ՝ իր մաքրությամբ, համով և կայուն որակով։
                </p>
            </div>
            <div class="image_box">
                <div class="image_overlay_line"></div>
                <img src="{{ asset('storage/images/marila/g9HP8Z1G5b1saUDxPM9RZVcL1QSRdlGrYnh4B1M1.webp') }}" width="100%" alt="Marila">
            </div>
        </div>
    </div>

    <div class="paralex_container"></div>

    <div class="container_lerg">
        <div class="lerg_con">
            <span class="small_exs">մեր խոսքը</span>
            <p class="our_txe">
                «Մարիլա» ընկերությունում մենք միշտ վստահ ենք, որ իսկական <strong
                    style="color: #881e1e; border-bottom: solid 1px #881e1e;">որակը</strong> սկսվում է
                <strong style="color: #881e1e; border-bottom: solid 1px #881e1e;">պատասխանատվությամբ</strong> և ճիշտ
                կազմակերպված արտադրությամբ։
            </p>

            <div class="decoration">
                <div class="line"></div>
                <div class="bol"></div>
                <div class="line_"></div>
            </div>
        </div>

        <div class="texnology">
            <div class="tex_colum">
                <div class="img_contain">
                    <img src="{{ asset('storage/images/marila/Produção BeefPassion.jpg') }}" width="100%">
                    <p>technology 2024</p>
                </div>
                <div class="text">
                    <h1>ISO & HACCP</h1>
                    <p class="diftitle">Certified</p>
                    <p class="all_text">
                        Մեր արտադրական համալիրները աշխատում են արդիական տեխնոլոգիաներով, որոնք ապահովում են բարձր
                        մաքրություն և անվտանգությունը։
                    </p>
                    <div class="clining">Մաքրություն</div>
                    <div class="politic">Անվտանքություն</div>
                </div>
            </div>
        </div>

        <div class="quest">
            <div class="qvart1" id="qvart1">
                <p>01</p>
                <h4>Թարմություն</h4>
                <h6>Մաքուր և վստահելի մսամթերք ձեր ընտանիքի համար</h6>
            </div>
            <div class="qvart1" id="qvart2">
                <p>02</p>
                <h4>Զարգացում</h4>
                <h6>Աջակցություն տեղական համայնքների կայուն աճին</h6>
            </div>
            <div class="qvart1" id="qvart3">
                <p>03</p>
                <h4>Շուկա</h4>
                <h6>Հաստատուն դիրք արտահանման միջազգային շուկայում</h6>
            </div>
        </div>

        <div class="dicrat_img">
            <img src="{{ asset('storage/images/marila/5217633023052945140.jpg') }}" width="100%" alt="Marila">
        </div>
        <div class="in_img">
            <p>«Մարիլա»-ն հետևում է պատասխանատու արտադրության սկզբունքներին՝
                կիրառելով էներգիաարդյունավետ տեխնոլոգիաներ:</p>
        </div>
    </div>

    <div class="paralex_selector"></div>

    <section class="quality_standards">
        <div class="philosophy_wrapper">
            <div class="philo_left">
                <div class="sticky_content">
                    <span class="philo_tag">Since 2010</span>
                    <h2 class="philo_title">ՄԱՐԻԼԱ<br><span>ԱՆՍԱՀՄԱՆ</span><br>ՈՐԱԿ</h2>
                    <div class="philo_line"></div>
                    <p class="philo_lead">Մենք սահմանում ենք նոր ստանդարտներ մսամթերքի արտադրության մեջ՝ համադրելով
                        ավանդական հայկական համն ու ժամանակակից տեխնոլոգիաները։</p>
                </div>
            </div>

            <div class="philo_right">
                <div class="philo_card card_top">
                    <div class="card_inner">
                        <span class="c_num">01</span>
                        <h4>Էկոլոգիական Մաքրություն</h4>
                        <p>Մեր կենդանիները սնվում են բացառապես բնական կերով Սյունիքի բարձրադիր արոտավայրերում:</p>
                    </div>
                </div>

                <div class="philo_card card_mid">
                    <div class="card_inner">
                        <span class="c_num">02</span>
                        <h4>Գիտական Մոտեցում</h4>
                        <p>Յուրաքանչյուր բաղադրատոմս մշակվում է լաբորատոր ճշգրտությամբ՝ պահպանելով մսի օգտակար
                            հատկությունները:</p>
                    </div>
                </div>

                <div class="philo_card card_bottom">
                    <div class="card_inner">
                        <span class="c_num">03</span>
                        <h4>Պրեմիում Փաթեթավորում</h4>
                        <p>Ժամանակակից վակուումային համակարգերը երաշխավորում են թարմությունը մինչև ձեր սեղան հասնելը:
                        </p>
                    </div>
                </div>

                <div class="https://www.embed-map.com/">
                    <div class="map_wrapper">
                        <iframe
                            src="https://www.google.com/maps?q=Armenia,+Kotayk+Marz,+Masiv+village,+1st+St.+6th+Blind+Alley,+6+Land+Lot&output=embed"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="standards_inner">
            <div class="standard_card">
                <div class="icon_wrap">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <h5>100% Բնական</h5>
                <p>Մեր արտադրանքը չի պարունակում արհեստական հավելումներ և սոյա:</p>
                <div class="card_line"></div>
            </div>

            <div class="standard_card">
                <div class="icon_wrap">
                    <i class="fa-solid fa-microscope"></i>
                </div>
                <h5>Լաբորատոր Ստուգում</h5>
                <p>Յուրաքանչյուր խմբաքանակ անցնում է խիստ բազմափուլ ստուգում:</p>
                <div class="card_line"></div>
            </div>

            <div class="standard_card">
                <div class="icon_wrap">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <h5>Թարմ Մատակարարում</h5>
                <p>Արտադրամասից ուղիղ դեպի վաճառակետեր՝ առավելագույն թարմությամբ:</p>
                <div class="card_line"></div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite('resources/js/marila.js')
@endsection
