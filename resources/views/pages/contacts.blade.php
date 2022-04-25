@extends('app')
@section('title',($seoTitle ? $seoTitle : __('general.contacts')))
@section('seo_title', ($seoTitle ? $seoTitle : __('general.contacts')))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',env('APP_URL').'/images/og.jpg')
@section('url',url()->current())
@section('page_class','contacts-page')
@section('content')
    <div class="page contacts-page">
        <div class="content-nosidebar">
            <div class="content col-12">
                <h1>{{__('general.contacts')}}</h1>
                @include('partials.breadcrumbs',['title'=>__('general.contacts')])
                <div class="page-content">
                    <div class="maps">
                        <nav>
                            <div class="nav nav-tabs align-items-end" id="nav-page-mapsTab" role="tablist">
                                @foreach($filials as $key=>$filial)
                                    <a class="nav-item nav-link {{$key == 0 ? 'active' : ''}}"
                                       id="nav-page-office-{{$key}}-tab"
                                       data-toggle="tab"
                                       href="#nav-page-office-{{$key}}" role="tab"
                                       aria-controls="nav-page-office-{{$key}}"
                                       aria-selected="{{$key == 0 ? 'true' : 'false'}}">{{$filial->getTranslatedAttribute('name',$locale,$fallbackLocale)}}</a>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-mapsContentPage">
                            @foreach($filials as $key=>$filial)
                                <div class="tab-pane fade {{$key == 0 ? 'show active' : ''}}"
                                     id="nav-page-office-{{$key}}" role="tabpanel"
                                     aria-labelledby="nav-page-office-{{$key}}-tab">
                                    <div class="contacts-content">
                                        <div class="map" id="map-page-{{$key}}"
                                             data-coordinates="{{$filial->map->value}}">
                                            <p class="text">{{$filial->address}}
                                                @lang('general.phone') {{$filial->phones->first()->value}};
                                                @lang('general.fax') {{$filial->fax->value}}
                                                @lang('general.schedule') {{$filial->graph}}</p>
                                        </div>
                                        <div class="info">
                                            <ul>
                                                <li>
                                                    <span>@lang('general.schedule')</span>
                                                    <p>{{$filial->graph}}</p>
                                                </li>
                                                <li>
                                                    <span>@lang('general.phoneFull')</span>
                                                    <p>
                                                        <a href="{{$filial->phones->first()->link}}">{{$filial->phones->first()->value}}</a>
                                                    </p>
                                                </li>
                                                <li>
                                                    <span>@lang('general.fax')</span>
                                                    <p><a href="{{$filial->fax->link}}">{{$filial->fax->value}}</a></p>
                                                </li>
                                                <li>
                                                    <span>E-mail:</span>
                                                    <p><a href="{{$filial->email->link}}">{{$filial->email->value}}</a>
                                                    </p>
                                                </li>
                                                <li>
                                                    <span>@lang('general.address')</span>
                                                    <p>{{$filial->address}}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="feedback">
                        <form action="{{route('feedback.inline')}}">
                            <input type="text" name="name" class="form-control" required
                                   placeholder="@lang('general.namePlaceholder')"
                                   autocomplete="off">
                            <input type="tel" name="phone" class="form-control" required
                                   placeholder="@lang('general.phonePlaceholder')"
                                   autocomplete="off">
                            <div class="submission">
                                <div class="checker">
                                    <label class="checkbox-check">
                                        <input type="checkbox" name="agreement" checked required>
                                        <span class="checkmark"></span>
                                        <span>@lang('general.termsAgree') <a
                                                href="{{route('page.terms')}}">@lang('general.more')</a></span>
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="page" value="Контакты">
                            <input type="hidden" name="pageLink" value="{{\Request::url()}}">
                            {{csrf_field()}}
                            {!! htmlFormSnippet() !!}
                            <button type="submit" class="btn">@lang('general.sendRequestButton')</button>
                        </form>
                        <div class="text">
                            {!! setting('site.formText_'.$locale) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
