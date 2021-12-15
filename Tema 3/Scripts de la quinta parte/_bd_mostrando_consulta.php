<?php
$cadena_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$usuario = 'root';
$clave = '';
try {
	$bd = new PDO($cadena_conexion, $usuario, $clave);
	$sql = 'SELECT nombre, clave, rol FROM usuarios';
	$usuarios = $bd->query($sql);
?>
	<html>

	<head>
		<title>Mostrando una consulta</title>
	</head>

	<body>
	Realizamos la siguiente consulta a la tabla "usuarios" de la base de datos "empresa": $sql = 'SELECT nombre, clave, rol FROM usuarios'<br>
	Guardamos su resultado en $usuarios = $bd->query($sql) <Br>
	$usuarios es, por tanto, un objeto de de la clase PDOStatement.
		<table>
			<tr>
				<td>
					<?php

					echo "--------------------------------------------------------------------------------";
					echo "<br> Mostrando el objeto 'usuarios' con vardump:</br>";
					echo "var_dump(\$usuarios);";
					echo "<PRE>";
					var_dump($usuarios);
					echo "</PRE>";
					echo "--------------------------------------------------------------------------------";
					echo "<br> Usando el método fetchAll del objeto 'usuarios': </br>";
					echo "var_dump(\$usuarios->fetchAll());";
					echo "<PRE>";
					var_dump($usuarios->fetchAll());
					echo "</PRE>";
					echo "----------------------------------------------------------------------------";
					echo "<br> Volviendo a usar el método fetchAll del objeto 'usuarios':</br>";
					echo "var_dump(\$usuarios->fetchAll());";
					echo "<PRE>";
					var_dump($usuarios->fetchAll());
					echo "</PRE>";
					echo "<br>";
					?>
				</td>
				<td>
				<?php
				echo "--------------------------------------------------------------------------------";
				echo "<br> Usando 'usuarios->fetchAll' como un array al uso:</br>";
				echo "\$arr[clave_1][clave_2];";
				echo "<PRE>";
				$usuarios = $bd->query($sql);
				$arr = $usuarios->fetchAll();
				echo "\$arr[0]['nombre']: ", $arr[0]['nombre'], "<br>";
				echo "\$arr[0]['clave']: ", $arr[0]['clave'], "<br>";
				echo "\$arr[0]['rol']: ", $arr[0]['rol'], "<br>";
				echo "\$arr[1]['nombre']: ", $arr[1]['nombre'], "<br>";
				echo "\$arr[1]['clave']: ", $arr[1]['clave'], "<br>";
				echo "\$arr[1]['rol']: ", $arr[1]['rol'], "<br>";
				echo "\$arr[2]['nombre']: ", $arr[2]['nombre'], "<br>";
				echo "\$arr[2]['clave']: ", $arr[2]['clave'], "<br>";
				echo "\$arr[2]['rol']: ", $arr[2]['rol'], "<br>";
				echo "</PRE>";
				echo "--------------------------------------------------------------------------------";
				echo "<br> Obtenemos lo mismo usando las correspondientes claves numéricas:</br>";
				echo "<PRE>";
				echo "\$arr[0][0]: ", $arr[0][0], "<br>";
				echo "\$arr[0][1]: ", $arr[0][1], "<br>";
				echo "\$arr[0][2]: ", $arr[0][2], "<br>";
				echo "\$arr[1][0]: ", $arr[1][0], "<br>";
				echo "\$arr[1][1]: ", $arr[1][1], "<br>";
				echo "\$arr[1][2]: ", $arr[1][2], "<br>";
				echo "\$arr[2][0]: ", $arr[2][0], "<br>";
				echo "\$arr[2][1]: ", $arr[2][1], "<br>";
				echo "\$arr[2][2]: ", $arr[2][2], "<br>";
				echo "</PRE>";
				echo "--------------------------------------------------------------------------------";
				echo "<br> Modificando los parámetros de fetchAll (Ver fetch_style en la documentación):</br>";
				echo "\$arr = \$usuarios->fetchAll(PDO::FETCH_ASSOC);";
				echo "<PRE>";
				$usuarios = $bd->query($sql);
				$arr = $usuarios->fetchAll(PDO::FETCH_ASSOC);
				var_dump($arr);
				echo "</PRE>";
				echo "<br><br><br><br><br><br><br>";
			} catch (PDOException $e) {
				echo 'Error con la base de datos: ' . $e->getMessage();
			}
				?>
				</td>
			</tr>
			<tr>
			</tr>
		</table>
	</body>

	</html>