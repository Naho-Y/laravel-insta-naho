<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profiles.show')
            ->with('user', $user);
    }

    public function follower($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profiles.follower')
            ->with('user', $user);
    }

    public function following($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profiles.following')
            ->with('user', $user);
    }

    public function edit()
    {

        $user = $this->user->findOrFail(auth()->user()->id);
            
        return view('users.profiles.edit')
        ->with('user', $user);
        
    }

    public function update(Request $request)
    {
      
        $request->validate([
            'name'      => 'required|min:1|max:50',
            'email'     => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'introduction'      => 'nullable|min:1|max:1000',
            'avatar'    => 'mimes:jpg,png,jpeg,gif|max:1048'
        ]);

        $user           = $this->user->findOrFail(auth()->user()->id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->introduction = $request->introduction;

        if($request->avatar){
            $user->avatar = 'data:avatar/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar)); 
        }
        $user->save(); 

       
        return redirect()->route('profile.show',auth()->user()->id);
    }
}
