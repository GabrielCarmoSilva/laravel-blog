<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('user_level', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('admin.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['status'] = 1;
        if($request->hasfile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $name = $request->name;
            $name = str_replace(" ", "-", strtolower($name));
            $file_name = "{$name}.{$extension}";
            $request->image->storeAs('public/img', $file_name);
            $data['image'] = 'img/'.$file_name;
        }
        else {
            $data['image'] = "img/imagem.jpg";
        }
        User::create($data);
        return redirect()->route('users.index')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();
        if(!$data['password']){
            unset($data['password']);
        }else{
            $data['password'] = bcrypt($data['password']);
        }
        $image = $user->image;
        if($request->hasfile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $name = $request->name;
            $name = str_replace(" ", "-", strtolower($name));
            $file_name = "{$name}.{$extension}";
            $request->image->storeAs('public/img', $file_name);
            $data['image'] = 'img/'.$file_name;
        }
        $user->update($data);
        if (User::where('image', '=', $image)->count() == 0) {
            Storage::disk('public')->delete($image);
        }
        return redirect()->route('users.index')->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', true);
    }

    public function approve(Request $request, User $user)
    {
        if($user->status) {
            $user->update(['status' => false]);
        }
        else {
            $user->update(['status' => true]);
        }
        return back();
    }
}
