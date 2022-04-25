<?php

namespace App\Http\Controllers\Backend;

use App\Exports\OrdersExport;
use App\Imports\ProductImport;
use App\Order;
use App\Product;
use App\ProductOption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class ProductsController extends VoyagerBaseController
{
    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = \Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
            ? new $dataType->model_name()
            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        $variants = Product::all();

        return \Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'variants'));
    }

    public function update(Request $request, $id)
    {
        $name = json_decode($request->get('name_i18n'));
        $excerpt = json_decode($request->get('excerpt_i18n'));
        $description = json_decode($request->get('description_i18n'));
        $seo_title = json_decode($request->get('seo_title_i18n'));
        $meta_keywords = json_decode($request->get('meta_keywords_i18n'));
        $meta_description = json_decode($request->get('meta_description_i18n'));
        $product = Product::find($id);
        $product->name = $name->ru;
        $product->brand = $request->get('brand');
        $product->category_id = $request->get('category_id');
        $product->excerpt = $excerpt->ru;
        $product->description = $description->ru;
        $product->meta_description = $meta_description->ru;
        $product->meta_keywords = $meta_keywords->ru;
        $product->seo_title = $seo_title->ru;
        $product->slug = $request->get('slug');
        if ($request->has('relateds')) {
            $product->relateds = serialize($request->get('relateds'));
        }
        if (!file_exists(public_path('storage/products/' . date('FY') . '/'))) {
            mkdir(public_path('storage/products/' . date('FY') . '/'));
        }

        if ($request->has('image')) {

            $image = $request->file('image');
            $filename = '/products/' . date('FY') . '/' . \Str::random();
            $result_img = \Image::make($image->getRealPath())->encode($image->getClientOriginalExtension(), 100);
            $result_webp = \Image::make($image->getRealPath())->encode('webp');
            $result_thumb = \Image::make($image->getRealPath())->resize(1000,null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode($image->getClientOriginalExtension(), 100);
            $result_thumbWeb = \Image::make($image->getRealPath())->encode('webp')->resize(1000*25/100,null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $result_bigThumb = \Image::make($image->getRealPath())->encode($image->getClientOriginalExtension(), 100)->resize(1000*75/100,null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            \Storage::disk(config('voyager.storage.disk'))->put($filename . '.' . $image->getClientOriginalExtension(), (string)$result_img, 'public');
            \Storage::disk(config('voyager.storage.disk'))->put($filename . '.webp' , (string)$result_webp, 'public');
            \Storage::disk(config('voyager.storage.disk'))->put($filename . '-small.'. $image->getClientOriginalExtension(), (string)$result_thumb, 'public');
            \Storage::disk(config('voyager.storage.disk'))->put($filename . '-big.'. $image->getClientOriginalExtension(), (string)$result_bigThumb, 'public');
            \Storage::disk(config('voyager.storage.disk'))->put($filename . '-small.webp', (string)$result_thumbWeb, 'public');

            $product->image = $filename . '.' . $image->getClientOriginalExtension();
        }

//        if ($request->has('images')) {
//
//            $images = $request->file('images');
//
//            $filenames = [];
//            foreach ($images as $image) {
//                $name = '/products/' . date('FY') . '/' . \Str::random();
//                $result = \Image::make($image->getRealPath())->encode('jpg');
//                $result_thumb = \Image::make($image->getRealPath())->encode('jpg')->resize(null, 90, function ($constraint) {
//                    $constraint->aspectRatio();
//                    $constraint->upsize();
//                });
//                $result_thumbWeb = \Image::make($image->getRealPath())->encode('webp')->resize(null, 90, function ($constraint) {
//                    $constraint->aspectRatio();
//                    $constraint->upsize();
//                });
//                $filenames[] = $name . '.' . $image->getClientOriginalExtension();
//                \Storage::disk(config('voyager.storage.disk'))->put($name . '.' . $image->getClientOriginalExtension(), (string)$result, 'public');
//                \Storage::disk(config('voyager.storage.disk'))->put($name . '-small.'. $image->getClientOriginalExtension(), (string)$result_thumb, 'public');
//                \Storage::disk(config('voyager.storage.disk'))->put($name . '-small.webp', (string)$result_thumbWeb, 'public');
//            }
//
//            $product->images = json_encode($filenames);
//
//
//        }

        /*CHARACTERISTICS SPECIFICATIONS START*/
        $charsRu = [];
        $charvaluesRu = [];
        $characteristicsRu = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'charRu_value') !== false) {
                $charvaluesRu[] = $request->get($key);
            }
            if (strpos($key, 'charRu') !== false && strpos($key, 'charRu_value') === false) {
                $charsRu[] = $request->get($key);
            }
        }
        foreach ($charsRu as $k => $char) {
            $characteristicsRu[] = ['name' => $charsRu[$k], 'value' => $charvaluesRu[$k]];
        }

        $product->specifications = serialize($characteristicsRu);

        $charsKz = [];
        $charvaluesKz = [];
        $characteristicsKz = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'charKz_value') !== false) {
                $charvaluesKz[] = $request->get($key);
            }
            if (strpos($key, 'charKz') !== false && strpos($key, 'charKz_value') === false) {
                $charsKz[] = $request->get($key);
            }
        }
        foreach ($charsKz as $k => $char) {
            $characteristicsKz[] = ['name' => $charsKz[$k], 'value' => $charvaluesKz[$k]];
        }
        $name = json_decode($request->get('name_i18n'));
        $excerpt = json_decode($request->get('excerpt_i18n'));
        $description = json_decode($request->get('description_i18n'));
        $seo_title = json_decode($request->get('seo_title_i18n'));
        $meta_keywords = json_decode($request->get('meta_keywords_i18n'));
        $meta_description = json_decode($request->get('meta_description_i18n'));

        $productTKz = $product->translate('kz');
        $productTKz->specifications = serialize($characteristicsKz);
        $productTKz->name = $name->kz;
        $productTKz->excerpt = $excerpt->kz;
        $productTKz->description = $description->kz;
        $productTKz->meta_description = $meta_description->kz;
        $productTKz->meta_keywords = $meta_keywords->kz;
        $productTKz->seo_title = $seo_title->kz;


        $charsEn = [];
        $charvaluesEn = [];
        $characteristicsEn = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'charEn_value') !== false) {
                $charvaluesEn[] = $request->get($key);
            }
            if (strpos($key, 'charEn') !== false && strpos($key, 'charEn_value') === false) {
                $charsEn[] = $request->get($key);
            }
        }
        foreach ($charsEn as $k => $char) {
            $characteristicsEn[] = ['name' => $charsEn[$k], 'value' => $charvaluesEn[$k]];
        }
        $name = json_decode($request->get('name_i18n'));
        $excerpt = json_decode($request->get('excerpt_i18n'));
        $description = json_decode($request->get('description_i18n'));
        $seo_title = json_decode($request->get('seo_title_i18n'));
        $meta_keywords = json_decode($request->get('meta_keywords_i18n'));
        $meta_description = json_decode($request->get('meta_description_i18n'));

        $productTEn = $product->translate('en');
        $productTEn->specifications = serialize($characteristicsEn);
        $productTEn->name = $name->en;
        $productTEn->excerpt = $excerpt->en;
        $productTEn->description = $description->en;
        $productTEn->meta_description = $meta_description->en;
        $productTEn->meta_keywords = $meta_keywords->en;
        $productTEn->seo_title = $seo_title->en;
        /*CHARACTERISTICS SPECIFICATIONS END*/

        /*FEATURES START*/

        $featuresGroupRu = [];
        $featuresNameRu = [];
        $featuresValuesRu = [];
        $featuresRu = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'featureRu_value') !== false) {
                $featuresValuesRu[] = $request->get($key);
            }
            if (strpos($key, 'featureRu_name') !== false) {
                $featuresNameRu[] = $request->get($key);
            }
            if (strpos($key, 'featureRu_group') !== false) {
                $featuresGroupRu[] = $request->get($key);
            }
        }
        foreach ($featuresNameRu as $k => $feature) {
            $featuresRu[] = ['name' => $featuresNameRu[$k], 'value' => $featuresValuesRu[$k], 'group' =>  $featuresGroupRu[$k]];
        }

        $product->features = serialize($featuresRu);
        $product->update();

        $featuresGroupKz = [];
        $featuresNameKz = [];
        $featuresValuesKz = [];
        $featuresKz = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'featureKz_value') !== false) {
                $featuresValuesKz[] = $request->get($key);
            }
            if (strpos($key, 'featureKz_name') !== false) {
                $featuresNameKz[] = $request->get($key);
            }
            if (strpos($key, 'featureKz_group') !== false) {
                $featuresGroupKz[] = $request->get($key);
            }
        }
        foreach ($featuresNameKz as $k => $feature) {
            $featuresKz[] = ['name' => $featuresNameKz[$k], 'value' => $featuresValuesKz[$k], 'group' =>  $featuresGroupKz[$k]];
        }

        $productTKz->features = serialize($featuresKz);
        $productTKz->save();

        $featuresGroupEn = [];
        $featuresNameEn = [];
        $featuresValuesEn = [];
        $featuresEn = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'featureEn_value') !== false) {
                $featuresValuesEn[] = $request->get($key);
            }
            if (strpos($key, 'featureEn_name') !== false) {
                $featuresNameEn[] = $request->get($key);
            }
            if (strpos($key, 'featureEn_group') !== false) {
                $featuresGroupEn[] = $request->get($key);
            }
        }
        foreach ($featuresNameEn as $k => $feature) {
            $featuresEn[] = ['name' => $featuresNameEn[$k], 'value' => $featuresValuesEn[$k], 'group' =>  $featuresGroupEn[$k]];
        }

        $productTEn->features = serialize($featuresEn);
        $productTEn->save();

        /*FEATURES END*/


        $variations = $request->get('relateds');
        if ($request->has('variations')){
            Product::whereIn('id', $request->get('relateds'))->each(function ($item) use ($product, $variations) {
                if ($item && ($key = array_search($item->id, $variations)) !== false) {
                    unset($variations[$key]);
                }
                array_push($variations, (string)$product->id);
                $item->relateds = serialize(array_values($variations));
                $item->update();
            });

        }

        return redirect()
            ->route("voyager.products.index")
            ->with([
                'message' => __('voyager::generic.successfully_updated') . " {$product->name}",
                'alert-type' => 'success',
            ]);
    }

    public function store(Request $request)
    {
        $name = json_decode($request->get('name_i18n'));
        $excerpt = json_decode($request->get('excerpt_i18n'));
        $description = json_decode($request->get('description_i18n'));
        $seo_title = json_decode($request->get('seo_title_i18n'));
        $meta_keywords = json_decode($request->get('meta_keywords_i18n'));
        $meta_description = json_decode($request->get('meta_description_i18n'));

        $product = new Product();
        $product->name = $name->ru;
        $product->brand = $request->get('brand');
        $product->category_id = $request->get('category_id');
        $product->excerpt = $excerpt->ru;
        $product->description = $description->ru;
        $product->meta_description = $meta_description->ru;
        $product->meta_keywords = $meta_keywords->ru;
        $product->seo_title = $seo_title->ru;
        $product->slug = $request->get('slug');
        if ($request->has('relateds')) {
            $product->relateds = serialize($request->get('relateds'));
        }

        if (!file_exists(public_path('storage/products/' . date('FY') . '/'))) {
            mkdir(public_path('storage/products/' . date('FY') . '/'));
        }

        if ($request->has('image')) {

            $image = $request->file('image');
            $filename = '/products/' . date('FY') . '/' . \Str::random();
            $result_img = \Image::make($image->getRealPath())->encode($image->getClientOriginalExtension(), 100);
            $result_webp = \Image::make($image->getRealPath())->encode('webp');
            $result_thumb = \Image::make($image->getRealPath())->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode($image->getClientOriginalExtension(), 100);
            $result_thumbWeb = \Image::make($image->getRealPath())->encode('webp')->resize(1000*25/100, null,  function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $result_bigThumb = \Image::make($image->getRealPath())->encode($image->getClientOriginalExtension(), 100)->resize(1000*75/100,null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            \Storage::disk(config('voyager.storage.disk'))->put($filename . '.' . $image->getClientOriginalExtension(), (string)$result_img, 'public');
            \Storage::disk(config('voyager.storage.disk'))->put($filename . '.webp' , (string)$result_webp, 'public');
            \Storage::disk(config('voyager.storage.disk'))->put($filename . '-small.'. $image->getClientOriginalExtension(), (string)$result_thumb, 'public');
            \Storage::disk(config('voyager.storage.disk'))->put($filename . '-big.'. $image->getClientOriginalExtension(), (string)$result_bigThumb, 'public');
            \Storage::disk(config('voyager.storage.disk'))->put($filename . '-small.webp', (string)$result_thumbWeb, 'public');

            $product->image = $filename . '.' . $image->getClientOriginalExtension();
        }

//        if ($request->has('images')) {
//
//            $images = $request->file('images');
//
//            $filenames = [];
//            foreach ($images as $image) {
//                $name = '/products/' . date('FY') . '/' . \Str::random();
//                $result = \Image::make($image->getRealPath());
//                $result_thumb = \Image::make($image->getRealPath())->resize(null, 90, function ($constraint) {
//                    $constraint->aspectRatio();
//                    $constraint->upsize();
//                });
//                $result_thumbWeb = \Image::make($image->getRealPath())->encode('webp')->resize(null, 90, function ($constraint) {
//                    $constraint->aspectRatio();
//                    $constraint->upsize();
//                });
//                $filenames[] = $name . '.' . $image->getClientOriginalExtension();
//                \Storage::disk(config('voyager.storage.disk'))->put($name . '.' . $image->getClientOriginalExtension(), (string)$result, 'public');
//                \Storage::disk(config('voyager.storage.disk'))->put($name . '-small.' . $image->getClientOriginalExtension(), (string)$result_thumb, 'public');
//                \Storage::disk(config('voyager.storage.disk'))->put($name . '-small.webp', (string)$result_thumbWeb, 'public');
//            }
//
//            $product->images = json_encode($filenames);
//
//
//        }


        $charsRu = [];
        $charvaluesRu = [];
        $characteristicsRu = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'charRu_value') !== false) {
                $charvaluesRu[] = $request->get($key);
            }
            if (strpos($key, 'charRu') !== false && strpos($key, 'charRu_value') === false) {
                $charsRu[] = $request->get($key);
            }
        }
        foreach ($charsRu as $k => $char) {
            $characteristicsRu[] = ['name' => $charsRu[$k], 'value' => $charvaluesRu[$k]];
        }

        $product->specifications = serialize($characteristicsRu);

        $charsKz = [];
        $charvaluesKz = [];
        $characteristicsKz = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'charKz_value') !== false) {
                $charvaluesKz[] = $request->get($key);
            }
            if (strpos($key, 'charKz') !== false && strpos($key, 'charKz_value') === false) {
                $charsKz[] = $request->get($key);
            }
        }
        foreach ($charsKz as $k => $char) {
            $characteristicsKz[] = ['name' => $charsKz[$k], 'value' => $charvaluesKz[$k]];
        }

        $name = json_decode($request->get('name_i18n'));
        $excerpt = json_decode($request->get('excerpt_i18n'));
        $description = json_decode($request->get('description_i18n'));
        $seo_title = json_decode($request->get('seo_title_i18n'));
        $meta_keywords = json_decode($request->get('meta_keywords_i18n'));
        $meta_description = json_decode($request->get('meta_description_i18n'));

        $productTKz = $product->translate('kz');
        $productTKz->specifications = serialize($characteristicsKz);
        $productTKz->name = $name->kz;
        $productTKz->excerpt = $excerpt->kz;
        $productTKz->description = $description->kz;
        $productTKz->meta_description = $meta_description->kz;
        $productTKz->meta_keywords = $meta_keywords->kz;
        $productTKz->seo_title = $seo_title->kz;

        $charsEn = [];
        $charvaluesEn = [];
        $characteristicsEn = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'charEn_value') !== false) {
                $charvaluesEn[] = $request->get($key);
            }
            if (strpos($key, 'charEn') !== false && strpos($key, 'charEn_value') === false) {
                $charsEn[] = $request->get($key);
            }
        }
        foreach ($charsEn as $k => $char) {
            $characteristicsEn[] = ['name' => $charsEn[$k], 'value' => $charvaluesEn[$k]];
        }

        $name = json_decode($request->get('name_i18n'));
        $excerpt = json_decode($request->get('excerpt_i18n'));
        $description = json_decode($request->get('description_i18n'));
        $seo_title = json_decode($request->get('seo_title_i18n'));
        $meta_keywords = json_decode($request->get('meta_keywords_i18n'));
        $meta_description = json_decode($request->get('meta_description_i18n'));

        $productTEn = $product->translate('en');
        $productTEn->specifications = serialize($characteristicsEn);
        $productTEn->name = $name->en;
        $productTEn->excerpt = $excerpt->en;
        $productTEn->description = $description->en;
        $productTEn->meta_description = $meta_description->en;
        $productTEn->meta_keywords = $meta_keywords->en;
        $productTEn->seo_title = $seo_title->en;



        /*FEATURES START*/

        $featuresGroupRu = [];
        $featuresNameRu = [];
        $featuresValuesRu = [];
        $featuresRu = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'featureRu_value') !== false) {
                $featuresValuesRu[] = $request->get($key);
            }
            if (strpos($key, 'featureRu_name') !== false) {
                $featuresNameRu[] = $request->get($key);
            }
            if (strpos($key, 'featureRu_group') !== false) {
                $featuresGroupRu[] = $request->get($key);
            }
        }
        foreach ($featuresNameRu as $k => $feature) {
            $featuresRu[] = ['name' => $featuresNameRu[$k], 'value' => $featuresValuesRu[$k], 'group' =>  $featuresGroupRu[$k]];
        }

        $product->features = serialize($featuresRu);
        $product->save();

        $featuresGroupKz = [];
        $featuresNameKz = [];
        $featuresValuesKz = [];
        $featuresKz = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'featureKz_value') !== false) {
                $featuresValuesKz[] = $request->get($key);
            }
            if (strpos($key, 'featureKz_name') !== false) {
                $featuresNameKz[] = $request->get($key);
            }
            if (strpos($key, 'featureKz_group') !== false) {
                $featuresGroupKz[] = $request->get($key);
            }
        }
        foreach ($featuresNameKz as $k => $feature) {
            $featuresKz[] = ['name' => $featuresNameKz[$k], 'value' => $featuresValuesKz[$k], 'group' =>  $featuresGroupKz[$k]];
        }

        $productTKz->features = serialize($featuresKz);
        $productTKz->save();

        $featuresGroupEn = [];
        $featuresNameEn = [];
        $featuresValuesEn = [];
        $featuresEn = [];
        foreach ($request->keys() as $key) {
            if (strpos($key, 'featureEn_value') !== false) {
                $featuresValuesEn[] = $request->get($key);
            }
            if (strpos($key, 'featureEn_name') !== false) {
                $featuresNameEn[] = $request->get($key);
            }
            if (strpos($key, 'featureEn_group') !== false) {
                $featuresGroupEn[] = $request->get($key);
            }
        }
        foreach ($featuresNameEn as $k => $feature) {
            $featuresEn[] = ['name' => $featuresNameEn[$k], 'value' => $featuresValuesEn[$k], 'group' =>  $featuresGroupEn[$k]];
        }

        $productTEn->features = serialize($featuresEn);
        $productTEn->save();

        /*FEATURES END*/

        $variations = $request->get('relateds');
        if ($request->has('relateds')) {
            Product::whereIn('id', $request->get('relateds'))->each(function ($item) use ($product, $variations) {
                if ($item && ($key = array_search($item->id, $variations)) !== false) {
                    unset($variations[$key]);
                }
                array_push($variations, (string)$product->id);
                $item->relateds = serialize(array_values($variations));
                $item->update();
            });
        }

        return redirect()
            ->route("voyager.products.index")
            ->with([
                'message' => __('voyager::generic.successfully_updated') . " {$product->name}",
                'alert-type' => 'success',
            ]);
    }

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = \Voyager::model('DataType')->where('slug', '=', $slug)->first();


        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses($model))) {
                $model = $model->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
                $model = $model->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        $dataTypeContent->setAttribute('charsRu', unserialize($dataTypeContent->getTranslatedAttribute('specifications', 'ru', 'ru')));
        $dataTypeContent->setAttribute('charsKz', unserialize($dataTypeContent->getTranslatedAttribute('specifications', 'kz', 'ru')));
        $dataTypeContent->setAttribute('charsEn', unserialize($dataTypeContent->getTranslatedAttribute('specifications', 'en', 'ru')));

        $dataTypeContent->setAttribute('featuresRu', unserialize($dataTypeContent->getTranslatedAttribute('features', 'ru', 'ru')));
        $dataTypeContent->setAttribute('featuresKz', unserialize($dataTypeContent->getTranslatedAttribute('features', 'kz', 'ru')));
        $dataTypeContent->setAttribute('featuresEn', unserialize($dataTypeContent->getTranslatedAttribute('features', 'en', 'ru')));
        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }


        $variants = Product::where('id', '!=', $dataTypeContent->id)
            ->get();

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }


        return \Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'variants'));
    }

}
