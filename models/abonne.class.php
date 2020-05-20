<?php
class Abonne
{
    //POJO  
    private $nom;
    private $prenom;
    private $date_naissance;
    private $profession;
    private $sexe;
    private $inscrit_le;
    private $photo;
    private $cin;
    //constructor 
    function __construct($nom, $prenom, $date_naissance, $profession = null, $sexe, $inscrit_le = "", $photo = "", $cin)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->$date_naissance = $date_naissance;
        $this->$profession = $profession;
        $this->sexe = $sexe;
        $this->$inscrit_le = $inscrit_le;
        $this->$photo = $photo;
        $this->cin = $cin;
    }
    //getter
    public function nom()
    {
        return  $this->nom;
    }
    //setter
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    //magic  method 
    // $x= $hp->prenom;
    //=> $param = prenom
    public function __get($param)
    {
        return $this->$param;
    }
    //magic  method 
    // $hp->prenom='test' // $param=prenom, $value =test
    public function __set($param, $value)
    {
        $this->$param = $value;
    }
    public function afficher()
    {
        print "$this->nom $this->prenom<br>";
    }
}
