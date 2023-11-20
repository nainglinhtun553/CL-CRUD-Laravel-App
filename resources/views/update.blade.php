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
				<div class="d-flex">
					<div class="btn btn-sm bg-dark text-white me-2 my-3"><i class="fa-solid fa-money-bill-1 text-primary"></i> {{ $post[0]['price'] }} Kyats</div>
					<div class="btn btn-sm bg-dark text-white me-2 my-3"><i class="fa-solid fa-location-dot text-danger"></i> {{ $post[0]['address'] }}</div>
					<div class="btn btn-sm bg-dark text-white me-2 my-3"><i class="fa-solid fa-star text-warning"></i>{{ $post[0]['rating'] }}</div>
					<div class="btn btn-sm bg-dark text-white me-2 my-3"><i class="fa-regular fa-calendar-days"></i> {{$post[0]->created_at->format("j-F-Y")}}</div>
					<div class="btn btn-sm bg-dark text-white me-2 my-3"><i class="fa-solid fa-clock"></i> {{$post[0]->created_at->format("h:m:s:A")}}</div>
				</div>
				<div class="">
							@if($post[0]['image'] == null)
							<img src="{{asset('storage/404image.png')}}" class="img-thumbnail my-4 shadow-sm" alt="">
							@else
							<img src="{{asset('storage/'.$post[0]['image'])}}" class="img-thumbnail my-4 shadow-sm" alt="">
							@endif		
				</div>

				<p class="text-muted">
					{{ $post[0]['description'] }}
				</p>
				
				
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
