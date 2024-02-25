


$(window).on("load",function() {
    $(window).scroll(function() {
      var windowBottom = $(this).scrollTop() + $(this).innerHeight();
      $(".fade").each(function() {
         
        var objectBottom = $(this).offset().top + $(this).outerHeight();
        
         
        if (objectBottom < windowBottom) {  
          if ($(this).css("opacity")==0) {$(this).fadeTo(400,1);}
        } else {  
          if ($(this).css("opacity")==1) {$(this).fadeTo(400,0);}
        }
      });
    }).scroll();  
  });

  // window.addEventListener('load', function() {
  //   setTimeout(function() {
  //     document.getElementById('loader').style.display = 'none';
  //   }, 4000);
  // });
  
function openNav() {
  document.getElementById("mySidepanel").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}



>>>>>>> 4754c565be4747a7bfd846ab57294058e7f4ac01




  