<?php

namespace App\Http\Controllers\APIS;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostControllerApi extends Controller
{
    public function posts()
    {
        $response = [];
        $posts = Post::latest()->get();
    
        foreach($posts as $post)
        {
            $category = Category::find($post->category_id);
            $user = User::find($post->user_id);
    
            $data = [
                "post" => $post,
                "category" => $category,
                "author" => $user,
                "tags"=>$post->tags()->get()
            ];
    
            $response[] = $data;
        }
    
        return response($response);
    }
    

    public function post(Post $post)
    {
        $category = Category::find($post->category_id);
        $user = User::find($post->user_id);

        $data = [
            "post"=>$post,
            "category"=> $category,
            "author"=> $user,
            "tags"=>$post->tags()->get()

            

        ];

        $response = [$data];

        return response($response);
       
    }


    public function categories()
    {
        $categories = Category::all();
        return response($categories);
    }

    public function tags()
    {
        $tags = Tag::all();
        return response($tags);
    }
    

    public function category(Category $category)
    {
        $posts = $category->posts;

        foreach($posts as $post)
        {
            $category = Category::find($post->category_id);
            $user = User::find($post->user_id);


            $data = [
                "post"=>$post,
                "category"=> $category,
                "author"=> $user,
                "tags"=>$post->tags()->get()

                
            ];

            $response[] = $data;

        }
     
        return response($response);
    }

    public function tag(Tag $tag)
    {
        $response = [];

        $posts = $tag->posts;

        foreach($posts as $post)
        {
            $category = Category::find($post->category_id);
            $user = User::find($post->user_id);


            $data = [
                "post"=>$post,
                "category"=> $category,
                "author"=> $user,
                "tags"=>$post->tags()->get()

                
            ];

            $response[] = $data;

        }

        return response($response);

}

    public function user(User $user)
    {
        $posts = $user->posts; 

        foreach($posts as $post)
        {
            $category = Category::find($post->category_id);
            $user = User::find($post->user_id);


            $data = [
                "post"=>$post,
                "category"=> $category,
                "author"=> $user
                

            ];

            $response[] = $data;
        }

     
        return response($response);
    }

    public function post_creation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'slug' => 'required',
            'tags'=>'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $errors,
            ], 422); 
        }


        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category_id');
        $post->user_id = $request->input('user_id');
        $post->slug = $request->input('slug');
        $post->save();

        $existing_tags = Tag::all();
        $tags = $request["tags"];
        $array = explode(",", $tags);

        foreach ($array as $arr) {
            $tagExists = false;

            foreach ($existing_tags as $existing_tag) {
                if (trim($arr) === $existing_tag->name) {
                    $tagExists = true;
                    $existing_tag->posts()->attach($post);
                    break;
                }
            }

            if (!$tagExists) {
                $tag = Tag::create([
                    'name' => trim($arr)
                ]);
                $tag->posts()->attach($post);
            }
        }

        return response('{"message": "Article post successful", "post_id": ' . $post->id . '}', 201);
    }

    
}
