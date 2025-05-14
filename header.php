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
    'post_type'      => 'info_contact',
    'lang'           => $current_lang,
    'posts_per_page' => -1,
);

$initials = get_posts($args);
$initial = $initials[0] ?? null;

$logo_header = get_field('logo_header', $initial->ID);
$logo_header_branca = get_field('logo_header_branca', $initial->ID);

// Definir o caminho da página de eventos para cada idioma
if ($current_lang == 'en') {
    $eventos_page_slug = 'events';
    $title_claro = 'Light Mode';
    $title_escuro = 'Dark Mode';
    $busca = "Search";
    $text_btn = 'View calendar';
} elseif ($current_lang == 'es') {
    $eventos_page_slug = 'eventos-es';
    $title_claro = 'Modo Claro';
    $title_escuro = 'Modo Oscuro';
    $busca = "Buscar";
    $text_btn = 'Ver calendario';
} else {
    $eventos_page_slug = 'eventos';
    $title_claro = 'Modo Claro';
    $title_escuro = 'Modo Escuro';
    $busca = "Busca";
    $text_btn = 'Ver calendário';
}
// Passando as variáveis PHP para o JavaScript de forma segura
$title_claro_js = json_encode($title_claro);
$title_escuro_js = json_encode($title_escuro);
?>


<?php
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';
$args = array(
    'post_type'      => 'info_contact',
    'lang'           => $current_lang,
    'posts_per_page' => -1,
);

$initials = get_posts($args);
$initial = $initials[0] ?? null;

$numero_wpp = get_field('numero_wpp', $initial->ID);


?>


