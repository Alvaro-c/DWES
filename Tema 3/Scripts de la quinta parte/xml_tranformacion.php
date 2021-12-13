<?php
	// cargar el fichero a transformar
	$dept = new DOMDocument();
	$dept->load( 'empleados.xml' );
	// cargar la transformacion
	$transformacion = new DOMDocument();
	$transformacion->load( 'departamento.xslt' );
	// crear el procesador
	$procesador = new XSLTProcessor();
	// asociar el procesador y la transformacion
	$procesador-> importStylesheet($transformacion) ;
	// transformar
	$transformada = $procesador->transformToXml($dept);
	echo $transformada;