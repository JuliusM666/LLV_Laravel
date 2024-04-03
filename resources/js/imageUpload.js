import axios from "axios";
import jQuery from 'jquery';
import carousel from './carousel.js';
window.$ = jQuery;

var images=[]
var Carousel=new carousel();



$("input[name='images[]']").on("change", function(event) {
  axios.post('/locations/moveImages',{
    images:$("input[name='images[]']")[0].files
},{headers: {
  "Content-Type": "multipart/form-data",
},}
)
    .then(function (response) {
      
     
     
      response['data']['images'].forEach(element => {
        
        images.push(element['image']);
       
      });
      
      
     
      
      Carousel.images=images;
      Carousel.loadImage();
    })
    .catch(function (error) {
        
    })
});


