<?php

class ControleurAdmin {

    public function __construct() {
        
    }

    public function afficherIndex() {
        if (isset($_SESSION['login_super_admin'])) {
            require Chemins::VUES_ADMIN . 'v_index_super_admin.inc.php';
        } else
            if (isset($_SESSION['login_admin'])) {
            require Chemins::VUES_ADMIN . 'v_index_admin.inc.php';
        } else {
            require Chemins::VUES_ADMIN . 'v_connexion.inc.php';
        }
    }

    public function verifierConnexion() {
        if (GestionBoutique::isRegistered($_POST['login'], $_POST['passe'])) {
            $_SESSION['login'] = $_POST['login'];

            if (GestionBoutique::superAdminOK($_POST['login'], $_POST['passe'])) {
                $_SESSION['login_super_admin'] = $_POST['login'];
                if (isset($_POST['connexion_auto'])) {
                    setcookie('login_super_admin', $_POST['login'], time() + 7 * 24 * 3600, '/', ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false, false, true);
                }
                require Chemins::VUES_ADMIN . 'v_index_super_admin.inc.php';
                return; // Assurez-vous de ne pas continuer l'exécution
            }

            if (GestionBoutique::isAdminOK($_POST['login'], $_POST['passe'])) {
                $_SESSION['login_admin'] = $_POST['login'];
                if (isset($_POST['connexion_auto'])) {
                    setcookie('login_admin', $_POST['login'], time() + 7 * 24 * 3600, '/', ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false, false, true);
                }
                require Chemins::VUES_ADMIN . 'v_index_admin.inc.php';
                return; // Assurez-vous de ne pas continuer l'exécution
            }

            header("Location: index.php"); // Rediriger vers l'index si l'utilisateur n'est ni admin ni super admin
            exit;
        } else {
            require_once Chemins::VUES . 'v_erreur404.inc.php';
        }
    }

    public function seDeconnecter() {
        setcookie('login_admin', ''); //suppression du cookie en vidant simplement la chaîne
        $_SESSION = array();
        session_destroy();
        header("Location:index.php");
    }
}
