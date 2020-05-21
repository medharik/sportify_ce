<?php
include "../../models/abonne.class.php";
Idao::connect_db();
extract($_POST);
extract($_GET); //$action
switch ($action) {
    case 'store':
        if (!empty($_FILES['photo']['name'])) {
            $chemin =  Abonne::uploader($_FILES['photo'], "images");
            $data = $_POST;
            $data['photo'] = $chemin;
            Abonne::store($data);
        }

        break;
    case 'update':
        # code...
        break;
    case 'delete':
        # code...
        break;


    default:
        # code...
        break;
}

header("location:index.php");
