<?php 
function getAllVariables()
{
  $mysqli = getConnexion();
  $query = "SELECT	* FROM variables";
  return $mysqli->query($query);
}