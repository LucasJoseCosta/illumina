<?php
/**
 * Template Name: Quem Somos
 */

get_header();
$args_quemsomos = array(
  'post_type' => 'quem-somos',
  'lang' => $current_lang,
  'posts_per_page' => 1,
);

$quemsomos = get_posts($args_quemsomos);
$initial_quemsomos = $quemsomos[0] ?? null;

$page_id = get_the_ID();

$titulo_quem_somos = get_field('titulo_quem_somos', $page_id);
$texto_quem_somos = get_field('texto_quem_somos', $page_id);
$titulo_quem_faz = get_field('titulo_quem_faz_acontecer', $page_id);
$texto_quem_faz = get_field('texto_quem_faz_acontecer', $page_id);
$titulo_ideias_brilhantes = get_field('titulo_ideias_brilhantes', $page_id);
$texto_ideias_brilhantes = get_field('texto_ideias_brilhantes', $page_id);
?>

<main class="quem-somos">
  <div class="container">

    <?php if (!empty($titulo_quem_somos) || !empty($texto_quem_somos)): ?>
      <section class="quem-somos-section">
        <h1 class="section-title"><?php echo esc_html($titulo_quem_somos); ?></h1>
        <p class="section-text"><?php echo esc_html($texto_quem_somos); ?></p>
      </section>
    <?php endif; ?>

    <?php if (!empty($titulo_quem_faz) || !empty($texto_quem_faz)): ?>
      <section class="quem-faz-acontecer-section">
        <h2 class="section-title"><?php echo esc_html($titulo_quem_faz); ?></h2>
        <p class="section-text"><?php echo esc_html($texto_quem_faz); ?></p>
      </section>
    <?php endif; ?>

    <?php if (!empty($titulo_ideias_brilhantes) || !empty($texto_ideias_brilhantes)): ?>
      <section class="ideias-brilhantes-section">
        <h3 class="section-title"><?php echo esc_html($titulo_ideias_brilhantes); ?></h3>
        <p class="section-text"><?php echo esc_html($texto_ideias_brilhantes); ?></p>
      </section>
    <?php endif; ?>

  </div>
</main>

<?php get_footer(); ?>
