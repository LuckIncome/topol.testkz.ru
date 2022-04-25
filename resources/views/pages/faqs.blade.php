@extends('app')
@section('title',($seoTitle ? $seoTitle : $page->title))
@section('seo_title', ($seoTitle ? $seoTitle : $page->seo_title))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',\Voyager::image($page->thumbic))
@section('url',url()->current())
@section('page_class','base')
@section('content')
    <div class="page faqs">
        <div class="content-sidebar">
            <h1>{{$page->title}}</h1>
            @include('partials.breadcrumbs',['title'=>__('general.usefulInformation'),'titleLink'=>route('info.index'),'subtitle' => $page->title])
            <div class="content col-9">
                <div class="accordion" id="faqs">
                    @foreach($faqs as $key=>$faq)
                    <div class="card">
                        <div class="card-header" id="heading{{$faq->id}}">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapse{{$faq->id}}" aria-expanded="{{ $loop->first ? 'true' : 'false'}}" aria-controls="collapse{{$faq->id}}">{{$faq->question}} <i class="fa fa-angle-down"></i></button>
                        </div>
                        <div id="collapse{{$faq->id}}" class="collapse @if($loop->first) show @endif" aria-labelledby="heading{{$faq->id}}"
                             data-parent="#faqs">
                            <div class="card-body">{!! $faq->answer !!}</div>
                        </div>
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
