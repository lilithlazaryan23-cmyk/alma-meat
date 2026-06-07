@extends('layouts.app')

@section('title', 'Բարի Գալուստ — Աղնենք')

@section('head')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.0.0/css/all.min.css') }}">
    @vite('resources/css/admin.css')
@endsection

@php
    $formatMoneyShort = function ($v) {
        if ($v >= 1000000) return round($v / 1000000, 1).' մլն';
        if ($v >= 1000)    return round($v / 1000,    1).' հզր';
        return number_format($v, 0, '.', ',').' ֏';
    };
@endphp

@section('body')
<div class="app-shell">
    @include('admin.partials.sidebar', ['currentPage' => 'dashboard'])

    <main class="main">
        <div class="page-head">
            <div>
                <div class="page-title">Բարի Գալուստ</div>
                <div class="dashboard-date">{{ $todayLabel }}</div>
            </div>
            <div style="display:flex;align-items:center;gap:14px;">
                <a href="{{ route('home') }}" class="btn-primary" style="padding:10px 18px;font-size:13px;">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    Վերադառնալ կայք
                </a>
                <img src="{{ asset('storage/images/main/Gemini_Generated_Image_czs168czs168czs1.png') }}"
                     alt="logo" style="width:60px;height:60px;border-radius:50%;box-shadow:0 4px 12px rgba(90,20,20,.35);">
            </div>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-cubes"></i></div>
                <div class="stat-meta">
                    <span class="stat-label">Ընդհանուր Տեսականի</span>
                    <span class="stat-value">{{ $totalAssortment }}</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-percent"></i></div>
                <div class="stat-meta">
                    <span class="stat-label">Զեղչեր</span>
                    <span class="stat-value">{{ $salesCount }}</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-truck-ramp-box"></i></div>
                <div class="stat-meta">
                    <span class="stat-label">Օրվա Պատվերներ</span>
                    <span class="stat-value">{{ $dailyOrders }}</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-bolt"></i></div>
                <div class="stat-meta">
                    <span class="stat-label">Քիչ քանակությամբ ապրանքներ</span>
                    <span class="stat-value">{{ $lowStockCount }}</span>
                </div>
            </div>
        </div>

        <div class="stat-grid" style="grid-template-columns: 1fr;">
            <div class="stat-card month-card" style="max-width:320px;">
                <div class="stat-icon"><i class="fa-solid fa-tags"></i></div>
                <div class="stat-meta">
                    <span class="stat-label">Այս Ամսվա Վաճառք</span>
                    <span class="stat-value">{{ $formatMoneyShort($monthlyRevenue) }}</span>
                </div>
            </div>
        </div>

        <div class="panel logistics-section">
            <h3>Լոգիստիկայի Վերահսկում</h3>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Անվանում</th>
                        <th>Քանակ</th>
                        <th>Որտեղ/արդյունքից</th>
                        <th>Վիճակ</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($logistics as $row)
                    @php
                        $statusMap = [
                            'pending'   => ['pill-warn', 'Սպասում է'],
                            'shipped'   => ['pill-good', 'Ուղարկված'],
                            'delivered' => ['pill-good', 'Հանձնված'],
                            'cancelled' => ['pill-bad',  'Չեղարկված'],
                        ];
                        $st = $statusMap[$row->status] ?? ['pill-warn', 'Անհայտ'];
                    @endphp
                    <tr>
                        <td>{{ $row->name ?? '-' }}</td>
                        <td class="mute-cell">{{ $row->qty }} {{ $row->type ?? '' }}</td>
                        <td class="price-cell">{{ number_format($row->total_price, 0, '.', ',') }} ֏</td>
                        <td><span class="pill {{ $st[0] }}">{{ $st[1] }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td class="mute-cell" colspan="4" style="text-align:center;padding:24px;">Դեռ պատվերներ չկան</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="panel products-section">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:12px;">
                <h3>Ապրանքացուցակ</h3>
                <div style="display:flex;gap:8px;align-items:center;">
                    <select id="brandFilter" style="padding:8px;border-radius:8px;border:1px solid #d8c6c5;">
                        <option value="">Բոլոր բրենդները</option>
                        <option value="Atenk">Atenk</option>
                        <option value="Marila">Marila</option>
                        <option value="Luma">Luma</option>
                    </select>
                    <input id="searchBox" placeholder="Փնտրել ապրանքը..." style="padding:8px 12px;border-radius:8px;border:1px solid #e0d3d2;min-width:260px;">
                    <button id="openAddProduct" class="btn-primary" style="padding:9px 14px;font-size:14px;">Ապրանքի Մուտքագրում</button>
                </div>
            </div>

            <table id="productsTable" class="data-table">
                <thead>
                    <tr>
                        <th>Անվանում</th>
                        <th>Կատեգորիա</th>
                        <th>Գին</th>
                        <th>Տեսակ</th>
                        <th>Բրենդ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td colspan="5" style="text-align:center;padding:18px;">Վերբեռնվում է...</td></tr>
                </tbody>
            </table>
        </div>
    </main>
</div>
        <div id="addProductModal" style="display:none;position:fixed;inset:0;background:rgba(15,10,10,0.46);align-items:center;justify-content:center;padding:28px;z-index:1200;">
        <div style="width:min(760px,96vw);background:#fff;border-radius:20px;padding:22px 20px;box-shadow:0 26px 60px rgba(30,20,20,.24);">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                <h3 style="margin:0;">Ապրանքի Մուտքագրում</h3>
                <button id="closeModal" style="background:transparent;border:none;font-size:20px;cursor:pointer;">&times;</button>
            </div>
            <form id="addProductForm" enctype="multipart/form-data">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                    <div>
                        <label>Նկարի վերբեռնում</label>
                        <input type="file" name="img" accept="image/*">
                    </div>
                    <div>
                        <label>Անվանում</label>
                        <input type="text" name="name" required style="width:100%;padding:10px;border-radius:8px;border:1px solid #ddd;">
                    </div>
                    <div>
                        <label>Ապրանքի Կատեգորիա</label>
                        <input type="text" name="category" required style="width:100%;padding:10px;border-radius:8px;border:1px solid #ddd;">
                    </div>
                    <div>
                        <label>Չափման Միավոր</label>
                        <input type="text" name="unit" required style="width:100%;padding:10px;border-radius:8px;border:1px solid #ddd;">
                    </div>
                    <div>
                        <label>Վաճառքի Գին</label>
                        <input type="text" name="price" required style="width:100%;padding:10px;border-radius:8px;border:1px solid #ddd;">
                    </div>
                    <div>
                        <label>Զեղչ</label>
                        <input type="number" name="sale" min="0" max="100" style="width:100%;padding:10px;border-radius:8px;border:1px solid #ddd;">
                    </div>
                    <div style="grid-column:1/3;">
                        <label>Հայտարարություն</label>
                        <textarea name="announcement" rows="3" style="width:100%;padding:10px;border-radius:8px;border:1px solid #ddd;"></textarea>
                    </div>
                    <div>
                        <label>Բրենդ</label>
                        <select name="brand" style="width:100%;padding:10px;border-radius:8px;border:1px solid #ddd;">
                            <option value="Atenk">Atenk</option>
                            <option value="Marila">Marila</option>
                            <option value="Luma">Luma</option>
                        </select>
                    </div>
                </div>
                <div style="display:flex;gap:10px;align-items:center;justify-content:flex-end;margin-top:14px;">
                    <button type="button" id="cancelBtn" class="btn-secondary">Չեղարկել</button>
                    <button type="submit" class="btn-primary">Պահպանել Գրառումը</button>
                </div>
                <div id="addProductFeedback" style="margin-top:12px;display:none;padding:10px;border-radius:8px;"></div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script>
        (function(){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            const $search = $('#searchBox');
            const $brand = $('#brandFilter');
            const $tableBody = $('#productsTable tbody');
            let debounceTimer = null;

            function loadProducts(){
                const q = $search.val().trim();
                const brand = $brand.val();
                $.ajax({
                    url: '{{ route('admin.products.search') }}',
                    method: 'GET',
                    data: { q: q, brand: brand },
                    dataType: 'json'
                }).done(function(resp){
                    $tableBody.empty();
                    if (!resp || !resp.length) {
                        $tableBody.append('<tr><td colspan="5" style="text-align:center;padding:18px;">Արդյունքներ չգտնվեցին</td></tr>');
                        return;
                    }
                    resp.forEach(function(row){
                        const tr = $('<tr/>');
                        tr.append($('<td/>').text(row.name));
                        tr.append($('<td/>').text(row.category));
                        tr.append($('<td/>').text(row.price+' ֏'));
                        tr.append($('<td/>').text(row.type));
                        tr.append($('<td/>').text(row.brand));
                        $tableBody.append(tr);
                    });
                }).fail(function(){
                    $tableBody.html('<tr><td colspan="5" style="text-align:center;padding:18px;color:#b33;">Սերվերի սխալ</td></tr>');
                });
            }

            $search.on('input', function(){
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(loadProducts, 350);
            });
            $brand.on('change', loadProducts);
            $(document).ready(loadProducts);

            $('#openAddProduct').on('click', function(){ $('#addProductModal').fadeIn(180).css('display','flex'); });
            $('#closeModal, #cancelBtn').on('click', function(){ $('#addProductModal').fadeOut(120); });

            $('#addProductForm').on('submit', function(e){
                e.preventDefault();
                const fd = new FormData(this);
                $('#addProductFeedback').hide();
                $.ajax({
                    url: '{{ route('admin.products.store-ajax') }}',
                    method: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: 'json'
                }).done(function(resp){
                    if (resp && resp.success) {
                        $('#addProductFeedback').css({'background':'#e6f6ea','color':'#1b5e23','border':'1px solid #cfe9d0'}).text(resp.message).show();
                        $('#addProductForm')[0].reset();
                        loadProducts();
                        setTimeout(function(){ $('#addProductModal').fadeOut(200); }, 900);
                    } else {
                        $('#addProductFeedback').css({'background':'#fff0f0','color':'#7a2222','border':'1px solid #f1c2c2'}).text(resp.message || 'Չհաջողվեց').show();
                    }
                }).fail(function(){
                    $('#addProductFeedback').css({'background':'#fff0f0','color':'#7a2222','border':'1px solid #f1c2c2'}).text('Ներմուծման սխալ.').show();
                });
            });
        })();
    </script>
@endsection
