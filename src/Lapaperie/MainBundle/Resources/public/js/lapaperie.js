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
        $(this).find("> a ").append("<div class='video_hover'>"+alt+"</div>") ;
    }, function() {
        $(this).find("> a > img").fadeTo("fast",1);
        $('.video_hover').detach() ;
    }
    );
});
