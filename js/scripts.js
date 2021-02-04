$(document).ready(function(){
    $('main').load('content.php #shop');
    //checking id of link
    $('a').click(function(){
        
        var clickedLink = $(this).attr('id');
        //  $('main').load('./includes/content.php #' + clickedLink);
        var filename = ""
         $('main').load('content.php #' +clickedLink);
    })
})