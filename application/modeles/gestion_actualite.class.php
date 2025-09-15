<?php

require_once Chemins::CONFIGS . 'mysql_config.class.php';

require_once Chemins::MODELES . 'gestion_boutique.class.php';

class GestionActualite {

    // <editor-fold defaultstate="collapsed" desc="Méthodes statiques">

    public static function getNbActualite() {
        return GestionBoutique::getNbTupleByTable('actualite');
    }

    public static function ajouter($Titre, $descriptionActualite, $dates, $image, $privacy) {
        GestionBoutique::seConnecter();
        GestionBoutique::$requete = "insert into actualite(Titre,description,dates,image,privacy) values(:Titre ,:description, :dates,:image, :privacy) ";
        GestionBoutique::$pdoStResults = GestionBoutique::$pdoCnxBase->prepare(GestionBoutique::$requete);
        GestionBoutique::$pdoStResults->bindValue('Titre', $Titre);
        GestionBoutique::$pdoStResults->bindValue('description', $descriptionActualite);
        GestionBoutique::$pdoStResults->bindValue('dates', $dates);
        GestionBoutique::$pdoStResults->bindValue('image', $image);
        GestionBoutique::$pdoStResults->bindValue('privacy', $privacy);
        GestionBoutique::$pdoStResults->execute();
    }

    public static function supprimerById($idActualite) {
        GestionBoutique::seConnecter();
        GestionBoutique::$requete = "Delete FROM actualite WHERE idActualite = :id ";
        GestionBoutique::$pdoStResults = GestionBoutique::$pdoCnxBase->prepare(GestionBoutique::$requete);
        GestionBoutique::$pdoStResults->bindValue('id', $idActualite);
        GestionBoutique::$pdoStResults->execute();
    }

    public static function modifierActualite($idProduitAChanger, $Titre, $descriptionActualite, $dates, $idUtilisateur) {
        GestionBoutique::seConnecter();
        GestionBoutique::$requete = "update actualite set Titre = :Titre , description = :description , dates = :dates , idUtilisateur = :idUtilisateur WHERE id = :id";
        GestionBoutique::$pdoStResults = GestionBoutique::$pdoCnxBase->prepare(GestionBoutique::$requete);
        GestionBoutique::$pdoStResults->bindValue('id', $idActualiteAChanger);
        GestionBoutique::$pdoStResults->bindValue('Titre', $nomProduit);
        GestionBoutique::$pdoStResults->bindValue('description', $descriptionActualite);
        GestionBoutique::$pdoStResults->bindValue('dates', $dates);
        GestionBoutique::$pdoStResults->bindValue('idUtilisateur', $idUtilisateur);
        GestionBoutique::$pdoStResults->execute();
    }

    public static function getLesActualites() {
        GestionBoutique::seConnecter();

        GestionBoutique::$requete = "Select * FROM actualite ORDER BY dates DESC;";
        GestionBoutique::$pdoStResults = GestionBoutique::$pdoCnxBase->prepare(GestionBoutique::$requete);
        GestionBoutique::$pdoStResults->execute();
        GestionBoutique::$resultat = GestionBoutique::$pdoStResults->fetchAll();

        GestionBoutique::$pdoStResults->closeCursor();

        return GestionBoutique::$resultat;
    }

    public static function getLesActualitesPublic() {
        GestionBoutique::seConnecter();

        GestionBoutique::$requete = "Select * FROM actualite WHERE privacy = 0 ORDER BY dates DESC;";
        GestionBoutique::$pdoStResults = GestionBoutique::$pdoCnxBase->prepare(GestionBoutique::$requete);
        GestionBoutique::$pdoStResults->execute();
        GestionBoutique::$resultat = GestionBoutique::$pdoStResults->fetchAll();

        GestionBoutique::$pdoStResults->closeCursor();

        return GestionBoutique::$resultat;
    }

    public static function getActualiteById($idActualite) {
        $pdo = GestionBoutique::seConnecter();
        if ($pdo) {
            $sql = "SELECT Titre, description, privacy FROM actualite WHERE idActualite = :idActualite";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idActualite', $idActualite, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo 'Erreur : Impossible de se connecter à la base de données.';
            return false;
        }
    }

    public static function modifier($idActualite, $nouveauTitre, $description, $image, $privacy) {
        GestionBoutique::seConnecter();
        $pdo = GestionBoutique::seConnecter();
        $sql = "UPDATE actualite SET Titre = :Titre, description = :Description, image = :Image, privacy = :Visibility WHERE idActualite = :idActualite";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'Titre' => $nouveauTitre,
            'Description' => $description,
            'Image' => $image,
            'Visibility' => $privacy,
            'idActualite' => $idActualite
        ]);
    }

    public static function modifierSansImage($idActualite, $nouveauTitre, $description, $privacy) {
        GestionBoutique::seConnecter();
        $pdo = GestionBoutique::seConnecter();
        $sql = "UPDATE actualite SET Titre = :Titre, description = :Description, privacy = :Privacy WHERE idActualite = :idActualite";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'Titre' => $nouveauTitre,
            'Description' => $description,
            'Privacy' => $privacy,
            'idActualite' => $idActualite
        ]);
    }

    public static function getImageById($idActualite) {
        try {
            $pdo = GestionBoutique::seConnecter(); 
            $sql = "SELECT idActualite FROM actualite WHERE idActualite = :idActualite";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['idActualite' => $idActualite]);
            $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($resultat && isset($resultat['image'])) {
                return $resultat['image']; // Retournez le nom de l'image
            } else {
                return null; // Aucune image trouvée pour cet identifiant
            }
        } catch (PDOException $e) {
            // Gérer les erreurs de connexion ou de requête SQL
            echo "Erreur SQL : " . $e->getMessage();
            return null;
        }
    }

    
}

// </editor-fold>   
?>
