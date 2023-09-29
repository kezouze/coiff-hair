    <div class="pages_header">
        <span style="width:33%">
            <?php include(APPPATH . 'views/includes/small_icon.php'); ?>
        </span>
        <span style="width:34%">
            <h1 style="color:<?= $color ?>" class="titre"><?= $title ?></h1>
        </span>
        <span class="add_on" style="width:33%; color:<?= $color ?>">
            <?php if (isset($add_on)) {
                echo $add_on;
            } ?>
        </span>
        <audio src="/coiffhair/assets/audio/uwu.mp3" type="audio/mpeg" id="uwuAudio"></audio>
    </div>
    <script>
        easterEgg();
    </script>