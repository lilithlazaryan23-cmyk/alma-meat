@extends('layouts.app')

@section('title', 'Գլխավոր')

@php
    $isAdmin = ! empty(session('is_admin')) && (int) session('is_admin') === 1;
@endphp

@section('head')
    @vite('resources/css/main.css')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.5.1/css/all.min.css') }}">
    @if ($isAdmin)
    <style>
        .admin-fab {
            position: fixed; bottom: 28px; right: 28px; z-index: 9999;
            display: inline-flex; align-items: center; gap: 10px;
            padding: 12px 22px; border-radius: 30px;
            background: linear-gradient(135deg, #5a1414, #c63d3d);
            color: #fff; text-decoration: none; font-weight: 700;
            box-shadow: 0 8px 22px rgba(90, 20, 20, 0.45);
            transition: transform .25s ease, box-shadow .25s ease;
            letter-spacing: .5px;
        }
        .admin-fab:hover { transform: translateY(-3px) scale(1.03); box-shadow: 0 12px 28px rgba(90, 20, 20, 0.55); }
        .admin-fab i { font-size: 16px; }
    </style>
    @endif
@endsection

@section('body')
    @if ($isAdmin)
        <a href="{{ route('admin.dashboard') }}" class="admin-fab" title="Անցնել ադմին վահանակ">
            <i class="fa-solid fa-gauge-high"></i>
            <span>Ադմին Վահանակ</span>
        </a>
    @endif
    <div class="hero-section" id="hero">
        <img src="{{ asset('storage/images/main/Online-Butcher-UK-_-Meatsupermarket.webp') }}" alt="Մսամթերքի նկար" class="hero-bg-img"
            width="100%">
        <div class="hero-ov"></div>
        <div class="hero-content">
            <h1>Բարի գալուստ ԱԼՄԱ Մսամթերք</h1>
            <p>Ամենաթարմ ու որակյալ մսամթերքը ձեր սեղանին</p>
        </div>
    </div>

    @include('partials.header', ['cartOnclick' => false, 'userArea' => 'plain'])

    <section class="mission-section" id="mission">
        <div class="mission-logos">
            <img src="{{ asset('storage/images/main/atenk.png') }}" class="brand-logo" alt="atenk">
            <img src="{{ asset('storage/images/main/luma.jpg') }}" class="brand-logo" alt="luma">
            <img src="{{ asset('storage/images/main/marila.png') }}" class="brand-logo" alt="marila">
        </div>

        <div class="mission-container">
            <div class="mission-content">
                <span class="sub-title">Մեր ինքնությունը</span>
                <h2 class="mission-title">Մեր <span>առաքելությունը</span></h2>
                <div class="mission-line"></div>

                <div class="mission-text">
                    <p>«Աթենք», «Միլան» և «Լուման» ընկերությունները միավորվել են՝ ստեղծելու համատեղ նախաձեռնություն, որի
                        նպատակն է զարգացնել հայկական արտադրությունը։</p>
                    <p>Մեր առաքելությունն է՝ ապահովել սպառողին <strong style="color: #99a7a8;">առողջ, բնական և
                            անվտանգ</strong> մսամթերքով՝
                        պահպանելով ավանդույթներն ու նորարարությունը։</p>
                </div>
            </div>

            <div class="mission-visual">
                <div class="image-stack">
                    <img class="main-img"
                        src="{{ asset('storage/images/main/Wär ich ein Schinken, träumt ich vom Lufttrocknen in Südtirol!.jpg') }}"
                        alt="All Brands">
                    <div class="hero-overlay"></div>
                    <div class="experience-badge">
                        <span>25+</span>
                        <p>Տարիների փորձ</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="vstahel" id="trust">
        <h2 class="main-title">Ինչու՞ վստահել մեզ</h2>
        <div class="accordion-container">

            <div class="acc-card active" style="--bg-image: url('{{ asset('storage/images/main/atenkg.jpg') }}');">
                <div class="acc-overlay"></div>
                <div class="acc-content">
                    <div class="acc-icon"><i class="fa-solid fa-award"></i></div>
                    <div class="acc-text">
                        <h3>Աթենք</h3>
                        <p>Շուկայի առաջատար և 5-ակի «Սպառողի ընտրություն» մրցանակակիր։</p>
                        <ul class="acc-list">
                            <li>Տարվա մսամթերք 2023</li>
                            <li>100 խոշոր հարկատու</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="acc-card" style="--bg-image: url('{{ asset('storage/images/main/lumag.jpg') }}');">
                <div class="acc-overlay"></div>
                <div class="acc-content">
                    <div class="acc-icon"><i class="fa-solid fa-lightbulb"></i></div>
                    <div class="acc-text">
                        <h3>Լումա</h3>
                        <p>Նորարարական կաթնամթերքի արտադրություն և կայուն զարգացում։</p>
                        <ul class="acc-list">
                            <li>Նորարար արտադրանք 2021</li>
                            <li>Սպառողի վստահություն 2023</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="acc-card" style="--bg-image: url('{{ asset('storage/images/main/marilag.jpg') }}');">
                <div class="acc-overlay"></div>
                <div class="acc-content">
                    <div class="acc-icon"><i class="fa-solid fa-leaf"></i></div>
                    <div class="acc-text">
                        <h3>Մարիլա</h3>
                        <p>Բնական հումքով պատրաստված բարձրակարգ կաթնամթերք և պանիրներ։</p>
                        <ul class="acc-list">
                            <li>Լավագույն պանիր արտադրող 2022</li>
                            <li>Որակի երաշխիք</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="masser" id="products">
        <div class="min_masser">
            <div class="every">յուրաքանչյուր հատվածում</div>
            <div class="bnakan">Բնական միս</div>
            <div class="ham">կատարյալ համ </div>
            <div class="connector-line1"></div>
            <div class="connector-line"></div>
            <div class="remember">Համ, որ հիշվում է</div>
            <div class="vertical-line"></div>
        </div>
        <img src="{{ asset('storage/images/main/ChatGPT Image Nov 6, 2025, 02_17_50 AM.png') }}" width="30%" class="cow" alt="cow">
        <img src="{{ asset('storage/images/main/ChatGPT Image Nov 6, 2025, 02_32_34 AM.png') }}" width="27%" class="pig" alt="pig">
    </div>

    <section class="mega_reviews" id="reviews">
        <div class="reviews_header">
            <h2 class="mega_title">ՄԵՐ ՀԱՃԱԽՈՐԴՆԵՐԻ ՁԱՅՆԸ</h2>
        </div>

        <div class="marquee_wrapper">
            <div class="marquee_row scroll_left">
                <div class="marquee_content">
                    <div class="m_card">
                        <p>"Միշտ թարմ ու որակով։"</p>
                        <span class="m_author">Ani G.</span>
                    </div>
                    <div class="m_card">
                        <p>"Լավագույն բաստուրման Հայաստանում։"</p>
                        <span class="m_author">Karen S.</span>
                    </div>

                    <div class="m_card">
                        <p>"Սպասարկումը և որակը՝ անթերի։"</p>
                        <span class="m_author">Lilit M.</span>
                    </div>
                    <div class="m_card">
                        <p>"յուրահատուկ համ մեր սեղանի համար"</p>
                        <span class="m_author">Karine A.</span>
                    </div>
                </div>
            </div>

            <div class="marquee_row scroll_right">
                <div class="marquee_content">
                    <div class="m_card">
                        <p>"Անփոխարինելի համ սերունդների համար։"</p>
                        <span class="m_author">Suren V.</span>
                    </div>
                    <div class="m_card">
                        <p>"աննկարագրելի համային խառնուրդներ"</p>
                        <span class="m_author">Astxik M.</span>
                    </div>
                    <div class="m_card">
                        <p>"Սպասարկումը և որակը՝ անթերի։"</p>
                        <span class="m_author">Liana M.</span>
                    </div>
                    <div class="m_card">
                        <p>"ամենահամեղ և անվտանգը"</p>
                        <span class="m_author">Armine V.</span>
                    </div>
                    <div class="m_card">
                        <p>"շնորհակալություն անվնաս և համեղ սնունդի համար"</p>
                        <span class="m_author">Olya K.</span>
                    </div>
                    <div class="m_card">
                        <p>"Հիանալի պրոդուկտ որը սիրով է օգտագործվում"</p>
                        <span class="m_author">Manan M.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="call" class="contact-section-premium">
        <div class="contact-column">
            <div class="col-content-wrapper">
                <div class="side-text">
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <span class="col-tag">Գրեք մեզ</span>
                    <h2>ՀԱՄԱԳՈՐԾԱԿՑՈՒԹՅՈՒՆ</h2>
                    <p>Մենք միշտ բաց ենք նոր առաջարկների և ստեղծագործական գաղափարների համար:</p>
                    <a href="mailto:lilithlazaryan23@gmail.com" class="col-link">lilithlazaryan23@gmail.com</a>
                </div>
            </div>
        </div>

        <div class="contact-column alt-bg">
            <div class="col-content-wrapper">
                <div class="side-text">
                    <i class="fa-solid fa-headset"></i>

                    <span class="col-tag">Զանգահարեք</span>
                    <h2>ԱՆՄԻՋԱԿԱՆ ԿԱՊ</h2>
                    <p>Մեր մասնագետները պատրաստ են պատասխանել Ձեր յուրաքանչյուր հարցին:</p>
                    <a href="tel:+37493470995" class="col-link">+374 93 470 995</a>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite('resources/js/main.js')
@endsection
