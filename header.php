<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>

<head>
    <title><?php custom_meta_title(); ?></title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bezier-easing@2.1.0/dist/bezier-easing.min.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/owl.theme.default.min.css">
    <script src="<?php echo get_template_directory_uri() ?>/assets/js/owl.carousel.min.js"></script>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="<?php bloginfo('charset'); ?>" />
    <?php wp_head(); ?>
</head>



<?php

$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';

$args = array(
    'post_type' => 'menu_custom',
    'lang' => $current_lang,
    'posts_per_page' => -1,
);
$args_misc = array(
    'post_type' => 'misc_info_contato',
    'lang' => $current_lang,
    'posts_per_page' => -1,
);

$menus = get_posts($args);
$misc = get_posts($args_misc);

$initial_menus = $menus[0] ?? null;
$initial_misc = $misc[0] ?? null;

$logo_header = get_field('logo_header', $initial_misc->ID);
$menus_header = get_field('menus', $initial_menus->ID);
$whatsapp_text = get_field('texto_botao', $initial_misc->ID);
$whatsapp_link = get_field('link_botao', $initial_misc->ID);
?>



<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php _e('Skip to content', 'twentynineteen'); ?></a>
        <header>
            <div class="header-wrapper">
                <div class="header-container container">
                    <div class="header-logo">
                        <a href="<?php echo get_home_url(); ?>" class="link-logo">
                            <img src="<?php echo $logo_header; ?>" alt="logo" class="logo">
                        </a>
                    </div>


                    <div class="header-menu-wrapper">
                        <div class="header-menu">
                            <?php if (isset($menus_header) && count($menus_header) > 0): ?>
                                <nav>
                                    <ul class="menu">
                                        <?php foreach ($menus_header as $menu): ?>
                                            <li class="menu-item">
                                                <div class="menu-container">
                                                    <?php if ($menu['tipo_de_link'] == 'ID'): ?>
                                                        <a href="<?php echo esc_url($menu['link_id']); ?>" class="link">
                                                            <?php echo esc_html($menu['titulo_menu']); ?>
                                                        </a>
                                                    <?php elseif ($menu['tipo_de_link'] == 'Link de pagina'): ?>
                                                        <a href="<?php echo esc_url($menu['link_de_pagina']); ?>" class="link">
                                                            <?php echo esc_html($menu['titulo_menu']); ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </nav>
                            <?php else: ?>
                                <span><?php pll_e('Não possui menus cadastrados'); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="header-actions">
                        <div class="lang-switcher-wrapper">
                            <?php if (function_exists('pll_the_languages')):
                                // Pega dados brutos de cada idioma
                                $langs = pll_the_languages([
                                    'raw' => 1,
                                    'hide_if_empty' => 0
                                ]);
                                $current = pll_current_language();  // slug do idioma atual, ex: "pt" ou "en"
                                ?>
                                <div class="lang-dropdown">
                                    <button class="lang-dropdown-toggle" aria-label="Mudar idioma">
                                        <img src="<?php echo esc_url($langs[$current]['flag']); ?>"
                                            alt="<?php echo esc_attr($langs[$current]['name']); ?>" width="16" height="11">
                                    </button>
                                    <ul class="lang-dropdown-menu">
                                        <?php foreach ($langs as $lang_slug => $lang): ?>
                                            <?php if ($lang_slug === $current)
                                                continue; // pula o atual ?>
                                            <li>
                                                <a href="<?php echo esc_url($lang['url']); ?>">
                                                    <img src="<?php echo esc_url($lang['flag']); ?>"
                                                        alt="<?php echo esc_attr($lang['name']); ?>" width="16" height="11">
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="header-button">
                            <a href="#orcamento">
                                <span><?php pll_e('Entre em contato'); ?></span>
                            </a>
                        </div>
                        <div class="header-button-ld">
                            <button>
                                <div class="theme-toggle-flip">
                                    <img class="light"
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/light-mode.svg"
                                        alt="">
                                    <img class="dark"
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/dark-mode.svg"
                                        alt="">
                                </div>
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
                    <div class="header-logo">
                        <a href="<?php echo get_home_url() ?>" class="link-logo">
                            <img src="<?php echo $logo_header ?>" alt="logo" class="logo light">
                        </a>
                    </div>
                    <!-- <div class="header-button-ld">
                        <button>
                            <img src="<?php echo get_template_directory_uri() ?>/assets/img/toggle-mode.svg" alt="" srcset="">
                        </button>
                    </div> -->
                    <div class="mobile-drawer-header-actions">
                        <div class="lang-switcher-wrapper">
                            <?php if (function_exists('pll_the_languages')):
                                // Pega dados brutos de cada idioma
                                $langs = pll_the_languages([
                                    'raw' => 1,
                                    'hide_if_empty' => 0
                                ]);
                                $current = pll_current_language();  // slug do idioma atual, ex: "pt" ou "en"
                                ?>
                                <div class="lang-dropdown">
                                    <button class="lang-dropdown-toggle" aria-label="Mudar idioma">
                                        <img src="<?php echo esc_url($langs[$current]['flag']); ?>"
                                            alt="<?php echo esc_attr($langs[$current]['name']); ?>" width="16" height="11">
                                    </button>
                                    <ul class="lang-dropdown-menu">
                                        <?php foreach ($langs as $lang_slug => $lang): ?>
                                            <?php if ($lang_slug === $current)
                                                continue; // pula o atual ?>
                                            <li>
                                                <a href="<?php echo esc_url($lang['url']); ?>">
                                                    <img src="<?php echo esc_url($lang['flag']); ?>"
                                                        alt="<?php echo esc_attr($lang['name']); ?>" width="16" height="11">
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="header-button-ld">
                            <button>
                                <div class="theme-toggle-flip">
                                    <img class="light"
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/light-mode.svg"
                                        alt="">
                                    <img class="dark"
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/dark-mode.svg"
                                        alt="">
                                </div>
                            </button>
                        </div>
                        <div class="mobile-drawer-close">
                            <button id="closeDrawer" class="close-drawer">×</button>
                        </div>
                    </div>
                </div>

                <nav class="mobile-menu">
                    <ul>
                        <?php if (isset($menus_header) && count($menus_header) > 0): ?>
                            <?php foreach ($menus_header as $menu): ?>
                                <li>
                                    <?php if ($menu['tipo_de_link'] == 'ID'): ?>
                                        <a href="<?php echo esc_url($menu['link_id']); ?>">
                                            <?php echo esc_html($menu['titulo_menu']); ?>
                                        </a>
                                    <?php elseif ($menu['tipo_de_link'] == 'Link de pagina'): ?>
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
                        <a href="#orcamento">
                            <span><?php pll_e('Entre em contato'); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php

        $args_whats_btn = array(
            'whatsapp_text' => $whatsapp_text,
            'whatsapp_link' => $whatsapp_link,
        );

        get_template_part('components/whatsapp-button', null, $args_whats_btn);
        ?>
    </div>
