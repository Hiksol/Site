<?php
$database = mysqli_connect('server','root','','Server');

function comparison($a,$b)	{return $a>$b;}

$GPUuser = "NVIDIA GeForce RTX 2070 Super";
$CPUuser = "Core i5-10400";
$RAMuser = 16;
$Game = "Cyberpunk 2077";


$Game = mysqli_query($database, "SELECT * FROM `games` WHERE `GameName` LIKE '$Game' ORDER BY `id` ASC");
$Game = mysqli_fetch_assoc($Game);

$GPUgame = mysqli_query($database, "SELECT * FROM `gpu` WHERE `id` = $Game[GPU_id] ");
$GPUarr1 = mysqli_fetch_assoc($GPUgame);


$GPUuser = mysqli_query($database, "SELECT * FROM `gpu` WHERE `GPU` LIKE '$GPUuser' ORDER BY `id` ASC");
$GPUarr = mysqli_fetch_assoc($GPUuser);


if(comparison($GPUarr[power],$GPUarr1[power]))
{echo "+";}
else {echo "-";}



$CPUgame = mysqli_query($database, "SELECT * FROM `cpu` WHERE `id` = $Game[CPU_id] ");
$CPUarr1 = mysqli_fetch_assoc($CPUgame);

$CPUuser = mysqli_query($database, "SELECT * FROM `cpu` WHERE `CPU` LIKE '$CPUuser' ORDER BY `id` ASC");
$CPUarr = mysqli_fetch_assoc($CPUuser);

if(comparison($CPUarr[power],$CPUarr1[power]))
{echo "+";}
else {echo "-";}



if(comparison($RAMuser,$Game[RAM]))
{echo "+";}
else {echo "-";}

?>