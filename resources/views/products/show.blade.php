@extends('layouts.app')

@section('content')
    @livewire('product-detail', ['product' => $product])
@endsection