</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // LD theme switcher
        const body = document.body;
        const toggleButton = document.querySelectorAll('.header-button-ld button');

        // 1) Inicializa o tema a partir do localStorage (ou default para light)
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            body.classList.add('dark-mode');
            body.classList.remove('light-mode');
        } else {
            body.classList.add('light-mode');
            body.classList.remove('dark-mode');
        }

        // 2) Ao clicar, alterna e salva no localStorage
        toggleButton.forEach(element => {
            element.addEventListener('click', () => {
                if (body.classList.contains('dark-mode')) {
                    body.classList.replace('dark-mode', 'light-mode');
                    localStorage.setItem('theme', 'light');
                } else {
                    body.classList.replace('light-mode', 'dark-mode');
                    localStorage.setItem('theme', 'dark');
                }
            });
        });

        // Dropdown language switcher
        const dropdowns = Array.from(document.querySelectorAll('.lang-dropdown'));

        function toggleDropdown(e, idx) {
            e.stopPropagation();
            dropdowns[idx].classList.toggle('open');
        }

        // Registra listeners de abertura
        dropdowns.forEach((dd, idx) => {
            const btn = dd.querySelector('.lang-dropdown-toggle');
            if (!btn) return;
            btn.addEventListener('click', e => toggleDropdown(e, idx));
        });

        // Fecha **só** se o clique/touch for fora de **todos** os dropdowns
        function closeAll(e) {
            // se veio de dentro de algum dropdown, ignora
            if (e.target.closest('.lang-dropdown')) return;
            dropdowns.forEach(dd => dd.classList.remove('open'));
        }
        document.addEventListener('click', closeAll);

        // Manipula drawer mobile
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

        //------------

        //Animação links menu
        function scrollToElementWithOffset(el, offset = 0, duration = 800, easing = [0.7, -0.4, 0.4, 1.4]) {
            const targetY = el.getBoundingClientRect().top + window.pageYOffset - offset;
            const startY = window.pageYOffset;
            const diff = targetY - startY;
            let start;

            const easingFn = window.BezierEasing(...easing);

            function step(timestamp) {
                if (!start) start = timestamp;
                const time = Math.min(1, (timestamp - start) / duration);
                const eased = easingFn(time);
                window.scrollTo(0, startY + diff * eased);
                if (time < 1) requestAnimationFrame(step);
            }

            requestAnimationFrame(step);
        }

        function getScrollOffset(id) {
            const width = window.innerWidth;
            if (width < 768) return id != 'orcamento' ? 153 : -20;
            if (width <= 1024) return id != 'orcamento' ? 200 : 20;
            return id != 'orcamento' ? 220 : 50;
        }

        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                const targetId = this.getAttribute("href").substring(1);
                const target = document.getElementById(targetId);
                if (target) {
                    scrollToElementWithOffset(target, getScrollOffset(target.id));
                    if (closeBtn) closeBtn.click();
                }
            });
        });
    });

</script>