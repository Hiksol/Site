<?php

	// echo htmlspecialchars($_POST["CPU"]);
	// echo "<br>" . htmlspecialchars($_POST["GPU"]);
	// echo "<br>" . htmlspecialchars($_POST["RAM"]) . "<br>";

$database = mysqli_connect('server','root','','Server');

if(mysqli_connect_errno())
{
	echo 'Ошибка в подключении к database ('.mysqli_connect_errno().'):'.mysqli_connect_error();
	exit();
}
echo "Ошибок в подключении к database нет.";



//Вывод на экран характеристик видеокарты
$G1 = htmlspecialchars($_POST["GPU"]);
$G2 = mysqli_query($database, "SELECT * FROM gpu WHERE GPU = '$G1'");
$G3 = mysqli_fetch_assoc($G2);

echo '<pre>';
print_r($G3);
echo '</pre>';
echo '<br>' . $G3['power'];

//Вывод на экран характеристик процессора
$C1 = htmlspecialchars($_POST["CPU"]);
$C2 = mysqli_query($database, "SELECT * FROM cpu WHERE CPU = '$C1'");
$C3 = mysqli_fetch_assoc($C2);

echo '<pre>';
print_r($C3);
echo '</pre>';
echo '<br>' . $C3['power'];

//Вывод на экран ОЗУ
$R1 = htmlspecialchars($_POST["RAM"]);
echo '<br>' . "$R1";


?>
<form action='index.php'>
	<input type='submit' value='Ок'>