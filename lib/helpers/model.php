<?php

function modelTableize($model_name) {
  return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $model_name));
}

function modelBackTicksForAttribute($attr) {
  return "`$attr`";
}

function modelColonForAttribute ($attr) {
  return ':' . $attr;
}

function modelUpdateSyntaxForAttribute($attr) {
  return "`$attr` = :$attr";
}

?>
