    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <style>
        /* CSS pour le style */
        .disabled {
            opacity: 0.5;
            pointer-events: none;
        }
    </style>
    
<section class="sectionConnexionAdmin">

    <div class="connexion_container" id="connexion_container">
        <div class="form-connexion_container sign-in">
            <form method="post" action="index.php?controleur=Admin&action=verifierConnexion">
                <legend>Identification</legend>
                <div class="input">
                    <label for="login">Login :</label> <input type="text" name="login" " /> <br/>
                    <label for="passe">Mot de passe :</label><input type="password" name="passe"  />
                </div>
                <br/>
                <div class="connexion_auto">
                    <label id="lblConnexionAuto" for="connexion_auto"> Connexion automatique : </label><br/>
                    <input type="checkbox" name="connexion_auto" id="connexion_auto" />
                </div>
                <div class="input">
                    <input id="connexion" type="submit" value="Connexion" />
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    // Fonction pour vérifier si les champs de connexion sont remplis
    function checkForm() {
        var login = document.getElementById("login").value;
        var passe = document.getElementById("passe").value;
        var submitBtn = document.getElementById("connexionBtn");

        // Si les champs ne sont pas vides, activer le bouton de soumission
        if (login !== "" && passe !== "") {
            submitBtn.classList.remove("disabled");
        } else {
            submitBtn.classList.add("disabled");
        }
    }

    // Appeler la fonction de vérification à chaque fois qu'un champ est modifié
    document.getElementById("login").addEventListener("input", checkForm);
    document.getElementById("passe").addEventListener("input", checkForm);
</script>


