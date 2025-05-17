<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>

<head>
    <title><?php custom_meta_title(); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Protest+Strike&display=swap"
        rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/owl.theme.default.min.css">
    <script src="<?php echo get_template_directory_uri() ?>/assets/js/owl.carousel.min.js"></script>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="<?php bloginfo('charset'); ?>" />
    <?php wp_head(); ?>
</head>



<?php
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';
$args = array(
    'post_type'      => 'menu_custom',
    'lang'           => $current_lang,
    'posts_per_page' => -1,
);
$args_misc = array(
    'post_type'      => 'misc_info_contato',
    'lang'           => $current_lang,
    'posts_per_page' => -1,
);

$menus = get_posts($args);
$misc = get_posts($args_misc);

$initial_menus = $menus[0] ?? null;
$initial_misc = $misc[0] ?? null;

$logo_header = get_field('logo_header', $initial_misc->ID);
$menus_header = get_field('menus', $initial_menus->ID);

// Passando as variáveis PHP para o JavaScript de forma segura
// $title_claro_js = json_encode($title_claro);
// $title_escuro_js = json_encode($title_escuro);
?>



<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'twentynineteen'); ?></a>
        <header>
            <div class="header-wrapper">
                <div class="header-container container">
                    <div class="header-logo">
                        <a href="#" class="link-logo">
                            <img src="<?php echo $logo_header ?>" alt="logo" class="logo light">
                            <!-- <img src="<?php echo $logo_header_branca ?>" alt="logo" class="custom-logo dark"> -->
                        </a>
                    </div>
                    

                    <div class="header-menu-wrapper">
                        <div class="header-menu">
                            <?php if(isset($menus_header) && count($menus_header) > 0) : ?>
                                <nav>
                                    <ul class="menu">
                                        <?php foreach ($menus_header as $menu) : ?>
                                            <li class="menu-item">
                                                <div class="menu-container">
                                                    <?php if ($menu['tipo_de_link'] == 'ID') : ?>
                                                        <a href="<?php echo esc_url($menu['link_id']); ?>" class="link">
                                                            <?php echo esc_html($menu['titulo_menu']); ?>
                                                        </a>
                                                    <?php elseif ($menu['tipo_de_link'] == 'Link de pagina') : ?>
                                                        <a href="<?php echo esc_url($menu['link_de_pagina']); ?>" class="link">
                                                            <?php echo esc_html($menu['titulo_menu']); ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </nav>
                            <?php else : ?>
                                <span>Não possui menus cadastrados</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="header-actions">
                        <div class="header-button">
                            <a href="#">
                                <span>Entre em contato</span>
                            </a>
                        </div>
                        <div class="header-button-ld">
                            <button>
                                <img src="<?php echo get_template_directory_uri() ?>/assets/img/toggle-mode.svg" alt="" srcset="">
                            </button>
                        </div>
                        <div class="header-button-burger">
                            <button id="burger" class="burger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="mobile-drawer" id="mobileDrawer">
            <div class="mobile-drawer-inner">
                <div class="mobile-drawer-header">
                    <div class="header-button-ld">
                        <button>
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/toggle-mode.svg" alt="" srcset="">
                        </button>
                    </div>
                    <div class="header-close-button">
                        <button id="closeDrawer" class="close-drawer">×</button>
                    </div>
                </div>
                
                <nav class="mobile-menu">
                    <ul>
                        <?php if(isset($menus_header) && count($menus_header) > 0) : ?>
                            <?php foreach ($menus_header as $menu) : ?>
                                <li>
                                    <?php if ($menu['tipo_de_link'] == 'ID') : ?>
                                        <a href="<?php echo esc_url($menu['link_id']); ?>">
                                            <?php echo esc_html($menu['titulo_menu']); ?>
                                        </a>
                                    <?php elseif ($menu['tipo_de_link'] == 'Link de pagina') : ?>
                                        <a href="<?php echo esc_url($menu['link_de_pagina']); ?>">
                                            <?php echo esc_html($menu['titulo_menu']); ?>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </nav>
               <div class="header-drawer-actions">
                    <div class="header-button">
                        <a href="#">
                            <span>Entre em contato</span>
                        </a>
                    </div>
               </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const burger = document.getElementById("burger");
        const drawer = document.getElementById("mobileDrawer");
        const closeBtn = document.getElementById("closeDrawer");

        burger.addEventListener("click", function () {
            burger.classList.toggle("active");
            drawer.classList.toggle("open");
            document.body.classList.toggle("drawer-open");
        });

        closeBtn.addEventListener("click", function () {
            drawer.classList.remove("open");
            burger.classList.remove("active");
            document.body.classList.remove("drawer-open");
        });
    });
</script>