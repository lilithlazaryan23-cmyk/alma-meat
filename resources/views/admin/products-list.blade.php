@extends('layouts.app')

@section('title', 'Ապրանքացուցակ')

@section('head')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.0.0/css/all.min.css') }}">
    @vite('resources/css/admin.css')
@endsection

@section('body')
<div class="app-shell">
    @include('admin.partials.sidebar', ['currentPage' => 'products'])

    <main class="main">
        <div class="page-head">
            <div>
                <div class="page-title">{{ $brand !== '' ? 'Ապրանքներ՝ '.$brand : 'Ապրանքացուցակ' }}</div>
                @if ($brand !== '')
                    <div class="page-subtitle">Խցիկը ընտրված է՝ {{ $brand }}</div>
                @endif
            </div>
            <a href="{{ route('admin.products.add') }}" class="btn-primary">
                <i class="fa-solid fa-plus"></i> Ավելացնել Նոր
            </a>
        </div>

        <div class="panel">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Ապրանքանիշ</th>
                        <th>Անվանում</th>
                        <th>Գին (֏)</th>
                        <th>Միավոր</th>
                        <th>Զեղչ</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($rows as $row)
                    @php
                        $raw_type = strtolower(trim($row->type ?? 'kg'));
                        $unit = in_array($raw_type, ['pice', 'piece', 'pcs', 'հատ']) ? 'հատ' : 'կգ';
                    @endphp
                    <tr>
                        <td>{{ $row->brand ?? '—' }}</td>
                        <td>{{ $row->name }}</td>
                        <td class="price-cell">{{ number_format($row->price, 0, '.', ',') }} ֏</td>
                        <td class="mute-cell">{{ $unit }}</td>
                        <td class="sale-cell">
                            {{ ($row->sale > 0) ? '-'.(int) $row->sale.'%' : '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="mute-cell" colspan="4" style="text-align:center;padding:24px;">Ապրանքներ դեռ չկան</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
