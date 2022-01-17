<?php
function eliminar_restaurante($datos){
	$res = leer_config(dirname(__FILE__) . "/configuracion.xml", dirname(__FILE__) . "/configuracion.xsd");
	$bd = new PDO($res[0], $res[1], $res[2]);
	//Buscamos si ya exite el restaurante en la base de datos.
	$preparada = $bd->prepare("SELECT codRes from restaurantes where correo = :correo");
	$preparada->execute($datos);
	//Si no existe, devolvemos falso.
	if ($preparada->rowCount() !== 1) {
		return false;
	}else{
		
	/*
	Buscamos los datos del correo a eliminar:
	
	"SELECT restaurantes.CodRes, restaurantes.Correo, pedidos.CodPed, pedidos.Fecha, pedidosproductos.CodProd, pedidosproductos.Unidades
	FROM restaurantes LEFT JOIN (pedidos LEFT JOIN pedidosproductos ON pedidos.CodPed = pedidosproductos.CodPed) ON restaurantes.CodRes = pedidos.Restaurante
	WHERE restaurantes.Correo= madrid1@empresa.com"

	CREACIÓN DEL FICHERO
		$fich = fopen ("copia_eliminados.txt","c");
		fwrite($fich, datos_de_la_consulta)
		Si se ha creado y guardado bien la información
		$bd->beginTransaction();
			PRIMERA ELIMINACIÓN
			$ins = "DELETE * FROM pedidosproductos WHERE CodPed IN (SELECT CodPEd FROM pedidos WHERE Restaurante IN (SELECT CorRes From restaurantes WHERE Correo= madrid1@empresa.com"))
			$resul = $bd->query($ins);
		 	 	Si ha ido bien
					SEGUNDA ELIMINACIÓN
					$ins = "DELETE * FROM pedidos WHERE Restaurante IN (SELECT CorRes From restaurantes WHERE Correo= madrid1@empresa.com"))
			 	 	$resul = $bd->query($ins);	
						Si ha ido bien
							TERCERA ELIMINACIÓN
							$ins = "DELETE * FROM restaurantes WHERE Correo= madrid1@empresa.com"))
							$resul = $bd->query($ins);
				 				Si ha ido bien
				 					$bd->commit();
				 				Si la tercera no ha ido bien
				 					$bd->rollback();
						Si la segunda no ha ido bien
							$bd->rollback();
				Si la primera no ido bien
					$bd->rollback();
		Si no se ha creado bien
		return FALSE;	
	*/			
	return TRUE;
	}
}
?>