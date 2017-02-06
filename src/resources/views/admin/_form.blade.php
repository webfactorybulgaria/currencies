@section('js')
    <script src="{{ asset('components/ckeditor/ckeditor.js') }}"></script>
@endsection

@include('core::admin._buttons-form')

{!! BootForm::hidden('id') !!}
<div class="row">
    <div class="col-md-4">
        {!! BootForm::select(trans('currencies::global.attributes.format'), 'format', config('typicms.currencies.formats')) !!}
    </div>
    <div class="col-md-4">
        {!! BootForm::text(trans('currencies::global.attributes.rate'), 'rate') !!}
    </div>
    <div class="col-md-4">
        {!! BootForm::text(trans('currencies::global.attributes.iso'), 'iso') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        {!! TranslatableBootForm::text(trans('validation.attributes.title'), 'title') !!}
    </div>
    <div class="col-md-4">
        {!! TranslatableBootForm::text(trans('currencies::global.attributes.symbol'), 'symbol') !!}
    </div>
    <div class="col-md-4">
        {!! TranslatableBootForm::hidden('status')->value(0) !!}
        {!! TranslatableBootForm::checkbox(trans('validation.attributes.online'), 'status') !!}
    </div>
</div>
