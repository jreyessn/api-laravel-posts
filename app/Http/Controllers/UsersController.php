<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::with(["videos", "posts"])->paginate();
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
            "name"      => "required|string|max:255",
            "email"     => "required|email|unique:users,email",
            "password"  => "string|min:4"
        ]);

        DB::beginTransaction();

        try{
            $user = User::create($request->all());
            
            DB::commit();

            return response()->json([
                "message" => "Registro éxitoso",
                "data"    => $user
            ], 201);

        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return [
            "data" => $user->load(["videos", "posts"])
        ];
    }

}
