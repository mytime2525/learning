@extends('app')

@section('content')
	<h1>Articles</h1>
	<hr class="soften">
	@foreach ($articles as $article)
		<article>
			<h2>
				<a href="{{ url('/articles',$article->id) }}"> {{ $article->title }} </a>
			</h2>
			<div class="body">{{ $article->body }}</div>

		</article>
	<hr class="soften">
	@endforeach
	<a href="{{ url('/articles/create') }}" class="btn btn-primary"> create </a>
@stop