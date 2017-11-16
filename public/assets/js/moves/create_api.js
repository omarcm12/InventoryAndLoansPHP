function showCreateMoveModal (type, materialId, materialName) {	
	document.getElementById("move-material-id").value = materialId;
	document.getElementById("move-type").value = type;
  document.getElementById("material-name").value = materialId +" - "+ materialName;
	$('#create-move-modal').modal('show');
  $("#move-response-message").hide();
  if(type == 0){
    document.getElementById("move-modal-title").innerHTML = '<i class="fa fa-minus-circle" aria-hidden="true"></i> Baja de Material';
  }else{
    document.getElementById("move-modal-title").innerHTML = '<i class="fa fa-plus-circle" aria-hidden="true"></i> Alta de Material';    
  }  
}

function createMove () {
  $("#btn-create-move").addClass('disabled');
	$.ajax({
       type: "POST",
       url: '/admin/movimientos/create',
       data: $("#create-move-form").serialize(), // serializes the form's elements.
       success: function(data){
        document.getElementById("move-response-message").innerHTML = data.result;
        document.getElementById("move-response-message").className = "";
        $("#move-response-message").show();
        if(data.errorCode == 0){
          document.getElementById("move-response-message").className = "api-message label-success";
          setTimeout(function() { 
            location.reload();
          },1000);
        }else{          
          document.getElementById("move-response-message").className = "api-message label-danger";
          $("#btn-create-move").removeClass('disabled');
        }        
       }
    });
}