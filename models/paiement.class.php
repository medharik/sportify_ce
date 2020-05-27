<?php
include "helper.php";

include "iDao.class.php";
class Paiement extends Idao
{

    use Helper_date;
    public static $table = "paiements";
}
