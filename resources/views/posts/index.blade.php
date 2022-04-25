@extends('app')
@section('title',($seoTitle ? $seoTitle : __('general.pageNews')))
@section('seo_title', ($seoTitle ? $seoTitle : __('general.pageNews')))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',env('APP_URL').'/images/og.jpg')
@section('url',url()->current())
@section('page_class','posts')
@section('content')
    <div class="page posts">
        <div class="content-sidebar">
            <h1>{{__('general.pageNews')}}</h1>
            @include('partials.breadcrumbs',['title'=> __('general.pageNews')])
            <div class="content col-9">
                <div class="items">
                    @if($posts->count())
                        @foreach($posts as $post)
                            <div class="item img-hover">
                                <a href="{{route('posts.show',$post)}}" class="image">
                                    <picture>
                                        <source srcset="{{$post->webpImage}}" type="image/webp">
                                        <source srcset="{{$post->bigThumb}}" type="image/pjpeg">
                                        <img src="{{$post->bigThumb}}" alt="{{$post->seo_title ? $post->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $post->getTranslatedAttribute('title',$locale,$fallbackLocale)}}">
                                    </picture>
                                </a>
                                <div class="text">
                                    <p class="date">{{\Carbon\Carbon::parse($post->post_date)->translatedFormat('d F Y')}}</p>
                                    <a href="{{route('posts.show',$post)}}" class="title">{{$post->getTranslatedAttribute('title',$locale,$fallbackLocale)}} <i class="icon"></i></a>
                                    <p class="description">{{Str::limit($post->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), 300, '...')}}</p>
                                    <a href="{{route('posts.show',$post)}}" class="btn-dark">@lang('general.more')</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center d-flex w-100 justify-content-center">@lang('general.noFiles')</p>
                    @endif
                </div>
                {!! $posts->links() !!}
            </div>
            <div class="sidebar col-3">
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection