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
					<!-- old(နောက်ထည့်မည့် တန်ဖိုး,အရှေ့က databaseထဲက တန်ဖိုး) -->
					<input type="text" name="postTitle"class="form-control my-3 @error('postTitle') is-invalid  @enderror" value="{{old('postTitle',$post['title']) }}" placeholder="Enter Post Title">

					 <!-- show error message for post title -->
                          @error('postTitle')
                            <div class="invalid-feedback mb-3">
                              {{ $message }}
                        </div>
                          @enderror
                          <!-- show error message for post title -->



					<label class="my-3">Post Description</label>
					<textarea class="form-control @error('postDescription') is-invalid  @enderror " name="postDescription"cols="30" rows="10" placeholder="Enter Post Description">

						{{old('postDescription',$post['description'])}}
					</textarea>

					 <!-- show error message for post Description -->
                          @error('postDescription')
                            <div class="invalid-feedback">
                              {{ $message }} 
                        </div>
                          @enderror
                          <!-- show error message for post Description -->




					<input type="submit" value="Update" class="btn bg-dark text-white my-3 float-end">
				</form>
			</div>
		</div>
</div>
@endsection