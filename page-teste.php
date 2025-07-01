<?php get_header();

// Verificar o idioma atual
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';

// Configurar os argumentos para pegar o post
$args = array(
    'post_type' => 'pag_teste',
    'lang' => $current_lang,
    'posts_per_page' => 1
);

// Buscar o post correspondente
$initials = get_posts($args);


if (!empty($initials)) {
    $initial = $initials[0];
    $titulo = get_field('titulo', $initial->ID);
    $conteudo = get_field('conteudo', $initial->ID);
    $imagem = get_field('imagem', $initial->ID);
}

?>

<div style="margin-top: 133px;">
    <h3><?php echo $titulo ?></h3>

    <div>
        <?php echo $conteudo ?>
    </div>

    <div>
        <picture>
            <source src="<?php echo $imagem ?>" type="">
            <img src="<?php echo $imagem ?>" alt="" srcset="">
        </picture>
    </div>
</div>


<?php get_footer() ?>