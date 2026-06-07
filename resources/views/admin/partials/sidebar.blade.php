@php
    $currentPage = $currentPage ?? '';
@endphp
<aside class="side-bar">
    <div class="brand">
        <div class="brand-circle">ԱՂՆԵՆՔ</div>
        <div class="brand-sub">ընկերության</div>
    </div>

    <button class="nav-toggle" type="button" aria-label="Մենյու" aria-expanded="false">
        <span></span><span></span><span></span>
    </button>

    <nav class="side-nav">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $currentPage === 'dashboard' ? 'is-active' : '' }}">
            <i class="fa-solid fa-chart-line"></i>
            <span>Գլխավոր էջ</span>
        </a>
        <a href="{{ route('admin.warehouse') }}" class="nav-link {{ $currentPage === 'warehouse' ? 'is-active' : '' }}">
            <i class="fa-solid fa-warehouse"></i>
            <span>Պահեստի մատյան</span>
        </a>
        <a href="{{ route('admin.products') }}" class="nav-link {{ $currentPage === 'products' ? 'is-active' : '' }}">
            <i class="fa-solid fa-cubes"></i>
            <span>Ապրանքացուցակ</span>
        </a>
        <a href="{{ route('admin.brand', ['brand' => 'atenk']) }}" class="nav-link {{ $currentPage === 'brand_atenk' ? 'is-active' : '' }}">
            <i class="fa-solid fa-bacon"></i>
            <span>Աթենք</span>
        </a>
        <a href="{{ route('admin.brand', ['brand' => 'marila']) }}" class="nav-link {{ $currentPage === 'brand_marila' ? 'is-active' : '' }}">
            <i class="fa-solid fa-cheese"></i>
            <span>Մարիլա</span>
        </a>
        <a href="{{ route('admin.brand', ['brand' => 'luma']) }}" class="nav-link {{ $currentPage === 'brand_luma' ? 'is-active' : '' }}">
            <i class="fa-solid fa-droplet"></i>
            <span>Լումա</span>
        </a>
        <a href="{{ route('admin.products.add') }}" class="nav-link {{ $currentPage === 'add' ? 'is-active' : '' }}">
            <i class="fa-solid fa-cart-plus"></i>
            <span>Ապրանքի Մուտքագրում</span>
        </a>
    </nav>

    <div class="side-decor">
        <img src="{{ asset('storage/images/admin/Колбаса.jpg') }}" alt="" class="decor-img decor-1">
        <img src="{{ asset('storage/images/admin/Колбаса.jpg') }}" alt="" class="decor-img decor-2">
        <img src="{{ asset('storage/images/admin/Колбаса.jpg') }}" alt="" class="decor-img decor-3">
        <img src="{{ asset('storage/images/admin/Колбаса.jpg') }}" alt="" class="decor-img decor-4">
    </div>

    <a href="#" class="logout-link"
       onclick="event.preventDefault();document.getElementById('admin-logout-form').submit();">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Ելք Համակարգից</span>
    </a>
    <form method="POST" action="{{ route('admin.logout') }}" id="admin-logout-form" style="display:none;">@csrf</form>

    <script>
        (function () {
            var bar = document.querySelector('.side-bar');
            var toggle = bar.querySelector('.nav-toggle');
            if (!toggle) return;
            toggle.addEventListener('click', function () {
                var open = bar.classList.toggle('nav-open');
                toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            });
        })();
    </script>
</aside>
