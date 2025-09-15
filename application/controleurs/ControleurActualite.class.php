<?php

require Chemins::MODELES . 'gestion_actualite.class.php';

class ControleurActualite {

    public function afficherActualite() {
//        GestionBoutique::getLesTuplesByTable('actualite');
        if (isset($_SESSION['login'])) {
            VariablesGlobales::$lesActualites = GestionActualite::getLesActualites();
            require Chemins::VUES . 'v_actualite.inc.php';
        } else {
            VariablesGlobales::$lesActualites = GestionActualite::getLesActualitesPublic();
            require Chemins::VUES . 'v_actualite.inc.php';
        }
    }

    public function __construct() {
        
    }

    public function AjouterActualite() {
        // Vérifier si le formulaire a été soumis avec la méthode POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $TitreActualite = $_POST["Titre"];
            $description = $_POST["description"];
            $dates = date("Y-m-d");
            $privacy = $_POST["Privacy_actualite"];

            // Vérifier si un fichier image a été téléchargé
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                // Récupérer les informations sur le fichier téléchargé
                $image_tmp_name = $_FILES["image"]["tmp_name"];
                $image_name = $_FILES["image"]["name"];

                // Définir le répertoire de destination pour l'enregistrement de l'image
                $upload_dir = Chemins::IMAGES_ACTUALITES;
                $target_file = $upload_dir . basename($image_name);

                // Déplacer le fichier téléchargé vers le répertoire de destination
                if (move_uploaded_file($image_tmp_name, $target_file)) {
                    // Le fichier a été téléchargé avec succès, maintenant vous pouvez ajouter l'actualité
                    // Utilisez seulement le nom de fichier pour l'enregistrement dans la base de données
                    $nom_image = basename($image_name);
                    GestionActualite::ajouter($TitreActualite, $description, $dates, $nom_image, $privacy);

                    // Redirection vers la page d'affichage des actualités
                    header("Location: index.php?controleur=Actualite&action=afficherActualite");
                    exit(); // Assurez-vous de terminer le script après la redirection
                } else {
                    echo "Erreur lors de l'enregistrement du fichier.";
                }
            } else {
                echo "Aucun fichier image téléchargé ou erreur lors du téléchargement.";
            }
        }
    }

    public function SupprimerActualite() {
        $id = $_POST["actualite_a_supprimer"];

        GestionActualite::supprimerById($id);
        header("Location:index.php?controleur=Actualite&action=afficherActualite");
    }

    public function afficherModifierActualite() {
        if (isset($_GET['idActualite'])) {
            $idActualite = $_GET['idActualite'];
            $actualite = GestionActualite::getActualiteById($idActualite);
            require Chemins::VUES_ADMIN . 'modifier_actualite_view.inc.php';
        }
    }

    public function getActualiteDetails() {
        if (isset($_POST['idActualite'])) {
            $idActualite = $_POST['idActualite'];
            $actualite = GestionActualite::getActualiteById($idActualite);

            if ($actualite) {
                header('Content-Type: application/json');
                echo json_encode($actualite);
            } else {
                echo json_encode(['error' => 'Erreur lors de la récupération des détails de l\'actualité.']);
            }
            exit;
        }
    }

    public function modifierActualite() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer l'ID de l'actualité à modifier depuis le formulaire
            $idActualite = $_POST['actualite_a_modifier'];

            // Récupérer les nouvelles données depuis le formulaire
            $nouveauTitre = $_POST['nouveau_nom_actualite'];
            $nouvelleDescription = $_POST['description_actualite'];
            $nouvelleVisibility = $_POST['Privacy_actualite'];

            // Vérifier si un fichier image a été téléchargé
            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                // Récupérer les informations sur le fichier téléchargé
                $image_tmp_name = $_FILES["image"]["tmp_name"];
                $image_name = $_FILES["image"]["name"];

                // Définir le répertoire de destination pour l'enregistrement de l'image
                $upload_dir = Chemins::IMAGES_ACTUALITES;
                $target_file = $upload_dir . basename($image_name);

                // Déplacer le fichier téléchargé vers le répertoire de destination
                if (move_uploaded_file($image_tmp_name, $target_file)) {
                    // Supprimer l'ancienne image si elle existe
                    $ancienneImage = GestionActualite::getImageById($idActualite);
                    if ($ancienneImage) {
                        $cheminAncienneImage = Chemins::IMAGES_ACTUALITES . $ancienneImage;
                        if (file_exists($cheminAncienneImage)) {
                            unlink($cheminAncienneImage); // Supprimer le fichier de l'ancienne image
                        }
                    }

                    // Mettre à jour l'actualité avec les nouvelles données et le nouveau chemin de l'image
                    GestionActualite::modifier($idActualite, $nouveauTitre, $nouvelleDescription, basename($image_name), $nouvelleVisibility);
                } else {
                    echo "Erreur lors de l'enregistrement du fichier.";
                }
            } else {
                // Aucune nouvelle image téléchargée, mettre à jour sans changer l'image
                GestionActualite::modifierSansImage($idActualite, $nouveauTitre, $nouvelleDescription, $nouvelleVisibility);
            }

            // Redirection vers la page d'affichage des actualités après modification
            header("Location: index.php?controleur=Actualite&action=afficherActualite");
            exit();
        }
    }
}

?>
