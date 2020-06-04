<?php
// include("models/iDao.class.php");
include("models/paiement.class.php");
// include("models/abonne.class.php");
// $ab=new Abonne("ali",'alaa','1999-09-09','etudiant','homme',date('Y-m-d'),'images/avatar.png','bj132323');// $ab > object (instance)/ Abonne => class

// $ab->afficher();

// $p = ['libelle' => 'hp', 'prix' => 7000]; // comme sur $_POST
// // insert into produit(libelle,prix) values (?,?)
// // ->execute(['hp',7000]);
// //

// $cles = array_keys($p);
// // print_r($cles); //$clas=['libelle','prix']  =>[7,4]
// $str_cles = join(",", $cles); // => libelle,prix
// // echo  $str_cles;
// //closure => fonction anonyme // lambda (role local ) ou fonction call back (fonction d'appel)
// $td = ['kaba', 'ali'];
// $inter = function ($value) {
//     return '?';
// };
// $int  = join(",", array_map($inter, $cles));
// echo "insert into produit ($str_cles) values($int)";
// var_dump(array_values($p));

// $vals = [];
// $cl = [];
// foreach ($p as  $c => $v) {
//     $vals[] = $v;
//     $cl[] = $c;
// // }

Idao::connect_db();
// echo  Paiement::$table;
$b = Abonne::find(15);
// $b1 = new Abonne();
// $b1->id = 15;
//echo $b->id;
$p = $b->paiements();
var_dump($p);
