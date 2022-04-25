<?php

namespace App\Http\Middleware;

use Closure;

class SecureHeaders
{
    // Enumerate headers which you do not want in your application's responses.
    // Great starting point would be to go check out @Scott_Helme's:
    // https://securityheaders.com/
    private $unwantedHeaderList = [
        'X-Powered-By',
        'Server',
    ];
    public function handle($request, Closure $next)
    {
        $this->removeUnwantedHeaders($this->unwantedHeaderList);
        $response = $next($request);
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
//        $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' site.yandex.net mc.yandex.ru an.yandex.ru api-maps.yandex.ru *.topol.lc topol.lc yastatic.net *.google.com *.gstatic.com pagead2.googlesyndication.com adservice.google.ru www.googletagservices.com; object-src 'self' topol.lc; style-src 'self' 'unsafe-inline' topol.lc www.google.com; img-src 'self' *.topol.lc data: avatars.mds.yandex.net *.yandex.ru *.yandex.net topol.lc *.googlesyndication.com *.google.com; media-src 'self'; frame-src 'self' *.yandex.ru st.yandexadexchange.net yastatic.net *.google.com *.gstatic.com *.youtube.com googleads.g.doubleclick.net; font-src 'self' data: fonts.gstatic.com; connect-src 'self' mc.yandex.ru an.yandex.ru www.google.com *.gstatic.com;"); // Clearly, you will be more elaborate here.
        return $response;
    }
    private function removeUnwantedHeaders($headerList)
    {
        foreach ($headerList as $header)
            header_remove($header);
    }
}
