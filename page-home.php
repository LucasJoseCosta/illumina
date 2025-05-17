<?php
get_header();

// Verificar o idioma atual
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';


// Configurar os argumentos para pegar o post
$args = array(
    'post_type' => 'pag_home',
    'lang' => $current_lang,
    'posts_per_page' => 1
);

// Buscar o post correspondente
$initials = get_posts($args);

if (!empty($initials)) {
    $initial = $initials[0];
    $banners = get_field('slider_home', $initial->ID);
} else {
    echo '<p>Nenhum post encontrado para o idioma atual.</p>';
    $banners = [];
}
?>

<?php if (!empty($initials)): ?>
    <section class="home-slider-banner">
        <div class="home-slider-banner-wrapper container">
            <div class="home-slider-banner-content">
                <div class="home-slider-work-button">
                    <a href="#" class="btn-home-slider-work">
                        <span class="btn-home-slider-work-text">Trabalhos Destaques</span>
                    </a>
                </div>
                <div class="owl-home-slider-banner owl-carousel owl-theme">
                    <?php if (isset($banners) && count($banners) > 0): ?>
                        <?php foreach ($banners as $banner): ?>
                            <div class="banner-item">
                                <div class="banner-item-image">
                                    <picture>
                                        <source srcset="<?php echo $banner['banner'] ?>">
                                        <img src="<?php echo $banner['banner'] ?>" alt="<?php echo esc_attr($banner['titulo']) ?>">
                                    </picture>
                                </div>
                                <!-- <div class="banner-item-content">
                                    <h2 class="banner-item-title"><?php echo esc_html($banner['titulo']) ?></h2>
                                    <p class="banner-item-text"><?php echo esc_html($banner['texto']) ?></p>
                                    <a href="<?php echo esc_url($banner['link']) ?>" class="btn-banner">
                                        <span class="btn-banner-text"><?php echo esc_html($banner['texto_botao']) ?></span>
                                    </a>
                                </div> -->
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="home-slider-see-more-button">
                    <a href="#" class="btn-home-slider-see-more">
                        <span class="btn-home-slider-see-more-text">Ver Mais →</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <p><?php esc_html_e('No banners available', 'text-domain'); ?></p>
<?php endif; ?>

<div class="section-divider container"></div>

<script>
    $(document).ready(function () {
        $('.owl-home-slider-banner').owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
            }
        });
    });
</script>

<?php get_footer(); ?>