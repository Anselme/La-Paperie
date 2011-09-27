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
        $(this).find("> a > img").attr("src","/bundles/lapaperiemain/images/logonet.png") ;
    }, function() {
        $(this).find("> a > img").attr("src",src) ;
    }
    );
});
