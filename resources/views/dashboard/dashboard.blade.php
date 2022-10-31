@extends('layouts.app')
@section('content')

    <dashboard
        :cars = "{{ json_encode($cars) }}"
        :session = "{{ json_encode($session) }}">
    </dashboard>
@endsection
