$(document).ready(function() {
  $(window).resize(function () {
        var ancho = 735;
        var alto = 220;
        var wscr = $(window).width();
        var hscr = $(window).height();
        $('#bgtransparent').css("width", wscr);
        $('#bgtransparent').css("height", hscr);
        $('#bgmodal').css("width", ancho + 'px');
        $('#bgmodal').css("height", alto + 'px');
        var wcnt = $('#bgmodal').width();
        var hcnt = $('#bgmodal').height();
        var mleft = (wscr - wcnt) / 2;
        var mtop = (hscr - hcnt) / 2;
        var atop = (mtop - 15);
        var aright = (mleft - 72);
        $('#bgmodal').css("left", mleft + 'px');
        $('#bgmodal').css("top", mtop + 'px');
        $('#modal-close').css("top", atop + 'px');
        $('#modal-close').css("right", aright + 'px')
    })
 $('#print-new-box').click(function(){
   showModal();
 });

 $('#petition').focus(function(){
      if($(this).attr('lang')==1)
      {
          $(this).val('');
          $(this).attr('lang',2);
      }
  });

  $('#new-petition').click(function(){
      var petition =  $('#petition').val();
      if(petition=='')
      {
        alert($('#text-alert').attr('char'));
        $('#petition').focus();
        return false
      }
      var text = $(this).attr('alt');
      var r = confirm(text);
      if(r)
      {
          $('#form-petition').submit();
      }
  })

  $('#petition').keyup(function(){
      var longitud = $(this).val().length;
      var max_length = $('#tr-text').attr('char');
      $('#petition').attr('maxlength', parseInt(max_length));
      var resto = max_length - longitud;
      if(resto <= 0)
      {
          alert($('#tr-text').attr('lang'));
          return false;
      }
      return true;
  });

});

//
function showModal() {
    var bgdiv = $('<div>').attr({
        'id': 'bgtransparent'
    });
    $('body').append(bgdiv);
    var wscr = $(window).width();
    var hscr = $(window).height();
    $('#bgtransparent').css("width", wscr);
    $('#bgtransparent').css("height", hscr);
    var moddiv = '';
    moddiv = $('<div>').attr({
        'id': 'bgmodal'
    });
    var mod_close = $('<div>').attr({
        id: 'modal-close-div'
    });
    $('body').append(moddiv);
    $('body').append(mod_close);
    $('#bgmodal').append($('#ab-inbox').contents());
    $('#modal-close-div').append($('#new-close-modal').contents());
    $(window).resize()
}

//
function closeModal() {
    $('#ab-inbox').append($('#bgmodal').contents());
    $('#new-close-modal').append($('#modal-close-div').contents());
    $('#bgmodal').remove();
    $('#bgtransparent').remove();
    $('#modal-close-div').remove()
}