<?php
	$i = 0;
	do {
		echo "En el do-while: $i <br>";
		$i = $i + 1;
	} while ($i < 0);
	while ($i < 0) {
		echo "En el while: $i <br>";
		$i = $i + 1;
	}