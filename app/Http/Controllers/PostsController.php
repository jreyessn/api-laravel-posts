<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::with(["user"])->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"     => "required|string|max:155",
            "body"      => "nullable|string",
            "tags"      => "array"
        ]);

        DB::beginTransaction();

        try{
            $data = $request->all();
            $data["user_id"] = 1; // Test

            $post = Post::create($data);
            
            $tags = $this->tagMap($data["tags"] ?? []);
            $post->tags()->saveMany($tags);

            DB::commit();

            return response()->json([
                "message" => "Registro éxitoso",
                "data"    => $post
            ], 201);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Mapea una colección de instancias del modelo Tag. 
     * Ignore case sensitivy. Crear aquellos tag que no existen
     * 
     * @param array $tags Nombre de tags 
     */
    private function tagMap($tags)
    {
        return collect($tags)->map(function($tag){
            return Tag::firstOrCreate(["name" => $tag]);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return [
            "data" => $post->load(["user"]) 
        ];
    }


}
