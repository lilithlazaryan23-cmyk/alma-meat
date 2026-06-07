@extends('layouts.app')

@section('title', 'Աթենք')

@section('head')
    @vite('resources/css/atenk.css')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.5.1/css/all.min.css') }}">
@endsection

@section('body')
    <img src="{{ asset('storage/images/atenk/mer1.jpg') }}" class="body_img" width="100%">

    @include('partials.header')

    <section class="about-atenq">
        <div class="innovative_wrapper">
            <div class="inno_left">
                <h2 class="inno_big_title">1993-ից <br>մինչև <span>Այսօր</span></h2>
                <p class="inno_main_p">
                    «Աթենք Մսամթերք» ընկերությունը սկսել է իր ուղին ընդամենը 3 տեսակի երշիկից։
                    Այսօր մենք ձևավորում ենք հայկական շուկայի որակի ստանդարտները՝ օգտագործելով լավագույն եվրոպական
                    տեխնոլոգիաները։
                </p>

                <div class="vertical_stats">
                    <div class="v_stat_item">
                        <div class="v_line"></div>
                        <div class="v_content">
                            <span class="v_num" id="d32">32</span>
                            <span class="v_label">Տարի փորձառություն</span>
                        </div>
                    </div>
                    <div class="v_stat_item">
                        <div class="v_line"></div>
                        <div class="v_content">
                            <span class="v_num" id="d120">120տ</span>
                            <span class="v_label">Օրական հզորություն</span>
                        </div>
                    </div>
                    <div class="v_stat_item">
                        <div class="v_line"></div>
                        <div class="v_content">
                            <span class="v_num" id="d150">150+</span>
                            <span class="v_label">Տեսականու ընտրանի</span>
                        </div>
                    </div>
                </div>
                <div class="inno_image_holder">
                    <img src="{{ asset('storage/images/atenk/atenq.jpg') }}" alt="Աթենք Գործարան">
                    <div class="image_stamp">SINCE 1993</div>
                </div>
            </div>

        </div>
    </section>

    <div class="parallax-section"></div>

    <section class="containerr">
        <div class="organic_wrapper">
            <div class="organic_text">
                <div class="text_reveal">
                    <span class="org_tag">Մեր խոսքը</span>
                    <h2 class="org_title">Արտադրություն, որտեղ <br> <span>սիրտ է դրված</span></h2>
                </div>

                <div class="org_desc_wrapper">
                    <p class="org_p">Մենք ձգտում ենք, որ հայկական ավանդական համը միավորվի աշխարհի առաջատար
                        տեխնոլոգիաների հետ։ Գործարանները համալրված են Եվրոպայի սարքավորումներով։</p>
                    <p class="org_p_accent">2025-ին բացված հզոր համալիրն այսօր Հայաստանի ամենաարդիական արտադրամասերից է։
                    </p>
                </div>
            </div>

            <div class="video_blob_frame">
                <div class="blo_bg"></div>
                <iframe src="https://www.youtube.com/embed/Osj9U0cI97M?controls=0&modestbranding=1" frameborder="0"
                    allowfullscreen></iframe>
                <div class="blob_bg"></div>
            </div>
        </div>

        <div class="we_work_container">
            <div class="we_content">
                <div class="we_header_box">
                    <span class="we_subtitle">Մեր Առաքելությունը</span>
                    <h2 class="we_title">Մենք աշխատում ենք, <span>որ.</span></h2>
                </div>

                <ul class="we_list_custom">
                    <li>
                        <span class="li_num">01</span>
                        <p>Ձեր սեղանին հայտնվի միայն բնական և թարմ մսամթերք</p>
                    </li>
                    <li>
                        <span class="li_num">02</span>
                        <p>Հայաստանում ավելանան կայուն ու բարձր վարձատրվող աշխատատեղեր</p>
                    </li>
                    <li>
                        <span class="li_num">03</span>
                        <p>Հայկական համը ճանաչելի դառնա ողջ արտերկրում</p>
                    </li>
                </ul>
            </div>
            <div class="we_img_wrapper">
                <div class="img_overlay_accent"></div>
                <img src="{{ asset('storage/images/atenk/atenq,team.jpg') }}" alt="team" class="team_img_premium">
            </div>
        </div>

        <div class="eco_inner">
            <div class="eco_visual_aside">
                <div class="vertical_label">EST. 1993</div>
                <div class="luxury_separator"></div>
            </div>

            <div class="eco_main_content">
                <h2 class="eco_title_minimal">
                    Կանաչ ապագայի <span>արահետով</span>
                </h2>

                <div class="eco_description_grid">
                    <p class="p_lead">
                        «Աթենք»-ը քայլում է կանաչ ապագայի ուղով․ գործում է <strong>150 կՎտ</strong> արևային կայան,
                        որը տարեկան շուրջ <strong>85 տոննա</strong> պակաս ածխածին է արտանետում։
                    </p>
                    <p class="p_secondary">
                        Մեր համար ամենամեծ գնահատականը ձեր վստահությունն է։ Մենք հավատարիմ ենք խոստմանը՝
                        մատուցել միայն թարմ, առողջ և համեղ մսամթերք՝ ամեն անգամ առաքելով այն սիրով։
                    </p>
                </div>
            </div>
        </div>

        <div class="cel">
            <div class="luxury_header">
                <h2 class="mer_ynker">Գլխավոր Նպատակները</h2>
                <div class="luxury_line"></div>
            </div>

            <div class="goals_creative_grid">
                <div class="goal_item" data-number="01">
                    <div class="goal_backdrop">01</div>
                    <div class="goal_main">
                        <p>Միայն բարձրորակ և բնական մսամթերք</p>
                        <div class="goal_dot"></div>
                    </div>
                </div>

                <div class="goal_item" data-number="02">
                    <div class="goal_backdrop">02</div>
                    <div class="goal_main">
                        <p>Հայկական համը՝ աշխարհին</p>
                        <div class="goal_dot"></div>
                    </div>
                </div>

                <div class="goal_item" data-number="03">
                    <div class="goal_backdrop">03</div>
                    <div class="goal_main">
                        <p>Ավելի շատ աշխատատեղեր Հայաստանում</p>
                        <div class="goal_dot"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="parallax_section"></div>

    <div class="main_prod">
        <div class="expo_container">
            <div class="expo_left">
                <span class="expo_tag">Premium Selection</span>
                <h2 class="expo_title">Անմահական <br><span>Համի Ժառանգություն</span></h2>
                <p class="expo_p">Յուրաքանչյուր կտոր պատմում է մի պատմություն, որտեղ միախառնվում են հայկական
                    ավանդույթներն ու բարձրագույն որակը։</p>
                <a href="{{ route('products') }}" class="expo_cta">Բացահայտել ողջ տեսականին</a>
            </div>

            <div class="expo_right">
                <div class="floating_card">
                    <div class="glass_effect"></div>
                    <img src="{{ asset('storage/images/atenk/Roger Stowell.jpg') }}" alt="Atenq Product" class="product_hero_img">
                    <div class="product_info_overlay">
                        <span class="price_tag">1,650 AMD</span>
                        <h4>Աթենք Կոնյակով</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <section class="minimal_heritage">
        <div class="heritage_wrapper">
            <div class="heritage_line"></div>
            <div class="heritage_content">
                <span class="heritage_subtitle">Մեր Արժեքները</span>
                <h2 class="heritage_title">ՈՐԱԿԸ ՉԻ ՓՈԽՎՈՒՄ</h2>
                <p class="heritage_desc">
                    Ավելի քան 30 տարի մենք ստեղծում ենք համ, որը դարձել է հայկական ընտանիքների անբաժան մասը։
                    Մեր գույնը մեր պատմությունն է։
                </p>
                <div class="heritage_badge">
                    <svg viewBox="0 0 100 100" class="badge_svg">
                        <path id="circlePath" d="M 50, 50 m -40, 0 a 40,40 0 1,1 80,0 a 40,40 0 1,1 -80,0"
                            fill="none" />
                        <text>
                            <textPath xlink:href="#circlePath">
                                PREMIUM QUALITY • ARMENIAN HERITAGE • SINCE 1993 •
                            </textPath>
                        </text>
                    </svg>
                    <div class="badge_center">A</div>
                </div>
            </div>
            <div class="heritage_line"></div>
        </div>

        <div class="https://www.embed-map.com/">
            <div class="map_wrapper">
                <iframe
                    src="https://www.google.com/maps?q=Armenia,+Kotayk+Marz,+Getamej+village,+1st+St.+6th+Blind+Alley,+6+Land+Lot&output=embed"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite('resources/js/atenk.js')
@endsection
