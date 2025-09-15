<?php

class ControleurMail {

    public function sendMail() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des données du formulaire
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            // Destinataire de l'email (votre adresse email)
            $to = "ecolejamondeyrabilingue@gmail.com";

            // Sujet de l'email
            $subject = "Nouveau message de contact";

            // Contenu de l'email
            $email_content = "Nom: $name\n";
            $email_content .= "Numéro de téléphone: $phone\n";
            $email_content .= "Email: $email\n";
            $email_content .= "Message:\n$message";

            // En-têtes de l'email
            $headers = "From: $email";

            // Envoi de l'email
            if (mail($to, $subject, $email_content, $headers)) {
                // Si l'email est envoyé avec succès, redirige vers une page de confirmation
                require_once Chemins::VUES . 'v_confirmation.inc.php';
            } else {
                // En cas d'échec de l'envoi de l'email, affiche un message d'erreur
                echo "Échec de l'envoi de l'email.";
            }
        }
    }
}
?>


