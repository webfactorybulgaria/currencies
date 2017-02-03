<ul class="list-currencies">
    @foreach ($items as $currency)
    @include('currencies::public._list-item')
    @endforeach
</ul>
