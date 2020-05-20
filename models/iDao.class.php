<?php
include("imetier.php");
// :: acces static / const

class Idao implements Imetier
{

    public static $cnx; // variable de classe
    public static  $table = "abonnes";
    public static  function connect_db()
    //pattern singleton (une seule instance (creer une seule fois))
    {
        if (!self::$cnx) {

            try {
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ];
                self::$cnx =  new PDO("mysql:host=localhost;dbname=sportify_db_2020", "root", "", $options);
            } catch (PDOException $e) {
                die("erreur de connexion a la base de donnees " . $e->getMessage());
            }

            //     finally{

            //     }
        }
    }
    public  static   function destroy($id)
    {
        try {
            $rp = self::$cnx->prepare("delete from  " . static::$table . "  where id=?");
            $rp->execute([$id]);
        } catch (PDOException $e) {
            die("erreur de suppression  de " . static::$table . " dans  la base de donnees " . $e->getMessage());
        }
    }

    public static  function all(): array
    {
        try {
            $rp = self::$cnx->prepare("select * from " . static::$table . " order by id  desc");
            $rp->execute();
            $resultat =  $rp->fetchAll();

            return $resultat;
        } catch (PDOException $e) {
            die("erreur de  recuperation dans  " . static::$table . " dans  la base de donnees " . $e->getMessage());
        }
    }
    public  static function find($id, $nom_id = "id")
    {
        try {
            $rp = self::$cnx->prepare("select * from " . static::$table . " where $nom_id=? ");
            $rp->execute([$id]);
            $resultat =  $rp->fetch();
            return $resultat;
        } catch (PDOException $e) {
            die("erreur de  recuperation (find) dans  " . static::$table . " dans  la base de donnees " . $e->getMessage());
        }
    }
    public static function findBy(String $condition)
    {
        try {
            $rp = self::$cnx->prepare("select * from " . static::$table . " where $condition ");
            $rp->execute();
            $resultat =  $rp->fetchAll();
            return $resultat;
        } catch (PDOException $e) {
            die("erreur de  recuperation (findBy) dans  " . static::$table . " dans  la base de donnees " . $e->getMessage());
        }
    }
    public  static  function update(array $data, int $id)
    {
    }
    public static     function store(array $data)
    {

        $str_cles = join(",", array_keys($data));
        $inter = function ($value) {
            return '?';
        };
        $intero  = join(",", array_map($inter, $data));
        try {
            $rp = self::$cnx->prepare("insert into " . static::$table . " ($str_cles) values($intero)");
            $rp->execute(array_values($data));
        } catch (PDOException $e) {
            die("Erreur d'ajout de " . static::$table . " " . $e->getMessage());
        }
    }
}
