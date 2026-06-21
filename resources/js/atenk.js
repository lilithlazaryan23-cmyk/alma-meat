
$(function () {
    let x = false;

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

    $(window).on('scroll', function ()  {
        let q = $(window).scrollTop();
        let links = $('.texts a');
        let menu_text = $('#glxavor, #mer_masin, #tesakani, #baxadratoms, #kap, #buy_now');
        let menu_icons = $('.fa-cart-shopping, #fa-user, .fa-caret-down');

        if (!x && q > 200 && q < 260) {
            updat();
        }

        if (q > 260 && q < 920) {
            menu_text.css({
                color: '#881e1e',
                fontWeight: 'bold'
            });
            links.css({ 'color': '#881e1e', '--underline-color': '#881e1e' })

            $('.hr').css('background-color', '#881e1e');

            menu_icons.css('color', '#881e1e');
            $('#logoo').attr('src', '/storage/app/public/images/atenk/cow_red.png');
        }

        else {
            menu_text.css('color', 'white');
            menu_icons.css('color', 'white');
            links.css({ 'color': 'white', '--underline-color': 'white' })
            $('.hr').css('background-color', 'white');

            $('#logoo').attr('src', '/storage/app/public/images/main/Gemini_Generated_Image_czs168czs168czs1.png');
        }

        if (q > 1220 && q < 3400) {
            menu_text.css({
                color: '#881e1e',
                fontWeight: 'bold'
            });
            links.css({ 'color': '#881e1e', '--underline-color': '#881e1e' })

            menu_icons.css('color', '#881e1e');
            $('#logoo').attr('src', '/storage/app/public/images/atenk/cow_red.png');
            $('.hr').css('background-color', '#881e1e');
        }

        if (q > 3800) {
            menu_text.css({
                color: '#881e1e',
                fontWeight: 'bold'
            });
            links.css({ 'color': '#881e1e', '--underline-color': '#881e1e' })
            menu_icons.css('color', '#881e1e');
            $('#logoo').attr('src', '/storage/app/public/images/atenk/cow_red.png');
            $('.hr').css('background-color', '#881e1e');
        }
    })

    function updat() {
        let d32 = document.getElementById('d32');
        let d120 = document.getElementById('d120');
        let d150 = document.getElementById('d150');

        let count1 = 0, count2 = 0, count3 = 0;

        let timer1 = setInterval(() => {
            if (count1 < 32) {
                count1++;
                d32.innerText = `${count1}`;
            } else {
                clearInterval(timer1);
            }
        }, 130);

        let timer2 = setInterval(() => {
            if (count2 < 120) {
                count2++;
                d120.innerText = `${count2}տ`;
            } else {
                clearInterval(timer2);
            }
        }, 100);

        let timer3 = setInterval(() => {
            if (count3 < 150) {
                count3++;
                d150.innerText = `${count3}+`;
            } else {
                clearInterval(timer3);
            }
        }, 90);
    }
});
