
 function fun1(id){
//	alert("algo");
	$( "#activo-"+id ).prop( "checked", false );
	$( "#ep-"+id ).prop( "checked", false );
}

function fun2(id){
	$( "#baja-"+id ).prop( "checked", false );
	$( "#ep-"+id ).prop( "checked", false );
}

function fun3(id){
	$( "#baja-"+id ).prop( "checked", false );
	$( "#activo-"+id ).prop( "checked", false );
}

function serv1(id){
	$( "#no-"+id ).prop( "checked", false );
}

function serv2(id){
	$( "#yes-"+id ).prop( "checked", false );
}