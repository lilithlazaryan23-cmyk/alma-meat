$(document).ready(function() {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    function notify(message, type) {
        var n = document.createElement('div');
        n.className = 'form-notice' + (type === 'success' ? ' success' : '');
        n.textContent = message;
        document.body.appendChild(n);
        setTimeout(function () { n.classList.add('show'); }, 10);
        setTimeout(function () {
            n.classList.remove('show');
            setTimeout(function () { n.remove(); }, 250);
        }, 3200);
    }

    let dont_sign = $('#dont_sign');
    let are_log = $('#are_log');
    let registration_blok = $('.registration_blok');

    dont_sign.on('click', function(e) {
        e.preventDefault();
        registration_blok.addClass('active-signup');
    });

    are_log.on('click', function(e) {
        e.preventDefault();
        registration_blok.removeClass('active-signup');
    });

    $('#login_form').on('submit', function(e) {
        e.preventDefault();

        const email = $('#login_e-mail').val().trim();
        const password = $('#login_pwd').val();

        if (!email || !password) {
            notify('Խնդրում ենք լրացնել բոլոր դաշտերը');
            return;
        }

        $.ajax({
            url: '/login',
            method: 'POST',
            data: {
                email: email,
                password: password
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    if (response.is_admin) {
                        window.location.href = '/admin/dashboard';
                    } else {
                        window.location.href = '/products';
                    }
                } else {
                    notify('Սխալ: ' + response.message);
                }
            },
            error: function() {
                notify('Մուտքի սխալ');
            }
        });
    });

    $('#signup_form').on('submit', function(e) {
        e.preventDefault();

        const fullname = $('#sig_name').val().trim();
        const username = $('#sig_uid').val().trim();
        const email = $('#sig_e-mail').val().trim();
        const password = $('#sig_pwd').val();
        const confirmPassword = $('#sig_conf').val();
        const gender = $('input[name="gender"]:checked').val();

        if (!fullname || !username || !email || !password || !confirmPassword || !gender) {
            notify('Խնդրում ենք լրացնել բոլոր դաշտերը');
            return;
        }

        if (password !== confirmPassword) {
            notify('Գաղտնաբառերը չեն համընկնում');
            return;
        }

        if (password.length < 6) {
            notify('Գաղտնաբառը պետք է լինի առնվազն 6 նիշ');
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            notify('Խնդրում ենք մուտքագրել վավեր էլ. փոստի հասցե');
            return;
        }

        $.ajax({
            url: '/register',
            method: 'POST',
            data: {
                name: fullname,
                username: username,
                email: email,
                password: password,
                password_confirmation: confirmPassword,
                gender: gender
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    notify('Գրանցումը հաջողվեց! Մուտք գործեք', 'success');
                    registration_blok.removeClass('active-signup');
                } else {
                    notify('Սխալ: ' + response.message);
                }
            },
            error: function() {
                notify('Գրանցման սխալ');
            }
        });
    });

    $('#sig_conf').on('input', function() {
        if ($(this).val() !== $('#sig_pwd').val()) {
            $(this).css('border-color', '#e74c3c');
        } else {
            $(this).css('border-color', 'rgba(136, 30, 30, 0.12)');
        }
    });
});
