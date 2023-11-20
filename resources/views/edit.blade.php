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

				
				<form action="{{route('post#update')}}" method="post" enctype="multipart/form-data">
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
						<label for="">Image:</label>
						  <div class="">
							@if($post['image'] == null)
							<img src="{{asset('storage/404image.png')}}" class="img-thumbnail my-2 shadow-sm" alt="">
							@else
							<img src="{{asset('storage/'.$post['image'])}}" class="img-thumbnail my-2 shadow-sm" alt="">
							@endif		
						</div>

					{{-- to update image  --}}
					<input type="file" name="postImage" id="" class="form-control @error('postImage') is-invalid @enderror" value="{{old('postImage')}}">	
						@error('postImage')
					<div class="invalid-feedback">
						  {{ $message }} 
					</div>
					  @enderror
					 {{-- to update image  --}}

						

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


						



						  <input type="text" name="postFee"class="form-control my-3" value="{{old('postFee',$post['price']) }}" placeholder="Enter Post Title">

						  <!-- show error message for post title -->
							   @error('postFee')
								 <div class="invalid-feedback mb-3">
								   {{ $message }}
							 </div>
							   @enderror
							   <!-- show error message for post title -->
						  


							   <input type="text" name="postAddress"class="form-control my-3" value="{{old('postAddress',$post['address']) }}" placeholder="Enter Post Address">

							   <!-- show error message for post title -->
									@error('postAddress')
									  <div class="invalid-feedback mb-3">
										{{ $message }}
								  </div>
									@enderror
									<!-- show error message for post title -->


									<input type="text" name="postRating"class="form-control my-3" value="{{old('postRating',$post['rating']) }}">

									<!-- show error message for post title -->
										 @error('postAddress')
										   <div class="invalid-feedback mb-3">
											 {{ $message }}
									   </div>
										 @enderror
										 <!-- show error message for post title -->

					<input type="submit" value="Update" class="btn bg-dark text-white my-3 float-end">
				</form>
			</div>
		</div>
</div>
@endsection