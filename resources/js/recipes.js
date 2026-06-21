$(function () {
    document.getElementById('mer_masin').addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        let div = document.getElementById('mer_masin_open');

        if (div.style.display === 'block') {
            div.style.display = 'none';
        } else {
            div.style.display = 'block';
        }

        document.querySelectorAll('.open_curor').forEach(function (l) {
            l.style.display = div.style.display;
        });
    });

    document.addEventListener('click', function () {

        let div = document.getElementById('mer_masin_open');

        div.style.display = 'none';

        document.querySelectorAll('.open_curor').forEach(function (l) {
            l.style.display = 'none';
        });

    });

    $(window).on('scroll', function () {
        let q = $(window).scrollTop();
        let links = $('.texts a');
        let menu_text = $('#glxavor, #mer_masin, #tesakani, #baxadratoms, #kap, #buy_now');
        let menu_icons = $('.fa-cart-shopping, #fa-user, .fa-caret-down');

        if (q > 260) {
            menu_text.css({
                color: 'black',
                fontWeight: 'bold'
            });
            links.css({'--underline-color':'black', 'color': 'black'});
            menu_icons.css('color', 'black');
            $('#logoo').attr('src', '/storage/app/public/images/main/img_color.png');
            $('.hr').css('background-color', 'black');
        }
        else {
            menu_text.css({
                color: 'white',
                fontWeight: 'lighter'
            });
            links.css({'--underline-color':'white', 'color': 'white'});
            menu_icons.css('color', 'white');
            $('#logoo').attr('src', '/storage/app/public/images/atenk/cow_red.png');
            $('.hr').css('background-color', 'white');
        }
    });

    $('#button_buy').on('click', function() {
        window.location.href = '/cart';
    });

    $('#fa-user').on('click', function() {
        window.location.href = '/register';
    });
});
