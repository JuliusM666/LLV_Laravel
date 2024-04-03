import './bootstrap';
import axios from "axios";
import Alpine from 'alpinejs';
import 'flowbite';


window.Alpine = Alpine;

Alpine.start();

//sweetalert for delete confirmation
import swal from 'sweetalert';
window.deleteConfirm = function (e) {
    e.preventDefault();
    e.stopPropagation();
    var form = e.target.form;
    swal({
        title: "Are you sure you want to delete?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
      });
}
//jquery for dropdown menu
import jQuery from 'jquery';
window.$ = jQuery;
$("#dropdown").find("button").on("click", function(event) {

  
  var value = $(this).attr('value');

  $("input[name='category']").attr('value',value);
  $("#dropdown-button").html($("#dropdown-button").html().replace(new RegExp("^([^\<]*)"),$(this).text()));


 
  
});


$("#hiddenTagsButton").on("click", function(event) {
  if($("#hiddenTags").hasClass("hidden"))
  {$("#hiddenTags").removeClass("hidden");}
  else{
    $("#hiddenTags").addClass("hidden");
  }
 
  
});


var tagsArr=[];
$("#tagAddButton").on("click", function(event) {
  var tagInput=$("input[name='Tag']").val().replaceAll('#','').toUpperCase();
  
  if(tagInput!="" && tagsArr.includes(tagInput)==false )
  {
    
    var button= document.createElement("button");
    button.setAttribute('type','button');
    if(tagInput.length<10)
    {button.innerHTML='#'+tagInput;}
    else{
      button.innerHTML='#'+tagInput.substring(0,10)+"...";
    }
    button.setAttribute('value',tagInput);
    button.className=("bg-white text-black  uppercase text-xs px-4 py-2 rounded-full shadow hover:shadow-md outline-none hover:bg-gray-700 focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150")
    button.setAttribute('name','newTag');
    button.onclick= function(){
     
      button.remove();
    };
    $("#addedTags").append(button);
    

    
  }
 
  
});
$("button[type='submit']").on("click", function(event) {
  $( "button[name='newTag']" ).each(function() {
    tagsArr.push($(this).attr('value'));
    
  });
  $('input[name="tags"]').attr('value',tagsArr.join(','));

});
$("button[name='newTag']").on("click", function(event) {
  
 
   $(this).remove()
});
