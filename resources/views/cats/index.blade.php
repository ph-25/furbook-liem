@extends('layouts.master')

@section('header')
	@if(isset($breed))
		All cats of {{$breed->name}}
	else
		All cats
	@endif

	<a class="btn btn-primary pull-right" href="{{route('cat.create')}}">Add new cat</a>
	<div class="clearfix"></div>



	<!-- @foreach ($cats as $cat)
	<div class="cat">
		<a href="{{url('cats/'.$cat->id)}}">
			<strong>{{$cat->name}}</strong> - {{$cat->breed->name}}
		</a>
	</div>
	@endforeach
	@stop -->
@section('content')
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
			<td><a href="{{route('cat.show', $cat->id)}}">{{$cat->name}}</a></td>
			<td>{{$cat->date_of_birth}}</td>
			<td><a href="/cats/breeds/{{$cat->breed->name}}">{{$cat->breed->name}}</a></td>
			<td><a href="{{route('cat.edit', $cat->id)}}" class="btn btn-warning">Edit</a></td>
			<td>
				<form action="{{route('cat.destroy', $cat->id)}}" method="POST" onsubmit="return confirm('Are you sure?');">
					<input type="hidden" name="_method" value="DELETE">
    				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button type="submit" class="btn btn-danger">Delete</a>
				</form>
			</td>
		</tr>	
		@endforeach
	</tbody>
</table>
