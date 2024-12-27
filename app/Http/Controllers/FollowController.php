<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    private $follow;
    

    public function __construct(Follow $follow)
    {
        $this->follow = $follow;
       
    }

    

    public function store($following_id)
    {
        $this->follow->follower_id = auth()->user()->id;
        $this->follow->following_id = $following_id;
    
        $this->follow->save();

        return back();
    }
    
 

    public function destroy($following_id)
    {

        // delete following
        $this->follow->where('follower_id', auth()->user()->id)
                    ->where('following_id', $following_id)
                    ->delete();

    
        return back();
    }

  
   

}
