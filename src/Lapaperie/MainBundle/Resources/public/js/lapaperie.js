//affiche l'image d'intro
$(function(){
    $('#intro_background').fadeIn();
});

//page d'accueil - disparition image sur click
$(function(){
    $('.bg').click(function(){
        $('.bg').fadeOut(1000);
        });
});

//page d'accueil - disparition image au bout de 4 sec'
$(function(){
    $('.bg').delay(4000).fadeOut(1000);
});

//pop up d'iscription à la Newsletter
$(function(){
    $("a[rel^='prettyNewsletter']").prettyPhoto({
        theme: 'la_paperie',
        social_tools: ''
    });
});

//Images des companies
$(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto({
        theme: 'light_rounded'
    });
});

//onHover sur les videos
$(function() {
    $(".video_home").hover(function(){
        alt = $(this).find("> a > img").attr("alt");
        $(this).find("> a > img").fadeTo("fast",0.3);
        $(this).append("<div class='video_hover'>"+alt+"</div>") ;
    }, function() {
        $(this).find("> a > img").fadeTo("fast",1);
        $('.video_hover').detach() ;
    }
    );
});
