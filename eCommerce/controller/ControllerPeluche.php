<?php

/* require_once ('../model/ModelVoiture.php'); 
  // chargement du modèle
  $tab_v = ModelVoiture::getAllVoitures();
  //appel au modèle pour gerer la BD
  require ('../view/voiture/list.php');
  //redirige vers la vue */

require_once File::build_path(array('model', 'Model.php'));
require_once File::build_path(array('model', 'ModelPeluche.php')); // chargement du modèle

class ControllerPeluche {

    public static function readAll() {
        $tab_p = ModelPeluche::getAllPeluches();
             //appel au modèle pour gerer la BD
        //require File::build_path(array('view', 'voiture','list.php'));  //"redirige" vers la vue
        $view = 'list';
        $pagetitle = 'Liste des peluches';
        $controller = 'peluche';
        require File::build_path(array('view', 'view.php'));
    }

    public static function read() {

        $nom_query = $_GET['nom'];
        $peluche = ModelPeluche::getPelucheByNom($nom_query);

        if ($peluche == false) {
            /*  $view = 'error';
              $pagetitle = 'Attention erreur fatale mouahah';
              $controller = 'voiture';
              //require_once File::build_path(array('view', 'voiture','error.php'));
              require File::build_path(array('view', 'view.php')); */

            $typeError = "noPeluche";
            require File::build_path(array('view', 'peluche', 'error.php'));
        } else {
            $view = 'detail';
            $pagetitle = 'Votre peluche';
            $controller = 'peluche';
            //require_once File::build_path(array('view', 'voiture','detail.php'));
            require File::build_path(array('view', 'view.php'));
        }
    }

    public static function create() {

        $view = 'create';
        $pagetitle = 'Nouvelle peluche';
        $controller = 'peluche';
        //require_once File::build_path(array('view', 'voiture','create.php'));
        require File::build_path(array('view', 'view.php'));
    }

    public static function created() {

        $nom = $_GET['nom'];
        $couleur = $_GET['couleur'];
        $prix = $_GET['prix'];
        $description = $_GET['description'];
        $taille = $_GET['taille'];

        $peluche = new ModelPeluche($nom, $couleur, $prix, $description, $taille);

        $peluche->save();

        $tab_p = ModelPeluche::getAllPeluches();

        $view = 'Created';
        $pagetitle = 'Créée';
        $controller = 'Peluche';
        //require_once File::build_path(array('view', 'voiture','create.php'));
        require File::build_path(array('view', 'view.php'));
    }
}

?>