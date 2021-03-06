<?php
spl_autoload_register(function ($class) {
    include(strtolower($class) . ".class.php");
});
// include "iDao.class.php";
class Paiement extends Idao
{
    public $user_id;
    public $abonne_id;
    use Helper_date;
    public static $table = "paiements";
    public static $class = "Paiement";

    function __construct($user_id = 0, ?int $abonne_id = 0)
    {
        $this->abonne_id = $abonne_id;
        $this->user_id = $user_id;
    }

    //many (paiement) de one  (user)
    public function user()
    {
        try {
            $rp = self::$cnx->prepare("select * from  users  where id=? ");
            // echo "select * from " . self::$table . " where $nom_id=$id ";
            $rp->execute([$this->user_id]);
            $resultat =  $rp->fetch();
            return $resultat;
        } catch (PDOException $e) {
            die("erreur de  recuperation  dans  la base de donnees " . $e->getMessage());
        }
    }
    public function abonne()
    {
        try {
            $rp = self::$cnx->prepare("select * from  abonnes  where id=? ");
            // echo "select * from " . self::$table . " where $nom_id=$id ";
            $rp->execute([$this->abonne_id]);
            $resultat =  $rp->fetch();
            return $resultat;
        } catch (PDOException $e) {
            die("erreur de  recuperation dans  la base de donnees " . $e->getMessage());
        }
    }
    public static  function last_paie()
    {
        try {
            $rp = self::$cnx->prepare(" SELECT * FROM paiements WHERE id IN (
                SELECT  max(id) FROM paiements
                 GROUP BY abonne_id
                  )");
            // echo "select * from " . self::$table . " where $nom_id=$id ";
            $rp->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::$class);
            $rp->execute();
            $resultat =  $rp->fetchAll();
            return $resultat;
        } catch (PDOException $e) {
            die("erreur de  recuperation dans  la base de donnees " . $e->getMessage());
        }
    }
}
