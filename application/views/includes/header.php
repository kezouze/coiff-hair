    <div class="pages_header">
        <?php include(APPPATH . 'views/includes/small_icon.php'); ?>
        <h1 style="color:<?= $color ?>" class="titre"><?= $title ?></h1>
        <?php if (isset($add)) {
            echo $add;
        } ?>
    </div>