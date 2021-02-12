$(document).ready(function(){
    $('input[type="file"]').change(function(e){
        file = URL.createObjectURL(e.target.files[0]);
        console.log(file);
        if(file){
                $('#thumbnail').removeClass('hidden');
               $('#thumbnail').attr("src",file);
        }
        
    })
})