<?php

namespace App\Http\Controllers;

use App\Advantage;
use App\Category;
use App\Cert;
use App\Client;
use App\HomeSlider;
use App\Partner;
use App\Post;
use App\Product;
use App\Program;
use App\Project;
use App\Review;
use App\Sale;
use App\Service;
use App\Subscriber;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Page;


class PagesController extends Controller
{

    public function home()
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $homeSliders = HomeSlider::where('active', true)->orderBy('sort_id')->get();
        $homeSliders = $homeSliders->translate($locale, $fallbackLocale);

        $advantages = Advantage::where('active', true)->orderBy('sort_id')->get();
        $advantages = $advantages->translate($locale, $fallbackLocale);

        $partners = Partner::where('active', true)->whereNotNull('image')->orderBy('sort_id')->get();
        $partners = $partners->translate($locale, $fallbackLocale);

        $posts = Post::where('status', Post::PUBLISHED)->orderBy('featured', 'DESC')->orderBy('date', 'DESC')->take(3)->get();

        $projects = Project::where('active', true)->where('featured', true)->orderBy('created_at')->take(3)->get();
        $about = Page::where('slug', 'o-kompanii')->orWhere('id', 3)->where('status', Page::STATUS_ACTIVE)->first();
        $about->webp = $about->image;

        $categories = Category::with('categories')
            ->where('active', true)
            ->whereNull('parent_id')
            ->where('slug', '!=', 'akcionnyj-tovar')
            ->orderBy('order')->get();

        $services = Service::where('active', true)->orderBy('sort_id')->take(8)->get();
        $sales = Sale::where('active', true)->orderBy('sort_id')->take(8)->get();

