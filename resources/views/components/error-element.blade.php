<div>
@if($errors->any())
          {!! implode('', $errors->all('<div class="bg-red-500 mt-5 rounded-md text-white px-3
            hover:bg-red-400 ">:message</div>')) !!}
          @endif
</div>