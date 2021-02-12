$(document).ready(function(){
   
    //checking id of link
    $('.item').click(function(){
        
        var clickedLink = $(this).attr('id');
        //  $('main').load('./includes/content.php #' + clickedLink);
        var newurl = '/ecom/description.php?id='.concat(clickedLink);
        // console.log(newurl);
        //
        window.location.replace(newurl);
    })

  




})