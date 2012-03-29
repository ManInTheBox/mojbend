$(document).ready(function(){
    
    $(".fancybox").fancybox();

    if($("#slides-container").length > 0)
    {
        $("#myController").jFlow({
            slides: "#slides",
            controller: ".jFlowControl",
            slideWrapper : "#jFlowSlide",
            selectedWrapper: "jFlowSelected",
            easing: "swing",
            width: "850px",
            auto: true,
            height: "315px",
            duration: 600,
            prev: ".jFlowPrev",
            next: ".jFlowNext"
        });
    }

    $('ul.dropdown').superfish({
        autoArrows: false,
        delay: 400
    });

});