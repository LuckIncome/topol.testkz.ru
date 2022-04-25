<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="@yield('page_class')" data-ng-app="topol">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5NND4ND"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@include('partials.header')
<div class="preloader-wrapper">
    <div class="preloader">
        <span class="char">t</span>
        <span class="char">o</span>
        <span class="char">p</span>
        <span class="char">o</span>
        <span class="char">l</span>
    </div>
</div>
<main id="main">
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>
</main>
@include('partials.footer')
@include('partials.modals')
@include('partials.scripts')
</body>
</html>