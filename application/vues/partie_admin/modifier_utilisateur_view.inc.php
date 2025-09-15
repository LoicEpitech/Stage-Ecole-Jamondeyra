

<section class="indexAdmin">
    <div class="titre">
        Administration du site (Accès réservé)</br>
        
    </div>
    <div class ="produit">
        
        <h2 class="titre_modifier_ajouter_supp">Modifier un utilisateur</h2>
        <form class="formModifierActualite" action="index.php?controleur=Utilisateur&action=modifierUtilisateur" method="POST" enctype="multipart/form-data">
            <label for="utilisateur_a_modifier">Modifier l'utilisateur :</label>
            <select id="utlisateur_a_modifier" name="utilisateur_a_modifier" required>
                <option value="">Sélectionner l'actualité</option>
                <?php
                $lesUtilisateurs = GestionBoutique::getLesTuplesByTable("utilisateur");
                foreach ($lesUtilisateurs as $unUtilisateur) {
                    $selected = ($unUtilisateur->idUtilisateur == $idUtilisateur) ? 'selected' : '';
                    echo '<option value="' . $unUtilisateur->idUtilisateur . '" ' . $selected . '>' . $unUtilisateur->Nom. '</option>';
                }
                ?>
            </select>
            <input type="text" id="nouveau_nom_utilisateur" name="nouveau_nom_utilisateur" placeholder="Nouveau Nom" value="<?php echo isset($utilisateur['Nom']) ? $utilisateur['Nom'] : ''; ?>" required><br>
           
         
            
            

            <label for="prenom">Prénom de l'utilisateur:</label>
            <input type="text" id="prenom" name="prenom" placeholder="Entrez le prénom de l'utilisateur"value="<?php echo isset($utilisateur['Prenom']) ? $utilisateur['Prenom'] : ''; ?>" required><br>

            <label for="mdp">Entrer le mot de passe de l'utilsateur:</label>
            <input type="text" id="mdp" name="mdp"><br>
            
            <label for="email">Entrer l'adresse email de l'utilisateur :</label>
            <input type="text" id="email" name="email"value="<?php echo isset($utilisateur['Mail']) ? $utilisateur['Mail'] : ''; ?>"required><br>
            
            <label for="login">Entrer le login de l'utilisateur :</label>
            <input type="text" id="login" name="login" value="<?php echo isset($utilisateur['login']) ? $utilisateur['login'] : '' ; ?>"required><br>
            
            <label for="isAdmin">Peut-il ajouter des utilisteurs ?</label>
            <select id="isAdmin" name="isAdmin" required>
                <option value="">Sélectionner oui ou non</option>
                <option value="1"<?php echo (isset($utilisateur['isAdmin']) && $utilisateur['isAdmin'] == 1) ? 'selected' : ''; ?>>oui</option>
                <option value="0"<?php echo (isset($utilisateur['isAdmin']) && $utilisateur['isAdmin'] == 0) ? 'selected' : ''; ?>>non</option>
            </select><br>
            
            <label for="SuperAdmin">Peut-il ajouter des utilisateurs?</label>
            <select id="SuperAdmin" name="SuperAdmin" required>
                <option value="">Sélectionner oui ou non</option>
                <option value="1"<?php echo (isset($utilisateur['SuperAdmin']) && $utilisateur['SuperAdmin'] == 1) ? 'selected' : ''; ?>>oui</option>
                <option value="0"<?php echo (isset($utilisateur['SuperAdmin']) && $utilisateur['SuperAdmin'] == 0) ? 'selected' : ''; ?>>non</option>
            </select><br>
            <input class="bouton_form" type="submit" value="Modifier">
        </form>

        <p class="textdeconnexion">
            <button class="deconnexion"><a href="index.php?controleur=Admin&action=afficherIndex">Retour </a></button>
        </p>

</section>

