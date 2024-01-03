<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class PostController extends Controller
{
    // get posts
    public function get_posts(){
        $posts = DB::table("posts")->orderBy('id', 'desc')->get();
        return response()->json($posts);
    }
    // get post
    public function get_post($id){
        $post = DB::table("posts")->find($id);
        return response()->json(['post' => $post]);
    }
    // view all post
    public function view_all_post(){
        $posts = DB::table("posts")->orderBy('id', 'desc')->get();
        return view("dashboard",compact("posts"));
    }
    // create a post
    public function create_a_post(Request $request){
        $request->validate([
            "image"=>"required|image|mimes:jpeg,png,jpg,svg,gif|max:5000"
        ]);
        $imageName = time().".".$request->image->extension();
        $request->image->move(public_path("images"),$imageName);
        $url = $request->url();

        // Parse the URL to extract the scheme and host
        $parsedUrl = parse_url($url);

        // Reconstruct the base URL using the scheme and host
        $baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
        // If the port is present and not a standard port, append it to the base URL
        if (isset($parsedUrl['port']) && !in_array($parsedUrl['port'], [80, 443])) {
            $baseUrl .= ':' . $parsedUrl['port'];
        }
        $image_link = $baseUrl."/blog_app/public/images/".$imageName;
        $data = [
            "title" => $request->title,
            "date" => $request->date,
            "description" => $request->description,
            "image"=>$imageName,
            "img_url"=>$image_link
        ];
        DB::table("posts")->insert($data);
        return redirect()->route("dashboard");
    }
    // edit a post
    public function edit_a_post(Request $request,$id){
        $post = DB::table("posts")->find($id);
        $flag = 0;
        if($request->flag){
            $flag = $request->flag;
        }
        return view("editPost",compact("post","flag"));
    }

    // update a post
    public function update_a_post(Request $request, $id){
        if($request->image){
            // delete older image
            $post = DB::table("posts")->find($id);
            if(File::exists("images/".$post->image)){
                File::delete("images/".$post->image);
            }
            // uplaod new image
            $request->validate([
                "image"=>"required|image|mimes:jpeg,png,jpg,svg,gif|max:5000"
            ]);
            $imageName = time().".".$request->image->extension();
            $request->image->move(public_path("images"),$imageName);
            $url = $request->url();
    
            // Parse the URL to extract the scheme and host
            $parsedUrl = parse_url($url);
    
            // Reconstruct the base URL using the scheme and host
            $baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
            // If the port is present and not a standard port, append it to the base URL
            if (isset($parsedUrl['port']) && !in_array($parsedUrl['port'], [80, 443])) {
                $baseUrl .= ':' . $parsedUrl['port'];
            }
            $image_link = $baseUrl."/blog_app/public/images/".$imageName;
            $data = [
                "title" => $request->title,
                "date" => $request->date,
                "description" => $request->description,
                "image"=>$imageName,
                "img_url"=>$image_link
            ];
            DB::table("posts")->where("id", $id)->update($data);
            return redirect()->route("post.edit",["id"=>$id,"flag"=>true]);
        }else{
            $data = [
                "title" => $request->title,
                "date" => $request->date,
                "description" => $request->description,
            ];
            DB::table("posts")->where("id", $id)->update($data);
            return redirect()->route("post.edit",["id"=>$id,"flag"=>true]);
        }
        
    }
    // delete a post
    public function delete_a_post($id){
        $post = DB::table("posts")->find($id);
        if(File::exists("public/images/".$post->image)){
            File::delete("public/images/".$post->image);
        }
       
        DB::table("posts")->where("id",$id)->delete();
        return redirect()->route("dashboard");
    }
}
