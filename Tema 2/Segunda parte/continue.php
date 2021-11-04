<?php
	for($i = 0; $i < 5; $i = $i + 1){
		if ($i == 3){
			continue; // para usar en los for, vuelve al principio del for, incrementa la i y sigue con la ejecucion
		}
		echo "$i <br>";
	}