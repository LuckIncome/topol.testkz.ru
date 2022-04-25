@extends('app')
@section('title',($seoTitle ? $seoTitle : $page->title))
@section('seo_title', ($seoTitle ? $seoTitle : $page->seo_title))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',\Voyager::image($page->thumbic))
@section('url',url()->current())
@section('page_class','posts')
@section('content')
    <div class="page posts services programs-page" data-ng-controller="SearchController as sc">
        <div class="content-sidebar">
            <h1>{{$page->title}}</h1>
            @include('partials.breadcrumbs',['title'=>__('general.pageAbout'),'titleLink'=>route('pages.about'),'subtitle' => $page->title])
            <div class="content col-9">
                <div class="tab-info">
                    <nav>
                        <div class="nav nav-tabs align-items-end" id="nav-productTab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-programs-tab" data-toggle="tab"
                               href="#nav-programs" role="tab"
                               aria-controls="nav-programs" aria-selected="true">@lang('general.programs')</a>
                            <a class="nav-item nav-link" id="nav-certs-tab" data-toggle="tab" href="#nav-certs"
                               role="tab"
                               aria-controls="nav-certs" aria-selected="false">@lang('general.registry')</a>

                        </div>
                    </nav>
                    <div class="tab-content" id="nav-programsTabContent">
                        <div class="tab-pane fade show active" id="nav-programs" role="tabpanel"
                             aria-labelledby="nav-programs-tab">
                            <div class="items">
                                @if($programs->count())
                                    @foreach($programs as $post)
                                        <div class="item img-hover">
                                            <a href="{{route('programs.show',$post)}}" class="image">
                                                <picture>
                                                    <source srcset="{{$post->webpImage}}" type="image/webp">
                                                    <source srcset="{{$post->bigThumb}}"
                                                            type="image/pjpeg">
                                                    <img src="{{$post->bigThumb}}"
                                                         alt="{{$post->seo_title ? $post->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $post->getTranslatedAttribute('title',$locale,$fallbackLocale)}}">
                                                </picture>
                                            </a>
                                            <div class="text">
                                                <a href="{{route('programs.show',$post)}}"
                                                   class="title">{{$post->getTranslatedAttribute('title',$locale,$fallbackLocale)}}
                                                    <i class="icon"></i></a>
                                                <p class="description">{{Str::limit($post->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), 165, '...')}}</p>
                                                <a href="{{route('programs.show',$post)}}"
                                                   class="btn-dark">@lang('general.more')</a>
                                            </div>
                                        </div>
                                    @endforeach
                                    {!! $programs->links() !!}
                                @else
                                    <p class="text-center d-flex w-100 justify-content-center">@lang('general.noFiles')</p>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-certs" role="tabpanel"
                             aria-labelledby="nav-certs-tab">
                            <div class="search input-group">
                                <input type="text" class="form-control" data-ng-model="certInput"
                                       placeholder="@lang('general.registryPlaceholder')"
                                       aria-label="@lang('general.registryPlaceholder')"
                                       aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn" type="button" id="button-addon1" data-ng-click="sc.searchCert(certInput)">@lang('general.find')</button>
                                </div>
                            </div>
                            <div class="items">
                                <div class="items-head">
                                    <p>@lang('general.fullName')</p>
                                    <p>@lang('general.certNumber')</p>
                                </div>
                                <div class="item" data-ng-repeat="item in sc.certItems track by $index">
                                    <p>@{{item.full_name}}</p>
                                    <p>№@{{item.number}}</p>
                                </div>
                                <div class="item" data-ng-if="sc.certItems.length <= 0">
                                   <p>@lang('general.certNotFound')</p>
                                   <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar col-3">
                <ul class="sidebar-menu">
                    @foreach($pages as $item)
                        @if($item->id == $page->id)
                            <li class="active"><span>{{$item->title}}</span></li>
                        @else
                            <li><a href="{{$item->url}}">{{$item->title}}</a></li>
                        @endif
                    @endforeach
                </ul>
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection