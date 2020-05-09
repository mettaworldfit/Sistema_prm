
$(document).ready(function(){
 
    

    // Jquery vegas
    $("body").vegas({
        slides: [
            { src: "http://localhost/prm/public/img/img1.jpg" },
            { src: "http://localhost/prm/public/img/img2.jpg" },
            { src: "http://localhost/prm/public/img/img3.jpg" },
            { src: "http://localhost/prm/public/img/img4.jpg" }
              
        ],
        transition: [ 'fade', 'zoomOut', 'flash', 'burn' ],
        animation: 'random'
    });
    
    

});


