
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

        if (q > 260 && q < 1080) {
            menu_text.css({
                color: '#881e1e',
                fontWeight: 'bold'
            });
            menu_icons.css('color', '#881e1e');
            $('#logoo').attr('src', '/storage/app/public/images/atenk/cow_red.png');
            links.css({'--underline-color':'#801e1e', 'color': '#881e1e'});
            $('.hr').css('background-color', '#881e1e');
        }
        else {
            menu_text.css('color', 'white');
            menu_icons.css('color', 'white');
            links.css({ '--underline-color': 'white', 'color': 'white' });
            $('#logoo').attr('src', '/storage/app/public/images/main/Gemini_Generated_Image_czs168czs168czs1.png');
            $('.hr').css('background-color', 'white');
        }

        if (q > 1430 && q < 3320) {
            menu_text.css({
                color: '#881e1e',
                fontWeight: 'bold'
            });
            menu_icons.css('color', '#881e1e');
            links.css({'--underline-color':'#801e1e', 'color': '#881e1e'});
            $('#logoo').attr('src', '/storage/app/public/images/atenk/cow_red.png');
            $('.hr').css('background-color', '#881e1e');
        }

        if (q > 3705) {
            menu_text.css({
                color: '#881e1e',
                fontWeight: 'bold'
            });
            menu_icons.css('color', '#881e1e');
            links.css({'--underline-color':'black', 'color': '#881e1e'});
            $('#logoo').attr('src', '/storage/app/public/images/atenk/cow_red.png');
            $('.hr').css('background-color', '#881e1e');
        }
    })
});

