@extends('layouts.app')

@section('title', 'Տեսականի')

@php
    $loggedUserName = session('User', '');
    $isAdmin = ! empty(session('is_admin')) && (int) session('is_admin') === 1;
@endphp

@section('head')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.0.0/css/all.min.css') }}">
    @vite('resources/css/products.css')
    @if ($isAdmin)
    <style>
        .admin-fab {
            position: fixed; bottom: 28px; right: 28px; z-index: 9999;
            display: inline-flex; align-items: center; gap: 10px;
            padding: 12px 22px; border-radius: 30px;
            background: linear-gradient(135deg, #5a1414, #c63d3d);
            color: #fff !important; text-decoration: none; font-weight: 700;
            box-shadow: 0 8px 22px rgba(90, 20, 20, 0.45);
            transition: transform .25s ease, box-shadow .25s ease;
            letter-spacing: .5px;
        }
        .admin-fab:hover { transform: translateY(-3px) scale(1.03); box-shadow: 0 12px 28px rgba(90, 20, 20, 0.55); }
        .admin-fab i { font-size: 16px; color: #fff !important; }
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
    <img src="{{ asset('storage/images/products/Maestro of Food _ Food photos _ Food recipes Professional photos of Restaurant dishes from the chef.jpg') }}" width="100%" class="under_menuimg" alt="">

    @include('partials.header', [
        'showCartCount' => true,
        'userArea' => 'products-session',
    ])

    <div class="menu2">
        <ul>
            <li><a href="{{ route('products') }}" class="a">բոլորը</a></li>
            <li><a href="{{ route('products') }}?filter=Եփած Մսամթերք" class="a">Եփած Մսամթերք</a></li>
            <li><a href="{{ route('products') }}?filter=Ապխտած Մսամթերք" class="a">Ապխտած Մսամթերք</a></li>
            <li><a href="{{ route('products') }}?filter=Բաստուրմա,Սուջուխ" class="a">Բաստուրմա,Սուջուխ</a></li>
            <li><a href="{{ route('products') }}?filter=Նրբերշիկ և սարդելկա" class="a">Նրբերշիկ և սարդելկա</a></li>
            <li><a href="{{ route('products') }}?filter=Գարեջրի Նախուտեստներ" class="a">Գարեջրի Նախուտեստներ</a></li>
            <li><a href="{{ route('products') }}?filter=հավանածներ" class="a">Հավանածներ</a></li>
            <li><a href="{{ route('products') }}?filter=sale" class="a">Զեղչ</a></li>
        </ul>
    </div>

    <div class="search-container">
        <form method="get" action="{{ route('products') }}" class="search-form">
            <input type="text" class="search-input" name="search" value="{{ request()->query('search', '') }}" placeholder="Որոնում...">
            <button class="search-btn" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <main class="main-content">
        <div class="products-grid">
            @foreach ($products as $row)
                @php
                    $price = $row->price;
                    $sale = $row->sale;

                    $sale_price = ($sale > 0) ? $price - ($price * $sale / 100) : $price;
                    $raw_type = strtolower(trim($row->type ?? 'kg'));
                    $is_piece = in_array($raw_type, ['pice', 'piece', 'pcs', 'հատ'], true);
                    $card_unit = $is_piece ? 'piece' : 'kg';
                    $display_type = $is_piece ? 'հատ' : strtoupper(trim($row->type ?? 'KG'));
                @endphp
                <div class="product-card" data-price="{{ $sale_price }}" data-type="{{ $raw_type }}" data-unit="{{ $card_unit }}" data-category="{{ $row->category }}" data-brand="{{ $row->brand ?? '' }}">
                    <div class="card-accent"></div>

                    @if ($sale > 0)
                        <div class="sale-badge">-{{ $sale }}%</div>
                    @endif

                    <div class="img-box">
                        <img src="{{ $row->img ? asset('storage/'.$row->img) : asset('storage/images/products/Gemini_Generated_Image_o3plqyo3plqyo3pl.png') }}" alt="{{ $row->name }}">
                    </div>

                    <div class="info">
                        <h3>{{ $row->name }}</h3>
                        <h6>{{ $row->recept }}</h6>
                        <div class="price-container">
                            @if ($sale > 0)
                                <span class="old-price">{{ number_format($price, 0, '.', ',') }} ֏</span>
                            @endif
                            <span class="new-price">{{ number_format($sale_price, 0, '.', ',') }} ֏</span>
                        </div>
                    </div>

                    <div class="controls-container">
                        <div class="minus-col">
                            <button class="qty-btn" data-step="-1">-</button>
                            @if (! $is_piece)
                                <button class="qty-btn" data-step="-0.1">-</button>
                            @endif
                        </div>
                        <div class="weight-display">
                            <span class="weight-value" id="weight-text">0</span>
                            <span class="weight-unit">{{ $display_type }}</span>
                        </div>
                        <div class="plus-col">
                            <button class="qty-btn plus" data-step="1">+</button>
                            @if (! $is_piece)
                                <button class="qty-btn plus" data-step="0.1">+</button>
                            @endif
                        </div>
                    </div>

                    <div class="footer-card">
                        <div class="total-text">Ընդամենը: <span class="sum">0</span> ֏</div>
                        <i class="fa-{{ $row->liked == 1 ? 'solid' : 'regular' }} fa-heart heart-icon {{ $row->liked == 1 ? 'active' : '' }}" data-id="{{ $row->id }}"></i>
                        <i class="fa-solid fa-basket-shopping"></i>
                    </div>
                </div>
            @endforeach
            <div id="no-results" style="display: {{ count($products) > 0 ? 'none' : 'block' }}; grid-column: 1 / -1; text-align: center; padding: 40px;">
                <div class="pig_whi">
                    <img src="{{ asset('storage/images/products/Gemini_Generated_Image_o3plqyo3plqyo3pl.png') }}" width="94%" class="img_noyet">
                </div>
                <p class="chgtnvac">Այդպիսի ապրանք չի գտնվել</p>
            </div>

        </div>
    </main>

    @include('partials.footer')

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite('resources/js/products.js')
@endsection
