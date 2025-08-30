<style>
    @media (max-width: 768px) {
        .footer-35d .footer-9z1 aside.wid-6bk {
            width: 100%;
        }
    }

    .footer-9z1 #men-54n li a,
    .footer-9z1 #men-er1 li a,
    .footer-35d a,
    .footer-35d .icon-fn7:hover,
    .footer-35d .footer-9z1 aside.wid-6bk .title-opx h4,
    .footer-35d {
        font-size: 16px !important;
    }

    .wid-6bk.footer-8vj ul li {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 2px;
        color: #000000 !important;
    }

    .address span {
        display: block;
        min-width: 100px;
        color: #000000;
    }

    .address .fa {
        color: black !important;
    }

    .footer-icon {
        left: 3px;
        top: -1px;

        position: relative;
        font-size: 26px;
    }

    #fixedFooter {
        position: fixed;
        bottom: 0px;
        width: 100%;
        z-index: 9;
    }

    @media(max-width:542px) {
        .container-9zp {
            text-align: center;
            justify-content: center;
            display: flex;
            flex-direction: column;
        }

    }

</style>

<div class="bg_-3kn text-7nf cle-6ew" id="fixedFooter">
    <div class="container-9zp cle-6ew font-weight-3ik">
        <div class="fs--hoe py-ac9 float-8xn">
            {{ __('app.all_rights_reserved') }} &copy; {{ date('Y') }}
        </div>
        <div class="fs--hoe py-ac9 float-prj" style="text-transform: uppercase">
            <a href="https://evorq.com/" target="_blank" class="text-7nf" id="kodoLink">
                {{ __('app.developed_by') }}
            </a>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <div class="decorative-elements">
            <div class="floating-icon">💻</div>
            <div class="floating-icon">🚀</div>
            <div class="floating-icon">⭐</div>
        </div>

        <button class="close-btn" id="closeBtn">&times;</button>

        <div class="modal-content">
            <div class="kodo-logo">
                <img style="width: 82px;" src="https://evorq.com/storage/footer-logo-1-1.png" alt="Evorq Logo">
            </div>
            <h2>{{ __('app.implemented_by_evorq') }}</h2>

            <div class="contact-info">
                <div class="phone">{{ __('app.tareq_mohamed_bn_kalban') }}</div>
                <div class="phone">📞 0501774477</div>
                <div class="website">🌐 <a href="https://evorq.com/" target="_blank">https://evorq.com</a></div>
            </div>

            <div class="modal-info">
                {{ __('app.evorq_company_slogan') }}<br>
                {{ __('app.evorq_description') }}
            </div>
        </div>
    </div>
</div>
