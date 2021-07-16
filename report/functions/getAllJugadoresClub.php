<?php 
function getAllJugadoresClub($idliga,$idclub)
{
  $mysqli = getConnexion();
  $query = "SELECT	codigoJugador,DesTipo,identificacion,nombres,apellidos,nacimiento,lugar,
		DesGenero,DesEtnia,DesLiga,DesClub,observacion,fichaje,activo
FROM	jugador a, tipoidentificacion b, tipogenero c, tipoetnia d, liga e, club f
WHERE	a.idtipo=b.idTipo and
		a.idgenero=c.idGenero and
        a.idetnia=d.idEtnia and
        a.idliga=e.idliga and
        a.idclub=f.idclub and
		a.idliga=$idliga and
		a.idclub=$idclub
ORDER BY codigoJugador";
  return $mysqli->query($query);
}