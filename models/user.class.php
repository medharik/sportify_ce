<?php
spl_autoload_register(function ($class) {
    include(strtolower($class) . ".class.php");
});
class User extends Idao
{
    public static $table = "users";

    public static $class = "User";
    public $id;
    public $login;
    public $passe;
    public $email;
    public $role;
    function __construct($id, $login, $mail, $passe)
    {
    }

    public static function verifier($login, $passe, $url_login)
    {
        try {
            $rp = self::$cnx->prepare("select * from  users  where login  = ? and passe = ?");
            $rp->execute([$login, $passe]);
            // $rp->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::$class);

            $resultat =  $rp->fetch();
            if (!empty($resultat)) {
                $_SESSION["login"] = $login;
                $_SESSION["passe"] = $passe;
                $_SESSION["nom"] = $resultat->nom;
                $_SESSION["email"] = $resultat->email;
                $_SESSION["role"] = $resultat->role;
                return $resultat;
            } else {
                header("location:$url_login?cn=no");
                die();
            }
        } catch (PDOException $e) {
            die("erreur de  recuperation dans  users dans  la base de donnees " . $e->getMessage());
        }
    }
}
