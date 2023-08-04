<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //customer create page
    public function create(){
        // take all data from database.
        // to array mean change to array format.
        // you can write all() or get().
        $posts=Post::orderBy('created_at','desc')->get()->toArray();
        //output with dd view
        // dd($posts[0]['title']);
        // dd($posts);
        return view('create',compact('posts'));
    }


    //post create
    public function postCreate(Request $request){
           
           $data= $this->getPostData($request);
           //create data into database
            Post::create($data);

            return redirect()->route('post#createPage');

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
        $post= Post::where('id',$id)->get()->toArray();
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
        //call a function from get update data function
        // dd($request->all());
        $updateData = $this->getPostData($request);
        // reesult 
        // dd($updateData);

        $id=$request->postId;      

        // real update function

        Post::where('id',$id)->update($updateData);
        // redirect page after update function.
        return redirect()->route('post#home');

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
                'description'=>$request->postDescription
                
            ];

         }


}
;