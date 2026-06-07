@extends('layouts.app')

@section('title', 'Բաղադրատոմսեր - ԱԼՄԱ Մսամթերք')

@section('head')
    @vite('resources/css/recipes.css')
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/6.5.1/css/all.min.css') }}">
@endsection

@section('body')
    @include('partials.header', [
        'logo' => 'storage/images/atenk/cow_red.png',
    ])

    <section class="premium-gallery">

        <div class="art-block">
            <div class="art-image">
                <img src="{{ asset('storage/images/recipes/pizza.jpg') }}">
                <div class="image-number">01</div>
            </div>
            <div class="art-details">
                <span class="brand-accent"> «Աթենք»</span>
                <h2 class="art-title">Պիցցա <br> Պեպերոնի</h2>
                <div class="art-line"></div>
                <p class="art-desc">
                    Բարակ խմոր, հագեցած պեպերոնի և մոցարելա։
                    Արագ պատրաստվող և անմոռանալի համով պիցցա։
                </p>
                <div class="ingredients-minimal">
                    <span>Պեպերոնի</span> •
                    <span>Մոցարելա</span> •
                    <span>Խմոր</span>
                </div>
                <button class="more"><a href="https://www.youtube.com/watch?v=MDX8fylSisU&t=271s" target="_blank">Իմանալ
                        ավելին</a></button>
            </div>
        </div>

        <div class="art-block reverse">
            <div class="art-image">
                <img src="{{ asset('storage/images/recipes/These oven-baked Italian sub sandwiches elevate….jpg') }}">
                <div class="image-number">02</div>
            </div>
            <div class="art-details">
                <span class="brand-accent">«Աթենք»</span>
                <h2 class="art-title">Իտալական <br> Սենդվիչ</h2>
                <div class="art-line"></div>
                <p class="art-desc">
                    Ջեռոցում թխված հաց՝ համադրված լավագույն նրբերշիկների հետ։
                </p>
                <div class="ingredients-minimal">
                    <span>Սերվիլատ</span> •
                    <span>Չեդեր</span> •
                    <span>Սոուս</span>
                </div>
                <button class="more"><a href="https://www.youtube.com/shorts/PM1rTYbmXHQ" target="_blank">Իմանալ
                        ավելին</a></button>

            </div>
        </div>

        <div class="art-block">
            <div class="art-image">
                <img src="{{ asset('storage/images/recipes/23 Best Hot Dog Toppings for Your Next Barbecue.jpg') }}">
                <div class="image-number">03</div>
            </div>
            <div class="art-details">
                <span class="brand-accent"> «Մարիլա»</span>
                <h2 class="art-title">Հոթ-Դոգ</h2>
                <div class="art-line"></div>
                <p class="art-desc">
                    Հյութալի նրբերշիկ՝ տաք բուլկայի մեջ։
                    Արագ, մատչելի և բոլորի սիրելի։
                </p>
                <div class="ingredients-minimal">
                    <span>Նրբերշիկ</span> •
                    <span>Մանանեխ</span> •
                    <span>Սոուս</span> •
                    <span>Խմոր</span>
                </div>
                <button class="more"><a href="https://www.youtube.com/shorts/O-pMaA03ap8" target="_blank">Իմանալ
                        ավելին</a></button>
            </div>
        </div>

        <div class="art-block reverse">
            <div class="art-image">
                <img
                    src="{{ asset('storage/images/recipes/Epic Prosciutto & Cheese Bruschetta_ The Best Easy Appetizer for a Homemade Bruschetta Board.jpg') }}">
                <div class="image-number">04</div>
            </div>
            <div class="art-details">
                <span class="brand-accent">«Մարիլա»</span>
                <h2 class="art-title">Բրուսկետտա <br> Բաստուրմայով </h2>
                <div class="art-line"></div>
                <p class="art-desc">
                    Փխրուն, թեթև և շատ գեղեցիկ նախուտեստ։
                </p>
                <div class="ingredients-minimal">
                    <span>Բաստուրմա</span> •
                    <span>Տոստացված հաց</span> •
                    <span>Լոլիկ</span>•
                    <span>Բազիլիկ</span>
                </div>
                <button class="more"><a href="https://www.youtube.com/shorts/eY_gVbYbejY" target="_blank">Իմանալ
                        ավելին</a></button>

            </div>
        </div>

        <div class="art-block">
            <div class="art-image">
                <img src="{{ asset('storage/images/recipes/Perfectly cooked spaghetti tossed in a rich….jpg') }}">
                <div class="image-number">05</div>
            </div>
            <div class="art-details">
                <span class="brand-accent"> «Լումա»</span>
                <h2 class="art-title">Պաստա <br> Սերուցքային </h2>
                <div class="art-line"></div>
                <p class="art-desc">
                    Նուրբ ու կրեմային պաստա՝ հարուստ պանրային համով և երշիկի հագեցած բույրով։
                </p>
                <div class="ingredients-minimal">
                    <span>Եփած երշիկ</span> •
                    <span>Մակարոնեղեն</span> •
                    <span>Սերուցք</span> •
                    <span>Պարմեզան</span>
                </div>
                <button class="more"><a href="https://www.youtube.com/shorts/hqq9FuGiMVw" target="_blank">Իմանալ
                        ավելին</a></button>
            </div>
        </div>

        <div class="art-block reverse">
            <div class="art-image">
                <img
                    src="{{ asset('storage/images/recipes/Epic Prosciutto & Cheese Bruschetta_ The Best Easy Appetizer for a Homemade Bruschetta Board.jpg') }}">
                <div class="image-number">06</div>
            </div>
            <div class="art-details">
                <span class="brand-accent">«Լումա»</span>
                <h2 class="art-title">Սենդվիչ <br> “Կարմիր Կլասիկ” </h2>
                <div class="art-line"></div>
                <p class="art-desc">
                    Թեթև, հարմար ու սննդարար սենդվիչ՝ զբաղված օրերի համար։
                </p>
                <div class="ingredients-minimal">
                    <span>Կոնյակով երշիկ</span> •
                    <span>Թեթև սերուցքային պանիր</span> •
                    <span>Հազարի թերթիկներ</span> •
                    <span>Հացիկներ</span>
                </div>
                <button class="more"><a href="https://www.youtube.com/shorts/vKJ7J9Qdd70" target="_blank">Իմանալ
                        ավելին</a></button>

            </div>
        </div>

    </section>

    @include('partials.footer')

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @vite('resources/js/recipes.js')
@endsection
