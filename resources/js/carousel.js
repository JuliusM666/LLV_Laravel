import jQuery from 'jquery';
window.$ = jQuery;


var object=null
export default class carousel{

    constructor(){
        
        this.images=images;
        this.index=0;
         object=this
        
        
        this.setUpJquery();
       
       
        
      
    }

loadImage(){
    
    $("#images").removeClass('hidden');
    
    $("#items > div > img:first").attr("src",'/uploads/'+this.images[this.index]);
    
}

setUpJquery(){
    
    $("#Previous").on("click", function(event) {
        
        if(object.index-1>=0){
            object.index=object.index-1;
            
            object.loadImage();
            
        }
       
     
      });
      $("#Next").on("click", function(event) {
       
        if(object.index+1<object.images.length){
            object.index=object.index+1;
           
            object.loadImage();
        }
        
      });
}


}