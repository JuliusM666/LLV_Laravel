<?php

namespace App\Http\Controllers;


use App\Models\Location;
use App\Models\LocationImage;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\ViewErrorBag;

class LocationController extends Controller
{
    public function destroy(Location $location):RedirectResponse{
        
        $this->authorize('delete',$location);
        
        $location->delete();

        return redirect(route('locations.index'));
    
    }
    public function create(){
       
        
        $this->authorize('create',Auth::user()
    );
        return view('location.create');
    }
    public function show(Location $location):View{
        
        
        return view('location.show', [

            'location' => $location,
            'comments' =>$location->comments()->orderBy('id')->cursorPaginate(10)

        ]);
    }
    public function index(Request $request):View{
        
        
        
        
       
        $search=$request->search==null?"":$request->search;
               
        switch ($request->category ) {
            case "Title":
                $locations=Location::with('user')->latest()->where('name', 'LIKE',"{$search}%");
               break;
            case "Tag":
                $locations=Location::with('user')->select('locations.*')->latest()->
                join('location_tag','locations.id','=','location_tag.location_id')->join('tags','location_tag.tag_id','=','tags.id')->where('tags.name', 'LIKE',"{$search}%");
                
                break;
            case "Description":
                $locations=Location::with('user')->latest()->where('description', 'LIKE',"%{$search}%");
                break;
            case "Creator":
                $locations=Location::with('user')->select('locations.*')->latest()->
                join('users','locations.user_id','=','users.id')->where('users.name', 'LIKE',"{$search}%");
                break;
           
            default:
                $locations=Location::with('user')->latest()->where('name', 'LIKE',"{$search}%");

            
            
        }
       
        return view('location.index',['locations'=>$locations->orderBy('id')->distinct()->cursorPaginate(9),
        'category'=>$request->category==null?"Title":$request->category,
        'search'=>$request->search,]);
    }
    public function edit(Location $location):View{
       

        $this->authorize('update', $location);

        return view('location.edit', [

            'location' => $location,
            'comments' =>$location->comments()->orderBy('id')->cursorPaginate(10)
        ]);

    }
    public function update(Request $request,Location $location):RedirectResponse{
        
        $this->authorize('update', $location);

        if($request->image==null){
            $this->ValidateLocationWithOldImage($request);
            $imageName=$location->image;
        }
        else{
            $this->ValidateLocation($request);
            $imageName=$this->MoveImage($request);
        }
       
        
       
       
        $tags=$this->createTagsArr($request);
        
        $location->update(['name'=>$request->name,'description'=>$request->description,'image'=>$imageName]);
        $location->Tags()->sync($tags);

        return redirect(route('locations.index'));
    }
    public function store(Request $request):RedirectResponse{

        
          
        $this->authorize('create',Auth::user());

        $tags=$this->createTagsArr($request);
        $this->ValidateLocation($request);
        $newNames=$this->moveImages($request);
        $location=Location::make(['name'=>$request->name,'description'=>$request->description]);
        
       
        $request->user()->locations()->save($location);
        $location->tags()->attach($tags);
        $location->images()->saveMany($newNames);
        
        return redirect(route('locations.index'));
        
    }
    private function ValidateLocation(Request $request){
        $validated = $request->validate([

            'name' => 'required|string|max:255|min:1',
            'description' => 'required|string|max:10000|min:1',
            'images.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
    }
    private function ValidateLocationWithOldImage(Request $request){
        $validated = $request->validate([

            'name' => 'required|string|max:255|min:1',
            'description' => 'required|string|max:10000|min:1',
           
        ]);
    }
    private function ValidateImages(Request $request){
        $validated = $request->validate([

            'images' => 'required',
            'images.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
    }
    private function ValidateTag(Request $request){
        $validated = $request->validate([

            'name' => 'required|string|max:255|min:1',
            
           
        ],[
            'name' => 'Tag lenght is incorrect'
        ]);
    }
    public function moveImages(Request $request){
      
        $this->authorize('create',Auth::user()
    );
        $this->ValidateImages($request);

        $files = $request->file('images');
        $newNames=['images'=>[]];
        foreach($files as $file){
            $newName=Str::uuid().".".$file->extension();
            $tmpModel=new LocationImage();
            $tmpModel->image=$newName;

            array_push($newNames['images'],$tmpModel);
            $file->move('uploads',$newName);
        }
      
       
        return $newNames;
    }
    private function createTagsArr($request){
        $tags=[];
        
        if($request->tags!=null)
       { foreach(explode(',',$request->tags) as $tagName){
            if(Tag::where('name', $tagName)->exists()){
                array_push($tags,Tag::where('name','=',$tagName)->first()['id']);
            }
            else{
                $this->ValidateTag(new Request(['name'=>$tagName]));
                array_push($tags,Tag::create(['name'=>$tagName])->id);
            }
            
          
        }}
        
        return $tags;

    }
}
