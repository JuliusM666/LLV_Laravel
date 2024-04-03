<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>

<body>
<x-app-layout>
<x-error-element :errors=$errors> </x-error-element>
<h1 class="text-3xl font-bold  text-center text-fuchsia-50 mt-5">
    Locations
  </h1>
  

<form id="searchForm" method="GET" action="{{ route('locations.index') }}" >
@csrf
    <input class="hidden" name="category" value="{{old('category',$category)}}" />
    <div class="flex mt-1 mx-3">
       
        <button id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600 w-36" type="button">
            {{old('category',$category)}}
           <div class="flex w-full flex justify-end "> 
        <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
  </svg>
</div>
</button>
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button" >
            <li>
                <button type="button" value="Title"  class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Title</button>
            </li>
            <li>
                <button type="button" value="Tag"  class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tag</button>
            </li>
            <li>
                <button type="button" value="Description" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Description</button>
            </li>
            <li>
                <button type="button" value="Creator" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Creator</button>
            </li>
           
           
            </ul>
        </div>
        <div class="relative w-full">
            <input value="{{old('search',$search)}}"  type="search" name="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-r-lg border-l-gray-50 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Search" required>
            <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-gray-800 rounded-r-lg border border-gray-800 hover:bg-gray-600">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>

  
  


  <div class="grid sm:grid-cols-1 justify-items-center  mt-5   lg:grid-cols-3   ">
           
            @foreach ($locations as $location)
                
                <div   onclick="window.location='{{ route("locations.show",$location) }}'" class="p-2  mt-10 bg-white  rounded-lg w-5/6 h-100 shadow-sm shadow-inner shadow-stone-500
                transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110  duration-300 cursor-pointer" >
                    <h1 class="m-1 text-xl text-gray-900 text-bold  text-center uppercase">{{ $location->name }}
                    
                    </h1>
                    <div class="flex justify-center">

                    @if (count($location->tags)==0)
                    <div class="mt-9"></div>
                    @endif


                    @for ($i = 0; $i < count($location->tags); $i++)
                    @if($i==3)
                    {{'...'}}
                    @break
                    @endif
                   
                    
                    <x-tag-element  :tag="$location->tags[$i]['name']" :popularity="$location->tags[$i]->getPopularity()"/>

                       
                    @endfor

                    </div>
                    <p class="text-justify mt-5  text-xs w-full h-1/6 bg-stone-50 rounded-lg 
                    outline outline-offset-0 outline-1 outline-stone-100">
                        
                        @if(strlen($location->description)<200)
                        {{ $location->description }}
                        @else
                        {{ substr($location->description,0,200).'...' }}
                        @endif
                   

                    </p>
                    <div class="relative ">
                       <img class="w-full h-48 mt-2   rounded-lg" src="{{'/uploads/'.$location->images->first()['image']}}" />
                        
                    
                       @if (Auth::user()->isAdmin==TRUE && $location->user_id==Auth::user()->id)
                       <a type="button"  href={{ route('locations.edit', $location) }} class="absolute bottom-0 text-black bg-stone-50 rounded-lg m-2 px-2 hover:shadow-sm shadow-inner shadow-stone-500">Edit</a>
                       <form method="POST" action="{{ route('locations.destroy', $location) }}">

                                            @csrf

                                            @method('delete')

                                            <button class="absolute bottom-0 right-0 text-black bg-stone-50 rounded-lg m-2 px-2 hover:shadow-sm shadow-inner shadow-stone-500"
                                            onclick=" deleteConfirm(event)">

                                                {{ __('Delete') }}
                                            
</button>                                        

                                        </form>
                      
                       @endif
                      
</div>
                            <div class="mt-4 my-4">
                
                                <span class="text-gray-800 inline-flex items-baseline">
                                <img src="baseImages/admin-icon.svg" class="h-6 w-6 text-gray-600 -scale-x-100 m-2" />
                                    {{ $location->user->name }}
                                </span>

                                <small class="ml-2 text-sm text-gray-600">{{ $location->created_at->format('j M Y, g:i a') }}</small>

                            </div>

                        

                        

                   

                </div>

            @endforeach
           
        </div>
        <div class="py-2 px-9  mt-10  ">
        {{ $locations->links() }}
        </div>
</x-app-layout>

</body>
</html>