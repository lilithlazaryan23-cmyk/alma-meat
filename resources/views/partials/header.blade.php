@php
    $logo = $logo ?? 'storage/images/main/Gemini_Generated_Image_czs168czs168czs1.png';
    $cartOnclick = $cartOnclick ?? true;
    $showCartCount = $showCartCount ?? false;
    $userArea = $userArea ?? 'register-onclick';
@endphp
<header class="menu" id="menu">
    <img src="{{ asset($logo) }}" id="logoo" alt="logo">

    <ul class="texts" id="texts">
        <li><a href="{{ route('home') }}" id="glxavor">Գլխավոր</a></li>
        <li>
            <a href="" id="mer_masin">Մեր մասին</a>

            <div id="mer_masin_open">
                <a href="{{ route('about.atenk') }}" class="open_curor">«Աթենք»</a>
                <a href="{{ route('about.luma') }}" class="open_curor">«Լումա»</a>
                <a href="{{ route('about.marila') }}" class="open_curor">«Մարիլա»</a>
            </div>
        </li>
        <li><a href="{{ route('products') }}" id="tesakani">տեսականի</a></li>
        <li><a href="{{ route('recipes') }}" id="baxadratoms">բաղադրատոմս</a></li>
        <li><a href="{{ route('home') }}#call" id="kap">կապ</a></li>
    </ul>

    <button class="button" id="button_buy" type="button"
        @if ($cartOnclick) onclick="window.location.href='{{ route('cart') }}';" @endif>
        <i class="fa-solid fa-cart-shopping"></i>
        <p id="buy_now">Զամբյուղ</p>
        @if ($showCartCount)
        <span id="cart-count" class="cart-count" style="display: none;">0</span>
        @endif
    </button>
    @if ($showCartCount)
    <a href="#" id="return-to-section" class="continue-btn" style="display:none; margin-left: 12px;">
        <i class="fas fa-arrow-left"></i> Վերադառնալ բաժին
    </a>
    @endif

    <button class="nav-toggle" type="button" aria-label="Մենյու" aria-expanded="false">
        <span></span><span></span><span></span>
    </button>

    @if ($userArea === 'products-session')
        @if (! empty(session('User')))
            <div class="user-info" id="user-info">
                <span class="user-name">{{ session('User') }}</span>
                <a href="#" class="logout-btn" id="logout-btn" title="Դուրս գալ"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
        @else
            <i class="fa-regular fa-user" id="fa-user"></i>
        @endif
    @elseif ($userArea === 'logout-onclick')
        <i class="fa-regular fa-user" id="fa-user" title="Ելք"
           onclick="document.getElementById('logout-form').submit();"></i>
        <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">@csrf</form>
    @elseif ($userArea === 'register-onclick')
        <i class="fa-regular fa-user" id="fa-user" onclick="window.location.href='{{ route('register') }}'"></i>
    @else
        <i class="fa-regular fa-user" id="fa-user"></i>
    @endif
    <div class="hr"></div>

    <script>
        (function () {
            var menu = document.getElementById('menu');
            var toggle = menu.querySelector('.nav-toggle');
            if (!toggle) return;
            toggle.addEventListener('click', function (e) {
                e.stopPropagation();
                var open = menu.classList.toggle('nav-open');
                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            });
            menu.querySelectorAll('.texts a').forEach(function (a) {
                a.addEventListener('click', function () {
                    if (a.id === 'mer_masin') return;
                    menu.classList.remove('nav-open');
                    toggle.setAttribute('aria-expanded', 'false');
                });
            });
        })();
    </script>
</header>
