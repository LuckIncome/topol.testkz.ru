<?php

namespace App\Providers;

use App\Category;
use App\Contact;
use App\Filial;
use App\SeoPage;
use App\Service;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use TCG\Voyager\Http\Controllers\ContentTypes\Image;
use TCG\Voyager\Http\Controllers\ContentTypes\MultipleImage;
use TCG\Voyager\Http\Controllers\Controller;
use TCG\Voyager\Http\Controllers\VoyagerController;
use TCG\Voyager\Http\Controllers\VoyagerSettingsController;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VoyagerBaseController::class, \App\Http\Controllers\Voyager\VoyagerBaseController::class);
        $this->app->bind(VoyagerController::class, \App\Http\Controllers\Voyager\VoyagerController::class);
        $this->app->bind(Controller::class, \App\Http\Controllers\Voyager\Controller::class);
        $this->app->bind(VoyagerSettingsController::class, \App\Http\Controllers\Voyager\VoyagerSettingsController::class);
        $this->app->bind(Image::class, \App\Http\Controllers\Voyager\ContentTypes\Image::class);
        $this->app->bind(MultipleImage::class, \App\Http\Controllers\Voyager\ContentTypes\MultipleImage::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view)
        {
            $seo_page = SeoPage::where('slug',\Request::url());
            if ($seo_page->exists()){
                $seoTitle = $seo_page->first()->meta_title ? $seo_page->first()->getTranslatedAttribute('meta_title',session()->get('locale'),config('app.fallback_locale')) : '';
                $keywords = $seo_page->first()->meta_keywords ? $seo_page->first()->getTranslatedAttribute('meta_keywords',session()->get('locale'),config('app.fallback_locale')) : '';
                $description = $seo_page->first()->meta_description ? $seo_page->first()->getTranslatedAttribute('meta_description',session()->get('locale'),config('app.fallback_locale')) : '';
            }else {
                $seoTitle = '';
                $keywords = '';
                $description = '';
            }

            $view->with('seoTitle', $seoTitle);
            $view->with('keywords', $keywords);
            $view->with('description', $description);

            $locale = session()->get('locale');
            $fallbackLocale = config('app.fallback_locale');

            $socials = Contact::where('type','social')->where('active',true)->orderBy('sort_id')->take(3)->get();
            foreach ($socials as $social){
                if (strpos(strtolower($social->value), 'twitter') !== false){
                    $social->setAttribute('name','twitter');
                }
                if (strpos(strtolower($social->value), 'telegram') !== false){
                    $social->setAttribute('name','telegram');
                }
                if (strpos(strtolower($social->value), 'instagram') !== false){
                    $social->setAttribute('name','instagram');
                }
                if (strpos(strtolower($social->value), 'facebook') !== false){
                    $social->setAttribute('name','facebook');
                }
                if (strpos(strtolower($social->value), 'vk') !== false){
                    $social->setAttribute('name','vk');
                }
            }
            $view->with('socials',$socials);
            $view->with('locale',$locale);
            $view->with('fallbackLocale',$fallbackLocale);

            $graph = Contact::where('type','graph')->where('is_main',true)->where('active',true)->orderBy('sort_id')->first();
            $graph = $graph->translate($locale,$fallbackLocale);
            $view->with('graph',$graph);

            $phones = Contact::where('type','phone')->where('filial',1)->where('active',true)->orderBy('sort_id')->get();
            $phones = $phones->translate($locale,$fallbackLocale);
            $view->with('phones',$phones);

            $footerPhones = Contact::where('type','footer_phone')->where('active',true)->orderBy('sort_id')->get();
            $footerPhones = $footerPhones->translate($locale,$fallbackLocale);
            $view->with('footerPhones',$footerPhones);

            $email = Contact::where('type','email')->where('is_main',true)->where('active',true)->orderBy('sort_id')->first();
            $email = $email->translate($locale,$fallbackLocale);

            $view->with('email',$email);

           $filials = Filial::with('contacts')->where('active',true)->orderBy('sort_id')->get();

//          foreach ($filials as $filial) {
//              dd($filial->getTranslatedAttribute('name',$locale,$fallbackLocale));
//          }

            $view->with('filials', $filials);

            $categoriesFooter = Category::with('categories')->whereIn('slug',['katalog-produkcii','uslugi'])->where('active',true)->orderBy('order')->take(5)->get();

            $view->with('categoriesFooter',$categoriesFooter);


            $servicesFooter = Service::where('active',true)->orderBy('sort_id')->take(5)->get();
            $view->with('servicesFooter',$servicesFooter);
        });
    }
}
