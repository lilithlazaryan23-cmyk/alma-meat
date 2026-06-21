
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

        if (q > 260 && q < 880) {
            menu_text.css({
                color: '#881e1e',
                fontWeight: 'bold'
            });
            links.css({'--underline-color':'#881e1e', 'color': '#881e1e'});
            menu_icons.css('color', '#881e1e');
            $('#logoo').attr('src', '/storage/images/atenk/cow_red.png');
            $('.hr').css('background-color', '#881e1e');
        }
        else {
            menu_text.css('color', 'white');
            links.css({'--underline-color':'white', 'color': 'white'});
            menu_icons.css('color', 'white');
            $('#logoo').attr('src', '/storage/images/main/Gemini_Generated_Image_czs168czs168czs1.png');
            $('.hr').css('background-color', 'white');
        }

        if (q > 1200 && q < 3220) {
            menu_text.css({
                color: '#881e1e',
                fontWeight: 'bold'
            });
            links.css({'--underline-color':'#881e1e', 'color': '#881e1e'});
            menu_icons.css('color', '#881e1e');
            $('#logoo').attr('src', '/storage/images/atenk/cow_red.png');
            $('.hr').css('background-color', '#881e1e');
        }

        if (q > 3590) {
            menu_text.css({
                color: '#881e1e',
                fontWeight: 'bold'
            });
            links.css({'--underline-color':'#881e1e', 'color': '#881e1e'});
            menu_icons.css('color', '#881e1e');
            $('#logoo').attr('src', '/storage/images/atenk/cow_red.png');
            $('.hr').css('background-color', '#881e1e');
        }
        const container = document.querySelector('.dicrat_img');
        const rect = container.getBoundingClientRect();
        const windowHeight = window.innerHeight;

        if (rect.top < windowHeight && rect.bottom > 0) {
            let scrolledPercentage = (windowHeight - rect.top) / (windowHeight + rect.height);

            let scaleValue = 1 - (scrolledPercentage * 0.2);

            let opacityValue = 1 - (scrolledPercentage * 1);

            container.style.transform = `scale(${scaleValue})`;
            container.style.opacity = opacityValue;
        }

    })

});

