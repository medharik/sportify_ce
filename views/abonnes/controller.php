        <?php
        include "../../models/abonne.class.php";
        Idao::connect_db();
        extract($_POST);//form
        extract($_GET); //$action,$id (data url) id=9 => $id=9
        switch ($action) {
            case 'store':
                if (!empty($_FILES['photo']['name'])) {
                    $chemin =  Abonne::uploader($_FILES['photo'], "images");
                    $data = $_POST;
                    $data['photo'] = $chemin;
                    Abonne::store($data);
                }

                break;
            case 'update':
                if (!empty($_FILES['photo']['name'])) {
                    $chemin =  Abonne::uploader($_FILES['photo'], "images");
                    $data = $_POST;
                    $data['photo'] = $chemin;
                    Abonne::update($data,$id);
                }else{

                    Abonne::update($_POST,$id);

                }
                break;
            case 'delete':
                Abonne::delete($id);
                break;


            default:
                # code...
                break;
        }

        header("location:index.php");
