<header>
    <div class="upper">
        <div class="container">
            <div class="row">
                <div class="content">
                    {{menu('header_menu','vendor.voyager.menu.default',['isParent' => true])}}
                    <div class="social-lang">
                        <p class="working-days">{{$graph->value}}</p>
                        <ul class="lang">
                            <li class="@if($locale == 'ru') active @endif"><a
                                        href="{{route('locale.set','ru')}}">RUS</a></li>
                            <li class="sep">|</li>
                            <li class="@if($locale == 'kz') active @endif"><a
                                        href="{{route('locale.set','kz')}}">KAZ</a></li>
                            <li class="sep">|</li>
                            <li class="@if($locale == 'en') active @endif"><a
                                        href="{{route('locale.set','en')}}">ENG</a></li>
                        </ul>
                        <ul class="socials">
                            @foreach($socials as $social)
                                    <li class="social {{$social->name}} icon-w"><a href="{{$social->link}}" target="_blank"><img src="{{Voyager::image($social->icon)}}"
                                                                                                                 alt="{{$social->value}}"></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="downer">
        <div class="container">
            <div class="row">
                <div class="content">
                    <a href="{{route('pages.home')}}" class="logo col-2"><img src="{{Voyager::image(setting('site.logo'))}}" alt="@lang('general.siteName')"></a>
                    <div class="search input-group col-6" data-ng-controller="SearchController as sc">
                        <input type="text" class="form-control" placeholder="@lang('general.searchPlaceholder')" data-ng-model="searchInput"
                               aria-label="@lang('general.searchPlaceholder')" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn" type="button" id="button-addon2" data-ng-click="sc.searchByInput(searchInput)">@lang('general.search')</button>
                        </div>
                        <div class="search-results">
                            <ul data-ng-if="sc.searchItems.length > 0">
                                <li data-ng-repeat="item in sc.searchItems track by $index"><a href="#" data-ng-href="@{{item.full_link}}">@{{item.item}}: <span>@{{item.name}}</span></a></li>
                            </ul>
                            <p data-ng-if="sc.searchItems.length <= 0">@lang('general.noSearchResults')</p>
                            <a data-ng-if="sc.searchItems.length > 0" href="#" data-ng-click="sc.openSearchPage(searchInput)" class="text-link">@lang('general.showAllSearchResults')</a>
                            <span class="close" data-ng-click="sc.closeResults()">&times;</span>
                        </div>
                    </div>
                    <div class="btns col-4">
                        <div class="phones">
                            <ul>
                                @php
                                    $arrPhone = explode(' ', $phones->where('is_main',true)->first()->value);
                                    $mainPhone = $arrPhone[0]. ' ' .$arrPhone[1].' <span>'.implode(' ',array_diff($arrPhone, [$arrPhone[0],$arrPhone[1]])).'</span>';
                                @endphp
                                <li class="dropdown">
                                    <a href="{{$phones->where('is_main',true)->first()->link}}" style="" class="dropdown-toggle phone">
                                        <i class="icon-phone"><img src="{{Voyager::image($phones->where('is_main',true)->first()->icon)}}" alt="Topol.kz - контакты"></i>{!! $mainPhone !!}

                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($phones as $phone)
                                            @php
                                                $phone1 = explode(' ', $phone->value);
                                                $phone2 = $phone1[0]. ' ' .$phone1[1].' <span>'.implode(' ',array_diff($phone1, [$phone1[0],$phone1[1]])).'</span>';
                                            @endphp
                                            @if(!$phone->is_main)
                                                <li class=" ">
                                                    <a href="{{$phone->link}}" style="" class="dropdown-toggle phone">
                                                        <i class="icon-phone"><img src="{{Voyager::image($phone->icon)}}" alt="Topol.kz - контакты"></i>{!! $phone2 !!}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <a href="#" class="btn-darkgreen callback-btn" data-toggle="modal" data-target="#callbackModal"
                           data-page="Кнопка в шапке">@lang('general.callbackBtn')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="fixed-menu" class="fixed-header">
        <div class="container">
            <div class="row">
                <div class="content">
                    <div class="block">
                        <a href="{{route('pages.home')}}" class="logo">
                            <img src="{{Voyager::image(setting('site.logo'))}}" alt="@lang('general.siteName')">
                        </a>
                        {{menu('header_menu','vendor.voyager.menu.default',['isParent' => true])}}
                        <div class="btns col-4">
                            <div class="phones">
                                <ul>
                                    @php
                                        $arrPhone = explode(' ', $phones->where('is_main',true)->first()->value);
                                        $mainPhone = $arrPhone[0]. ' ' .$arrPhone[1].' <span>'.implode(' ',array_diff($arrPhone, [$arrPhone[0],$arrPhone[1]])).'</span>';
                                    @endphp
                                    <li class="dropdown">
                                        <a href="{{$phones->where('is_main',true)->first()->link}}" style="" class="dropdown-toggle phone">
                                            <i class="icon-phone"><img src="{{Voyager::image($phones->where('is_main',true)->first()->icon)}}" alt="Topol.kz - контакты"></i>{!! $mainPhone !!}

                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            @foreach($phones as $phone)
                                                @php
                                                    $phone1 = explode(' ', $phone->value);
                                                    $phone2 = $phone1[0]. ' ' .$phone1[1].' <span>'.implode(' ',array_diff($phone1, [$phone1[0],$phone1[1]])).'</span>';
                                                @endphp
                                                @if(!$phone->is_main)
                                                    <li class=" ">
                                                        <a href="{{$phone->link}}" style="" class="dropdown-toggle phone">
                                                            <i class="icon-phone"><img src="{{Voyager::image($phone->icon)}}" alt="Topol.kz - контакты"></i>{!! $phone2 !!}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <a href="#" class="btn-darkgreen callback-btn" data-toggle="modal"
                               data-target="#callbackModal" data-page="Кнопка в шапке">@lang('general.callbackBtn')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mob-fixed-menu">
        <div class="hamburger menu-btn" id="nav-hamb">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div id="nav-mobile">
            <div class="menu-content">
                <div class="search input-group col-6" data-ng-controller="SearchController as sc">
                    <input type="text" class="form-control" placeholder="@lang('general.searchPlaceholder')" data-ng-model="searchInput"
                           aria-label="@lang('general.searchPlaceholder')" aria-describedby="button-addon3">
                    <div class="input-group-append">
                        <button class="btn" type="button" id="button-addon3" data-ng-click="sc.searchByInput(searchInput)">@lang('general.search')</button>
                    </div>
                    <div class="search-results">
                        <ul data-ng-if="sc.searchItems.length > 0">
                            <li data-ng-repeat="item in sc.searchItems track by $index"><a href="#" data-ng-href="@{{item.full_link}}">@{{item.item}}: <span>@{{item.name}}</span></a></li>
                        </ul>
                        <p data-ng-if="sc.searchItems.length <= 0">@lang('general.noSearchResults')</p>
                        <a data-ng-if="sc.searchItems.length > 0" href="#" data-ng-click="sc.openSearchPage(searchInput)" class="text-link">@lang('general.showAllSearchResults')</a>
                        <span class="close" data-ng-click="sc.closeResults()">&times;</span>
                    </div>
                </div>
                {{menu('header_menu','vendor.voyager.menu.default-m',['isParent' => true])}}
                <div class="btm-content">
                    <a href="{{$phones->where('is_main',true)->first()->link}}" class="phone"> <i class="icon-phone"><img src="{{Voyager::image($phones->where('is_main',true)->first()->icon)}}" alt="Topol.kz - контакты"></i>{{$phones->where('is_main',true)->first()->value}}</a>
                    <a href="{{$phones->where('is_main',false)->first()->link}}" class="phone"> <i class="icon-phone whatsapp"><img src="{{Voyager::image($phones->where('is_main',false)->first()->icon)}}" alt="Topol.kz - контакты"></i>{{$phones->where('is_main',false)->first()->value}}</a>

                    <ul class="lang">
                        <li class="@if($locale == 'ru') active @endif"><a
                                    href="{{route('locale.set','ru')}}">RUS</a></li>
                        <li class="sep">|</li>
                        <li class="@if($locale == 'kz') active @endif"><a
                                    href="{{route('locale.set','kz')}}">KAZ</a></li>
                        <li class="sep">|</li>
                        <li class="@if($locale == 'en') active @endif"><a
                                    href="{{route('locale.set','en')}}">ENG</a></li>
                    </ul>
                    <ul class="socials">
                        @foreach($socials as $social)
                            <li class="social {{$social->name}} icon-w"><a href="{{$social->link}}" target="_blank"><img src="{{Voyager::image($social->icon)}}"
                                                                                                         alt="{{$social->value}}"></a></li>
                        @endforeach
                    </ul>
                    <p>@lang('general.orderText')</p>
                    <a href="#" class="btn-darkgreen" data-toggle="modal" data-target="#callbackModal"
                       data-page="Кнопка в шапке">@lang('general.callbackBtn')</a>
                </div>
            </div>
        </div>
        <a href="{{route('pages.home')}}" class="logo">
            <img src="{{Voyager::image(setting('site.logo'))}}" alt="@lang('general.siteName')">
            <img class="opened" src="{{Voyager::image(setting('site.logo_w'))}}" alt="@lang('general.siteName')">
        </a>
        <div class="phones">
            <a href="{{$phones->where('is_main',false)->first()->link}}" class="phone whatsapp"><i class="icon-phone"><img src="{{Voyager::image($phones->where('is_main',false)->first()->icon)}}"
                                                                                                                  alt="Topol.kz - контакты"></i></a>
            <a href="{{$phones->where('is_main',true)->first()->link}}" class="phone"><i class="icon-phone"><img src="{{Voyager::image($phones->where('is_main',true)->first()->icon)}}"
                                                                                                                 alt="Topol.kz - контакты"></i></a>
        </div>
    </div>
</header>