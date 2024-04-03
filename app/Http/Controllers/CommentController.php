<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    private function ValidateComment(Request $request){
        $validated = $request->validate([

            'comment' => 'required|string|max:500|min:5',
            
        ]);
    }
    public function store(Request $request):RedirectResponse{

        
            
     
        
     
        $this->ValidateComment($request);

        $comment=new  Comment();
        $comment->comment=$request->comment;
        
        $comment->location_id=$request->locationId;
        $comment->user_id=$request->user()->id;

        $comment->save();
       
        return redirect(route('locations.show',Location::find($request->locationId)));
 

        
        
    }
    public function destroy(Comment $comment):RedirectResponse{
        $location=Location::find($comment->location_id);
        
        $this->authorize('delete',$comment);
        $comment->delete();

        return redirect(route('locations.edit',$location));
    }
}