        return view('home', compact('homeSliders', 'advantages', 'partners', 'posts', 'projects', 'about', 'categories', 'services', 'sales'));
    }

    public function terms()
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');

        $page = Page::where('slug', 'terms')->orWhere('id', 1)->where('status', Page::STATUS_ACTIVE)->first();
        $page->webp = $page->image;
        $page = $page->translate($locale, $fallbackLocale);
        return view('pages.terms', compact('page'));
    }


    public function about()
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');

        $page = Page::where('slug', 'o-kompanii')->orWhere('id', 3)->where('status', Page::STATUS_ACTIVE)->first();
        $pages = Page::where('type', 'about')->where('slug', '!=', 'o-kompanii')->where('status', Page::STATUS_ACTIVE)->orderBy('sort_id')->get();

        $advantages = Advantage::where('active', true)->orderBy('sort_id')->get();
        $advantages = $advantages->translate($locale, $fallbackLocale);

        return view('pages.about', compact('page', 'pages', 'advantages'));
    }

    public function show(Page $page)
    {
        if ($page->slug == 'o-kompanii') {
            return redirect(route('pages.about'), 301);
        }
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $gallery = json_decode($page->gallery);
        $images = [];
        $pages = Page::where('type', 'about')->where('status', Page::STATUS_ACTIVE)->orderBy('sort_id')->get();
        if ($gallery) {
            foreach ($gallery as $item) {
                $images[] = ['original' => \Voyager::image($page->getThumbnail($item, 'big')), 'webp' => str_replace('.' . pathinfo(\Voyager::image($item), PATHINFO_EXTENSION), '.webp', \Voyager::image($item))];
            }
        }

        $exclude = ['obuchenie', 'nashi-proekty', 'o-kompanii'];
        if (!in_array($page->slug, $exclude)) {
            $page = $page->translate($locale, $fallbackLocale);

            if (strpos($page->slug, 'partnery') !== false) {
                return $this->partners();

            } elseif (strpos($page->slug, 'zakazchiki') !== false) {
                return $this->clients();
            } elseif (strpos($page->slug, 'licenzii') !== false) {
                return $this->certs();
            } elseif (strpos($page->slug, 'otzyvy') !== false) {
                return $this->reviews();
            } elseif (strpos($page->slug, 'vakansii') !== false) {
                return $this->jobs($page->slug);
            }

            return view('pages.aboutShow', compact('page', 'images', 'pages'));
        }

    }

    public function partners()
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');

        $partners = Partner::where('active', true)->whereNotNull('image')->orderBy('sort_id')->get();
        $partners = $partners->translate($locale, $fallbackLocale);
        $exclude = ['obuchenie', 'nashi-proekty', 'o-kompanii'];
        $pages = Page::where('type', 'about')->where('status', Page::STATUS_ACTIVE)->orderBy('sort_id')->get()->each(function ($item) use ($exclude) {
            if (!in_array($item->slug, $exclude)) {
                $item->url = route('about.show', $item);
            } else {
                if ($item->slug == 'o-kompanii') {
                    $item->url = route('pages.about');
                } else {
                    $item->url = ($item->slug == 'obuchenie') ? route('programs.index') : route('projects.index');
                }
            }
        });
        $pages = $pages->translate($locale, $fallbackLocale);

        $page = Page::where('slug', 'nashi-partnery')->first();
        $page = $page->translate($locale, $fallbackLocale);
        $isClientsPage = false;

        return view('pages.partners', compact('partners', 'page', 'pages', 'isClientsPage'));
    }

    public function clients()
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $exclude = ['obuchenie', 'nashi-proekty', 'o-kompanii'];
        $clients = Client::where('active', true)->whereNotNull('image')->orderBy('sort_id')->get();
        $partners = $clients->translate($locale, $fallbackLocale);

        $pages = Page::where('type', 'about')->where('status', Page::STATUS_ACTIVE)->orderBy('sort_id')->get()->each(function ($item) use ($exclude) {
            if (!in_array($item->slug, $exclude)) {
                $item->url = route('about.show', $item);
            } else {
                if ($item->slug == 'o-kompanii') {
                    $item->url = route('pages.about');
                } else {
                    $item->url = ($item->slug == 'obuchenie') ? route('programs.index') : route('projects.index');
                }
            }
        });
        $pages = $pages->translate($locale, $fallbackLocale);

        $page = Page::where('slug', 'zakazchiki')->first();
        $page = $page->translate($locale, $fallbackLocale);
        $isClientsPage = true;
        return view('pages.partners', compact('partners', 'page', 'pages', 'isClientsPage'));
    }

    public function certs()
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $exclude = ['obuchenie', 'nashi-proekty', 'o-kompanii'];
        $certs = Cert::where('active', true)->orderBy('sort_id')->get()->each(function ($cert) {
            if (count(json_decode($cert->link)))
                $cert->setAttribute('file', \Voyager::image(json_decode($cert->link)[0]->download_link));
        });
        $certs = $certs->translate($locale, $fallbackLocale);


        $pages = Page::where('type', 'about')->where('status', Page::STATUS_ACTIVE)->orderBy('sort_id')->get()->each(function ($item) use ($exclude) {
            if (!in_array($item->slug, $exclude)) {
                $item->url = route('about.show', $item);
            } else {
                if ($item->slug == 'o-kompanii') {
                    $item->url = route('pages.about');
                } else {
                    $item->url = ($item->slug == 'obuchenie') ? route('programs.index') : route('projects.index');
                }
            }
        });
        $pages = $pages->translate($locale, $fallbackLocale);

        $page = Page::where('slug', 'licenzii-i-sertifikaty')->first();
        $page = $page->translate($locale, $fallbackLocale);

        return view('pages.certs', compact('certs', 'pages', 'page'));
    }

    public function reviews()
    {

        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $exclude = ['obuchenie', 'nashi-proekty', 'o-kompanii'];
        $reviews = Review::where('active', true)->orderBy('sort_id')->get()->each(function ($review) {
            $review->thumbnailSmall = $review->image;
        });


        $pages = Page::where('type', 'about')->where('status', Page::STATUS_ACTIVE)->orderBy('sort_id')->get()->each(function ($item) use ($exclude) {
            if (!in_array($item->slug, $exclude)) {
                $item->url = route('about.show', $item);
            } else {
                if ($item->slug == 'o-kompanii') {
                    $item->url = route('pages.about');
                } else {
                    $item->url = ($item->slug == 'obuchenie') ? route('programs.index') : route('projects.index');
                }
            }
        });
        $pages = $pages->translate($locale, $fallbackLocale);

        $page = Page::where('slug', 'otzyvy')->first();
        $page = $page->translate($locale, $fallbackLocale);

        return view('pages.reviews', compact('reviews', 'page', 'pages'));
    }

    public function jobs($slug)
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $exclude = ['obuchenie', 'nashi-proekty', 'o-kompanii'];
        $pages = Page::where('type', 'about')->where('status', Page::STATUS_ACTIVE)->orderBy('sort_id')->get()->each(function ($item) use ($exclude) {
            if (!in_array($item->slug, $exclude)) {
                $item->url = route('about.show', $item);
            } else {
                if ($item->slug == 'o-kompanii') {
                    $item->url = route('pages.about');
                } else {
                    $item->url = ($item->slug == 'obuchenie') ? route('programs.index') : route('projects.index');
                }
            }
        });
        $pages = $pages->translate($locale, $fallbackLocale);

        $page = Page::where('slug', $slug)->first();
        $page = $page->translate($locale, $fallbackLocale);


        return view('pages.jobs', compact('page', 'pages'));
    }

    public function contacts()
    {
        return view('pages.contacts');
    }

    public function search(Request $request)
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $input = $request->get('input');
        $categories = Category::search($input)->whereNotNull('parent_id')->select('name', 'slug', 'excerpt', 'parent_id')->get();
        $products = Product::search($input)->select('name', 'brand', 'slug', 'category_id', 'image', 'excerpt')->with('category')->get();
        $pages = Page::search($input)->select('title', 'slug', 'excerpt', 'type')->get();
        $posts = Post::search($input)->select('title', 'slug', 'excerpt', 'created_at')->get();
        $projects = Project::search($input)->select('title', 'slug', 'excerpt', 'category')->get();
        $programs = Program::search($input)->select('title', 'slug', 'excerpt')->get();
        $sales = Sale::search($input)->select('title', 'slug', 'excerpt', 'period')->get();
        $services = Service::search($input)->select('title', 'slug', 'excerpt')->get();

        $collection = collect($pages)->merge($products)->merge($categories)->merge($posts)->merge($sales)->merge($services)->merge($programs)->merge($projects);
        foreach ($collection as $item) {
            switch (class_basename($item)) {
                case 'Category':
                    $item->setAttribute('full_link', env('APP_URL') . $item->link);
                    $item->setAttribute('item', __('general.catalogTitle'));
                    $item->name = $item->getTranslatedAttribute('name', $locale, $fallbackLocale);
                    $item->excerpt = $item->getTranslatedAttribute('excerpt', $locale, $fallbackLocale);
                    $item->setAttribute('date', null);
                    break;
                case 'Product':
                    $item->setAttribute('full_link', env('APP_URL') . $item->link);
                    $item->thumbnailSmall = $item->image;
                    $item->setAttribute('date', null);
                    $item->name = $item->getTranslatedAttribute('name', $locale, $fallbackLocale);
                    $item->excerpt = $item->getTranslatedAttribute('excerpt', $locale, $fallbackLocale);
                    $item->setAttribute('item', __('general.product'));
                    break;
                case 'Page':
                    $link = $item->type == 'info' ? '/poleznaya-informaciya/' : '/o-kompanii/';
                    $item->setAttribute('full_link', env('APP_URL') . $link . $item->slug);
                    $item->title = $item->getTranslatedAttribute('title', $locale, $fallbackLocale);
                    $item->excerpt = $item->getTranslatedAttribute('excerpt', $locale, $fallbackLocale);
                    $item->setAttribute('name', $item->title);
                    $item->setAttribute('date', null);
                    $item->setAttribute('item', __('general.page'));
                    break;
                case 'Post':
                    $item->setAttribute('full_link', env('APP_URL') . '/novosti/' . $item->slug);
                    $item->title = $item->getTranslatedAttribute('title', $locale, $fallbackLocale);
                    $item->excerpt = $item->getTranslatedAttribute('excerpt', $locale, $fallbackLocale);
                    $item->setAttribute('name', $item->title);
                    $item->setAttribute('date', Carbon::parse($item->created_at)->translatedFormat('d F Y'));
                    $item->setAttribute('item', __('general.post'));
                    break;
                case 'Sale':
                    $item->setAttribute('full_link', env('APP_URL') . '/catalog/akcii/' . $item->slug);
                    $item->title = $item->getTranslatedAttribute('title', $locale, $fallbackLocale);
                    $item->excerpt = $item->getTranslatedAttribute('excerpt', $locale, $fallbackLocale);
                    $item->setAttribute('name', $item->title);
                    $item->setAttribute('date', $item->period);
                    $item->setAttribute('item', __('general.sale'));
                    break;
                case 'Service':
                    $item->setAttribute('full_link', env('APP_URL') . '/catalog/uslugi/' . $item->slug);
                    $item->title = $item->getTranslatedAttribute('title', $locale, $fallbackLocale);
                    $item->excerpt = $item->getTranslatedAttribute('excerpt', $locale, $fallbackLocale);
                    $item->setAttribute('name', $item->title);
                    $item->setAttribute('date', null);
                    $item->setAttribute('item', __('general.service'));
                    break;
                case 'Program':
                    $item->setAttribute('full_link', env('APP_URL') . '/o-kompanii/obuchenie/' . $item->slug);
                    $item->title = $item->getTranslatedAttribute('title', $locale, $fallbackLocale);
                    $item->excerpt = $item->getTranslatedAttribute('excerpt', $locale, $fallbackLocale);
                    $item->setAttribute('name', $item->title);
                    $item->setAttribute('date', null);
                    $item->setAttribute('item', __('general.programs'));
                    break;
                case 'Project':
                    $item->setAttribute('full_link', env('APP_URL') . '/o-kompanii/nashi-proekty/' . $item->slug);
                    $item->title = $item->getTranslatedAttribute('title', $locale, $fallbackLocale);
                    $item->excerpt = $item->getTranslatedAttribute('excerpt', $locale, $fallbackLocale);
                    $item->setAttribute('name', $item->title);
                    $item->setAttribute('date', $item->category);
                    $item->setAttribute('item', __('general.project'));
                    break;
            }
        }
