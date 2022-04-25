@extends('app')
@section('title',__('general.notFoundTitle'))
@section('seo_title', __('general.notFoundTitle'))
@section('meta_keywords', '')
@section('meta_description', '')
@section('image',env('APP_URL').'/images/og.jpg')
@section('url',url()->current())
@section('page_class','page-404')
@section('content')
    <div class="page page-404">
        <div class="content-nosidebar">
            <div class="content col-12">
                <h1>@lang('general.notFoundTitle')</h1>
                @include('partials.breadcrumbs',['title'=>__('general.notFoundTitle')])
                <div class="notfound-content">
                    <div class="head">
                        <strong>404</strong>
                        <p>@lang('general.notFoundTitle')</p>
                    </div>
                    <p>@lang('general.notFoundContent')</p>
                </div>
            </div>
        </div>
    </div>
@endsection