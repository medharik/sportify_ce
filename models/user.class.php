<?php
spl_autoload_register(function ($class) {
    include(strtolower($class) . ".class.php");
});
class User extends Idao
{
    public static $table = "users";
}
