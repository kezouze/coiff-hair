<div class="footer">
    <a href="<?= site_url() ?><?= $linkTo ?>" class="retour-button" style="background-color:<?= $color ?>">Retour</a>
    <?php if (isConnected()) { ?>
        <a href="<?= site_url() ?>Pros/deconnect" class="deco_button">Déconnexion</a>
    <?php } ?>
</div>