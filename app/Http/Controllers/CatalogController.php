<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Sale;
use App\Service;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->where('active', true)->orderBy('order')->get();

        return view('catalog.main', compact('categories'));
    }

    public function showCatalog(Category $category,$cats = null)
    {
        $categories = Category::whereNull('parent_id')->where('active', true)->orderBy('order')->get();

        $catsArray = explode('/', $cats);
        if (is_null($cats)) {
            if ($category->slug == 'uslugi') {
                return $this->services($category, $categories);
            }

            if ($category->slug == 'akcii') {
                return $this->sales($category, $categories);
            }
            $current_category = $category;
            return view('catalog.products', compact('current_category', 'categories'));
        }
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');

        if ($category->slug == 'uslugi') {
            $service = Service::whereSlug(array_pop($catsArray))->where('active', true)->firstOrFail();
            $gallery = json_decode($service->gallery);
            $images = [];
            if ($gallery) {
                foreach ($gallery as $item) {
                    $images[] = ['original' => \Voyager::image($service->getThumbnail($item, 'big')), 'webp' => str_replace('.' . pathinfo(\Voyager::image($item), PATHINFO_EXTENSION), '.webp', \Voyager::image($item))];
                }
            }
            $service = $service->translate($locale, $fallbackLocale);
            return view('services.show', compact('category', 'service', 'images'));
        }

        if ($category->slug == 'akcii') {
            $sale = Sale::whereSlug(array_pop($catsArray))->where('active', true)->firstOrFail();
            $gallery = json_decode($sale->gallery);
            $images = [];
            if ($gallery) {
                foreach ($gallery as $item) {
                    $images[] = ['original' => \Voyager::image($sale->getThumbnail($item, 'big')), 'webp' => str_replace('.' . pathinfo(\Voyager::image($item), PATHINFO_EXTENSION), '.webp', \Voyager::image($item))];
                }
            }
            $sale = $sale->translate($locale, $fallbackLocale);
            return view('sales.show', compact('category', 'sale', 'images'));
        }


        $current_category = Category::with('categories')
            ->where('slug', array_pop($catsArray))
            ->first();
        if (is_null($current_category)) {
            return $this->showProductPage($category,$cats);
        }

        $categories = Category::with('categories')->where('parent_id', $current_category->parent->id)->orderBy('order')->get();

        if ($current_category->link != '/catalog/'.$category->slug .'/'. $cats) {
            return redirect(url(env('APP_URL') . $current_category->link));
        }

        $products = $current_category->allProducts ?? null;


        return view('catalog.products', compact('categories', 'products', 'current_category'));
    }

    public function showProductPage($category,$cats)
    {
        $catsArray = explode('/', $cats);
        $product = Product::where('slug', array_pop($catsArray))->where('active', true)->firstOrFail();
        if ($product->link != '/catalog/'.$category->slug .'/'. $cats) {
            return redirect(url(env('APP_URL') . $product->link));
        }
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $product->webp = $product->image;
        $product = $product->translate($locale, $fallbackLocale);
        $product->features = collect(unserialize($product->features))->groupBy('group');

        return view('catalog.product', compact( 'product'));
    }

    public function services($category, $categories)
    {
        $services = Service::where('active', true)->orderBy('sort_id')->get();

        return view('services.index', compact('services', 'category', 'categories'));
    }

    public function sales($category, $categories)
    {

        $sales = Sale::where('active', true)->orderBy('sort_id')->get();

        return view('sales.index', compact('sales', 'category', 'categories'));
    }

    public function getCurrentCategory($slug)
    {
        $category = Category::with('translations')->with('parent')->where('slug', $slug)->first();
        $category = $category->translate(session()->get('locale'), config('app.fallback_locale'));
        return response()->json(['category' => $category]);
    }

    public function getAjaxProducts($categoryId)
    {
        $locale = session()->get('locale');
        $fallbacklocale = config('app.fallback_locale');
        $products = Product::where('category_id', $categoryId)->where('active', true)->orderBy('sort_id')->get();
        $category = Category::find($categoryId);
        $filterables = json_decode($category->filters);
        if ($filterables && in_array('Бренд',$filterables)){
            array_push($filterables,'brand');
        }
        $options = [];
        if ($products->count()) {
            foreach ($products as $product) {
                $product->getAttributes();
                $product->setAttribute('image_link', \Voyager::image($product->thumbnail('big', 'image')));
                $product->setAttribute('webp_link', $product->webpImage);
                $product->setAttribute('web_link', $product->link);
                $productT = $product->translate($locale, $fallbacklocale);
                foreach (unserialize($productT->specifications) as $option) {
                    if ($option['name'] != null && $option['value'] != null) {
                        if (!in_array($option, $options))
                            array_push($options, $option);
                        $product->setAttribute($option['name'] ? $option['name'] : "", $option['value'] ? $option['value'] : '');

                    }
                }
                foreach (unserialize($productT->features) as $option) {
                    if ($option['name'] != null && $option['value'] != null) {
                        if (!in_array($option, $options))
                            array_push($options, $option);
                        $product->setAttribute($option['name'] ? $option['name'] : "", $option['value'] ? $option['value'] : '');
                    }
                }
            }
            $products = $products->translate($locale, $fallbacklocale);
            $brands = $products->groupBy('brand')->keys();
            $options_key = collect($options)->groupBy('name')->keys();
            $options = collect($options)->unique('value')->groupBy('name');
            $result_options = [];
            foreach ($brands as $brand) {
                $result_options['brand'][$brand] = false;
            }
            foreach ($options as $key => $option) {
                $result_options[$key] = [];
                foreach ($option as $item) {
                    if (!array_key_exists($item['value'], array_keys($result_options[$key]))) {
                        $result_options[$key][$item['value']] = false;
                    }
                }
            }
            if ($filterables != null || $filterables != []) {
                foreach ($result_options as $k => $opt) {
                    ksort($result_options[$k]);
                    $optKeys = array_unique(array_keys($opt));
                    foreach ($optKeys as $optKey) {
                        $result_options[$k][$optKey] = false;
                    }
//                if (count($result_options[$k]) < 3 && $k != 'brand') {
//                    unset($result_options[$k]);
//                }
                    if (!in_array($k,$filterables)){
                        unset($result_options[$k]);
                    }
                }
            }else {
                foreach ($result_options as $k => $opt) {
                    ksort($result_options[$k]);
                    $optKeys = array_unique(array_keys($opt));
                    foreach ($optKeys as $optKey) {
                        $result_options[$k][$optKey] = false;
                    }
                if (count($result_options[$k]) < 3 && $k != 'brand') {
                    unset($result_options[$k]);
                }
//                    if (!in_array($k,$filterables)){
//                        unset($result_options[$k]);
//                    }
                }
            }

            return response()->json(['products' => $products, 'options_key' => $options_key, 'options' => $options, 'brands' => $brands, 'filters' => $result_options]);
        } else {
            return response()->json(['products' => null]);
        }

    }
}
