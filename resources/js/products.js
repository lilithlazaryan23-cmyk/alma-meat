function esc(v) {
    return String(v == null ? '' : v).replace(/[&<>"']/g, function (c) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
}

$(document).ready(function () {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

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

    const faUserEl = document.getElementById('fa-user');
    if (faUserEl) {
        faUserEl.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = '/register';
        });
    }

    document.addEventListener('click', function () {
        let div = document.getElementById('mer_masin_open');
        div.style.display = 'none';
        document.querySelectorAll('.open_curor').forEach(function (l) {
            l.style.display = 'none';
        });
    });

    function isPieceProduct(card) {
        const unit = String(card.attr('data-unit') || card.find('.weight-unit').text() || '').toLowerCase().trim();
        return ['piece', 'pice', 'pcs', 'հատ'].includes(unit);
    }

    function isPieceCartItem(item) {
        const unit = String((item && item.unit) || (item && item.type) || '').toLowerCase().trim();
        return ['piece', 'pice', 'pcs', 'հատ'].includes(unit);
    }

    function formatWeightValue(value, pieceProduct) {
        return pieceProduct ? String(Math.max(0, Math.round(value))) : value.toFixed(1);
    }

    function getCartQuantity(cart) {
        return cart.reduce(function (total, item) {
            const weight = parseFloat(item.weight) || 0;
            const itemQuantity = isPieceCartItem(item) ? Math.round(weight) : Math.round(weight * 10) / 10;
            return total + itemQuantity;
        }, 0);
    }

    function formatCartQuantity(count) {
        const roundedCount = Math.round(Math.max(0, count) * 10) / 10;
        return Number.isInteger(roundedCount) ? String(roundedCount) : roundedCount.toFixed(1);
    }

    function updateCartCount(count) {
        const cartCountEl = $('#cart-count');
        const formattedCount = formatCartQuantity(Math.max(0, count));
        if (formattedCount !== '0') {
            cartCountEl.text(formattedCount).show();
        } else {
            cartCountEl.hide();
        }
    }

    function readCart() {
        return JSON.parse(localStorage.getItem('cart')) || [];
    }

    function syncCartCount() {
        updateCartCount(getCartQuantity(readCart()));
    }

    function emitCartUpdated() {
        window.dispatchEvent(new Event('cart-updated'));
    }

    $(document).on('click', '.qty-btn', function () {
        let btn = $(this);
        let card = btn.closest('.product-card');
        let display = card.find('.weight-value');
        let sumElement = card.find('.sum');
        let basketIcon = card.find('.fa-basket-shopping');

        let price = parseFloat(card.attr('data-price')) || 0;
        let currentWeight = parseFloat(display.text()) || 0;
        let pieceProduct = isPieceProduct(card);
        let step = parseFloat(btn.attr('data-step'));

        if (Number.isNaN(step)) {
            step = btn.hasClass('plus') ? (pieceProduct ? 1 : 0.1) : (pieceProduct ? -1 : -0.1);
        }

        let newWeight = currentWeight + step;

        if (newWeight < 0) newWeight = 0;

        let formattedWeight = formatWeightValue(newWeight, pieceProduct);
        display.text(formattedWeight);

        let total = newWeight * price;
        sumElement.text(Math.round(total).toLocaleString());

        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let productId = card.find('.heart-icon').attr('data-id');
        let itemIndex = cart.findIndex(i => String(i.id) === String(productId));

        if (newWeight > 0) {
            let productData = {
                id: productId,
                name: card.find('h3').text(),
                price: price,
                weight: pieceProduct ? Math.round(newWeight) : parseFloat(newWeight.toFixed(1)),
                totalPrice: Math.round(total),
                img: card.find('.img-box img').attr('src'),
                type: card.find('.weight-unit').text(),
                unit: pieceProduct ? 'piece' : 'kg'
            };

            if (itemIndex > -1) {
                cart[itemIndex] = productData;
            } else {
                cart.push(productData);
                showAddToCartNotification(productData.name, productData.totalPrice);
            }

            basketIcon.addClass('in-cart');
            basketIcon.css('color', '#28a745');
        } else {
            if (itemIndex > -1) cart.splice(itemIndex, 1);
            basketIcon.removeClass('in-cart');
            basketIcon.css('color', '#999');
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount(getCartQuantity(cart));
        emitCartUpdated();
    });

    $(document).on('click', '.heart-icon', function () {
        if ($('meta[name="authed"]').attr('content') !== '1') {
            window.location.href = '/register';
            return;
        }

        let heart = $(this);
        let id = heart.attr('data-id');

        $.ajax({
            url: '/products/like',
            method: 'POST',
            data: { heart_id: id },
            success: function (response) {

                if (response.trim() === 'red') {
                    heart.removeClass('fa-regular').addClass('fa-solid active');
                } else if (response.trim() === 'silver') {
                    heart.removeClass('fa-solid active').addClass('fa-regular');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    });

    $(window).on('scroll', function () {
        let q = $(window).scrollTop();

        let menu_text = $('#glxavor, #mer_masin, #tesakani, #baxadratoms, #kap, #buy_now, .user-name');
        let menu_icons = $('.fa-cart-shopping, #fa-user, .fa-caret-down, .logout-btn i');
        let menu2 = $('.a');

        if (q > 120) {
            menu_text.css({
                color: '#881e1e',
                fontWeight: '600'
            });
            menu_icons.css('color', '#881e1e');
            menu2.css({
                fontWeight: 'bold',
                color: '#881e1e',
            });
            $('body').addClass('scrolled');
            $('#logoo').attr('src', '/storage/images/atenk/cow_red.png');

        } else {
            menu_text.css('color', 'white');
            menu_icons.css('color', 'white');

            menu2.css({
                fontWeight: 'bold',
                color: 'white',
            });
            $('body').removeClass('scrolled');
            $('#logoo').attr('src', '/storage/images/main/Gemini_Generated_Image_czs168czs168czs1.png');
        }
    });

    $(document).ready(function () {
        const searchInput = $('.search-input');
        const noResults = $('#no-results');

        function performSearch() {
            const query = searchInput.val().toLowerCase().trim();
            const products = $('.product-card');
            let foundAny = false;

            if (query === "") {
                products.show();
                if (products.length === 0) {
                    noResults.show();
                } else {
                    noResults.hide();
                }
                return;
            }

            products.each(function () {
                const card = $(this);
                const productName = card.find('h3').text().toLowerCase();
                const productDesc = card.find('h6').text().toLowerCase();
                const category = (card.attr('data-category') || '').toLowerCase();
                const brand = (card.attr('data-brand') || '').toLowerCase();
                const match = [productName, productDesc, category, brand].some(field => field.includes(query));

                if (match) {
                    card.show();
                    foundAny = true;
                } else {
                    card.hide();
                }
            });

            if (foundAny) {
                noResults.hide();
            } else {
                noResults.show();
            }
        }

        searchInput.on('input', performSearch);

        performSearch();
    });

    function showAddToCartNotification(productName, price) {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 120px;
            right: 20px;
            background: linear-gradient(135deg, #881E1E, #c32f2f);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(136, 30, 30, 0.4);
            z-index: 10001;
            animation: slideInNotif 0.4s ease, slideOutNotif 0.4s ease 2.6s forwards;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 14px;
        `;
        notification.innerHTML = `<i class="fas fa-check-circle" style="margin-right: 10px;"></i>${esc(productName)} ավելացվել է <strong>${price.toLocaleString()}֏</strong>`;
        document.body.appendChild(notification);

        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideInNotif {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOutNotif {
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        setTimeout(() => notification.remove(), 3200);
    }

    function loadCartData() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        $('.product-card').each(function () {
            let card = $(this);
            let productId = card.find('.heart-icon').attr('data-id');
            let item = cart.find(i => String(i.id) === String(productId));

            if (item) {
                let pieceProduct = String(item.unit || item.type || '').toLowerCase().trim();
                let isPiece = ['piece', 'pice', 'pcs', 'հատ'].includes(pieceProduct);
                card.find('.weight-value').text(formatWeightValue(parseFloat(item.weight) || 0, isPiece));
                card.find('.sum').text(Number(item.totalPrice || 0).toLocaleString());
                card.find('.fa-basket-shopping').css('color', '#28a745').addClass('in-cart');
            }
        });

        updateCartCount(getCartQuantity(cart));
    }

    window.addEventListener('storage', function (event) {
        if (event.key === 'cart') {
            loadCartData();
        }
    });

    window.addEventListener('cart-updated', function () {
        loadCartData();
    });

    function updateReturnToSectionLink() {
        const returnButton = $('#return-to-section');
        const returnUrl = localStorage.getItem('returnUrl');
        if (!returnButton.length) return;

        if (returnUrl) {
            returnButton.attr('href', returnUrl).show();
        } else {
            returnButton.hide();
        }
    }

    loadCartData();
    updateReturnToSectionLink();
});
