<?php

$register = new User();

$register->name = "Uriel";  
$register->last_name = "Cebreros";  
$register->email = "urielcebreros@gmail.com";

$vars = [
	"register" => $register
];

$BASE->Response()->Render($BASE->Template(), $vars);

?>