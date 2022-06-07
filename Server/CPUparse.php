<?php
$q=1;
$database = mysqli_connect('server','root','','Server');
function Parse ($p1, $p2, $p3)
{
	$num1 = strpos($p1, $p2);
	if($num1 === false) return 0;
	$num2 = substr($p1,$num1);
	return strip_tags(substr($num2,0,strpos($num2,$p3)));
}

$string=file_get_contents('https://www.chaynikam.info/cpu_table.html');
$int = Parse($string, "Отобрано: ",'</div>');
$int = str_replace("Отобрано: ",'',$int);
$string = str_replace('_',' ',$string);
$int = $int - 298;
while($q!=$int)
{

$CPUname = Parse($string, 'rtyrty ', '"' );
$CPUname = str_replace('rtyrty', '', $CPUname);

$CPUpower = Parse($string, 'color: #3e8b00">', '</span>' );
$CPUpower = str_replace('color: #3e8b00">','',$CPUpower);

echo $CPUname . "<br>";
echo $CPUpower . "<br>";

mysqli_query($database, "INSERT INTO `cpu` (`id`, `CPU`, `power`) VALUES (NULL, '$CPUname', '$CPUpower')");

$string = str_replace('rtyrty' . "$CPUname",'',$string);
$string = str_replace('#3e8b00">' . "$CPUpower",'',$string);

 unset($СPUname);
 unset($СPUpower);

$q++;
}



?>