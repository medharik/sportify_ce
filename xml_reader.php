<?php
$etudiants = simplexml_load_file("test2.xml");
foreach ($etudiants as $e) {
    echo "nom est " . $e->nom . ", age est " . $e->age . " ans , id est " . $e['id'] . " classe est " . $e->classe . " <br>";
    // print_r($e);
}
