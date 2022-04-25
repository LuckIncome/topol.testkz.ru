<ul class="breadcrumbs">
    <li><a href="/">@lang('general.home')</a></li>
    <li class="sep"><i class="fa fa-angle-right"></i></li>
    @if(isset($subtitle))
        @if(isset($titleLink))
            <li><a href="{{$titleLink}}">{{$title}}</a></li>
        @else
            <li class="current"><span>{{$title}}</span></li>
        @endif
        <li class="sep"><i class="fa fa-angle-right"></i></li>
        @if(isset($childTitle))
            <li><a href="{{$subtitleLink}}">{{$subtitle}}</a></li>
            <li class="sep"><i class="fa fa-angle-right"></i></li>
            @if(isset($subChildTitle))
                    <li><a href="{{$childLink}}">{{$childTitle}}</a></li>
                    <li class="sep"><i class="fa fa-angle-right"></i></li>
                    <li class="current"><span>{{$subChildTitle}}</span></li>
            @else
                    <li class="current"><span>{{$childTitle}}</span></li>
            @endif
        @else
            <li class="current"><span>{{$subtitle}}</span></li>
        @endif
    @else
        <li class="current"><span>{{$title}}</span></li>
    @endif
</ul>