<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'twentynineteen'); ?></a>
        <header>
            <div class="wrapper-wpp">
                <a href="<?= $numero_wpp ?>" class="link" target="_blank">
                    <img class="wpp light" src="<?php echo get_template_directory_uri() ?>/assets/img/wpp.png">
                    <img class="wpp dark" src="<?php echo get_template_directory_uri() ?>/assets/img/wpp-w.png">
                </a>
            </div>
            <div class="container-header">
                <a href="/" class="link">
                    <img src="<?php echo $logo_header ?>" alt="logo" class="custom-logo light">
                    <img src="<?php echo $logo_header_branca ?>" alt="logo" class="custom-logo dark">
                </a>

                <div class="wrapper-menu-desktop">
                    <div class="wrapper-menu-custom">
                        <div class="related-posts">
                            <?php

                            $custom_posts_args = [
                                'post_type' => 'menu_custom',
                                'posts_per_page' => -1,
                                'lang'           => $current_lang,
                                'orderby' => 'date',
                                'order' => 'ASC',
                            ];

                            $custom_posts_query = new WP_Query($custom_posts_args);

                            if ($custom_posts_query->have_posts()) :
                                while ($custom_posts_query->have_posts()) : $custom_posts_query->the_post();
                                    $link_principal = get_field('link_principal', get_the_ID());
                                    $lista_de_menu = get_field('lista_de_menu', get_the_ID());
                            ?>
                                    <?php if ($lista_de_menu) : ?>
                                        <div class="related-post-item">
                                            <a href="<?php echo $link_principal ?>" class="link-principal">
                                                <p class="title"><?php the_title(); ?></p>

                                            </a>
                                            <img class="arrow light"
                                                src="<?php echo get_template_directory_uri() ?>/assets/img/arrow.svg">
                                            <img class="arrow dark"
                                                src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-white.svg">

                                            <div class="wrapper-absolute">
                                                <div class="wrapper-left">
                                                    <div class="wrapper-list-menu">
                                                        <?php foreach ($lista_de_menu as $item_menu) : ?>
                                                            <a href="<?php echo $item_menu["link"]; ?>" class="link">
                                                                <div class="item">
                                                                    <p class="title"><?php echo $item_menu["nome"]; ?></p>
                                                                </div>
                                                            </a>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="related-post-item">
                                            <a href="<?php echo $link_principal ?>" class="link-principal">
                                                <p class="title"><?php the_title(); ?></p>

                                            </a>
                                        </div>

                                    <?php endif; ?>

                                <?php endwhile;
                                wp_reset_postdata();
                            else : ?>
                                <p>Nenhum menu encontrado.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="wrapper-search-bar">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <label for="search-field">
                            <input type="search" id="search-field" class="search-field" placeholder="<?= $busca ?>"
                                value="<?php echo esc_attr(get_search_query()); ?>" name="s" required />
                        </label>
                        <button type="submit" class="search-submit">
                            <img class="light"
                                src="<?php echo get_template_directory_uri() ?>/assets/img/search-button.svg" alt=""
                                srcset="">
                            <img class="dark"
                                src="<?php echo get_template_directory_uri() ?>/assets/img/search-button-white.svg"
                                alt="" srcset="">
                        </button>
                    </form>
                </div>
                <!-- <div class="wrapper-settings-desktop">
                    <div class="wrapper-settings">
                        <div class="theme-toggle">
                            <input type="checkbox" id="theme-toggle-checkbox-desktop">
                            <label for="theme-toggle-checkbox-desktop" class="toggle-label">

                                <span class="toggle-text"><?php $title_claro ?></span>
                            </label>
                        </div>
                        <ul class="translate">
                            <li
                                class="<?php echo (get_locale() == 'pt' || (isset($_GET['lang']) && $_GET['lang'] == 'pt')) ? 'ativa' : ''; ?>">
                                <a href="?lang=pt">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/pt-br.svg" alt="pt-BR" srcset="">
                                </a>
                            </li>
                            <li
                                class="<?php echo (get_locale() == 'en' || (isset($_GET['lang']) && $_GET['lang'] == 'en')) ? 'ativa' : ''; ?>">
                                <a href="?lang=en"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/en-us.svg" alt="en-US" srcset=""></a>
                            </li>
                            <li
                                class="<?php echo (get_locale() == 'es' || (isset($_GET['lang']) && $_GET['lang'] == 'es')) ? 'ativa' : ''; ?>">
                                <a href="?lang=es"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/es.svg" alt="es" srcset=""></a>
                            </li>
                        </ul>
                    </div>
                </div> -->
                <div id="control-menu">
                    <a id="burger-3">
                        <img class="light" src="<?php echo get_template_directory_uri() ?>/assets/img/buguer.svg">
                        <img class="dark" src="<?php echo get_template_directory_uri() ?>/assets/img/burguer-white.svg">
                    </a>
                </div>
            </div>
            <div class="menu-toggle" id="menu-drawer">
                <div class="wrapper-top-menu">
                    <div class="logo-menu">
                        <img src="<?php echo $logo_header ?>" alt="logo" class="custom-logo light">
                        <img src="<?php echo $logo_header_branca ?>" alt="logo" class="custom-logo dark">
                    </div>
                    <div id="control-menu-4">
                        <a id="close-button-1">
                            <img class="light" src="<?php echo get_template_directory_uri() ?>/assets/img/close.svg">
                            <img class="dark"
                                src="<?php echo get_template_directory_uri() ?>/assets/img/close-white.svg">
                        </a>
                    </div>
                </div>
                <div class="wrapper-settings">
                    <div class="theme-toggle">
                        <input type="checkbox" id="theme-toggle-checkbox">
                        <label for="theme-toggle-checkbox" class="toggle-label">

                            <span class="toggle-text"><?php $title_claro ?></span>
                        </label>
                    </div>

                    <ul class="translate">
                        <li class="<?php echo pll_current_language() === 'pt' ? 'ativa' : ''; ?>">
                            <a href="<?php echo pll_the_languages(array('raw' => 1))['pt']['url']; ?>"><img
                                    class="bandeira"
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/pt-br.svg"></a>
                        </li>
                        <li class="<?php echo pll_current_language() === 'en' ? 'ativa' : ''; ?>">
                            <a href="<?php echo pll_the_languages(array('raw' => 1))['en']['url']; ?>"><img
                                    class="bandeira"
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/en-us.svg"></a>
                        </li>
                        <li class="<?php echo pll_current_language() === 'es' ? 'ativa' : ''; ?>">
                            <a href="<?php echo pll_the_languages(array('raw' => 1))['es']['url']; ?>"><img
                                    class="bandeira"
                                    src="<?php echo get_template_directory_uri() ?>/assets/img/es.svg"></a>
                        </li>
                    </ul>
                </div>
                <?php
                wp_nav_menu(array(
                    [
                        'menu_class' => 'main_menu',
                        'container' => false,
                        'theme_location' => 'primary',
                        'depth' => 4,
                    ]
                ));
                ?>
            </div>

    </div>



    <?php
    $current_lang = function_exists('pll_current_language') ? pll_current_language() : '';

    // Encontrar a página de eventos
    $eventos_page = get_page_by_path($eventos_page_slug);

    // Buscar os campos personalizados da página de eventos
    $banner = get_field('banner_modal', $eventos_page->ID);
    $banner_mb = get_field('banner_modal_mb', $eventos_page->ID);
    $titulo_modal = get_field('titulo_modal', $eventos_page->ID);
    $link_modal = get_field('link_modal', $eventos_page->ID);

    // O resto do seu código para buscar eventos futuros permanece o mesmo
    $args = array(
        'post_type'      => 'eventos',
        'lang'           => $current_lang,
        'posts_per_page' => -1,
        'orderby'        => 'meta_value',
        'meta_key'       => 'data_do_evento',
        'order'          => 'ASC',
    );

    $eventos = get_posts($args);

    $hoje = strtotime(date('Y-m-d'));
    $limite = strtotime("+30 days");

    $eventos_futuros = array_filter($eventos, function ($evento) use ($hoje, $limite) {
        $data_evento = get_post_meta($evento->ID, 'data_do_evento', true);

        if ($data_evento) {
            $data_formatada = DateTime::createFromFormat('Y-m-d H:i:s', $data_evento);
            if ($data_formatada) {
                $timestamp_evento = $data_formatada->getTimestamp();
                return $timestamp_evento >= $hoje && $timestamp_evento <= $limite;
            }
        }
        return false;
    });

    $has_eventos = !empty($eventos_futuros);

    // Passar informação para o JavaScript
    echo '<script>var hasEventos = ' . json_encode($has_eventos) . ';</script>';
    ?>

    <div class="modal" id="modal-events">
        <div class="wrapper-modal">
            <div class="close">
                <img class="light" src="<?php echo get_template_directory_uri() ?>/assets/img/close.svg">
                <img class="dark" src="<?php echo get_template_directory_uri() ?>/assets/img/close-white.svg">
            </div>
            <div class="wrapper-banner">
                <!-- Usar os banners da página de eventos -->
                <img src="<?php echo esc_url($banner); ?>" alt="Banner do Evento" class="banner">
                <img src="<?php echo esc_url($banner_mb); ?>" alt="Banner do Evento Mobile" class="banner-mb">
            </div>
            <div class="event-list">
                <div class="wrapper-top">
                    <p class="title">
                        <?php echo esc_html($titulo_modal); ?>
                    </p>
                    <?php if ($has_eventos): ?>
                        <?php foreach ($eventos_futuros as $evento): ?>
                            <?php
                            $data_evento = get_post_meta($evento->ID, 'data_do_evento', true);
                            $data_formatada = DateTime::createFromFormat('Y-m-d H:i:s', $data_evento);
                            $data_somente = $data_formatada ? $data_formatada->format('d/m/Y') : '';
                            ?>
                            <div class="event-item" data-date="<?php echo esc_attr($data_somente); ?>">
                                <span class="event-date"><?php echo esc_html($data_somente); ?></span>
                                <span class="event-title"><?php echo esc_html(get_the_title($evento)); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <a href="<?php echo esc_url($link_modal); ?>" class="link"><?php echo $text_btn; ?></a>
            </div>
        </div>
    </div>



    </header>
    </div>
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const header = document.querySelector("header");

        window.addEventListener("scroll", function() {
            if (window.scrollY > 0) {
                header.classList.add("border-bottom");
            } else {
                header.classList.remove("border-bottom");
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        const menuToggle = document.getElementById("menu-drawer");
        const burgerButton = document.getElementById("burger-3");
        const closeButton = document.getElementById("close-button-1");

        burgerButton.addEventListener("click", function() {
            menuToggle.classList.add("open");
        });

        closeButton.addEventListener("click", function() {
            menuToggle.classList.remove("open");
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const menuItems = document.querySelectorAll(".menu-item-has-children");

        // Abrir submenus por padrão apenas no mobile
        function openSubMenusByDefault() {
            if (window.innerWidth <= 768) {
                menuItems.forEach(item => {
                    item.classList.add("active");
                });
            }
        }

        function toggleSubMenu() {
            if (window.innerWidth <= 768) {
                menuItems.forEach(item => {
                    const link = item.querySelector("a");

                    link.addEventListener("click", (e) => {
                        e.preventDefault();
                        item.classList.toggle("active");

                    });
                });
            }
        }


        openSubMenusByDefault();
        toggleSubMenu();

        window.addEventListener("resize", () => {

            if (window.innerWidth > 768) {
                menuItems.forEach(item => item.classList.remove("active"));
            }

            menuItems.forEach(item => {
                const link = item.querySelector("a");
                link.replaceWith(link.cloneNode(true));
            });

            openSubMenusByDefault();
            toggleSubMenu();
        });
    });



    function scrollToSection(sectionId) {
        const targetElement = document.getElementById(sectionId);

        if (targetElement) {
            // Define uma altura fixa de 100px para o ajuste
            const fixedHeight = 100;
            const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;
            const offsetPosition = elementPosition - fixedHeight;

            // Suaviza a rolagem até a posição ajustada
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    }

    // Adiciona o listener a todos os botões que levam à seção "contato"
    document.querySelectorAll('.scroll-to-contact').forEach(button => {
        button.addEventListener('click', function() {
            scrollToSection('contato');
        });
    });

    // // Initialize the state based on user's preference or default
    // const prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    // toggleDarkMode({
    //     checked: prefersDarkMode
    // });




    document.addEventListener("DOMContentLoaded", function() {

        if (typeof hasEventos !== 'undefined' && hasEventos === true) {
            const modal = document.getElementById("modal-events");

            if (modal) {
                const closeModal = modal.querySelector(".close");

                let lastShownDate = localStorage.getItem("modalShownDate");
                let today = new Date().toLocaleDateString();

                if (lastShownDate !== today) {
                    setTimeout(function() {
                        modal.classList.add("active");
                        document.body.style.overflow = "hidden";
                    }, 2000);
                }

                function closeModalFunction() {
                    modal.classList.remove("active");
                    document.body.style.overflow = "";
                    localStorage.setItem("modalShownDate", today);
                }

                if (closeModal) {
                    closeModal.addEventListener("click", closeModalFunction);
                }

                modal.addEventListener("click", function(event) {
                    if (event.target === modal) {
                        closeModalFunction();
                    }
                });
            }
        }
    });
</script>