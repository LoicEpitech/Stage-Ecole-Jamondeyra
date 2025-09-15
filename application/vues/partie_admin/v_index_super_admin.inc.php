
<section class="indexSuperAdmin">
    <div class="titre">
        Administration du site (Accès réservé)</br>
        - Bonjour <?php echo $_SESSION['login_super_admin']; ?> -
    </div>
    <div class ="utilisateur">
        <h2 class="titre_modifier_ajouter_supp">Ajouter/Modifier/Supprimer un utilsateur</h2>

        <form class="formAjouterUtilisateur" method="POST" action="index.php?controleur=Utilisateur&action=AjouterUtilisateur" enctype="multipart/form-data">
            <input type="hidden" name="action" value="ajouterUtilisateur">

            <label for="Nom">Nom utilisateur :</label>
            <input type="text" id="Nom" name="Nom" placeholder="Entrez le Nom de l'utilsiteur" required><br>

            <label for="prenom">Prénom de l'utilisateur:</label>
            <input type="text" id="prenom" name="prenom" placeholder="Entrez le prénom de l'utilisateur" required><br>

            <label for="mdp">Entrer le mot de passe de l'utilsateur:</label>
            <input type="text" id="mdp" name="mdp"><br>

            <label for="email">Entrer l'adresse email de l'utilisateur :</label>
            <input type="text" id="email" name="email"><br>

            <label for="login">Entrer le login de l'utilisateur :</label>
            <input type="text" id="login" name="login"><br>

            <label for="isAdmin">Peut-il ajouter des actualités?</label>
            <select id="isAdmin" name="isAdmin" required>
                <option value="">Sélectionner oui ou non</option>
                <option value="1">oui</option>
                <option value="0">non</option>
            </select><br>

            <label for="SuperAdmin">Peut-il ajouter des utilisateurs?</label>
            <select id="SuperAdmin" name="SuperAdmin" required>
                <option value="">Sélectionner oui ou non</option>
                <option value="1">oui</option>
                <option value="0">non</option>
            </select><br>

            <input class="bouton_form" type="submit" value="Ajouter">
        </form>

        <form id="selectUtilisateurForm" method="GET" action="index.php">
            <input type="hidden" name="controleur" value="Utilisateur">
            <input type="hidden" name="action" value="afficherModifierUtilisateur">
            <label for="utilisateur_a_modifier">Modifier l'utilisateur :</label>
            <select id="utilisateur_a_modifier" name="idUtilisateur" required>
                <option value="">Sélectionner l'utilisateur</option>
                <?php
                $lesUtilisateurs = GestionBoutique::getLesTuplesByTable("utilisateur");
                foreach ($lesUtilisateurs as $unUtilisateur) {
                    echo '<option value="' . $unUtilisateur->idUtilisateur . '">' . $unUtilisateur->Nom . '</option>';
                }
                ?>
            </select>
        </form>

        <script>
            document.getElementById('utilisateur_a_modifier').addEventListener('change', function () {
                document.getElementById('selectUtilisateurForm').submit();
            });
        </script>



