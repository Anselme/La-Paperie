//page d'accueil - disparition image
$(function(){
    $('.bg').click(function(){
        $('.bg').hide("puff", {}, 1500);
        });
});


//pop up d'iscription à la Newsletter
$(function(){
    $("a[rel^='prettyNewsletter']").prettyPhoto({
        theme: 'light_rounded',
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
        src = $(this).find("> a > img").attr("src");
        $(this).find("> a > img").attr("src","/bundles/lapaperiemain/images/fondalter-100.png") ;
    }, function() {
        $(this).find("> a > img").attr("src",src) ;
    }
    );
});
