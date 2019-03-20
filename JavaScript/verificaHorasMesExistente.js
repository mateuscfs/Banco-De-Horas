$(function(){ // declaro o início do jquery
  $("#ano").on('click', function(){//botão para disparar a ação
   
    var usuario = $("#usuario").val();
    var ano = $("#ano").val();
    if(ano != 0){
    console.log(ano);
    $.get('verificaHorasMesExistente.php?usuario=' + usuario + '&ano=' + ano,function(data){
      
        
        
//        if(data == 0){
//            $('#resultado').html("<span class='glyphicon glyphicon-remove-circle'></span> Email já existe!");
//        }else
//        {
//            $('#resultado').html("<span class='glyphicon glyphicon-ok-circle'></span>Email disponivel!");
//        }
        
        
        $('#resultado').html(data);//onde vou escrever o resultado
    });
    }else{
         document.getElementById("mes").innerHTML = '<option> </option>';
    }
});
});// fim do jquery