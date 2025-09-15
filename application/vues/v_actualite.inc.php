<section class="article_actu">
    <?php
    foreach (VariablesGlobales::$lesActualites as $uneActualite) {
        // Convertis la date
        $date = new DateTime($uneActualite->dates);
        $formattedDate = $date->format('d/m/Y');
        ?> 
        <article> 
            <img src="<?php echo Chemins::IMAGES_ACTUALITES ?>/<?php echo $uneActualite->image; ?>" alt="photo" onclick="openModal(this)" />
            <aside>
                <h1><?php echo $uneActualite->Titre ?> </h1>    
                <p><?php echo "(" . $formattedDate . ")"; ?></p>   
                <h3><?php echo $uneActualite->description ?></h3>
            </aside>
        </article>
        <?php
    }
    ?>
</section>

<!-- Modal Structure -->
<div id="modal" class="modal" onclick="closeModal()">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modal-img">
</div>


<script>
function openModal(element) {
    var modal = document.getElementById('modal');
    var modalImg = document.getElementById("modal-img");
    modal.style.display = "block";
    modalImg.src = element.src;
}

function closeModal() {
    var modal = document.getElementById('modal');
    modal.style.display = "none";
}
</script>
