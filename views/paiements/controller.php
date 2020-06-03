        <?php
        spl_autoload_register(function ($class) {
            include("../../models/" . strtolower($class) . ".class.php");
        });
        Idao::connect_db();
        extract($_POST); //form
        extract($_GET); //$action,$id (data url) id=9 => $id=9
        switch ($action) {
            case 'store':

                $data = $_POST;
                Paiement::store($data);


                break;
            case 'update':

                $data = $_POST;

                Paiement::update($data, $id);

                break;
            case 'delete':
                Paiement::delete($id);
                break;


            default:
                # code...
                break;
        }

        header("location:index.php");
