<div class=" bg-stone-50  rounded-md mt-5 border-2 border-gray-500 grid grid-cols-3  ">
<div class="w-full bg-black text-white  border-r-2 border-gray-500">
    <p class="text-center p-2">
{{$comment->user()->first()->name}}
    </p>
    <p class="text-center p-2">
{{$comment->getDate()}}
    </p>
    @if ($isEdit==true)
    
    <form method="POST" action="{{ route('comments.destroy', $comment) }}">

    @csrf

    @method('delete')
        <div class="flex justify-center">
    <button class=" w-5/6 rounded-md my-2 text-black bg-gray-50 hover:bg-red-300" type="submit">DELETE</button>
    </div>
    </form>
    
@endif
</div>
<div class="w-full p-2 col-span-2">
    <p class="text-justify">
        {{$comment->comment}}
    </p>
</div>



</div>