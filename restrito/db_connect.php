<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "controleponto";

$connect = mysqli_connect($servername, $username, $password, $dbname);


if (mysqli_connect_error()):
	echo "Falha ao conectar com o banco de dados: ".mysqli_connect_error();
endif;