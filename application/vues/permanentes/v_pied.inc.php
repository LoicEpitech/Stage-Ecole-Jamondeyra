<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>

      <script>  <!-- bouton remonter page -->

        // Récupère le bouton
        let backToTopBtn = document.querySelector(".btn");

        // Affiche le bouton lorsque l'utilisateur fait défiler vers le bas de 20px à partir du sommet du document
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                backToTopBtn.style.display = "block";
            } else {
                backToTopBtn.style.display = "none";
            }
        }

        // Lorsque l'utilisateur clique sur le bouton, fait défiler vers le haut du document
        backToTopBtn.onclick = function() {
            topFunction();
        };

        function topFunction() {
            document.body.scrollTop = 0; // Pour Safari
            document.documentElement.scrollTop = 0; // Pour Chrome, Firefox, IE et Opera
        }
    </script>
  
  
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>