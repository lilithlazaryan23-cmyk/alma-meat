function esc(v) {
    return String(v == null ? '' : v).replace(/[&<>"']/g, function (c) {
        return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
}

$(document).ready(function () {
    const menuButton = document.getElementById('mer_masin');
    if (menuButton) {
        menuButton.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const div = document.getElementById('mer_masin_open');
            if (div.style.display === 'block') {
                div.style.display = 'none';
            } else {
                div.style.display = 'block';
            }
            document.querySelectorAll('.open_curor').forEach(function (l) {
                l.style.display = div.style.display;
            });
        });
    }

    $(window).on('scroll', function () {
        let q = $(window).scrollTop();
        let links = $('.texts a');
        let menu_text = $('#glxavor, #mer_masin, #tesakani, #baxadratoms, #kap, #buy_now');
        let menu_icons = $('.fa-cart-shopping, #fa-user, .fa-caret-down');

        if (q > 130 ) {
            menu_text.css({
                color: '#881e1e',
                fontWeight: 'bold'
            });
            links.css({ 'color': '#881e1e', '--underline-color': '#881e1e' })

            $('.hr').css('background-color', '#881e1e');

            menu_icons.css('color', '#881e1e');
            $('#logoo').attr('src', '/storage/images/atenk/cow_red.png');
        }

        else {
            menu_text.css('color', 'white');
            menu_icons.css('color', 'white');
            links.css({ 'color': 'white', '--underline-color': 'white' })
            $('.hr').css('background-color', 'white');

            $('#logoo').attr('src', '/storage/images/main/Gemini_Generated_Image_czs168czs168czs1.png');
        }
    })

    document.addEventListener('click', function () {
        const div = document.getElementById('mer_masin_open');
        if (div) {
            div.style.display = 'none';
        }
        document.querySelectorAll('.open_curor').forEach(function (l) {
            l.style.display = 'none';
        });
    });

    loadCart();

    $('#checkout-btn').on('click', function () {
        // Առաքումը դեռ հասանելի չէ — պատվերը հնարավոր չէ ձևակերպել
        showNotification('Առաքումը ներկայումս հասանելի չէ։ Պատվերը հնարավոր չէ կատարել։');
    });
});

function loadCart() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsList = document.getElementById('cart-items-list');
    const emptyCart = document.getElementById('empty-cart');

    cartItemsList.innerHTML = '';

    if (cart.length === 0) {
        emptyCart.style.display = 'flex';
        cartItemsList.style.display = 'none';
        updateTotals(0);
        return;
    }

    emptyCart.style.display = 'none';
    cartItemsList.style.display = 'grid';

    let subtotal = 0;

    cart.forEach((item, index) => {
        const quantity = Number(item.weight) || 0;
        const price = Number(item.price) || 0;
        const totalPrice = Math.round(quantity * price);
        subtotal += totalPrice;

        const name = esc(item.name);
        const img = esc(item.img);
        const unit = esc(item.unit || item.type || 'kg');

        const itemNode = document.createElement('div');
        itemNode.className = 'cart-item';
        itemNode.innerHTML = `
            <div class="cart-item-image">
                <img src="${img}" alt="${name}">
            </div>
            <div class="cart-item-details">
                <h3>${name}</h3>
                <p>${quantity} ${unit}</p>
                <p class="item-price">${totalPrice.toLocaleString()}֏</p>
            </div>
            <div class="cart-item-actions">
                <div class="qty-control">
                    <button class="qty-btn decrease-btn" data-index="${index}">−</button>
                    <span>${quantity}</span>
                    <button class="qty-btn increase-btn" data-index="${index}">+</button>
                </div>
                <button class="remove-btn" data-index="${index}"><i class="fas fa-trash"></i></button>
            </div>
        `;

        cartItemsList.appendChild(itemNode);
    });

    cartItemsList.querySelectorAll('.increase-btn').forEach(button => {
        button.addEventListener('click', function () {
            updateQuantity(this.dataset.index, 1);
        });
    });

    cartItemsList.querySelectorAll('.decrease-btn').forEach(button => {
        button.addEventListener('click', function () {
            updateQuantity(this.dataset.index, -1);
        });
    });

    cartItemsList.querySelectorAll('.remove-btn').forEach(button => {
        button.addEventListener('click', function () {
            removeItem(this.dataset.index);
        });
    });

    updateTotals(subtotal);
}

function updateQuantity(index, delta) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const item = cart[index];
    if (!item) return;

    let newWeight = Number(item.weight) + delta;
    if (newWeight < 0) newWeight = 0;
    item.weight = item.unit === 'piece' ? Math.round(newWeight) : Number(newWeight.toFixed(1));
    item.totalPrice = Math.round(item.weight * Number(item.price));

    if (item.weight <= 0) {
        cart.splice(index, 1);
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
}

function removeItem(index) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart();
    showNotification('Ապրանքը հեռացվել է');
}

function updateTotals(subtotal) {
    const taxAmount = Math.round(subtotal * 0.1);
    const total = subtotal + taxAmount;

    document.getElementById('subtotal').textContent = subtotal.toLocaleString() + '֏';
    document.getElementById('tax-amount').textContent = taxAmount.toLocaleString() + '֏';
    document.getElementById('total-price').textContent = total.toLocaleString() + '֏';
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => notification.remove(), 2600);
}
