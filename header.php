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
            <div class="container-header container">
                <a href="/" class="link-logo">
                    <img src="<?php echo $logo_header ?>" alt="logo" class="custom-logo light">
                    <!-- <img src="<?php echo $logo_header_branca ?>" alt="logo" class="custom-logo dark"> -->
                </a>

                <div class="wrapper-menu-desktop">
                    <div class="wrapper-menu-custom">
                        <?php if(isset($menus_header) && count($menus_header) > 0) : ?>
                            <nav>
                                <ul>
                                    <?php foreach ($menus_header as $menu) : ?>
                                        <li class="menu-item-has-children">
                                            <a href="<?php echo esc_url($menu['link_id']); ?>" class="link">
                                                <?php echo esc_html($menu['titulo_menu']); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </nav>
                        <?php else : ?>
                            <span>Não possui menus cadastrados</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="header-button">
                    <a href="">
                        <span>Entre em contato</span>
                    </a>
                </div>
            </div>
        </header>
    </div>
</body>

</html>
<!-- <script>
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
</script> -->