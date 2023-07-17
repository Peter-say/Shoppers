@extends('web.layouts.app')

@section('contents')
    @livewire('add-to-cart', ['id' => $product->id])
   
@endsection
