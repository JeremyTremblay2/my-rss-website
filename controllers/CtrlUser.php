<?php
require("../Classes/Validation.php");
require("../config/config.php");
class CtrlUser
{
    public function __construct()
    {
        global $localPath,$views;
        $tabErr = array();
        require($localPath.$views['connect']);
        try{
            $action=$_REQUEST['action'] ?? null;
            switch($action){
                case null:
                    $this->Init();
                    break;
                case "valider":
                    $this->VerifConnection($tabErr);
                    break;
                default:
                    $tabErr = "Erreur inattendue!! ";
                    require($localPath.$views["connect"]);
            }
        }
        catch (Exception $e){
            require($localPath.$views["connect"]);
            echo $e->getMessage();
        }
    }

    public function Init(){
        global $localPath,$views; // nécessaire pour utiliser variables globales

        $dataVue = array (
            'pseudo' => "",
            'password' => "",
            'data' => "",
        );
        require ($localPath.$views['connect']);
    }

    public function VerifConnection (array $tabErr){
        global $localPath,$views;

        $pseudo = $_POST['name'];
        $pwd = $_POST['password'];
        try {
            Validation::str($pseudo);
            Validation::str($pwd);
            $model = new modele();
            $valeur = $model->get_value();
            $dataVue = array(
                'pseudo' => $pseudo,
                'password' => $pwd,
                'valeur' => $valeur,
            );
            require ($localPath.$views['connect']);
        }
        catch (Exception $e){
            $tabErr = "erreur";
            require ($localPath.$views['connect']);
        }

    }
}
new CtrlUser();
//password_hash
//password_verify(mdpclaire,mdpcripté)