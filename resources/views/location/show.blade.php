<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="h-full ">
<x-app-layout >

  <h1 class="text-3xl font-bold  text-center text-fuchsia-50 my-5 uppercase">
   {{$location->name}}
  </h1>
  <div class="flex justify-center">
                    @for ($i = 0; $i < count($location->tags); $i++)
                    @if($i==3)
                    <button id="hiddenTagsButton"   class="bg-white text-black font-bold uppercase text-xs px-4 py-2 rounded-full shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button"
  >...</button>
  
                    @break
                    @endif
                   
                    
                    <x-tag-element  :tag="$location->tags[$i]['name']" :popularity="$location->tags[$i]->getPopularity()"/>

                       
                    @endfor

                    </div>
                    <div  id="hiddenTags" class=" grid grid-cols-3    lg:grid-cols-4 justify-items-center  max-w-2xl mx-auto mt-2 hidden">
                    @for ($i = 3; $i < count($location->tags); $i++)
                    
                   
                    
                    <x-tag-element  :tag="$location->tags[$i]['name']" :popularity="$location->tags[$i]->getPopularity()"/>

                       
                    @endfor

                    </div>
  <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
       
            

            <p class="text-justify mt-5 py-10 px-2 text-lg  w-full h-full bg-stone-50 rounded-lg 
                    outline outline-offset-0 outline-1 outline-stone-100">
               
            {{$location->description}}
</p>
          


<x-carousel  :images="$location->images->toArray()"></x-carousel>
   


       
       
    <form method="POST" class="mb-20" action="{{ route('comments.store') }} " enctype=multipart/form-data>
            @csrf
            <input hidden value="{{$location->id}}" name="locationId">
            <textarea class="block w-full border-stone-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-5" name="comment" placeholder="Leave Comment"></textarea>
            <x-primary-button class="mt-1 w-3/12 float-right " type="submit">
              <p class="text-center text-xs w-max ">
              Post comment
              </p>
            </x-primary-button>

            
          </form>
        
      
          @if($errors->any())
          {!! implode('', $errors->all('<div class="bg-red-500 mt-5 rounded-md text-white px-3
            hover:bg-red-400 ">:message</div>')) !!}
          @endif
           
          @foreach ($comments as $comment)
            <x-commentElement :comment="$comment" > </x-commentElement>
          @endforeach
    </div>
    <div class="py-2 px-9  mt-10  ">
        {{ $comments->links() }}
        </div>
</x-app-layout>
</body>
</html>