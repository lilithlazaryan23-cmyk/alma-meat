@extends('layouts.app')

@section('title', $brandLabel.' — Ադմին Մոդուլ')

@section('head')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.0.0/css/all.min.css') }}">
    @vite('resources/css/admin.css')
@endsection

@php
    $formatQty = function ($qty, $type) {
        $metric = in_array(strtolower(trim($type)), ['pice', 'piece', 'pcs', 'հատ']) ? 'հատ' : 'կգ';
        $qty = rtrim(rtrim(number_format($qty, 2, '.', ''), '0'), '.');
        return $qty.' '.$metric;
    };

    $stockStatus = function ($qty) {
        if ($qty <= 0) return ['pill-bad', 'չկա մնում'];
        if ($qty < 10) return ['pill-bad', 'կրիտիկական'];
        if ($qty < 30) return ['pill-warn', 'քիչ է մնում'];
        return ['pill-good', 'բավարար'];
    };
@endphp

@section('body')
<div class="app-shell">
    @include('admin.partials.sidebar', ['currentPage' => 'brand_'.$brandKey])

    <main class="main">
        <div class="page-head">
            <div>
                <div class="page-title">{{ $brandLabel }} ապրանքանիշի կառավարում</div>
                <div class="page-subtitle">Նայել և կարգավորել ապրանքներն ու պահեստի քանակը</div>
            </div>
            <form method="get" action="{{ route('admin.brand') }}" style="display:flex;gap:10px;align-items:center;">
                <input type="hidden" name="brand" value="{{ $brandKey }}">
                <input class="search-bar" type="text" name="search" value="{{ $search }}" placeholder="Որոնել ապրանք ըստ անվան կամ կատեգորիայի">
            </form>
        </div>

        <div class="stat-grid" style="grid-template-columns: repeat(2, minmax(220px, 1fr)); margin-bottom: 20px;">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-cubes-stacked"></i></div>
                <div class="stat-meta">
                    <span class="stat-label">Ընդհանուր ապրանքներ</span>
                    <span class="stat-value">{{ $totalItems }}</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-exclamation-triangle"></i></div>
                <div class="stat-meta">
                    <span class="stat-label">Մնացող քանակություն քիչ</span>
                    <span class="stat-value">{{ $lowStockCount }}</span>
                </div>
            </div>
        </div>

        <div class="panel">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Անվանում</th>
                        <th>Տեսակ</th>
                        <th>Միավոր</th>
                        <th>Քանակ</th>
                        <th>Թարմություն</th>
                        <th>Վիճակ</th>
                        <th>Գին</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($rows as $row)
                    @php
                        $qty = (float) $row->qty;
                        $fresh = (int) round($row->freshness);
                        $raw_type = strtolower(trim($row->type ?? 'kg'));
                        $unit = in_array($raw_type, ['pice', 'piece', 'pcs', 'հատ']) ? 'հատ' : 'կգ';
                        [$statusClass, $statusLabel] = $stockStatus($qty);
                    @endphp
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->category }}</td>
                        <td class="mute-cell">{{ $unit }}</td>
                        <td>{{ $formatQty($qty, $raw_type) }}</td>
                        <td>
                            <div class="freshness">
                                <div class="freshness-bar">
                                    <div class="freshness-fill {{ $fresh >= 70 ? '' : ($fresh >= 30 ? 'warn' : 'bad') }}" style="width: {{ max(0, min(100, $fresh)) }}%"></div>
                                </div>
                                <span class="freshness-pct">{{ $fresh }}%</span>
                            </div>
                        </td>
                        <td><span class="pill {{ $statusClass }}">{{ $statusLabel }}</span></td>
                        <td class="price-cell">{{ number_format($row->price, 0, '.', ',') }} ֏ {{ $row->sale > 0 ? '('.(int) $row->sale.'%)' : '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="mute-cell" colspan="7" style="text-align:center;padding:24px;">Տվյալ ապրանքանիշի ապրանքներ չեն գտնվել</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
