@extends('master')

@section('content')
 <div class="container">
 	<div class="row mt-5">
 		<div class="col-5">
 			<div class="p-3">
             <!-- for create success function -->

            @if(session('insertSuccess'))               
                <div class="alert-message">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>{{ session('insertSuccess')}}</strong> 
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                </div>
            @endif 

            <!-- for create success function-->


            <!-- for update success message function -->
            @if(session('updateSuccess'))               
                <div class="alert-message">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>{{ session('updateSuccess')}}</strong> 
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                </div>
            @endif   
             <!-- for update success message function -->


            <!-- error message for validation rule -->
          
            <!-- original form from laravel doc -->

           <!--  @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error) 
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif -->


            <!-- original form from laravel doc -->

            <!-- error message for validation rule -->



 				<form action="{{ route('post#create') }}" method="post" enctype="multipart/form-data">
                    @csrf
 					<div class="text-group mb-3">
 						<label for="">Post Title</label>
 					      <input type="text" name="postTitle" id="" class="form-control @error('postTitle') is-invalid  @enderror" value="{{old('postTitle')}}" placeholder="Enter Post Title...">
                         <!-- show error message for post title -->
                          @error('postTitle')
                            <div class="invalid-feedback">
                              {{ $message }}
                        </div>
                          @enderror
                          <!-- show error message for post title -->
 					</div>

 					<div class="text-group mb-3">
 						<label for="">Post Description</label>
 					      <textarea name="postDescription" class="form-control @error('postDescription') is-invalid  @enderror" id="" cols="30" rows="10" placeholder="Enter Post Description...">
                                {{old('postDescription')}}              
                          </textarea>


                          <!-- show error message for post Description -->
                          @error('postDescription')
                            <div class="invalid-feedback">
                              {{ $message }} 
                        </div>
                          @enderror
                          <!-- show error message for post Description -->
 					</div>
                   
          <div class="text-group mb-3"> 
 					 <label for="">Image</label>
                         <input type="file" name="postImage" id="" class="form-control  @error('postImage') is-invalid @enderror" value="{{old('postImage')}}">	
                         @error('postImage')
                         <div class="invalid-feedback">
                           {{ $message }} 
                     </div>
                       @enderror
                                           
                         
           </div>  


            <div class="text-group mb-3">
 						<label for="">Fee</label>
                         <input type="number" name="postFee" id="" class="form-control @error('postFee') is-invalid @enderror" value="{{old('postFee')}}" placeholder="Enter Post Fee...">					

                         
                         @error('postFee')
                            <div class="invalid-feedback">
                              {{ $message }} 
                        </div>
                          @enderror
                         
                    </div>
                    

                    <div class="text-group mb-3">
 						<label for="">Address</label>
                         <input type="text" name="postAddress" id="" class="form-control @error('postAddress') is-invalid @enderror" value="{{old('postAddress')}}" placeholder="Enter Post Address...">					
                          <!-- show error message for post Description -->
                          @error('postAddress')
                            <div class="invalid-feedback">
                              {{ $message }} 
                        </div>
                          @enderror
                          <!-- show error message for post Description -->

                         
                    </div>


                      <div class="text-group mb-3">
 						<label for="">Rating</label>
                         <input type="number" name="postRating" min="0" max="5" id="" class="form-control @error('postRating') is-invalid @enderror" value="{{old('postRating')}}" placeholder="Enter Post Rating.....">					
                         <!-- show error message for post Description -->
                         @error('postRating')
                            <div class="invalid-feedback">
                              {{ $message }} 
                        </div>
                          @enderror
                          <!-- show error message for post Description -->
                    </div>
                    

                     <!-- image-storage -->





 					<div class="mb-3">
 						<input type="submit" value="Create" class="btn btn-danger">
 					</div>
				</form>
 			</div>
 		</div>



 		<div class="col-7">

            <h3 class="mb-3">
                <div class="row">
                    <div class="col-5"> Total-{{$posts->total()}}</div>
                    <div class="col-6 offset-1">
                        
                              <form action="{{route('post#createPage')}}" method="get">
                                    <div class="row">
                                            <input type="text" name="searchKey" value="{{request('searchKey')}}"  class="form-control col" placeholder="Enter Search Key....">
                                            &nbsp;<button class="btn btn-danger col-2" type="submit">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </button>
                                    </div>
                              </form>
                       
                    </div>

                    
                </div>
            </h3>


 			<div class="data-container">
               <!-- for posts components  -->
               @if(count($posts) !=0) 
               @foreach($posts as $item)
                <div class="post p-3 shadow-sm mb-4">
                    <div class="row">
                        <h5 class="col-7">{{$item->title}}</h5> 
                        <h5 class="col-4 offset-1">{{ $item->created_at->format("j-F-Y ") }}</h5>

                        <div class="col">
                            <!-- <span class="text-secondary">{{ $item['created_at'] }}</span> -->
                            
                        </div>
                        
                    </div>

                    <div class="">
                        @if($item->image == null)
                        <img src="{{asset('storage/404image.png')}}" class="img-thumbnail my-4 shadow-sm" alt="">
                        @else
                        <img src="{{asset('storage/'.$item->image)}}" class="img-thumbnail my-4 shadow-sm" alt="">
                        @endif		
                     </div>



                        <p class="text-muted">
                        <!-- pure php writing rule -->
                        <!-- {{substr($item['description'],0,100)}} -->
                        <!-- simple text -->
                        <!-- $item['description'] -->


                        <!-- laravel wrting rule  -->
                         {{ Str::words($item->description,25,'.......')}}
                    </p>

                    <span>
                       <small> <i class="fa-solid fa-money-bill-1 text-primary"></i>{{$item->price}} Kyats</small>
                    </span>|

                    <span>
                        <i class="fa-solid fa-location-dot text-danger"></i>{{$item->address}}
                    </span>|

                    <span>
                        {{$item->rating}}<i class="fa-solid fa-star text-warning"></i>
                    </span>



                    <div class="text-end"> 
                        <!-- first way -->
                        <!-- $item->id is a format of object -->
                        <a href="{{ route('post#delete',$item->id) }}">
                            <button class="btn btn-sm btn-danger"><i class="fa-sharp fa-solid fa-trash"></i> &nbsp;ဖျက်ရန်</button>
                        </a> &nbsp;

                        <!-- second way -->
                       <!--  <form action="{{ route('post#delete',$item['id']) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa-sharp fa-solid fa-trash"></i> ဖျက်ရန်</button>

                        </form> -->

                        <a href="{{ route('post#updatePage',$item->id)}}">
                             <button class="btn btn-sm btn-primary"><i class="fa-regular fa-file-lines"></i>&nbsp; အပြည့်အစုံ ဖတ်ရန်</button>
                        </a>                      
                       
                    </div>
                </div>

               @endforeach
               @else
               <h3 class="text-danger text-center mt-5">There is no data....</h3>
               @endif
            </div>

            {{$posts->appends(request()->query())->links()}}

 		</div>
 	</div>
 </div>
@endsection