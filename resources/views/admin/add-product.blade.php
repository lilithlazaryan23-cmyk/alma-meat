@extends('layouts.app')

@section('title', 'Ապրանքի Մուտքագրում')

@section('head')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.0.0/css/all.min.css') }}">
    @vite('resources/css/admin.css')
@endsection

@section('body')
<div class="app-shell">
    @include('admin.partials.sidebar', ['currentPage' => 'add'])

    <main class="main">
        <div class="page-head">
            <div class="page-title">Ապրանքի Մուտքագրում</div>
        </div>

        <div class="panel">
            @if ($okMsg)
                <div class="alert alert-ok">{{ $okMsg }}</div>
            @endif
            @if ($errMsg)
                <div class="alert alert-err">{{ $errMsg }}</div>
            @endif

            <form action="{{ route('admin.products.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">

                    <div class="form-col">
                        <h4>Ապրանքի վերաբերյալ</h4>

                        <label class="image-drop" id="imgDrop">
                            <i class="fa-solid fa-camera"></i>
                            <span id="dropText">Կից նկար</span>
                            <input type="file" name="img" accept="image/*" id="imgInput" required>
                            <img class="preview" id="imgPreview" style="display:none;">
                        </label>

                        <div class="field" style="margin-top:18px;">
                            <label>Վաճառքի գին</label>
                            <input type="number" name="price" min="0" step="1" placeholder="1200 ֏" required>
                        </div>

                        <div class="field">
                            <label>Զեղչ</label>
                            <div class="toggle-row">
                                <label class="switch">
                                    <input type="checkbox" id="saleToggle">
                                    <span class="slider"></span>
                                </label>
                                <span class="mute-cell" style="font-size:13px;">Ակտիվացնել զեղչը</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-col">
                        <h4>Ապրանքի մանրամասներ</h4>

                        <div class="field">
                            <label>Անվանում (Հայերենով)</label>
                            <input type="text" name="name" placeholder="Օրինակ՝ Նրբերշիկ Բրնձաին" required>
                        </div>

                        <div class="field">
                            <label>Ապրանքի տեսակը</label>
                            <select name="category" required>
                                <option value="">Ընտրել տեսակը</option>
                                <option value="Եփած Մսամթերք">Եփած Մսամթերք</option>
                                <option value="Ապխտած Մսամթերք">Ապխտած Մսամթերք</option>
                                <option value="Բաստուրմա,Սուջուխ">Բաստուրմա, Սուջուխ</option>
                                <option value="Նրբերշիկ և սարդելկա">Նրբերշիկ և սարդելկա</option>
                                <option value="Գարեջրի Նախուտեստներ">Գարեջրի Նախուտեստներ</option>
                            </select>
                        </div>

                        <div class="field">
                            <label>Ապրանքանիշ</label>
                            <select name="brand" required>
                                <option value="">Ընտրել ապրանքանիշը</option>
                                <option value="Աթենք">Աթենք</option>
                                <option value="Մարիլա">Մարիլա</option>
                                <option value="Լումա">Լումա</option>
                            </select>
                        </div>

                        <div class="field">
                            <label>Չափման միավոր</label>
                            <select name="type" required>
                                <option value="">Ընտրել միավորը</option>
                                <option value="KG">Կիլոգրամ (կգ)</option>
                                <option value="pice">Հատ</option>
                            </select>
                        </div>

                        <div class="field">
                            <label>Բաղադրությունը</label>
                            <input type="text" name="recept" placeholder="Հավի միս, աղ․․․" required>
                        </div>

                        <div class="field" id="saleField" style="display:none;">
                            <label>Զեղչի տոկոս (%)</label>
                            <input type="number" name="sale" id="saleInput" min="1" max="99" placeholder="10">
                        </div>

                        <button type="submit" class="btn-save">Պահպանել Գործարքը</button>
                    </div>

                </div>
            </form>
        </div>
    </main>
</div>

<script>
const imgInput = document.getElementById('imgInput');
const imgPrev  = document.getElementById('imgPreview');
const dropText = document.getElementById('dropText');
imgInput.addEventListener('change', e => {
    const f = e.target.files[0];
    if (!f) return;
    const r = new FileReader();
    r.onload = ev => { imgPrev.src = ev.target.result; imgPrev.style.display = 'block'; dropText.style.display = 'none'; };
    r.readAsDataURL(f);
});

const saleToggle = document.getElementById('saleToggle');
const saleField  = document.getElementById('saleField');
const saleInput  = document.getElementById('saleInput');
saleToggle.addEventListener('change', () => {
    saleField.style.display = saleToggle.checked ? 'block' : 'none';
    if (!saleToggle.checked) saleInput.value = '';
});
</script>
@endsection
