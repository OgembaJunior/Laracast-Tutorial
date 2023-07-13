<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{

    public function getPosts()
    {
        return Post::latest()->filter()->paginate(5);

    }


    public function index()
    {
                
        return view('posts',[
            'posts'=>$this->getPosts()
        ]);
    }

    public function show(Post $post)
    {
        
        return view('post',[
            'post'=>$post
        ]);
    }

    public function category(Category $category)
    {
        $posts = $category->posts;
        
        return view('posts',[
            'posts'=>$posts
        ]);
    }

    public function author(User $user)
    {
        $posts = $user->posts;
        
        return view('posts',[
            'posts'=>$posts
        ]);
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts;
        
        return view('posts',[
            'posts'=>$posts
        ]);
    }


    public function create()  {
        if (auth()->check()){
            $categories = Category::all();
            $tags = Tag::all();

        }
        else{
            return redirect('sign-in');
        }

        $assoc_array = [
            "categories"=>$categories,
            "tags"=>$tags

        ];

        return view('post_creation', $assoc_array);
    }


    public function create_post(Request $request)  {
        if (auth()->check())
        {
                    
            $fields = $request->validate([
                'title'=>['required', 'min:3'],
                'body' => ['required', 'min:10'],
                'category_id' => ['required'],
                'user_id'=> ['required'],
                'slug'=> ['required']
    
            ]);

            $post = Post::create($fields);
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
            return redirect('/');
        }

        else
        {
            return redirect('sign-in');
        }


        return view('post_creation');
    }

    
}
