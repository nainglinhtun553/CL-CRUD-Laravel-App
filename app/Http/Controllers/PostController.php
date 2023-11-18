<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\validator;

class PostController extends Controller
{
    //customer create page
    public function create(){
        // take all data from database.
        // to array mean change to array format.
        // you can write all() or get().
       
        // $posts=Post::get();
        // $posts=Post::first();
         // $posts=Post::get()->last();
        // dd($posts->toArray());
        // catch with collection ($posts->title)| catch with array ($posts['title'])
        // $posts=Post::orderBy('created_at','desc')->get();

        // $posts=Post::pluck('title');
        // $posts=Post::select("title","price")->get();
        // $posts=Post::select("title","rating")->get();
        // dd($posts->toArray());
        // dd($posts->toArray());

        // $posts=Post::get()->pluck('title');
        // dd($posts);

        // address ကို sagaing ဖြစ်တဲ့ပာာကို ramdom ပြပေးပါဆို အောက်ပါအတိုင်း ရေးရသည်။ 
        // $posts=Post::where('address','sagaing')->get()->random();

        // နှစ်ခုစလုံးရမှ data ရမည်ဆိုရင် where 
        // နှစ်ခုထဲက တစ်ခု ဆိုရင် orWhere ကို သုံးရသည်။ 
        // $posts=Post::where('id','<',20)->where('address','sagaing')->get();
        // $posts=Post::orWhere('id','<',20)->orWhere('address','sagaing')->get();
          // $posts=Post::orderBy('id','asc')->get();
        // $posts=Post::orderBy('price','desc')->get();
        // between price 
        // $posts=Post::whereBetween('price',[3000,9000])->orderBy('price','asc')->get();
        // $posts=Post::select('id','title','address','price')->where('address','sagaing')->whereBetween('price',[3000,9000])->orderBy('price','asc')->get();

        // $posts=Post::where('address','sagaing')->dd();
        // $posts=Post::select('address',DB::raw('COUNT(address) as count_address'))->groupBy('address')->get();


        // dd($posts->toArray());
        // dd($posts[0]);



        // database မှာ title description ကို စကားလုံး အကြီးတွေ ပြောင်းချင်ရင် အောက်ပါအတိုင်း ရေးသည်။ 
        // $post =Post::get()->map(function($post){
        //     $post->title= strtoupper($post->title);
        //     $post->description=strtoupper($post->description);
        // return $post;
             
        // });
        // dd($post->toArray());


        // each using
        // $post =Post::get()->each(function($post){
        //     $post->title= strtoupper($post->title);
        //     $post->description=strtoupper($post->description);
        //     $post->price= $post->price * 2;
        //     return $post;
            
        // });
        // dd($post->toArray());


        // $post =Post::paginate(5)->through(function($post){
        //     $post->title= strtoupper($post->title);
        //     $post->description=strtoupper($post->description);
        //     $post->price= $post->price * 2;
        //     return $post;
            
        // });
        // dd($post->toArray());



        //output with dd view
        // dd($posts[0]['title']);
        // dd($posts['total']);
        // dd($posts);



        // data searching into database from url 
        //http://localhost:8000/customer/createPage?key="code lab"
        // $searchKey=$_REQUEST['key'];
        // $post = Post::where('title',$searchKey)->get()->toArray();


        // $post = Post::where('title','like','%'.$searchKey.'%')->get()->toArray();

        // search key ပါမပါ စစ်  ပါခဲ့ရင် filter လုပ် မပါခဲ့ရင် အကုန်ချပြ
        // $post= Post::when(request('key'),function($p){
        //     $searchKey=$_REQUEST['key'];
        //     // check condition
        //     $p->where('title','like','%'.$searchKey.'%');
        // })->get();
        // dd($post->toArray());
        // Post::where('title','like','%'.$searchKey.'%')->get();
        
        
        // http://127.0.0.1:8000/?page=2
        
        

        // $posts=Post::orderBy('created_at','desc')->paginate(3);


        // data searching
     $posts =Post::when(request('searchKey'),function($query){
            $key =request('searchKey');
            $query->orWhere('title','like','%'.$key.'%')
            ->orWhere('description','like','%'.$key.'%');
        })->orderBy('created_at','desc')->paginate(4);
        return view('create',compact('posts'));
    }

    


