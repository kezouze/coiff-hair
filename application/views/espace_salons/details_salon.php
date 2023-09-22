<!DOCTYPE html>
<html lang="fr">

<?php
$title = $name;
$color = "#2f4f4f";
if (isset($_SESSION['type']) && $_SESSION['type'] === "pro") {
    $linkTo = "Pros";
    $add_on = '<button disabled style="background:' . $likeBtnColor . '" class="disabled">👍🏻
            <p id="likes" style="color:white;">' . $likes . '</p>
            </button>';
} else {
    $linkTo = "Welcome/infos";
    $add_on = '<button data-id="' . $id . '" style="background:' . $likeBtnColor . '" class="likes">👍🏻
            <p id="likes" style="color:white;">' . $likes . '</p>
        </button>';
}
require_once(APPPATH . 'views/includes/head.php');
?>

<body>
    <!-- <div style="height: 100vh; display:flex; align-items: center; justify-content: center; gap: 3rem"> -->
    <!-- <img class="icone_previous" src="" alt="Précédent"> -->
    <div class="blur">
        <?php include(APPPATH . 'views/includes/header.php'); ?>
        <div class="details_content">
            <div class="left">
                <?php if (count($photos) > 0) { ?>
                    <div class="carousel-container">
                        <?php foreach ($photos as $photo) { ?>
                            <div class="carousel-slide">
                                <!-- class="big_img"-->
                                <img src="<?= base_url() ?>/uploads/<?= $photo->file_access ?>" class="big_img_carrousel" alt="Photo du salon">
                            </div>
                        <?php } ?>
                    </div>
                    <div>
                        <button class="button" id="prevBtn">←</button>
                        <button class="button" id="nextBtn">→</button>

                    </div>
                <?php } else if (count($photos) === 0) { ?>
                    <img src="https://source.unsplash.com/random/600x400?hair" class="big_img" alt="Photo du salon">
                <?php }
                ?>
            </div>
            <div class="right">
                <?php foreach ($all_data as $data) { ?>
                    <p style="max-width:50%;"><?= substr($data->description, 0, 150) ?>...</p>
                    <hr>
                    <p><?= $data->address ?></p>
                    <p><?= $data->postal_code; ?> <?= strtoupper($data->city) ?></p>
                    <p><?= $data->telephone; ?></p>
                    <p><a href="mailto:<?= $data->email; ?>"><?= $data->email; ?></a></p>
                    <p><?= $data->boss; ?></p>
                    <hr>
                    <a href="/coiffhair/Welcome/prestations?id=<?= $data->id_pro ?>" style="background:<?= $color ?>" class="button">Les prestations</a>
                    <?php if (isset($_SESSION['type']) && $_SESSION['type'] == "client") { ?>
                        <a href="http://[::1]/coiffhair/Users/rendez_vous?id=<?= $data->id_pro ?>&name=<?= $data->name ?>" style="background:<?= $color ?>" class="button">Réserver</a>
                    <?php } else if (isset($_SESSION['type']) && $_SESSION['type'] == "pro") { ?>
                        <button disabled href="" style="background:<?= $color ?>" class="button">Réserver</button>
                    <?php } else { ?>
                        <a href="http://[::1]/coiffhair/Users/" style="background:<?= $color ?>" class="button">Réserver</a>
                <?php }
                } ?>
            </div>
        </div>
        <?php include(APPPATH . 'views/includes/footer.php'); ?>
        <!-- <img class="icone_next" src="" alt="Suivant"> -->
        <!-- </div> -->
    </div>
</body>
<script>
    updateLikes();

    const carouselContainer = document.querySelector('.carousel-container');
    const slides = document.querySelectorAll('.carousel-slide');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    let currentIndex = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.transform = `translateX(${100 * (i - index)}%)`;
        });
    }

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        showSlide(currentIndex);
    });

    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    });

    showSlide(currentIndex);
</script>

</html>