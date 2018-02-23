(function(){
 
  $('dd').filter(':nth-child(n+4)').addClass('hide');

  $('dl').on('click', 'dt', function() {
      $(this).next().slideToggle(200);
    });
  
 })();