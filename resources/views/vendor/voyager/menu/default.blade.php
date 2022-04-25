<ul class="{{!isset($isParent) ? 'nav navbar-nav menu' : 'dropdown-menu'}}">
    @php

        if (Voyager::translatable($items)) {
            $items = $items->load('translations');
        }

    @endphp

    @foreach ($items as $item)

        @php

            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }

            $isActive = null;
            $styles = null;
            $icon = null;
            $hasPage = false;
                if($originalItem->route == 'pages.about'){
                    $exclude = ['obuchenie','nashi-proekty'];
                    $pages = \App\Page::where('type','about')->where('slug','!=','o-kompanii')->where('status',\App\Page::STATUS_ACTIVE)->orderBy('sort_id')->get()->each(function ($item) use ($exclude){
                        if (!in_array($item->slug,$exclude)){
                            $item->url = route('about.show',$item);
                        }else {
                            $item->url = ($item->slug == 'obuchenie') ? route('programs.index') : route('projects.index');
                        }
                    });
                    $originalItem->setAttribute('pages',$pages);
                    $hasPage = true;
                }

                 if($originalItem->route == 'info.index'){
                    $pages = \App\Page::where('type','info')->where('slug','!=','terms')->where('status',\App\Page::STATUS_ACTIVE)->orderBy('sort_id')->get()->each(function ($item) {
                        $item->url = route('info.show',$item);
                    });
                    $originalItem->setAttribute('pages',$pages);
                    $hasPage = true;
                }

                 if($originalItem->route == 'catalog.index'){
                    $pages = \App\Category::where('parent_id',null)->where('active',true)->orderBy('order')->get()->each(function ($item) {
                        $item->url = route('catalog.show',$item);
                    });
                    $originalItem->setAttribute('pages',$pages);
                    $hasPage = true;
                }

            if (!in_array(class_basename($originalItem) ,['Page','Category'])){
                // Background Color or Color
                if (isset($options->color) && $options->color == true) {
                    $styles = 'color:'.$item->color;
                }
                if (isset($options->background) && $options->background == true) {
                    $styles = 'background-color:'.$item->color;
                }

                // Check if link is current
                if(url($originalItem->link()) == url()->current()){
                    $isActive = 'active';
                }

                // Set Icon
                if(isset($options->icon) && $options->icon == true){
                    $icon = '<i class="' . $item->icon_class . '"></i>';
                }

            }

            $originalItem->setAttribute('hasPage',$hasPage);
        @endphp
        @if(!in_array(class_basename($originalItem) ,['Page','Category']))
            <li class="nav-item {{ $isActive }} {{($originalItem->hasPage || !$originalItem->children->isEmpty()) ? 'dropdown':''}}">
                <a href="{{ url($originalItem->link()) }}" target="{{ $originalItem->target }}" style="{{ $styles }}">
                    {{ $item->title }}
                </a>
                @if(!$originalItem->children->isEmpty())
                    @include('voyager::menu.default', ['items' => $originalItem->children, 'options' => $options, 'isParent' => false])
                @endif
                @if($originalItem->hasPage)
                    @include('voyager::menu.default', ['items' => $originalItem->pages, 'options' => $options, 'isParent' => false])
                @endif
            </li>
        @else
            <li class="{{$originalItem->url == url()->current() ? 'active' : ''}}">
                <a href="{{ $originalItem->url }}">
                    {{ $item->title ? $item->title : $item->name }}
                </a>
                @if($originalItem->hasPage)
                    @include('voyager::menu.default', ['items' => $originalItem->pages, 'options' => $options, 'isParent' => false])
                @endif
            </li>
        @endif
    @endforeach

</ul>
