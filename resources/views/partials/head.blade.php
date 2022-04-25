<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="format-detection" content="telephone=no">
    {{--<meta name="theme-color" content="#3f0e0b"/>--}}
    {{--<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">--}}
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="title" content="@yield('seo_title')"/>
    <link rel="icon" href="/images/icons/favicon.ico?v=28072020">
    <title>@if(strlen($__env->yieldContent('seo_title')) > 2) @yield('seo_title') @else @yield('title') @endif | @lang('general.siteName')</title>
    <link rel="canonical" href="/@yield('url')">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta property="og:title" content="@if(strlen($__env->yieldContent('seo_title')) > 2) @yield('seo_title') @else @yield('title') @endif | @lang('general.siteName')"/>
    <meta property="og:description" content="@yield('meta_description')"/>
    <meta property="og:url" content=@yield('url')/>
    <meta property="og:image" content="@if(strlen($__env->yieldContent('image')) > 2) @yield('image') @else {{ env('APP_URL').'/images/og.jpg'}} @endif"/>
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:width" content="300"/>
    <meta property="og:image:height" content="300"/>
	<meta name="yandex-verification" content="6e93b1efb0a4ede0" />

    <link href="/css/bootstrap.min.css?v=22022021" rel="stylesheet">
    <link href="/css/bootstrap.min.css?v=22022021" rel="preload" as="style">
    <link href="/css/header.min.css?v=24092021" rel="stylesheet">
    <link href="/css/header.min.css?v=24092021" rel="preload" as="style">
    <link href="/css/m-header.min.css?v=24092021" rel="stylesheet">
    <link href="/css/m-header.min.css?v=24092021" rel="preload" as="style">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        // Picture element HTML5 shiv
        document.createElement( "picture" );
    </script>
    <script src="/js/picturefill.min.js" async></script>
    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(72678898, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/72678898" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5NND4ND');</script>
<!-- End Google Tag Manager -->
</head>