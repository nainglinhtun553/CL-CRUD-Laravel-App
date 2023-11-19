@extends('master')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-6 offset-3 ">

				<div class="my-3">
					<a href="{{ route('post#home') }}" class="text-decoration-none text-black">
						<i class="fa-sharp fa-solid fa-arrow-left"></i>	back
					</a>				
				</div>

				<h3> {{ $post[0]['title'] }}</h3>
				<p class="text-muted">
					{{ $post[0]['description'] }}
				</p>
				<h3> {{ $post[0]['price'] }}</h3>
				<h3> {{ $post[0]['address'] }}</h3>
				<h3> {{ $post[0]['rating'] }}</h3>

				{{$post[0]->created_at->format("j-F-Y")}}
			</div>
		</div>

		<div class="row my-3">
			<div class="col-3 offset-8">
				<a href="{{route('post#editPage',$post[0]['id'])}}">
					<button class="btn btn-dark text-white">Edit</button>
				</a>
			</div>
		</div>
	</div>
@endsection
