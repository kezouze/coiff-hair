<div class="footer">
    <a href="http://[::1]/coiffhair/<?= $linkTo ?>" class="retour-button" style="background-color:<?= $color ?>">Retour</a>
    <?php if (isConnected()) { ?>
        <a href="http://[::1]/coiffhair/<?= $linkTo ?>/deconnect" class="deco_button">Déconnexion</a>
    <?php } ?>
</div>