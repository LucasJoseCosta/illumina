<?php
get_header();

$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';

$args_quemsomos = array(
  'post_type' => 'page_quem_somos',
  'lang' => $current_lang,
  'posts_per_page' => 1,
);

$initials = get_posts($args_quemsomos);

if (!empty($initials)) {
  $initial = $initials[0];
  $titulo_quem_somos = get_the_title($initial->ID);
  $quem_quer_faz_acontecer_titulo = get_field('quem_quer_faz_acontecer_titulo', $initial->ID);
  $imagem_quem_faz_acontecer = get_field('imagem_quem_faz_acontecer', $initial->ID);
  $texto_lado_imagem_quem_faz_acontecer = get_field('texto_lado_imagem_quem_faz_acontecer', $initial->ID);
  $texto_abaixo_imagem_quem_faz_acontecer = get_field('texto_abaixo_imagem_quem_faz_acontecer', $initial->ID);
  $imagem_quem_faz_acontecer_dados = get_field('imagem_quem_faz_acontecer_dados', $initial->ID);
  $titulo_quem_faz_acontecer_dados = get_field('titulo_quem_faz_acontecer_dados', $initial->ID);
  $imagem_carousel_quem_faz_acontecer = get_field('imagem_carousel_quem_faz_acontecer', $initial->ID);
  $texto_abaixo_carousel_quem_faz_acontecer = get_field('texto_abaixo_carousel_quem_faz_acontecer', $initial->ID);
  $tittle_ideias_brilhantes = get_field('tittle_ideias_brilhantes', $initial->ID);
} else {

  echo '<p>Nenhum post encontrado para o idioma atual.</p>';

}

?>

<section class="quem-somos container">
  <div class="quem-somos-header">
    <h1 class="quem-somos-header-title"><?php echo $titulo_quem_somos; ?></h1>
  </div>
</section>

<section class="quem-faz-acontece-section">
  <div class="quem-faz-acontece">
    <div class="quem-faz-acontece-wrapper container">
      <div class="quem-faz-acontece-content">
        <div class="quem-faz-acontece-image">
          <picture>
            <img src="<?php echo get_template_directory_uri() ?>/assets/img/who_make_it_happen.svg"
              alt="<?php esc_attr_e('Quem faz acontecer', 'text-domain'); ?>">
          </picture>
        </div>

        <?php if (!empty($texto_lado_imagem_quem_faz_acontecer)): ?>
          <div class="quem-faz-acontece-text">
            <?php echo wp_kses_post(wpautop($texto_lado_imagem_quem_faz_acontecer)); ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="quem-faz-acontece-image-below">
        <?php if (!empty($texto_abaixo_imagem_quem_faz_acontecer)): ?>
          <?php echo wp_kses_post(wpautop($texto_abaixo_imagem_quem_faz_acontecer)); ?>
        <?php endif; ?>
      </div>
      <div class="section-divider"></div>

      <div class="container-who-make-it-happen-carousel">
        <div class="title-and-carousel">
          <div class="img-and-title">
            <picture>
              <img class="light img-title" src="<?php echo get_template_directory_uri() ?>/assets/img/traffic-paid.svg"
                alt="<?php esc_attr_e('Quem faz acontecer dados', 'text-domain'); ?>">
              <img class="dark img-title"
                src="<?php echo get_template_directory_uri() ?>/assets/img/traffic-paid-dark.svg"
                alt="<?php esc_attr_e('Quem faz acontecer dados', 'text-domain'); ?>">
            </picture>
            <?php if (!empty($titulo_quem_faz_acontecer_dados)): ?>
              <h1 class="title-who-we-are-data"><?php echo esc_html($titulo_quem_faz_acontecer_dados); ?></h1>
            <?php endif; ?>
          </div>

          <picture class="image-carousel">
            <img class="image-carousel" src="<?php echo get_template_directory_uri() ?>/assets/img/carousel.svg"
              alt="<?php esc_attr_e('Quem faz acontecer carousel', 'text-domain'); ?>">
          </picture>
        </div>

        <div class="container-below-image-carousel">
          <?php if (!empty($texto_abaixo_carousel_quem_faz_acontecer)): ?>
            <div class="text-below-image-carousel">
              <?php echo wp_kses_post(wpautop($texto_abaixo_carousel_quem_faz_acontecer)); ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="container-bright-ideas">
    <div class="container-bright-ideas-wrapper container">
      <?php if (!empty($tittle_ideias_brilhantes)): ?>
        <h1 class="title-bright-ideas"><?php echo esc_html($tittle_ideias_brilhantes); ?></h1>
      <?php endif; ?>
    </div>
  </div>
</section>



<?php get_footer(); ?>