    <div class="pages_header">
        <span style="width:33%">
            <?php include(APPPATH . 'views/includes/small_icon.php'); ?>
        </span>
        <h1 style="color:<?= $color ?>" class="titre"><?= $title ?></h1>
        <span style="width:33%">
            <?php if (isset($add)) {
                echo $add;
            } ?>
        </span>
    </div>