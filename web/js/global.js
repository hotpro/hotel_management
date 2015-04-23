// $('button#date-submit').on('click', function(){
//   var date = $('input#room').val();
//   $.post('ajax/room.php',{date: date}, function(data){
//     $('div#date-data').text(data);
//   })
// });

$(document).ready(function(){
  $('button#date-submit').on('click', function(){

  });

})



$(function(){
  $('#dp1').datepicker(
    {todayHighlight: true}

  );
});

$('#dp1').on('click',function(){
  var date = $('#dp1').data('datepicker').getFormattedDate('yyyy-mm-dd');
  // console.log(date);
  $('div#date-data').text(date);
});

$(function(){
  $('#dp2').datepicker();

});
