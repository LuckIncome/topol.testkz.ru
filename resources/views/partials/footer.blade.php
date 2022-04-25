<footer class="@yield('page_class')">
    <div class="container">
        <div class="row">
            <div class="info-block col-5">
                <a href="{{route('pages.home')}}" class="logo"><img src="{{Voyager::image(setting('site.logo'))}}"
                                                                    alt="@lang('general.siteName')"></a>
                <div class="menu">
                    @foreach($categoriesFooter as  $category)
                        <div class="@if($category->slug == 'katalog-produkcii') col-5 @else col-7 @endif cat">
                            <a href="{{$category->link}}"
                               class="strong">{{$category->getTranslatedAttribute('name',$locale,$fallbackLocale)}}</a>
                            <ul>
                                @if($category->categories->count())
                                    @foreach($category->categories->take(5) as $item)
                                        <li>
                                            <a href="{{$item->link}}">{{$item->getTranslatedAttribute('name',$locale,$fallbackLocale)}}</a>
                                        </li>
                                    @endforeach
                                @else
                                    @foreach($servicesFooter as $service)
                                        <li>
                                            <a href="{{route('catalog.show',[$category,$service->slug])}}">{{$service->getTranslatedAttribute('title',$locale,$fallbackLocale)}}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    @endforeach
                </div>
                <div class="pages">
                    <ul>
                        <li><a href="{{route('pages.about')}}">@lang('general.pageAbout')</a></li>
                        <li><a href="{{route('posts.index')}}">@lang('general.pageNews')</a></li>
                        <li><a href="{{route('info.index')}}">@lang('general.pageInfo')</a></li>
                        <li><a href="{{route('pages.contacts')}}">@lang('general.contacts')</a></li>
                    </ul>
                </div>
                <div class="contacts">
                    @foreach($footerPhones->where('is_main',true) as $phone)
                        <a href="{{$phone->link}}" class="phone"><i class="icon"><img
                                        src="{{Voyager::image($phone->icon)}}"
                                        alt="Topol.kz - контакты"></i> {{$phone->value}}</a>
                    @endforeach
                    <a href="{{$email->link}}" class="mail"><i class="icon"><img src="{{Voyager::image($email->icon)}}"
                                                                                 alt="Topol.kz - контакты"></i> {{$email->value}}
                    </a>
                    @foreach($footerPhones->where('is_main',false) as $phone)
                        <a href="{{$phone->link}}" class="whatsapp"><i class="icon"><img
                                        src="{{Voyager::image($phone->icon)}}"
                                        alt="Topol.kz - контакты"></i> {{$phone->value}}</a>
                    @endforeach
                    <div class="socials">
                        @foreach($socials as $social)
                            <a href="{{$social->link}}" target="_blank" class="item {{$social->name}}"><img
                                        src="{{Voyager::image($social->icon)}}" alt="{{$social->value}}"></a>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="{{route('pages.home')}}" class="mob-logo"><img src="{{Voyager::image(setting('site.logo'))}}"
                                                                    alt="@lang('general.siteName')"></a>
            <div class="maps offset-1 col-6">
                <nav>
                    <div class="nav nav-tabs align-items-end" id="nav-mapsTab" role="tablist">
                        @foreach($filials as $key=>$filial)
                            <a class="nav-item nav-link {{$key == 0 ? 'active' : ''}}" id="nav-office-{{$key}}-tab"
                               data-toggle="tab"
                               href="#nav-office-{{$key}}" role="tab"
                               aria-controls="nav-office-{{$key}}"
                               aria-selected="{{$key == 0 ? 'true' : 'false'}}">{{$filial->getTranslatedAttribute('name',$locale,$fallbackLocale)}}</a>
                        @endforeach
                    </div>
                </nav>
                <div class="tab-content" id="nav-mapsContent">
                    @foreach($filials as $key=>$filial)
                        <div class="tab-pane fade {{$key == 0 ? 'show active' : ''}}" id="nav-office-{{$key}}"
                             role="tabpanel"
                             aria-labelledby="nav-office-{{$key}}-tab">
                            <div class="map" id="map-{{$key}}" data-coordinates="{{$filial->map->value}}">
                                <p class="text">{{$filial->address}}
                                    @lang('general.phone') {{$filial->phones->first()->value}}
                                    @lang('general.fax') {{$filial->fax->value}}
                                    @lang('general.schedule') {{$filial->graph}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="copyright">
                <p>{{setting('site.copyrights')}}</p>
                <p><a href="{{route('sitemap')}}">@lang('general.sitemap')</a></p>
                {{--<p>Разработано в компании <a href="#" target="_blank">«IMarketing»</a></p>--}}
            </div>
        </div>
    </div>
</footer>
