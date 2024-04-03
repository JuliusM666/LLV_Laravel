<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css','resources/js/imageUpload.js'])
</head>
<body>
<x-app-layout>

  <h1 class="text-3xl font-bold  text-center text-fuchsia-50 mt-5">
    Add Location
  </h1>

  <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('locations.store') }} " enctype=multipart/form-data>
            @csrf
            <input name='tags' value="" hidden/>
            <input
                name="name"
                placeholder="{{ __('Location\'s name') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                focus:ring-opacity-50 rounded-md shadow-sm mt-5 px-3"
                value="{{old('name')}}"
            />
            <div id="addedTags" class=" grid grid-cols-3    lg:grid-cols-4 justify-items-center    mt-2">
            
            </div>
            <div class="flex">
            <input
                name="Tag"
                placeholder="{{ __('Location\'s tag') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                focus:ring-opacity-50 rounded-md shadow-sm mt-5 px-3"
                value="{{old('tag')}}"
            />
            <button type="button" id="tagAddButton" class="mt-5 w-1/6 bg-gray-700 rounded-md">
              <p class="text-center w-full ">
              +
              </p>
</button>
            </div>

            <textarea
                name="description"
                placeholder="{{ __('Location\'s description') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-5"
            >{{ old('description') }}</textarea>
            
  
  <input
    class="relative mt-5 block w-full min-w-0 flex-auto rounded border border-solid 
    border-neutral-300 bg-clip-padding px-3 py-[0.32rem] 
    text-base font-normal text-neutral-700 transition duration-300 
    ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden 
    file:rounded-none file:border-0 file:border-solid file:border-inherit 
    file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 
    file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] 
    file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary 
    focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:border-neutral-600 
    dark:text-neutral-200 dark:file:bg-neutral-700 dark:file:text-neutral-100 dark:focus:border-primary"
    type="file"
    name="images[]"
    multiple 
    placeholder="images"/>

           
           
            <x-primary-button class="mt-5 w-full ">
              <p class="text-center w-full ">
              {{ __('Add') }}
              </p>
            </x-primary-button>
            @if($errors->any())
          {!! implode('', $errors->all('<div class="bg-red-500 mt-5 rounded-md text-white px-3
            hover:bg-red-400 ">:message</div>')) !!}
          @endif
        </form>
        <div id="images" class="hidden">
      <x-edit-carousel></x-edit-carousel>
        </div>
    </div>

</x-app-layout>
</body>
</html>