//        $collection = $collection->sortBy('name');
        if ($request->wantsJson()) {
            return response()->json(['items' => $collection->take(10)]);
        } else {
            $items = $this->paginate($collection, 6, null, ['path' => '/search?input=' . $input]);

            return view('pages.search', compact('items', 'input'));
        }
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    public function setLocale($locale)
    {

        if (in_array($locale, config()->get('app.locales'))) {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }

    public function popupCallback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'agreement' => 'required',
            recaptchaFieldName() => recaptchaRuleName()
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false], 400);
        }
        if($request->has('comment') && $request->comment != strip_tags($request->comment)) {
            return response()->json(['success' => false], 400);
        }
        $users = User::where('role_id', 1)->select('email')->get()->pluck('email')->toArray();
        $firstUser = $users[0];
        if (($key = array_search($firstUser, $users)) !== false) {
            unset($users[$key]);
        }
        $comment = $request->has('comment') ? $request->comment : null;
        $email = array_key_exists('email', $request->all()) ? $request->email : null;
        $page = array_key_exists('page', $request->all()) ? $request->page : null;
        $pageLink = array_key_exists('pageLink', $request->all()) ? $request->pageLink : null;
        Mail::send('emails.callback', [
            'name' => $request->name,
            'phone' => $request->phone,
            'comment' => $comment,
            'e_mail' => $email,
            'page' => $page,
            'pageLink' => $pageLink,
        ], function ($m) use ($users, $firstUser) {
            $m->to($firstUser)
                ->subject('Новая заявка на Обратный звонок');
        });

        return response()->json(['success' => true], 200);

    }

    public function newSubscriber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            recaptchaFieldName() => recaptchaRuleName()
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false], 400);
        }

        if (Subscriber::where('email', $request->email)->exists()) {
            return response()->json(['success' => false, 'message' => __('general.alreadySubscribed')]);
        } else {
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->save();
        }

        return response()->json(['success' => true],200);
    }

    public function sitemapPage()
    {
        $services = Service::where('active', true)->orderBy('sort_id')->get();
        $sales = Sale::where('active', true)->orderBy('sort_id')->get();
        $categories = Category::where('parent_id', null)->where('active', true)->orderBy('order')->get();

        $infoPages = Page::where('type', 'info')->where('status', Page::STATUS_ACTIVE)->orderBy('sort_id')->get();
        $aboutPages = Page::where('type', 'about')->where('status', Page::STATUS_ACTIVE)->orderBy('sort_id')->get();

        return view('pages.sitemap', compact('services', 'sales', 'categories', 'infoPages', 'aboutPages'));
    }
}
