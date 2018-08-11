@extends('layouts.master')

@section('header')
	<a href="/cats">Back to overview</a>
	<h2>{{ $cat->name }}</h2>
	<a href="{{route('cat.edit', $cat->id)}}">
		<span class="glyphicon glyphicon-edit"></span>
		Edit
	</a>
	 <form action="{{route('cat.destroy', $cat->id)}}"
        method="POST" onsubmit="return confirm('Are you sure?');">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <a href="javascript:void(0);" onclick="$(this).parent().submit();">
            <span class="glyphicon glyphicon-trash"></span>
            Delete
        </a>
    </form>
	<p>Last edited: {{ $cat->updated_at->diffForHumans() }}</p>
@stop

@section('content')
	<p>Date of Birth: {{ $cat->date_of_birth }}</p>
	<p>
		@if ($cat->breed)
			Breed:
			{{ link_to ('cats/breeds/'.$cat->breed->name, $cat->breed->name) }}
		@endif
	</p>
@stop