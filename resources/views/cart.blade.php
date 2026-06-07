@extends('layouts.app')

@section('title', 'Զամբյուղ - ԱԼՄԱ Մսամթերք')

@section('head')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.5.1/css/all.min.css') }}">
    @vite('resources/css/cart.css')
@endsection

@section('body')
    <img src="{{ asset('storage/images/products/back_img.jpg') }}" width="100%" class="under_menuimg" alt="">

    @include('partials.header', ['userArea' => 'logout-onclick'])

    <main class="cart-page">
        <section class="cart-section">
            <div class="cart-content">
                <div class="cart-items-panel">
                    <div class="cart-panel-header">
                        <h1>Ձեր զամբյուղը</h1>
                        <p id="cart-summary-text">Ձեր ընտրած բոլոր ապրանքները</p>
                    </div>
                    <div id="empty-cart" class="empty-cart">
                        <i class="fa-solid fa-shopping-cart"></i>
                        <h2>Զամբյուղը դատարկ է</h2>
                        <p>Ավելացրեք ապրանքներ, որպեսզի տեսնեք նրանց այստեղ։</p>
                        <a href="{{ route('products') }}" class="continue-btn">Շարունակել գնումը</a>
                    </div>
                    <div id="cart-items-list" class="cart-items-list"></div>
                </div>

                <aside class="order-summary">
                    <div class="summary-card">
                        <h2>Պատվերի ամփոփում</h2>
                        <div class="summary-row">
                            <span>Ենթավճար</span>
                            <span id="subtotal">0֏</span>
                        </div>
                        <div class="summary-row">
                            <span>Հարկ (10%)</span>
                            <span id="tax-amount">0֏</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-row total-row">
                            <span>Ընդհանուր</span>
                            <span id="total-price">0֏</span>
                        </div>
                        <button id="checkout-btn" class="checkout-btn">
                            <i class="fas fa-credit-card"></i> Պատվեր ուղարկել
                        </button>
                        <a href="{{ route('products') }}" class="continue-btn continue-shopping-btn">
                            <i class="fas fa-arrow-left"></i> Շարունակել գնումը
                        </a>
                    </div>
                </aside>
            </div>
        </section>
    </main>

    @include('partials.footer')

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite('resources/js/cart.js')
@endsection