<!--        <script>
            $(document).ready(function () {
                $('#actualite_a_modifier').change(function () {
                    var idActualite = $(this).val();
                    console.log("Actualité sélectionnée: " + idActualite); // Debug
                    if (idActualite) {
                        $.ajax({
                            type: 'POST',
                            url: 'index.php?controleur=Actualite&action=getActualiteDetails',
                            data: {idActualite: idActualite},
                            dataType: 'json',
                            success: function (response) {
                                console.log("Réponse du serveur: ", response); // Debug
                                if (response) {
                                    $('#nouveau_nom_actualite').val(response.Titre);
                                    $('#descrption_actualite').val(response.description);
                                    $('#Privacy_actualite').val(response.privacy);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("Erreur lors de la récupération des détails de l'actualité:", error); // Debug
                                alert('Erreur lors de la récupération des détails de l\'actualité.');
                            }
                        });
                    } else {
                        $('#nouveau_nom_actualite').val('');
                        $('#descrption_actualite').val('');
                        $('#Privacy_actualite').val('');
                    }
                });
            });
        </script>-->

        <form  class="formSuppUtilisateur"action="index.php?controleur=Utilisateur&action=SuprimerUtilisateur" method="POST">
            <label for="utilisateur_a_supprimer">Supprimer une actualite</label>
            <select id="utilisateur_a_supprimer" name="idUtilisateur" required>
                <option value="">Sélectionner l'utilisateur</option>
                <?php
                $lesUtilisateurs = GestionBoutique::getLesTuplesByTable("utilisateur");
                foreach ($lesUtilisateurs as $unUtilisateur) {
                    echo '<option value="' . $unUtilisateur->idUtilisateur . '">' . $unUtilisateur->Nom . '</option>';
                }
                ?>
            </select>

            <input class ="bouton_form" type="submit" value="Supprimer">
        </form>
    </div>




<div class ="Actualite">
    <h2 class="titre_modifier_ajouter_supp">Ajouter/Modifier/Supprimer une actualité</h2>

    <form class="formAjouterActualite" method="POST" action="index.php?controleur=Actualite&action=AjouterActualite" enctype="multipart/form-data">
        <input type="hidden" name="action" value="ajouterActualite">
        <label for="Titre">Titre de l'actualité :</label>
        <input type="text" id="Titre" name="Titre" placeholder="Entrez le Titre de l'actualité" required><br>

        <label for="description">Description de l'actualité :</label>
        <input type="text" id="description" name="description" placeholder="Entrez la description" required><br>

        <label for="image">Image de l'actualité :</label>
        <input type="file" id="image" name="image"><br>

        <label for="Privacy_actualite">Visibilité de l'actualité :</label>
        <select id="Privacy_actualite" name="Privacy_actualite" required>
            <option value="">Sélectionner la visibilité de l'actualité</option>
            <option value="0">public</option>
            <option value="1">privé</option>
        </select><br>

        <input class="bouton_form" type="submit" value="Ajouter">
    </form>



    <!--        <form class="formModifierActualite" action="index.php?controleur=Actualite&action=modifierActualite" method="POST">
                <label for="actualite_a_modifier">Modifier l'actualité :</label>
                <select id="actualite_a_modifier" name="actualite_a_modifier" required>
                    <option value="">Sélectionner l'actualité</option>
    <?php
    $lesActualites = GestionBoutique::getLesTuplesByTable("actualite");
    foreach ($lesActualites as $uneActualite) {
        echo '<option value="' . $uneActualite->idActualite . '">' . $uneActualite->Titre . '</option>';
    }
    ?>
                </select>
                <input type="text" id="nouveau_nom_actualite" name="nouveau_nom_actualite" placeholder="Nouveau Titre" required><br>
                <label for="descrption_actualite">Description de l'actualité :</label>
                <input type="text" id="descrption_actualite" name="descrption_actualite" value="" required><br>
                <label for="image">Image de l'actualité :</label>
                <input type="file" id="image" name="image"><br>
                <label for="Privacy_actualite">Visibilité de l'actualité :</label>
                <select id="Privacy_actualite" name="Privacy_actualite" required>
                    <option value="">Sélectionner la visibilité de l'actualité</option>
                    <option value="0">Public</option>
                    <option value="1">Privé</option>
                </select><br>
                <input class="bouton_form" type="submit" value="Modifier">
            </form>-->

    <form id="selectActualiteForm" method="GET" action="index.php">
        <input type="hidden" name="controleur" value="Actualite">
        <input type="hidden" name="action" value="afficherModifierActualite">
        <label for="actualite_a_modifier">Modifier l'actualité :</label>
        <select id="actualite_a_modifier" name="idActualite" required>
            <option value="">Sélectionner l'actualité</option>
            <?php
            $lesActualites = GestionBoutique::getLesTuplesByTable("actualite");
            foreach ($lesActualites as $uneActualite) {
                echo '<option value="' . $uneActualite->idActualite . '">' . $uneActualite->Titre . '</option>';
            }
            ?>
        </select>
    </form>

    <script>
        document.getElementById('actualite_a_modifier').addEventListener('change', function () {
            document.getElementById('selectActualiteForm').submit();
        });
    </script>



<!--        <script>
            $(document).ready(function () {
                $('#actualite_a_modifier').change(function () {
                    var idActualite = $(this).val();
                    console.log("Actualité sélectionnée: " + idActualite); // Debug
                    if (idActualite) {
                        $.ajax({
                            type: 'POST',
                            url: 'index.php?controleur=Actualite&action=getActualiteDetails',
                            data: {idActualite: idActualite},
                            dataType: 'json',
                            success: function (response) {
                                console.log("Réponse du serveur: ", response); // Debug
                                if (response) {
                                    $('#nouveau_nom_actualite').val(response.Titre);
                                    $('#descrption_actualite').val(response.description);
                                    $('#Privacy_actualite').val(response.privacy);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error("Erreur lors de la récupération des détails de l'actualité:", error); // Debug
                                alert('Erreur lors de la récupération des détails de l\'actualité.');
                            }
                        });
                    } else {
                        $('#nouveau_nom_actualite').val('');
                        $('#descrption_actualite').val('');
                        $('#Privacy_actualite').val('');
                    }
                });
            });
        </script>-->

    <form  class="formSuppActualite"action="index.php?controleur=Actualite&action=SupprimerActualite" method="POST">
        <label for="actualite_a_supprimer">Supprimer une actualite</label>
        <select id="actualite_a_supprimer" name="actualite_a_supprimer" required>
            <option value="">Sélectionner l'actualite</option>
            <?php
            $lesActualites = GestionBoutique::getLesTuplesByTable("actualite");

            foreach ($lesActualites as $uneActualite) { // Remplir le select avec les actualites
                ?>
                <option value="<?php echo $uneActualite->idActualite ?>"> <?php echo $uneActualite->Titre ?></option>
                <?php
            }
            ?>

        </select>

        <input class ="bouton_form" type="submit" value="Supprimer">
    </form>
</div>
<p class="textdeconnexion">
    <button class="deconnexion"><a href="index.php?controleur=Admin&action=seDeconnecter">Déconnexion </a></button>
</p>

</section>




