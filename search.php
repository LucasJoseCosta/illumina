<?php get_header();

// Verificar o idioma atual
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';

$filter_title = match ($current_lang) {
    "pt" => "Filtre pelas marcas desejadas",
    "en" => "Filter by desired brands",
    "es" => "Filtrar por marcas deseadas",
    default => "",
};

$filter_all_products = match ($current_lang) {
    "pt" => "Todos os produtos",
    "en" => "All products",
    "es" => "Todos los productos",
    default => "",
};

$filter_btn = match ($current_lang) {
    "pt" => "Filtrar",
    "en" => "Filter",
    "es" => "Filtrar",
    default => "",
};

$filter_clean_btn = match ($current_lang) {
    "pt" => "Limpar filtros",
    "en" => "Clear filters",
    "es" => "Limpiar filtros",
    default => "",
};

$know_more_btn = match ($current_lang) {
    "pt" => "Saiba mais",
    "en" => "Learn more",
    "es" => "Saber más",
    default => "",
};

$filter_no_results =  match ($current_lang) {
    "pt" => "Nenhum resultado encontrado",
    "en" => "No results found",
    "es" => "No se encontraron resultados",
    default => "",
};

// Configurar os argumentos para pegar o post
// $args = array(
// 	'post_type' => 'produto',
// 	'lang' => $current_lang,
// 	'posts_per_page' => -1
// );

// $product_page = get_post();
// // Buscar o post correspondente
// $products = get_posts($args);



?>

<section class="page-products">
    <div class="container">
        <div class="page-products-wrapper">
            <div class="page-products-header">
                <h1 class="page-products-title">
                    <?php
                    if (is_search()) {
                        // Exibe o termo de busca
                        echo 'Resultados para: ' . get_search_query();
                    } else {
                        // Caso não seja uma busca, exibe o título normal
                        echo get_the_title($product_page);
                    }
                    ?>
                </h1>
                <div class="products-filter-mobile">
                    <div class="products-filter-mobile-btn-wrapper">
                        <button class="filter-mobile-btn" id="filter-mobile-btn">
                            <img class="light" src="<?php echo get_template_directory_uri() ?>/assets/img/filter.svg"
                                alt="filter">
                            <img class="dark"
                                src="<?php echo get_template_directory_uri() ?>/assets/img/filter-white.svg"
                                alt="filter">
                            <span><?php echo $filter_btn ?></span>
                        </button>
                    </div>
                    <div class="menu-toggle" id="filter-drawer">
                        <div class="wrapper-top-menu">
                            <div id="control-menu-4">
                                <a id="close-button-2">
                                    <img class="light"
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/close.svg">
                                    <img class="dark"
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/close-white.svg">
                                </a>
                            </div>
                        </div>
                        <div class="products-filter-header-mobile">
                            <h3 class="page-products-filter-title-mobile"><?php echo $filter_title ?></h3>
                        </div>
                        <div class="products-filter-drawer-mobile">
                            <ul class="products-filter-options-mobile">
                                <?php
                                $marcas_exibidas = [];

                                if (have_posts()) :
                                    while (have_posts()) : the_post();

                                        $marca = get_field('marca', get_the_ID());


                                        if ($marca && !in_array($marca, $marcas_exibidas)) {
                                            $marcas_exibidas[] = $marca;
                                ?>
                                            <li class="products-filter-option">
                                                <input type="checkbox" id="<?php echo esc_attr(pll__($marca)); ?>" name="marca"
                                                    value="<?php echo esc_attr(pll__($marca)); ?>">
                                                <label for="<?php echo esc_attr(pll__($marca)); ?>"><?php echo esc_html(pll__($marca)); ?></label>
                                            </li>
                                    <?php
                                        }
                                    endwhile;
                                    ?>
                                    <li class="products-filter-option">
                                        <input type="checkbox" id="<?php echo $filter_all_products ?>" name="marca"
                                            value="<?php echo $filter_all_products  ?>">
                                        <label
                                            for="<?php echo $filter_all_products  ?>"><?php echo $filter_all_products  ?></label>
                                    </li>
                                <?php
                                else :
                                    echo '<p>' . esc_html($filter_no_results) . '</p>';
                                endif;
                                ?>

                            </ul>
                            <div class="filter-mobile-action">
                                <button class="clean-action-btn">
                                    <span><?php echo $filter_clean_btn ?></span>
                                </button>
                                <button class="filter-action-btn">
                                    <span><?php echo $filter_btn ?></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-products-content">
                <div class="page-products-filter-wrapper">
                    <div class="page-products-filter">
                        <h3 class="page-products-filter-title"><?php echo $filter_title ?></h3>
                        <div class="products-filter">
                            <ul class="products-filter-options">
                                <?php
                                $marcas_exibidas = [];

                                if (have_posts()) :
                                    while (have_posts()) : the_post();
                                        $marca = get_field('marca', get_the_ID());

                                        if ($marca && !in_array($marca, $marcas_exibidas)) {
                                            $marcas_exibidas[] = $marca;
                                ?>
                                            <li class="products-filter-option">
                                                <input type="checkbox" id="<?php echo esc_attr(pll__($marca)); ?>" name="marca"
                                                    value="<?php echo esc_attr(pll__($marca)); ?>">
                                                <label for="<?php echo esc_attr(pll__($marca)); ?>"><?php echo esc_html(pll__($marca)); ?></label>
                                            </li>
                                    <?php
                                        }
                                    endwhile;
                                    ?>
                                    <li class="products-filter-option">
                                        <input type="checkbox" id="<?php echo $filter_all_products ?>" name="marca"
                                            value="<?php echo $filter_all_products  ?>">
                                        <label
                                            for="<?php echo $filter_all_products  ?>"><?php echo $filter_all_products  ?></label>
                                    </li>
                                <?php
                                else :
                                    echo '<p>' . esc_html($filter_no_results) . '</p>';
                                endif;
                                ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="page-products-list-wrapper">
                    <div class="products-list">
                        <?php
                        if (have_posts()) :
                            while (have_posts()) : the_post();
                                $product_name = get_field('nome_produto');
                                $product_image = get_field('imagem_destaque');
                                $product_link = get_field('link_botao'); ?>
                                <div class="product-item" data-marca="<?php echo get_field('marca', get_the_ID()); ?>">
                                    <div class="product-item-image">
                                        <picture>
                                            <source srcset="<?php echo $product_image ?>">
                                            <img src="<?php echo $product_image ?>"
                                                alt="<?php echo esc_attr($product_name); ?>">
                                        </picture>
                                    </div>
                                    <div class="product-name-wrapper">
                                        <h3 class="product-name"><?php echo esc_html($product_name); ?></h3>
                                    </div>
                                    <div class="product-btn-wrapper">
                                        <a href="<?php echo esc_url($product_link); ?>" class="product-btn">
                                            <span class="product-btn-text"><?php echo $know_more_btn ?></span>
                                        </a>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                        else :
                            echo '<p>' . $filter_no_results . '</p>';
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>