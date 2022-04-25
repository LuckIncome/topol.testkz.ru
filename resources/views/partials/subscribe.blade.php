<div class="subscription">
    <div class="inline-form">
        <p>@lang('general.subscribeTitle')</p>
        <form action="{{route('subscribe')}}">
            <input type="email" name="email" required placeholder="Email">
            {{csrf_field()}}
            {!! htmlFormSnippet() !!}
            <button type="submit" class="btn-darkgreen">@lang('general.subscribeBtn')</button>
        </form>
    </div>
    <div class="text-success">
        <p>@lang('general.subscribeThanks')</p>
    </div>
</div>
<div class="socials">
    <p>@lang('general.inSocials')</p>
    <ul>
        @foreach($socials as $social)
            <li><a href="{{$social->link}}"><i class="icon {{$social->name}}"></i> {{$social->value}}</a></li>
        @endforeach
    </ul>
</div>