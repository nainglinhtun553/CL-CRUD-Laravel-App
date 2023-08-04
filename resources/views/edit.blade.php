@extends('master')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-6 offset-3 ">

				<div class="my-3">
					<a href="{{ route('post#updatePage',$post['id']) }}" class="text-decoration-none text-black">
						<i class="fa-sharp fa-solid fa-arrow-left"></i>	back
					</a>				
				</div>

				
				<form action="{{route('post#update')}}" method="post" >
					@csrf
					<label>Post Title</label>
					<input type="hidden" name="postId" value="{{$post['id']}}">  
					<input type="text" name="postTitle"class="form-control my-3" value="{{ $post['title'] }}" placeholder="Enter Post Title" required>
					<label class="my-3">Post Description</label>
					<textarea class="form-control " name="postDescription"cols="30" rows="10" placeholder="Enter Post Description" required>
						{{$post['description']}}
					</textarea>
					<input type="submit" value="Update" class="btn bg-dark text-white my-3 float-end">
				</form>
			</div>
		</div>
</div>
@endsection