    //post create
    public function postCreate(Request $request){
        // dd($request->all());

        // file ပါမပါ temary operator ကိုသုံးပြီး စစ်ကြည့်မည်။ 
        // dd($request->hasFile('postImage')?'yes':'no');

        // image ကို အောက်ပါအတိုင်း ဖမ်းကြည့်မည်။
        // dd($request->file('postImage'));
        // another way the catch the image.
         // dd($request->postImage);

        // to find the image path.
        // dd($request->postImage->path());

        // to find image extension.
        // dd($request->postImage->extension());



       // to take origial name of image with extension.
    //    dd($request->postImage->getClientOriginalName());


        // dd($request->postTitle);
        // dd($request->postFee);
        $this->postValidationCheck($request,"create");
         // validation rule creation
         $data= $this->getPostData($request);
        // has or hasn't image to catch the if statement.
        if($request->hasFile('postImage')){
            // to save the folder of storage>app
            // $request->file('postImage')->store('myImage');
            // to save the image with user assign name in store>app>myImage folder.
            // **************************************************************************
            // to assign the original file name for saving with original name.
            $fileName= uniqid().$request->file('postImage')->getClientOriginalName();
            // write for to do the save function of images
            $request->file('postImage')->storeAs('public',$fileName);
            $data['image']=$fileName;
             // to show the success step.
            // dd("store success");

        }
        // dd($data);
        // dd('not have photo');  

           
        // validation rule creation
        // validator::make($request->all(),[

        //     // posttitle name from create.blade.php
        //     // search Available Validation Rules in laravel doc.
        //     'postTitle'=>'required|min:5|unique:posts,title',
        //     // postdescription name from create.blade.php
        //     'postDescription'=>'required||min:5'

        // ])->validate();


          //second way old

        //      $validator = Validator::make($request->all(), [
        //     'postTitle' => 'required',
        //     'postDescription' => 'required',
        // ]);
 
        // if ($validator->fails()) {
        //     return back()
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }
      
           //create data into database
            Post::create($data);          

            return redirect()->route('post#createPage')->with(['insertSuccess'=>'Post ဖန်တီးခြင်းအောင်မြင်ပါသည်']);

            // redirect the createpage
            // return view('create');
            // return back();
            // return redirect('testing');// url
           // return redirect()->route('test');// name
    }





    // for post delete route 
    public function postDelete($id){
        
        // dd($id);
        //first way
        // Post::where('id',$id)->delete();
        // redirect to the post page.
        // return redirect()->route('post#createPage');


        //second way
         Post::find($id)->delete();
            return back();        

    }


    // for direct update post
    public function updatePage($id){


        // search the data with id number.
        // first way
        $post= Post::where('id',$id)->get();
        // $post= Post::where('id',$id)->first()->toArray();
        // dd($post);

        //second way
        // $post=Post::find($id)->get()->toArray();
        // dd($post);
        return view('update',compact('post'));

    }

    // for edit page
    public function editPage($id){
        $post=Post::where('id',$id)->first()->toArray();
        return view('edit',compact('post'));
    }



        // update post
    public function update(Request $request){
            // dd($request->all());

          // custom messages creation
        //validation rule when update data from user.
        $this->postValidationCheck($request,"update");

        
        //call a function from get update data function
        // dd($request->all());
        $updateData = $this->getPostData($request);
        // reesult 
        // dd($updateData);

        $id=$request->postId;      

        // real update function

        Post::where('id',$id)->update($updateData);
        // redirect page after update function.
        return redirect()->route('post#home')->with(['updateSuccess'=>'update လုပ်ခြင်းအောင်မြင်ပါသည်']);

    }

    // get update data
    // private function getUpdateData($request){
    //     return[

    //         'title'=>$request->updateName,
    //         'description'=>$request->updateDescription
    //     ];

    // }  


    // private function
    // get post data
    private function getPostData($request){
        // $response =[
        //         'title' =>$request->postTitle,
        //         'description'=>$request->postDescription
        //     ];
        //     return $response;
        return [
                'title' =>$request->postTitle,
                'description'=>$request->postDescription,
                'price'=>$request->postFee,
                'address'=>$request->postAddress,
                'rating'=>$request->postRating
                
            ];
         }

        
    //postvalidationcheck
     private function postValidationCheck($request,$status){
         $validationRules=[
            'postTitle'=>'required|min:5|unique:posts,title',
            // postdescription name from create.blade.php
            'postDescription'=>'required||min:5',
            'postImage'=>'mimes:jpg,bmp,jpeg,png'            
            
        ];   

             // custom messages creation 
        
        $validationMessage=[
            'postTitle.required'=>'Post Title ဖြည့်ရန် လိုအပ်ပါသည်။',
            'postTitle.min'=>'အနည်းဆုံး ၅လုံးအထက် ရှိရမည်။',
            'postDescription.min'=>'အနည်းဆုံး ၅လုံးအထက် ရှိရမည်။',
            'postTitle.unique'=>'ခေါင်းစဥ်တူနေပါသည်,ထပ်မံရိုက်ကြည့်ပါ။',
            'postDescription.required'=>'Post Description ဖြည့်ရန် လိုအပ်ပါသည်။',
            'postFee.required'=>'Post Fee ဖြည့်ရန် လိုအပ်ပါသည်။',
            'postAddress.required'=>'Post Address ဖြည့်ရန် လိုအပ်ပါသည်။',
            'postRating.required'=>'Post Rating ဖြည့်ရန် လိုအပ်ပါသည်။',
            'postImage.mimes'=>'image သည် jpg,bmp,jpeg,png file typpe ဖြစ်ရန် လိုအပ်ပါသည်။'
        ];

        validator::make($request->all(),$validationRules,$validationMessage)->validate();
        // custom messages creation 
     }


};