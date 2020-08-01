<?php

    $meteo = '../data/meteo.json';

    $fileContent = file_get_contents($meteo);

    $fileContent = mb_convert_encoding($fileContent, "UTF-8", "Windows-1252");

    $jsonContent = json_decode($fileContent);    

    // var_dump($jsonContent);

    