<?php
include("imetier.php");
// :: acces static / const
class Idao implements Imetier
{
 //INJECTION SQL    
//XSS : CROSS SITE SCRIPTING
//CSRF 
//FIXATION de SESSION
   // use Helper;
    public static $cnx; // variable de classe
    public static  $table = "abonnes";
    public const MAX_UPLOAD_SIZE = 8 * 1024 * 1024;
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
    public  static   function delete($id)
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
            // echo "select * from " . self::$table . " where $nom_id=$id ";
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
        $str_cles = join(",", array_keys($data));
        $inter = function ($value) {
            return "$value=?";
        };
        $intero  = join(",", array_map($inter, array_keys($data) ));//nom=?, prenom=? 
        try {
            $rp = self::$cnx->prepare(" update  " . static::$table . " set $intero  where id=?");
           // echo " update  " . static::$table . " set $intero  where id=?";
            $values=array_values($data);//['ali','rim']
            $values[]=$id;///['ali','rim',1]
            $rp->execute($values);
        } catch (PDOException $e) {
            die("Erreur  de modification de " . static::$table . " " . $e->getMessage());
        }
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

    // upload = televersement de fichier 
    //$infos=$_FILES['chemin']
    public  static  function uploader($infos, $dossier = "images")
    {
        if (!is_dir($dossier)) {
            mkdir($dossier, 777, true);
        }
        $tmp = $infos['tmp_name'];
        $nom = $infos['name'];
        $path_parts = pathinfo($nom);
        //var_dump($path_parts);
        $ext = strtolower($path_parts["extension"]);
        $new_name = md5(date('YmdHis') . '_' . rand(0, 9999)) . '.' . $ext;
        $autorise = ['jpg', 'png', 'jpeg', 'gif', 'mp4'];
        $chemin = "$dossier/$new_name";
        if (!in_array($ext, $autorise)) {
            die("Ce n'est pas une image");
        }
        $taille = filesize($tmp); // retourne la taille du fichier en octect
        if ($taille > self::MAX_UPLOAD_SIZE) {
            die("Veulliez choisir un fichier de taille < 8Mo");
        }
        if (!move_uploaded_file($tmp, $chemin)) {
            die("Probleme d'upload de l'image");
        };

        return $chemin;
    }
}
