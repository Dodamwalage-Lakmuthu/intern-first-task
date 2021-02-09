$(document).ready(function(){
    
   var url = window.location.href;
   var newurl = url.substring(url.lastIndexOf("/")+1);
   var newurl =newurl.substring(0,newurl.indexOf("."))
   console.log(newurl);
   if(newurl==""){
       newurl="index";
   }



   var href ="";
   $('nav li a').each(function(){
       var idof= $(this).attr('id');
       console.log(idof);
       if(newurl==idof){
           $(this).addClass('highlight');
       }
   })
})