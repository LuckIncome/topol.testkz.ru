@extends('app')
@section('title',($seoTitle ? $seoTitle : __('general.home')))
@section('seo_title', ($seoTitle ? $seoTitle : __('general.home')))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',env('APP_URL').'/images/og.jpg')
@section('url',url()->current())
@section('page_class','home')
@section('content')
    <div class="page main">
        <div class="home-slider">
            <div class="slider-content">
                @foreach($homeSliders as $key=>$homeSlider)
                    <div class="slider">
                        <div class="text">
                            @if($key == 0)
                                <h1>{{$homeSlider->title}}</h1>
                            @else
                                <h2>{{$homeSlider->title}}</h2>
                            @endif
                            <p>{{$homeSlider->description}}</p>
                            <div class="btns">
                                <a href="{{$homeSlider->btn_link}}" class="btn-light">{{$homeSlider->btn_text}}</a>
                            </div>
                        </div>
                        <picture>
                            <source srcset="{{$homeSlider->webpImage}}" type="image/webp">
                            <source srcset="{{$homeSlider->bigThumb}}" type="image/jpeg">
                            <img src="{{$homeSlider->bigThumb}}" alt="{{$homeSlider->title}}">
                        </picture>
                    </div>
                @endforeach
            </div>
            <div class="slider-arrows">
                <button class="arrow prevSlide"><span class="sr-only">Previous</span><i
                            class="icon"></i>
                </button>
                <button class="arrow nextSlide"><span class="sr-only">Next</span><i class="icon"></i>
                </button>
            </div>
        </div>
        <!--FEATURED PRODUCTS TAB START-->
        <div class="featured-products">
            <nav>
                <div class="nav nav-tabs align-items-end" id="nav-tab" role="tablist">
                    @foreach($categories as $key=>$category)
                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-{{$category->id}}-tab"
                           data-toggle="tab"
                           href="#nav-{{$category->id}}" role="tab"
                           aria-controls="nav-{{$category->id}}"
                           aria-selected="{{$key == 0 ? 'true' : 'false'}}">{{$category->getTranslatedAttribute('name',$locale,$fallbackLocale)}}</a>
                    @endforeach
                </div>
                <a href="/catalog/akcionnyj-tovar" class="nav-item nav-link external">Акционный товар</a>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @foreach($categories as $key=>$category)
                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-{{$category->id}}"
                         role="tabpanel"
                         aria-labelledby="nav-{{$category->id}}-tab">
                        @if($category->slug == 'uslugi')
                        <a href="{{$category->link}}" class="btn-dark">@lang('general.allServices')</a>
                        @elseif($category->slug == 'akcii')
                            <a href="{{$category->link}}" class="btn-dark">@lang('general.allSales')</a>
                        @else
                            <a href="{{$category->link}}" class="btn-dark">@lang('general.goCatalog')</a>
                        @endif
                        <div class="tab-slider @if($category->categories->count() < 3 || $services->count() < 3 || $sales->count() < 3) not-slider @endif">
                            <div class="content">
                                @if($category->slug == 'katalog-produkcii')
                                    @foreach($category->categories as $cat)
                                        @php($cat->webp = $cat->bg)
                                        <div class="item img-hover">
                                            <a href="{{$cat->link}}" class="image">
                                                <picture class="default">
                                                    <source srcset="{{$cat->webpImage}}"
                                                            type="image/webp">
                                                    <source srcset="{{$cat->bigThumb}}"
                                                            type="image/pjpeg">
                                                    <img src="{{$cat->bigThumb}}"
                                                         alt="{{$cat->getTranslatedAttribute('name',$locale,$fallbackLocale)}}">
                                                </picture>
                                                <picture class="bg">
                                                    <source srcset="{{$cat->webp}}"
                                                            type="image/webp">
                                                    <source srcset="{{\Voyager::image($cat->thumbnail('big','bg'))}}"
                                                            type="image/pjpeg">
                                                    <img src="{{\Voyager::image($cat->thumbnail('big','bg'))}}"
                                                         alt="{{$cat->getTranslatedAttribute('name',$locale,$fallbackLocale)}}">
                                                </picture>
                                            </a>
                                            <a href="{{$cat->link}}"
                                               class="name">{{$cat->getTranslatedAttribute('name',$locale,$fallbackLocale)}}
                                                <i class="icon"></i></a>
                                        </div>
                                    @endforeach
                                @elseif($category->slug == 'uslugi')
                                    @foreach($services as $service)
                                        <div class="item img-hover">
                                            <a href="{{route('catalog.show',[$category,$service->slug])}}" class="image">
                                                <picture>
                                                    <source srcset="{{$service->webpImage}}"
                                                            type="image/webp">
                                                    <source srcset="{{$service->bigThumb}}"
                                                            type="image/pjpeg">
                                                    <img src="{{$service->bigThumb}}"
                                                         alt="{{$service->seo_title ? $service->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $service->getTranslatedAttribute('title',$locale,$fallbackLocale)}}">
                                                </picture>
                                            </a>
                                            <a href="{{route('catalog.show',[$category,$service->slug])}}" class="name">{{$service->getTranslatedAttribute('title',$locale,$fallbackLocale)}} <i class="icon"></i></a>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach($sales as $sale)
                                        <div class="item img-hover">
                                            <a href="{{route('catalog.show',[$category,$sale->slug])}}" class="image">
                                                <picture>
                                                    <source srcset="{{$sale->webpImage}}"
                                                            type="image/webp">
                                                    <source srcset="{{$sale->bigThumb}}"
                                                            type="image/pjpeg">
                                                    <img src="{{$sale->bigThumb}}"
                                                         alt="{{$sale->seo_title ? $sale->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $sale->getTranslatedAttribute('title',$locale,$fallbackLocale)}}">
                                                </picture>
                                            </a>
                                            <a href="{{route('catalog.show',[$category,$sale->slug])}}" class="name">{{$sale->getTranslatedAttribute('title',$locale,$fallbackLocale)}} <i class="icon"></i></a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="slider-arrows">
                                <button class="arrow prevSlide"><span class="sr-only">Previous</span><i
                                            class="icon"></i>
                                </button>
                                <button class="arrow nextSlide"><span class="sr-only">Next</span><i
                                            class="icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!--FEATURED PRODUCTS TAB END-->
        <div class="action-block about">
            <picture>
                <source srcset="{{$about->webpImage}}" type="image/webp">
                <source srcset="{{$about->bigThumb}}" type="image/pjpeg">
                <img src="{{$about->bigThumb}}"
                     alt="{{$about->getTranslatedAttribute('seo_title',$locale,$fallbackLocale)}}">
            </picture>
            <div class="text">
                <h2>{{$about->getTranslatedAttribute('title',$locale,$fallbackLocale)}}</h2>
                <p>{{$about->getTranslatedAttribute('excerpt',$locale,$fallbackLocale)}}</p>
                <a href="{{route('pages.about')}}" class="btn-dark">Подробнее о нас</a>
            </div>
        </div>
        <div class="action-tab-block">
            <nav>
                <div class="nav nav-tabs align-items-end" id="nav-advantages-tab" role="tablist">
                    @foreach($advantages as $i=>$advantage)
                        <a class="nav-item nav-link {{$i == 0 ? 'active': ''}}" id="nav-av-{{$i}}-tab" data-toggle="tab"
                           href="#nav-av-{{$i}}" role="tab"
                           aria-controls="nav-av-{{$i}}" aria-selected="{{$i == 0 ? 'true' : 'false'}}">
                            <img src="{{Voyager::image($advantage->icon)}}" class="svg" alt="{{$advantage->icon_text}}">
                            <span>{{$advantage->icon_text}}</span>
                        </a>
                    @endforeach
                </div>
            </nav>
            <div id="nav-advTabContent" class="tab-content" role="tablist">
                @foreach($advantages as $i => $advantage)
                    <div class="card tab-pane fade  {{$i == 0 ? 'show active': ''}}" id="nav-av-{{$i}}" role="tabpanel"
                         aria-labelledby="nav-av-{{$i}}-tab">
                        <div class="card-header {{$i == 0 ? 'active-acc': ''}} " role="tab" id="heading-av-{{$i}}">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#collapse-av-{{$i}}"
                                   aria-expanded="{{$i == 0 ? 'true' : 'false'}}"
                                   aria-controls="collapse-av-{{$i}}">
                                    <img src="{{Voyager::image($advantage->icon)}}" class="svg"
                                         alt="{{$advantage->icon_text}}">
                                    <span>{{$advantage->icon_text}}</span>
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-av-{{$i}}" class="collapse {{$i == 0 ? 'show': ''}}" role="tabpanel"
                             aria-labelledby="heading-av-{{$i}}" data-parent="#nav-advTabContent">
                            <div class="card-body">
                                <div class="action-block about">
                                    <picture>
                                        <source srcset="{{$advantage->webpImage}}" type="image/webp">
                                        <source srcset="{{$advantage->bigThumb}}" type="image/pjpeg">
                                        <img src="{{$advantage->bigThumb}}" alt="{{$advantage->title}}">
                                    </picture>
                                    <div class="text">
                                        <h2>{{$advantage->title}}</h2>
                                        <p>{{$advantage->text}}</p>
                                        <a href="{{route('pages.about')}}" class="btn-dark">@lang('general.moreAboutUs')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="projects posts block-header">
            <div class="header">
                <h2>@lang('general.ourProjects')</h2>
                <a href="{{route('projects.index')}}" class="btn-dark">@lang('general.allProjects')</a>
            </div>
            <div class="items">
                @foreach($projects as $key => $project)
                    <div class="item img-hover">
                        <a class="image" href="{{route('projects.show',$project)}}">
                            <picture>
                                <source srcset="{{$project->webpImage}}" type="image/webp">
                                <source srcset="{{$project->bigThumb}}" type="image/pjpeg">
                                <img src="{{$project->bigThumb}}"
                                     alt="{{$project->seo_title ? $project->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $project->getTranslatedAttribute('title',$locale,$fallbackLocale)}}">
                            </picture>
                        </a>
                        <p class="category">{{$project->getTranslatedAttribute('category',$locale,$fallbackLocale)}}</p>
                        <a href="{{route('projects.show',$project)}}"
                           class="title">{{$project->getTranslatedAttribute('title',$locale,$fallbackLocale)}} <i
                                    class="icon"></i></a>
                        <p class="description">{{Str::limit($project->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), $key == 0 ? 160 : 70 , '...')}}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="partners block-header">
            <div class="header">
                <h2>@lang('general.ourPartners')</h2>
                <a href="{{route('about.show','nashi-partnery')}}" class="btn-dark">@lang('general.allPartners')</a>
            </div>
            <div class="slider-data">
                <div class="content">
                    @foreach($partners as $partner)
                        <div class="item" data-toggle="popover" data-trigger="hover" data-placement="bottom"
                             data-content="{{$partner->description}}">
                            <picture>
                                <source srcset="{{$partner->webpImage}}" type="image/webp">
                                <source srcset="{{$partner->bigThumb}}" type="image/pjpeg">
                                <img src="{{$partner->bigThumb}}" alt="{{$partner->name}}">
                            </picture>
                        </div>
                    @endforeach
                </div>
                <div class="slider-arrows">
                    <button class="arrow prevSlide"><span class="sr-only">Previous</span><i
                                class="icon"></i>
                    </button>
                    <button class="arrow nextSlide"><span class="sr-only">Next</span><i class="icon"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="posts block-header">
            <div class="header">
                <h2>@lang('general.pageNews')</h2>
                <a href="{{route('posts.index')}}" class="btn-dark">@lang('general.allNews')</a>
            </div>
            <div class="items">
                @foreach($posts as $post)
                    <div class="item img-hover">
                        <a class="image" href="{{route('posts.show',$post)}}">
                            <picture>
                                <source srcset="{{$post->webpImage}}" type="image/webp">
                                <source srcset="{{$post->bigThumb}}" type="image/pjpeg">
                                <img src="{{$post->bigThumb}}"
                                     alt="{{$post->seo_title ? $post->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $post->getTranslatedAttribute('title',$locale,$fallbackLocale)}}">
                            </picture>
                        </a>
                        <p class="date">{{\Carbon\Carbon::parse($post->post_date)->translatedFormat('d F Y')}}</p>
                        <a href="{{route('posts.show',$post)}}"
                           class="title">{{$post->getTranslatedAttribute('title',$locale,$fallbackLocale)}} <i
                                    class="icon"></i></a>
                        <p class="description">{{Str::limit($post->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), 105, '...')}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
