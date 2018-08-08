@extends('layouts.master')

@section('header')
	@if(isset($breed))
	<a href="{{url('/')}}">Back to the overview</a>
	@endif
	<h2>
		All @if(isset($breed)) {{$breed->name}}@endif Cats
		<a href="{{url('cats/create')}}" class="btn btn-primary pull-right">Add new cat</a>
	</h2>
@stop
@section('content')
	@foreach ($cats as $cat)
	<div class="cat">
		<a href="{{url('cats/'.$cat->id)}}">
			<strong>{{$cat->name}}</strong> - {{$cat->breed->name}}
		</a>
	</div>
	@endforeach
@stop
<table class="table table-border">
	<thead>
		<th>ID</th>
		<th>Name</th>
		<th>Birthday</th>
		<th>Breed Name</th>
		<th colspan="2">Action</th>
	</thead>
	<tbody>
		@foreach ($cats as $cat)
		<tr>
			<td>{{$cat->id}}</td>
			<td>{{$cat->name}}</td>
			<td>{{$cat->date_of_birth}}</td>
			<td><a href="/cats/breeds/{{$cat->breed->name}}">{{$cat->breed->name}}</a></td>
			<td><a href="/cats/{{$cat->id}}/edit" class="btn btn-warning">Edit</a>|<a href="#" class="btn btn-danger">Delete</a></td>
		</tr>
		@endforeach
	</tbody>
</table>