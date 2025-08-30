<style>
    #header {
        background: #002e6d;
        text-align: center;
        align-items: center;
        justify-content: center;
        display: flex;
        margin: auto;
        position: fixed;
        width: 100%;
        top: 0px;
        z-index: 9;
    }

    .logo img {
        max-width: 416px;
        height: 132px !important;
    }

</style>

<div id="header">
    <div class="logo">
        <a href="{{ url('/') }}"><img src="{{ asset('assets/images/ask-logo.png') }}" /></a>
    </div>
</div>
