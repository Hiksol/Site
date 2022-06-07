<?php
$database = mysqli_connect('server','root','','Server');

function Parse ($p1, $p2, $p3)
{
	$num1 = strpos($p1, $p2);
	if($num1 === false) return 0;
	$num2 = substr($p1,$num1);
	return strip_tags(substr($num2,0,strpos($num2,$p3)));
}

$string=file_get_contents('https://www.chaynikam.info/gpu_specif.html');
$int = Parse($string, "Отобрано: ",'</div>');
$int = str_replace("Отобрано: ",'',$int);

$q=1;
while($q<=$int)
{

$array = Parse($string,'class="gpu">'."$q".'</td>','</div></td>');
$array = str_replace('<td class="gpu2"><a href="','',$array);

$j=strlen($array);

if($q==1){$k=$array[$j-6];}

while($array[$j]!="$k")
{
	$j--;
}

$i=0;
while($i!=$j)
{
	$GPUname="$GPUname"."$array[$i]";
	$i=$i+1;
}
while($i!=strlen($array))
{$i++;$GPUpower="$GPUpower"."$array[$i]";}

$GPUname = str_replace('class="gpu">'."$q"."$k",'',$GPUname);

$marker = stripos($GPUname, "NVIDIA");
if($marker) 
    $GPUname = substr($GPUname, $marker+6);

$marker = stripos($GPUname, "AMD");
if($marker) 
    $GPUname = substr($GPUname, $marker+3);

$marker = stripos($GPUname, "Intel");
if($marker) 
    $GPUname = substr($GPUname, $marker+5);

// $marker = stripos($GPUname, "ATI");
// if($marker) 
//     $GPUname = substr($GPUname, $marker+3);

mysqli_query($database, "INSERT INTO `gpu` (`id`, `GPU`, `power`) VALUES ('$q', '$GPUname', '$GPUpower');");


echo $GPUname;
echo "<br>";
echo $GPUpower . "<br>";

unset($GPUname);
unset($GPUpower);

$q++;
}
?>