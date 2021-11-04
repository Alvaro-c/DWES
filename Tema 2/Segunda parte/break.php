<?php
$i = 0;
while ($i < 5) {
	echo "$i <br>";
	$i++; // es lo mismo que $i = $ i + 1;
	if ($i == 3) {
		break;
	}
}

// Lo mismo sin break:

$i = 0;
while ($i < 3) {
	echo "$i <br>";
	$i++; // es lo mismo que $i = $ i + 1;

}
