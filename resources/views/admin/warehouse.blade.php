@extends('layouts.app')

@section('title', 'Պահեստի Մատյան')

@section('head')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.0.0/css/all.min.css') }}">
    @vite('resources/css/admin.css')
@endsection

@section('body')
<div class="app-shell">
    @include('admin.partials.sidebar', ['currentPage' => 'warehouse'])

    <main class="main">
        <div class="page-head">
            <div>
                <div class="page-title">{{ $brand !== '' ? 'Պահեստ — '.$brand : 'Պահեստի Մատյան' }}</div>
                <div class="page-subtitle">Իրական ժամանակում նվազ քանակություն</div>
            </div>
            <form method="get" action="{{ route('admin.warehouse') }}" style="display:flex;gap:10px;align-items:center;">
                <input class="search-bar" type="text" name="q" value="{{ $search }}" placeholder="Որոնել ապրանք">
                @if ($brand !== '')
                    <input type="hidden" name="brand" value="{{ $brand }}">
                @endif
            </form>
        </div>

        <div class="panel">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Ապրանքանիշ</th>
                        <th>Անվանում</th>
                        <th>Քանակ Մնում</th>
                        <th>Թարմություն</th>
                        <th>Վիճակ</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($rows as $row)
                    @php
                        $qty = (float) $row->qty;
                        $fresh = (int) round($row->freshness);
                        $raw_type = strtolower(trim($row->type ?? 'kg'));
                        $unit = in_array($raw_type, ['pice', 'piece', 'pcs', 'հատ']) ? 'հատ' : 'կգ';

                        if ($fresh >= 70)      { $fresh_class = ''; }
                        elseif ($fresh >= 30)  { $fresh_class = 'warn'; }
                        else                   { $fresh_class = 'bad'; }

                        if ($qty <= 0)        { $st_class = 'pill-bad';  $st_text = 'չկա մնում'; }
                        elseif ($qty < 10)    { $st_class = 'pill-bad';  $st_text = 'կրիտիկական'; }
                        elseif ($qty < 30)    { $st_class = 'pill-warn'; $st_text = 'քիչ է մնում'; }
                        else                  { $st_class = 'pill-good'; $st_text = 'բավարար'; }
                    @endphp
                    <tr>
                        <td>{{ $row->brand ?: '—' }}</td>
                        <td>{{ $row->name }}</td>
                        <td class="mute-cell">{{ rtrim(rtrim(number_format($qty, 2, '.', ''), '0'), '.') }} {{ $unit }}</td>
                        <td>
                            <div class="freshness">
                                <div class="freshness-bar">
                                    <div class="freshness-fill {{ $fresh_class }}" style="width: {{ max(0, min(100, $fresh)) }}%"></div>
                                </div>
                                <span class="freshness-pct">{{ $fresh }}% թարմություն</span>
                            </div>
                        </td>
                        <td><span class="pill {{ $st_class }}">{{ $st_text }}</span></td>
                    </tr>
                @empty
                    <tr>
                        <td class="mute-cell" colspan="4" style="text-align:center;padding:24px;">Ապրանքներ չեն գտնվել</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
