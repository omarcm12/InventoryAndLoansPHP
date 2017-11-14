function showCreateMoveModal (type, materialId) {	
	document.getElementById("move-material-id").value = materialId;
	document.getElementById("move-type").value = type;
	$('#create-move-modal').modal('show');
}

function createMove () {
	$.ajax({
       type: "POST",
       url: '/admin/movimientos/create',
       data: $("#create-move-form").serialize(), // serializes the form's elements.
       success: function(data){
       	console.log(data);
       }
    });
}