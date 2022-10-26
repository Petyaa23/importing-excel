@extends('layouts.app')

@section('content')
    <dashboard :cars = "{{ $cars }}"> </dashboard>
@endsection
