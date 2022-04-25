@extends('app')
@section('title',($seoTitle ? $seoTitle : $page->title))
@section('seo_title', ($seoTitle ? $seoTitle : $page->seo_title))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',\Voyager::image($page->thumbic))
@section('url',url()->current())
@section('page_class','base')
@section('content')
    <div class="page base">
        <div class="content-sidebar">
            <h1>{{$page->title}}</h1>
            @include('partials.breadcrumbs',['title'=>__('general.usefulInformation'),'titleLink'=>route('info.index'),'subtitle' => $page->title])
            <div class="content col-9">
                <div class="docs">
                    @foreach($normatives as $normative)
                        <div class="doc">
                            <p class="date">{{\Carbon\Carbon::parse($normative->created_at)->translatedFormat('d F Y')}}</p>
                            <strong>{{$normative->getTranslatedAttribute('title',$locale,$fallbackLocale)}}</strong>
                            @if($normative->file)
                                <a target="_blank" href="{{$normative->file}}" class="btn-dark">@lang('general.downloadFile')</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="sidebar col-3">
                <ul class="sidebar-menu">
                    @foreach($pages as $item)
                        <li @if($page->id == $item->id) class="active" @endif><a href="{{route('info.show',$item)}}">{{$item->getTranslatedAttribute('title',$locale,$fallbackLocale)}}</a></li>
                    @endforeach
                </ul>
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection