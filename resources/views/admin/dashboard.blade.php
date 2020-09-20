@extends('admin.layout')

@section('content')
	<h1>Dashboard</h1>

	<p>Usuario:{{ auth()->User()->name }} </p>
	
@stop