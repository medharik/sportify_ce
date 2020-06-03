<?php
spl_autoload_register(function ($class) {
    include(strtolower($class) . ".class.php");
});
// include "helper.php";
// include "iDao.class.php";
class Abonne extends Idao
{

    use  Helper_date;

    //POJO  

    public $id;
    private $nom;
    private $prenom;
    private $date_naissance;
    private $profession;
    private $sexe;
    private $inscrit_le;
    private $photo;
    private $cin;
    //constructor 
    function __construct($id = 0, $nom = "", $prenom = "", $date_naissance = "", $profession = null, $sexe = "", $inscrit_le = "", $photo = "", $cin = "")
    {
        $this->id = $id;
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
    //one (abonne) to many (paiement)
    public   function paiements()
    {
        try {
            $rp = self::$cnx->prepare("select * from  paiements  where abonne_id=? order by id desc");
            $rp->execute([$this->id]);
            $resultat =  $rp->fetchAll();

            return $resultat;
        } catch (PDOException $e) {
            die("erreur de  recuperation dans  " . static::$table . " dans  la base de donnees " . $e->getMessage());
        }
    }
}
