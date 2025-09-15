<?php

class GestionBoutique {
    // <editor-fold defaultstate="collapsed" desc="Champs statiques"> 

    /**
     * Objet de la classe PDO
     * @var PDO
     */
    public static $pdoCnxBase = null;

    /**
     * Objet de la classe PDOStatement
     * @var PDOStatement
     */
    public static $pdoStResults = null;
    public static $requete = ""; //texte de la requête
    public static $resultat = null; //résultat de la requête

    // </editor-fold>
    // 
    // <editor-fold defaultstate="collapsed" desc="Méthodes statiques">

    /**
     * Permet de se connecter à la base de données
     */
        public static function seConnecter() {
        if (!isset(self::$pdoCnxBase)) { // S'il n'y a pas encore eu de connexion
            try {
                self::$pdoCnxBase = new PDO('mysql:host=' . MysqlConfig::SERVEUR . ';dbname=' . MysqlConfig::BASE, MysqlConfig::UTILISATEUR, MysqlConfig::MOT_DE_PASSE);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$pdoCnxBase->query("SET CHARACTER SET utf8");
            } catch (Exception $e) {
                // l’objet pdoCnxBase a généré automatiquement un objet de type Exception
                echo 'Erreur : ' . $e->getMessage() . '<br />'; // méthode de la classe Exception
                echo 'Code : ' . $e->getCode(); // méthode de la classe Exception
            }
        }
        return self::$pdoCnxBase; // Retourne la connexion PDO
    }

    public static function isAdminOK($login, $passe) {
        self::seConnecter();
        self::$requete = "SELECT * FROM utilisateur where login = :login and mdp = :passe";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $login);
        self::$pdoStResults->bindValue('passe', sha1($passe));
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();
        if ((self::$resultat != null) and (self::$resultat->isAdmin))
            return true;
        else
            return false;
    }
    public static function superAdminOK($login, $passe) {
        self::seConnecter();
        self::$requete = "SELECT * FROM utilisateur where login = :login and mdp = :passe";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $login);
        self::$pdoStResults->bindValue('passe', sha1($passe));
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();
        if ((self::$resultat != null) and (self::$resultat->SuperAdmin))
            return true;
        else
            return false;
    }
      public static function isRegistered($login, $passe) {  
        self::seConnecter();
        self::$requete = "SELECT * FROM utilisateur where login =:login and mdp =:passe";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('login', $login);
        self::$pdoStResults->bindValue('passe', sha1($passe));
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();
        
        return (self::$resultat!=null);
    }

    public static function seDeconnecter() {
        self::$pdoCnxBase = null; //base a null donc déconnecter
    }

    public static function getLesTuplesByTable($table) {
        self::seConnecter();

        self::$requete = "Select * FROM $table";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    public static function getLeTupleTableById($table, $id) {
        self::seConnecter();
        self::$requete = "Select * FROM $table WHERE id = $id";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }

    private static function getLeTupleByTable($table) {
        self::seConnecter();

        self::$requete = "Select * FROM $table";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$resultat;
    }


    public static function getNbTupleByTable($table) {
        self::seConnecter();
        self::$requete = "SELECT Count(*) AS nbTuples FROM $table";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();
        return self::$resultat->nbTuples;
    }

    // </editor-fold>
}

?>