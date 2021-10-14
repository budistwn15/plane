<?php

function rekening($tf)
{
    $name = "PT Plane Indonesia Sejahtera";
    if ($tf == "mandiri") {
        $rek    = "1730005751103";
    } else if ($tf == "bni") {
        $rek    = "009641810";
    } else if ($tf == "bca") {
        $rek = "0149876512";
    } else if ($tf == "briva") {
        $rek = "171892340000004";
    }
    return $name . " - " . $rek;
}
