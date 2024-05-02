<?php

if(isset($_GET['i'])){
    $input = $_GET['i'];
    $file = fopen('../../data/users.csv','r');

    while(($line = fgetscsv($file)) !== FALSE){
        if(strpos($line[2],$input) === 0){
            echo"<p>$line[2]</p>";
        }
    }
    fclose($file);
}