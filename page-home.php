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
    $titulo_marca = get_field('titulo_marcas', $initial->ID);
    $marcas = get_field('marcas', $initial->ID);
    $titulo_trafego = get_field('titulo_trafego', $initial->ID);
    $conteudo_trafego = get_field('conteudo_trafego', $initial->ID);
    $img_conteudo_trafego = get_field('imagem_conteudo_trafego', $initial->ID);
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

<section class="home-brands">
    <div class="home-brands-wrapper container">
        <div class="home-brands-header">
            <h2 class="home-brands-title">
                <?php if (!empty($titulo_marca)): ?>
                    <?php echo esc_html($titulo_marca); ?>
                <?php else: ?>
                    <?php esc_html_e('Marcas', 'text-domain'); ?>
                <?php endif; ?>
            </h2>
        </div>

        <div class="home-brands-content">
            <div class="home-brands-content-wrapper">
                <div class="home-brands-list">
                    <?php if (isset($marcas) && count($marcas) > 0): ?>
                        <?php foreach ($marcas as $marca): ?>
                            <div class="home-brands-item" style="max-width: <?php echo $marca['largura_img_marca'] ?>px;">
                                <div class="home-brands-item-image">
                                    <a href="<?php echo esc_url($marca['link_marca']) ?>" class="home-brands-item-link"
                                        target="_blank" rel="noopener noreferrer">
                                        <picture>
                                            <source srcset="<?php echo esc_url($marca['logo_marca']) ?>">
                                            <img src="<?php echo esc_url($marca['logo_marca']) ?>"
                                                alt="<?php echo esc_attr($marca['titulo_marca']) ?>">
                                        </picture>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p><?php esc_html_e('No brands available', 'text-domain'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="section-divider container"></div>

<section class="home-traffic">
    <div class="home-traffic-wrapper container">
        <div class="home-traffic-content">
            <div class="home-traffic-content-wrapper">
                <div class="home-traffic-image">
                    <picture>
                        <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/traffic-paid.svg">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/traffic-paid.svg"
                            alt="<?php esc_attr_e('Tráfico pago', 'text-domain'); ?>">
                    </picture>
                </div>
                <div class="home-traffic-text">
                    <h2 class="home-traffic-title">
                        <?php if (!empty($titulo_trafego)): ?>
                            <?php echo esc_html($titulo_trafego); ?>
                        <?php else: ?>
                            <?php esc_html_e('Traffic', 'text-domain'); ?>
                        <?php endif; ?>
                    </h2>
                    <?php if (!empty($conteudo_trafego)): ?>
                        <?php echo $conteudo_trafego; ?>
                    <?php else: ?>
                        <?php esc_html_e('No traffic content available', 'text-domain'); ?>
                    <?php endif; ?>
                </div>
                <div class="home-traffic-button">
                    <a href="#" class="btn-home-traffic">
                        <span class="btn-home-traffic-text">Quero Saber Mais →</span>
                    </a>

                </div>
            </div>
        </div>
        <div class="home-traffic-img">
            <div class="home-traffic-img-wrapper">
                <picture>
                    <source srcset="<?php echo esc_url($img_conteudo_trafego) ?>">
                    <img src="<?php echo esc_url($img_conteudo_trafego) ?>"
                        alt="<?php esc_attr_e('Tráfico pago', 'text-domain'); ?>">
                </picture>
            </div>
        </div>
    </div>
</section>

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

<!-- <?php get_footer(); ?>