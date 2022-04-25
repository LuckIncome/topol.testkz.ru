@extends('app')
@section('title',($seoTitle ? $seoTitle : $page->title))
@section('seo_title', ($seoTitle ? $seoTitle : $page->title))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',env('APP_URL').'/images/og.jpg')
@section('url',url()->current())
@section('page_class','base')
@section('content')
    <div class="page static-page">
        <div class="content-sidebar">
            <h1>{{$page->title}}</h1>
            @include('partials.breadcrumbs',['title'=>($seoTitle ? $seoTitle : $page->title)])
           <div class="terms-content">
               {!! $page->body !!}
               {!! $page->body_footer !!}
           </div>
        </div>
    </div>
@endsection