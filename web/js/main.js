$( function() {
    $( "#accordion" ).accordion({
        heightStyle: "content"
    });
} );


$('.registration').on('click', function (e) {
    if($('input[type=checkbox]').is(':checked')==false){
		$('.checkbox_color').css({'width':'100%',
		'border':'1px solid red',
		'paddindRight':'20px'});
		return false;
	}
	else{
		return true;
	}
    
});

$('.slick_slider').slick({
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 3,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});

 var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        }
    }
	


