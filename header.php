<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>

<head>
    <title><?php custom_meta_title(); ?></title>
    <!-- Ensinando pull request -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bezier-easing@2.1.0/dist/bezier-easing.min.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/owl.theme.default.min.css">
    <script src="<?php echo get_template_directory_uri() ?>/assets/js/owl.carousel.min.js"></script>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/css/style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <link rel="stylesheet" href="https://use.typekit.net/wqe2kav.css">

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="UTF-8" />
    <?php header('Content-Type: text/html; charset=utf-8'); ?>
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
$logo_header_dark = get_field('logo_header_dark', $initial_misc->ID);
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
                            <img src="<?php echo $logo_header; ?>" alt="logo" class="light logo">
                            <img src="<?php echo $logo_header_dark; ?>" alt="logo" class="dark logo">
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
                                                        <a href="<?php echo esc_url(home_url('/')); ?>" class="link scroll-home"
                                                            data-target="<?php echo esc_attr(ltrim($menu['link_id'], '#')); ?>">
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
                                $langs = pll_the_languages([
                                    'raw' => 1,
                                    'hide_if_empty' => 0
                                ]);
                                $current = pll_current_language();

                                // Mapeia os ícones para cada idioma
                                $icon_map = [
                                    'pt' => 'icone_idioma_pt_br',
                                    'en' => 'icone_idioma_en',
                                ];
                                ?>
                                <div class="lang-dropdown">
                                    <button class="lang-dropdown-toggle" aria-label="Mudar idioma">
                                        <img class="lang-icon"
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$current]; ?>.svg"
                                            data-src-light="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$current]; ?>.svg"
                                            data-src-dark="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$current]; ?>_dark.svg"
                                            alt="<?php echo esc_attr($langs[$current]['name']); ?>" width="32" height="32">
                                    </button>
                                    <ul class="lang-dropdown-menu">
                                        <?php foreach ($langs as $lang_slug => $lang): ?>
                                            <?php if ($lang_slug === $current)
                                                continue; ?>
                                            <li>
                                                <a href="<?php echo esc_url($lang['url']); ?>">
                                                    <img class="lang-icon"
                                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$lang_slug]; ?>.svg"
                                                        data-src-light="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$lang_slug]; ?>.svg"
                                                        data-src-dark="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$lang_slug]; ?>_dark.svg"
                                                        alt="<?php echo esc_attr($lang['name']); ?>" width="32" height="32">
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>



                        <div class="header-button">
                            <a class="scroll-home" href="<?php echo esc_url(home_url('/')); ?>" data-target="orcamento">
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
                                <span class="line line1"></span>
                                <span class="line line2"></span>
                                <span class="line line3"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="mobile-drawer" id="mobileDrawer">
            <div class="mobile-drawer-inner">
                <div class="mobile-drawer-top">
                    <nav class="mobile-menu">
                        <ul>
                            <?php foreach ($menus_header as $menu): ?>
                                <li class="menu-item">
                                    <div class="menu-container">
                                        <?php if ($menu['tipo_de_link'] == 'ID'): ?>
                                            <a href="<?php echo esc_url(home_url('/')); ?>" class="link scroll-home"
                                                data-target="<?php echo esc_attr(ltrim($menu['link_id'], '#')); ?>">
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

                    <div class="mobile-drawer-header">
                        <div class="mobile-drawer-header-actions">
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
                            <div class="lang-switcher-wrapper">
                                <?php if (function_exists('pll_the_languages')):
                                    $langs = pll_the_languages([
                                        'raw' => 1,
                                        'hide_if_empty' => 0
                                    ]);
                                    $current = pll_current_language();

                                    // Mapeia os ícones para cada idioma
                                    $icon_map = [
                                        'pt' => 'icone_idioma_pt_br',
                                        'en' => 'icone_idioma_en',
                                    ];
                                    ?>
                                    <div class="lang-dropdown">
                                        <button class="lang-dropdown-toggle" aria-label="Mudar idioma">
                                            <img class="lang-icon"
                                                src="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$current]; ?>.svg"
                                                data-src-light="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$current]; ?>.svg"
                                                data-src-dark="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$current]; ?>_dark.svg"
                                                alt="<?php echo esc_attr($langs[$current]['name']); ?>" width="32"
                                                height="32">
                                        </button>
                                        <ul class="lang-dropdown-menu">
                                            <?php foreach ($langs as $lang_slug => $lang): ?>
                                                <?php if ($lang_slug === $current)
                                                    continue; ?>
                                                <li>
                                                    <a href="<?php echo esc_url($lang['url']); ?>">
                                                        <img class="lang-icon"
                                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$lang_slug]; ?>.svg"
                                                            data-src-light="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$lang_slug]; ?>.svg"
                                                            data-src-dark="<?php echo get_template_directory_uri(); ?>/assets/img/<?php echo $icon_map[$lang_slug]; ?>_dark.svg"
                                                            alt="<?php echo esc_attr($lang['name']); ?>" width="32" height="32">
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="header-drawer-actions">
                    <div class="header-button">
                        <a class="scroll-home" href="<?php echo esc_url(home_url('/')); ?>" data-target="orcamento">
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

        // 1) Inicializa o tema a partir do localStorage
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            body.classList.add('dark-mode');
            body.classList.remove('light-mode');
        } else {
            body.classList.add('light-mode');
            body.classList.remove('dark-mode');
        }

        // Atualiza os ícones
        function updateThemeIcons(theme) {
            const icons = document.querySelectorAll('.lang-icon');
            icons.forEach(icon => {
                const lightSrc = icon.getAttribute('data-src-light');
                const darkSrc = icon.getAttribute('data-src-dark');
                icon.setAttribute('src', theme === 'dark' ? darkSrc : lightSrc);
            });
        }

        // Chama no carregamento
        updateThemeIcons(savedTheme === 'dark' ? 'dark' : 'light');

        // 2) Alterna tema e atualiza ícones
        toggleButton.forEach(button => {
            button.addEventListener('click', () => {
                const isDark = body.classList.contains('dark-mode');
                const newTheme = isDark ? 'light' : 'dark';

                body.classList.toggle('dark-mode', newTheme === 'dark');
                body.classList.toggle('light-mode', newTheme === 'light');

                localStorage.setItem('theme', newTheme);
                updateThemeIcons(newTheme);
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

        burger.addEventListener("click", function () {
            burger.classList.toggle("active");
            drawer.classList.toggle("open");
            document.body.classList.toggle("drawer-open");
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
            if (width < 768) return id !== 'orcamento' ? 153 : -20;
            if (width <= 1024) return id !== 'orcamento' ? 200 : 20;
            return id !== 'orcamento' ? 220 : 50;
        }

        document.querySelectorAll('a.scroll-home').forEach(link => {
            link.addEventListener("click", function (e) {
                console.log("Link clicked:", this);
                const targetId = this.dataset.target;
                const target = document.getElementById(targetId);

                if (!target) {
                    sessionStorage.setItem('scrollTarget', targetId);
                    window.location.href = "<?php echo esc_url(home_url('/')); ?>";
                    return;
                }

                e.preventDefault();
                scrollToElementWithOffset(target, getScrollOffset(target.id));
                if (typeof closeBtn !== 'undefined' && closeBtn) closeBtn.click();
            });
        });

        const targetId = sessionStorage.getItem('scrollTarget');
        if (targetId) {
            setTimeout(() => {
                const target = document.getElementById(targetId);
                if (target) {
                    scrollToElementWithOffset(target, getScrollOffset(target.id));
                }
                sessionStorage.removeItem('scrollTarget');
            }, 300);
        }

    });
</script>