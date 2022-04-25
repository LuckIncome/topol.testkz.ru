<?php

namespace App\Http\Controllers;

use App\Faq;
use App\Normative;
use App\Page;
use Illuminate\Http\Request;

class InfosController extends Controller
{
    public function index()
    {
        $pages = Page::where('type','info')->where('slug','!=','terms')->where('status',Page::STATUS_ACTIVE)->orderBy('sort_id')->get();


        return view('pages.info',compact('pages'));
    }

    public function show(Page $page)
    {
        if ($page->slug == 'terms'){
            return redirect()->route('page.terms');
        }
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $gallery = json_decode($page->gallery);
        $images = [];
        $pages = Page::where('type','info')->where('slug','!=','terms')->where('status',Page::STATUS_ACTIVE)->orderBy('sort_id')->get()->each(function ($item){
            $item->setAttribute('url',route('info.show', $item));
        });
        if ($gallery) {
            foreach ($gallery as $item){
                $images[] = ['original'=> \Voyager::image($page->getThumbnail($item,'big')),'webp' => str_replace('.' . pathinfo(\Voyager::image($item),PATHINFO_EXTENSION), '.webp', \Voyager::image($item))];
            }
        }
        $page = $page->translate($locale,$fallbackLocale);

        if ($page->slug == 'normativnaya-baza'){

            $normatives = Normative::where('active',true)->orderBy('sort_id')->get()->each(function ($cert) {
                if (count(json_decode($cert->link)))
                    $cert->setAttribute('file', \Voyager::image(json_decode($cert->link)[0]->download_link));
            });

            return view('pages.normatives',compact('page','normatives', 'pages'));

        }elseif (strpos($page->slug, 'faq') !== false){

            $faqs = Faq::where('active',true)->orderBy('sort_id')->get();

            return view('pages.faqs',compact('page','faqs','pages'));
        }

        return view('pages.infoShow', compact('page','images','pages'));
    }
}
