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

function getCurrentSectionId() {
    const sectionIds = ['hero', 'mission', 'trust', 'products', 'reviews', 'call'];
    const viewportCenter = window.innerHeight * 0.4;

    for (const id of sectionIds) {
        const section = document.getElementById(id);
        if (!section) continue;
        const rect = section.getBoundingClientRect();
        if (rect.top <= viewportCenter && rect.bottom >= 120) {
            return id;
        }
    }

    return 'hero';
}

const buyButton = document.getElementById('button_buy');
if (buyButton) {
    buyButton.addEventListener('click', function (event) {
        event.preventDefault();
        window.location.href = '/cart';
    });
}

const userIcon = document.getElementById('fa-user');
if (userIcon) {
    userIcon.addEventListener('click', function (event) {
        event.preventDefault();
        window.location.href = '/register';
    });
}

let images = document.querySelectorAll('.masser img');
images.forEach(img => {
    img.addEventListener('mouseenter', () => {
        images.forEach(other => {
            if (other !== img) {
                other.style.filter = 'blur(3px) grayscale(100%)';
            }
        });
    });
    img.addEventListener('mouseleave', () => {
        images.forEach(other => {
            other.style.filter = 'none';
            other.style.filter = "brightness(0.8)";
        })
    })
});

$(function () {
    document.onscroll = function () {
        let q = document.documentElement.scrollTop;
        let links = $('.texts a');
        let menu_text = $('#glxavor, #mer_masin, #tesakani, #baxadratoms, #kap, #buy_now');
        let menu_icons = $('.fa-cart-shopping, #fa-user, .fa-caret-down');

        if (q > 600) {
            menu_text.css({ 'color': 'black', 'font-weight': 'bold' });
            links.css({
                "--underline-color": 'black',
                "color": "black"
            });

            menu_icons.css('color', 'black');
            $('.hr').css('background-color', 'black');
            $('#logoo').attr('src', '/storage/images/main/img_color.png');
        } else {
            menu_text.css({ 'color': 'white', 'font-weight': 'lighter' })
            links.css({ 'color': 'white', '--underline-color': 'white' })

            menu_icons.css('color', 'white');
            $('.hr').css('background-color', 'white');
            $('#logoo').attr('src', '/storage/images/main/Gemini_Generated_Image_czs168czs168czs1.png');
        }
    }
})

const pCards = document.querySelectorAll('.p_review_card');
const pNext = document.getElementById('pNext');
const pPrev = document.getElementById('pPrev');
let pIndex = 0;

function showReview(idx) {
    pCards.forEach(card => card.classList.remove('active'));
    pCards[idx].classList.add('active');
}

if (pNext && pPrev && pCards.length) {
    pNext.addEventListener('click', () => {
        pIndex = (pIndex + 1) % pCards.length;
        showReview(pIndex);
    });

    pPrev.addEventListener('click', () => {
        pIndex = (pIndex - 1 + pCards.length) % pCards.length;
        showReview(pIndex);
    });
}