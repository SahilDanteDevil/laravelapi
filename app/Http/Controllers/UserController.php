<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        return UserResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->only('first_name','last_name','email','role_id') + ['password' => Hash::make($request->input('password'))]);

        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {

        $user = User::find($id);

        // $user->update([            
        //     'first_name'=> $request->input('first_name'),
        //     'last_name'=> $request->input('last_name'),
        //     'email'=> $request->input('email'),
        //     'password'=> Hash::make($request->input('password')),
        //     'remember_token'=>$request->input('remember_token'),
        // ]);
        $user->update($request->only('first_name','last_name','email','role_id'));
        return response(new UserResource($user),Response::HTTP_ACCEPTED);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response("DELETED",Response::HTTP_NO_CONTENT);
    }

    public function user(){
        return new UserResource(Auth::user());
    }

    public function updateInfo(Request $request){
        $user = Auth::user();

        $user->update($request->only('first_name','last_name','email'));

        return response(new UserResource($user),Response::HTTP_ACCEPTED);
    } 

    public function updatePassword(Request $request){
        $user = Auth::user();

        $user->update([
            'password'=> Hash::make($request->input('password'))
        ]);

         return response(new UserResource($user),Response::HTTP_ACCEPTED);
    }
}
