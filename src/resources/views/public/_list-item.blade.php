<li>
    <a href="{{ route($lang.'.currencies.slug', $currency->slug) }}" title="{{ $currency->title }}">
        {!! $currency->title !!}
        {!! $currency->present()->thumb(null, 200) !!}
    </a>
</li>
