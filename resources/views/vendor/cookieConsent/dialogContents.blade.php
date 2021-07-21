<div class="js-cookie-consent cookie-consent">

    <span class="cookie-consent__message">
        {!! trans('cookieConsent::texts.message') !!}
    </span>
    <span class="cookie-consent__message">
        <a href="{{url("/politica-cookies")}}"> Política de Cookies</a>
    </span>
    <button class="js-cookie-consent-agree cookie-consent__agree button button-medium">
        {{ trans('cookieConsent::texts.agree') }}
    </button>

</div>
