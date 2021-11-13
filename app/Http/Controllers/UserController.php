<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User:: orderBy('created_at','desc')->paginate(15);
        return view("admin.users.index", [
            "users"=> $users
        ]);
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
    public function store(Request $request)
    {
        //
    }

    public function show($name)
    {
        $user = User:: where("name", $name)->first();
        if(!$user) return abort(404);
        $comments = $user->coments;
        $favorites = $user->favorites()->paginate(6);

        return view("user",[
            "user"=> $user,
            "comments"=> $comments,
            "favorites"=> $favorites
        ]);
    }

    public function upload(Request $request, ImageService $imageService) {
        $user = auth()->user();
        $this->authorize('update', $user);

        $validator = Validator::make($request->all(),[
            'image'=> ['required', 'mimes:jpg,png', 'max:2048']
            ], 
            [
                'image.required' => 'Внесите картинку',
                'image.mimes' => "Файл картинки не в нужном формате: png, jpg",
                'image.max' => "Максимальный размер картинки не долже привышать 2 мб",
        ]);

        if (!$validator->passes()) {
            return response()->json(["resultCode"=> 1,'errors'=> $validator->errors()->all()]);
        }
        
        $image = $imageService->upload($request->image, 'images/users');
        $imageService->delete('/images/users/'.$user->image);

        $user->image = $image;
        $user->save();

        return response()->json(["resultCode"=> 0,'image' => $image]);
    }

    public function changeName(Request $request) {
        $user = auth()->user();
        $this->authorize('update', $user);

        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'min:4', 'max:16', 'unique:users,name']
            ], 
            [
                'name.required' => "Заполните имя",
                'name.string' => "Имя пользователя должно быть в виде строки",
                'name.min' => "Имя должно содержаться не менее 4 и не более 12 символов",
                'name.max' => "Имя должно содержаться не менее 4 и не более 16 символов",
                'name.unique' => "Пользователь с таким именем уже существует",
        ]);

        if (!$validator->passes()) {
            return response()->json(["resultCode"=> 1,'errors'=> $validator->errors()->all()]);
        }

        $user->name = $request->name;
        $user->save();

        return response()->json(["resultCode"=> 0,'name' => $request->name]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
