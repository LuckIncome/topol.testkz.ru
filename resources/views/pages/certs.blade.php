@extends('app')
@section('title',($seoTitle ? $seoTitle : $page->title))
@section('seo_title', ($seoTitle ? $seoTitle : $page->title))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',\Voyager::image($page->thumbic))
@section('url',url()->current())
@section('page_class','base')
@section('content')
    <div class="page base">
        <div class="content-sidebar">
            <h1>{{$page->title}}</h1>
            @include('partials.breadcrumbs',['title'=>__('general.pageAbout'),'titleLink'=>route('pages.about'),'subtitle' => $page->title])
            <div class="content col-9">
                <div class="docs certs">
                    @foreach($certs as $cert)
                        <div class="doc">
                            <p class="description @if(!$cert->file) w-100 @endif">{{$cert->name}}</p>
                            @if($cert->file)
                                <a target="_blank" href="{{$cert->file}}" class="btn-dark">@lang('general.download')</a>
                            @endif
                        </div>
                    @endforeach
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