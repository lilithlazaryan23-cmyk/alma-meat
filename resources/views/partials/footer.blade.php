<footer class="main-footer">
    <div class="mini-footer"></div>
    <div class="footer-top">
        <div class="footer-col about">
            <h2 class="footer-brand">ԱԼՄԱ մսամթերք</h2>
            <p class="wor">Որակ և համ, որին վստահում են ընտանիքները:</p>
            <div class="social-links">
                <a href="https://www.facebook.com/share/1DPXWyQpL1/?mibextid=wwXIfr" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/liiiliith__?igsh=cmswZ3k4b3kxeDg5" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://wa.me/37493470995" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>

        <div class="footer-col links">
            <h4>Ապրանքանիշեր</h4>
            <ul>
                <li><a href="{{ route('about.atenk') }}">Աթենք</a></li>
                <li><a href="{{ route('about.luma') }}">Լումա</a></li>
                <li><a href="{{ route('about.marila') }}">Մարիլա</a></li>
            </ul>
        </div>

        <div class="footer-col links">
            <h4>Մենյու</h4>
            <ul>
                <li><a href="#">Մեր մասին</a></li>
                <li><a href="{{ route('products') }}">Տեսականի</a></li>
                <li><a href="{{ route('recipes') }}">Բաղադրատոմս</a></li>
            </ul>
        </div>

        <div class="footer-col contacts">
            <h4>Հետադարձ կապ</h4>
            <p><i class="fa-solid fa-envelope"></i> lilithlazaryan23@gmail.com</p>
            <p><i class="fa-solid fa-phone"></i> +374 93 47 09 95</p>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="hr-line"></div>
        <div class="bottom-content">
            <img src="{{ asset('storage/images/main/ChatGPT Image Jan 5, 2026, 08_26_14 PM.png') }}" class="footer-logo-img" alt="Logo">
        </div>
    </div>

</footer>
