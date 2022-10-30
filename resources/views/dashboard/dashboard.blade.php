@extends('layouts.app')

@section('content')
    <dashboard :cars = "{{ json_encode($cars )}}"> </dashboard>
    @endsection
