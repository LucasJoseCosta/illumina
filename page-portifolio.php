<?php
get_header();

// Verificar o idioma atual
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';


$selected_term_slug = '';
if (isset($_GET['cat_slug']) && !empty($_GET['cat_slug'])) {
    $selected_term_slug = sanitize_text_field($_GET['cat_slug']);
}
$termos_portifolio = []; // Array padrão

$args_home_page_content = array(
    'post_type' => 'pag_home',
    'lang' => $current_lang,
    'posts_per_page' => 1,
    'no_found_rows' => true, // Otimização se não precisar de paginação
    'update_post_term_cache' => false, // Otimização
    'update_post_meta_cache' => false, // Otimização
);


// Buscar o post correspondente
$initials = get_posts($args_home_page_content);

if (!empty($initials)) {
    $initial_post_id = $initials[0]->ID;
    $acf_titulo = get_field('titulo_portifolio', $initial_post_id);
    if ($acf_titulo) {
        $titulo_portifolio = $acf_titulo;
    }
    $acf_termos = get_field('termos_portifolio', $initial_post_id);
    if ($acf_termos) {
        $termos_portifolio = $acf_termos;
    }
}

$current_page_url = get_permalink();

?>
<p><?php echo $selected_term_slug ?></p>
<section class="portifolio">
    <div class="portifolio-wrapper container">
        <div class="portifolio-header">
            <h2 class="portifolio-title">
                <?php if (!empty($titulo_portifolio)): ?>
                    <?php echo esc_html($titulo_portifolio); ?>
                <?php else: ?>
                    <?php esc_html_e('Portfolio', 'text-domain'); ?>
                <?php endif; ?>
            </h2>
        </div>

        <div class="portifolio-terms">
            <div class="portifolio-terms-wrapper">
                <div class="portifolio-terms-content">
                    <?php
                    if (is_array($termos_portifolio) && count($termos_portifolio) > 0) {
                        foreach ($termos_portifolio as $termo_obj) {
                            $term_slug_for_data = isset($termo_obj["categoria_do_termo"]) ? $termo_obj["categoria_do_termo"] : '';
                            $term_name_for_display = isset($termo_obj['termo']) ? $termo_obj['termo'] : 'Termo Inválido';

                            // Adiciona a classe 'active-term' se este for o termo selecionado inicialmente (vindo da URL)
                            $is_active_class = ($selected_term_slug === $term_slug_for_data && !empty($selected_term_slug)) ? 'active-term' : '';
                            ?>
                            <div class="portifolio-terms-item">
                                <div class="portifolio-terms-item-button">
                                    <a href="javascript:void(0);"
                                        class="btn-portifolio-terms <?php echo esc_attr($is_active_class); ?>"
                                        data-term-slug="<?php echo esc_attr($term_slug_for_data); ?>">
                                        <span
                                            class="btn-portifolio-terms-text"><?php echo esc_html($term_name_for_display); ?></span>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<p>' . esc_html__('No portfolio terms available', 'text-domain') . '</p>';
                    }
                    ?>
                </div>
                <div class="portifolio-terms-content-mobile">
                    <div class="owl-portifolio-terms owl-carousel owl-theme">
                        <?php
                        if (is_array($termos_portifolio) && count($termos_portifolio) > 0) {
                            foreach ($termos_portifolio as $termo_obj) {
                                $term_slug_for_data = isset($termo_obj["categoria_do_termo"]) ? $termo_obj["categoria_do_termo"] : '';
                                $term_name_for_display = isset($termo_obj['termo']) ? $termo_obj['termo'] : 'Termo Inválido';

                                // Adiciona a classe 'active-term' se este for o termo selecionado inicialmente (vindo da URL)
                                $is_active_class = ($selected_term_slug === $term_slug_for_data && !empty($selected_term_slug)) ? 'active-term' : '';
                                ?>
                                <div class="portifolio-terms-item">
                                    <div class="portifolio-terms-item-button">
                                        <a href="javascript:void(0);"
                                            class="btn-portifolio-terms <?php echo esc_attr($is_active_class); ?>"
                                            data-term-slug="<?php echo esc_attr($term_slug_for_data); ?>">
                                            <span
                                                class="btn-portifolio-terms-text"><?php echo esc_html($term_name_for_display); ?></span>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p>' . esc_html__('No portfolio terms available', 'text-domain') . '</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        // --- LÓGICA PARA EXIBIR POSTS DO PORTFÓLIO (pag_portifolio) ---
        $prioritized_posts_output = [];
        $other_posts_output = [];

        $args_all_posts = array(
            'post_type' => 'pag_portifolio',
            'lang' => $current_lang,
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $all_posts_query = new WP_Query($args_all_posts);

        if ($all_posts_query->have_posts()) {
            while ($all_posts_query->have_posts()) {
                $all_posts_query->the_post();
                $post_object = get_post();


                $esta_no_termo = false;
                if (!empty($selected_term_slug)) {
                    $esta_no_termo = has_term($selected_term_slug, 'category', $post_object->ID);
                }


                if ($esta_no_termo) {
                    $prioritized_posts_output[] = $post_object;
                } else {
                    $other_posts_output[] = $post_object;
                }
            }
            wp_reset_postdata();
        }

        $final_posts_to_display = array_merge($prioritized_posts_output, $other_posts_output);

        if (!empty($final_posts_to_display)) {
            echo '<div class="portfolio-items-container">';
            foreach ($final_posts_to_display as $post_item) {
                ?>
                <div class="portfolio-item">
                    <h4>
                        <a href="<?php echo esc_url(get_permalink($post_item->ID)); ?>">
                            <?php echo esc_html($post_item->post_title); ?>
                        </a>
                    </h4>
                    <?php if (has_post_thumbnail($post_item->ID)): ?>
                        <?php // echo get_the_post_thumbnail($post_item->ID, 'medium'); ?>
                    <?php endif; ?>
                </div>
                <?php
            }
            echo '</div>';
        } else {
            echo '<p>' . esc_html__('Nenhum item de portfólio encontrado.', 'text-domain') . '</p>';
        }
        ?>
    </div>
</section>


<script>
    $(document).ready(function () {
        $('.owl-portifolio-terms').owlCarousel({
            nav: false,
            dots: false,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
                767: {
                    items: 2
                }
            }
        });
    });
</script>

<?php get_footer(); ?>