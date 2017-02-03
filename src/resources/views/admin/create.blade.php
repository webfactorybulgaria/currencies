@extends('core::admin.master')

@section('title', trans('currencies::global.New'))

@section('main')

    @include('core::admin._button-back', ['module' => 'currencies'])
    <h1>
        @lang('currencies::global.New')
    </h1>

    {!! BootForm::open()->action(route('admin::index-currencies'))->multipart()->role('form') !!}
        @include('currencies::admin._form')
    {!! BootForm::close() !!}

@endsection
