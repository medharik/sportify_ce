<?php
include("models/abonne.class.php");
$ab=new Abonne("ali",'alaa','1999-09-09','etudiant','homme',date('Y-m-d'),'images/avatar.png','bj132323');// $ab > object (instance)/ Abonne => class

$ab->afficher();

?>



