<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';
if ($current_lang == 'en') {
  $title_claro = 'Light Mode';
  $title_escuro = 'Dark Mode';
} elseif ($current_lang == 'es') {
  $title_claro = 'Modo Claro';
  $title_escuro = 'Modo Oscuro';
} else {
  $title_claro = 'Modo Claro';
  $title_escuro = 'Modo Escuro';
}

// Passando as variáveis PHP para o JavaScript de forma segura
$title_claro_js = json_encode($title_claro);
$title_escuro_js = json_encode($title_escuro);

?>


<?php
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';
$args = array(
  'post_type' => 'info_contact',
  'lang' => $current_lang,
  'posts_per_page' => -1,
);

$initials = get_posts($args);
$initial = $initials[0] ?? null;

$logo_header = get_field('logo_header', $initial->ID);
$logo_header_branca = get_field('logo_header_branca', $initial->ID);
$copy = get_field('copy', $initial->ID);
$cnpj = get_field('cnpj', $initial->ID);
$social_media = get_field('redes_socias', $initial->ID);

?>

<?php
$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'pt';

$text_links = array(
  'title_m12' => ['text' => 'A TBR', 'link' => '/tbr/sobre-nos'],
  'title_governance' => ['text' => 'Perguntas frequentes', 'link' => '/tbr/perguntas-frequentes'],
  'title_investors' => ['text' => 'Contato', 'link' => '/tbr/contato'],
  'title_gallery' => ['text' => 'Galeria', 'link' => '/tbr/galeria'],
  'title_documents' => ['text' => 'Marcas', 'link' => '#'],
  'title_institutional' => ['text' => 'Institucional', 'link' => '#']
);

function getFooterLink($current_lang, $text_links)
{
  if ($current_lang == 'en') {
    $text_links['title_m12']['text'] = 'TBR';
    $text_links['title_governance']['text'] = 'FAQ';
    $text_links['title_investors']['text'] = 'Contact';
    $text_links['title_gallery']['text'] = 'Gallery';
    $text_links['title_documents']['text'] = 'Brands';
    $text_links['title_institutional']['text'] = 'Institutional';

    $text_links['title_m12']['link'] = '/tbr/about-us';
    $text_links['title_governance']['link'] = '/tbr/frequently-asked-questions';
    $text_links['title_investors']['link'] = '/tbr/contact';
    $text_links['title_gallery']['link'] = '/tbr/gallery';
  } elseif ($current_lang == 'es') {
    $text_links['title_m12']['text'] = 'La TBR';
    $text_links['title_governance']['text'] = 'Preguntas frecuentes';
    $text_links['title_investors']['text'] = 'Contacto';
    $text_links['title_gallery']['text'] = 'Galeria';
    $text_links['title_documents']['text'] = 'Marcas';
    $text_links['title_institutional']['text'] = 'Institucional';

    $text_links['title_m12']['link'] = '/tbr/sobre-nosotros';
    $text_links['title_governance']['link'] = '/tbr/preguntas-frecuentes';
    $text_links['title_investors']['link'] = '/tbr/contacto';
    $text_links['title_galeria']['link'] = '/tbr/galeria-es';
  }

  return $text_links;
}

$text_links = getFooterLink($current_lang, $text_links);
?>

<footer id="colophon" class="site-footer">
  <div class="container" id="top-footer">
    <div class="wrapper-logo">
      <div class="logo-content">
        <a href="/" class="link">
          <img src="<?php echo $logo_header; ?>" alt="logo" class="custom-logo light">
          <img src="<?php echo $logo_header_branca; ?>" alt="logo" class="custom-logo dark">
        </a>
        <?php if (isset($social_media) && count($social_media) > 0): ?>
          <div class="social-media-wrapper">
            <?php foreach ($social_media as $social): ?>
              <div class="social-media-item">
                <a href="<?= $social['link_da_rede'] ?>">
                  <?php if ($social['titulo'] == "Instagram"): ?>
                    <img class="light" src="<?php echo get_template_directory_uri() ?>/assets/img/instagram.svg"
                      alt="Instagram">
                    <img class="dark" src="<?php echo get_template_directory_uri() ?>/assets/img/instagram-white.svg"
                      alt="Instagram">
                  <?php elseif ($social['titulo'] == "Facebook"): ?>
                    <img class="light" src="<?php echo get_template_directory_uri() ?>/assets/img/facebook.svg"
                      alt="Facebook">
                    <img class="dark" src="<?php echo get_template_directory_uri() ?>/assets/img/facebook-white.svg"
                      alt="Facebook">
                  <?php elseif ($social['titulo'] == "Youtube"): ?>
                    <img class="light" src="<?php echo get_template_directory_uri() ?>/assets/img/youtube.svg" alt="Youtube">
                    <img class="dark" src="<?php echo get_template_directory_uri() ?>/assets/img/youtube-white.svg"
                      alt="Youtube">
                  <?php elseif ($social['titulo'] == "WhatsApp"): ?>
                    <img class="light" src="<?php echo get_template_directory_uri() ?>/assets/img/whatsapp.svg"
                      alt="WhatsApp">
                    <img class="dark" src="<?php echo get_template_directory_uri() ?>/assets/img/whatsapp-white.svg"
                      alt="WhatsApp">
                  <?php endif; ?>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="footer-top desktop">
        <div class="menu">
          <p class="title-footer has-sub-menu"><?php echo $text_links['title_documents']['text']; ?></p>
          <div class="menu-footer">
            <?php
            $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'pt';
            // Verificar qual idioma está ativo e definir o nome do menu
            $menu_name = '';
            if ($current_lang == 'pt') {
              $menu_name = 'marcas';
            } elseif ($current_lang == 'es') {
              $menu_name = 'marcas-es';
            } else {
              $menu_name = 'marcas-en';
            }
            wp_nav_menu(array(
              'menu' => $menu_name,
              'menu_class' => 'menu-footer',
              'container' => false,
              'depth' => 4,
            ));
            ?>
          </div>
        </div>
        <div class="menu">
          <p class="title-footer"><?php echo $text_links['title_institutional']['text']; ?></p>
          <div class="menu-footer">
            <?php
            $menu_name = '';
            if ($current_lang == 'pt') {
              $menu_name = 'institucional';
            } elseif ($current_lang == 'es') {
              $menu_name = 'institucional-es';
            } else {
              $menu_name = 'institucional-en';
            }
            wp_nav_menu(array(
              'menu' => $menu_name,
              'menu_class' => 'menu-footer',
              'container' => false,
              'depth' => 4,
            ));
            ?>
          </div>
        </div>
      </div>
      <div class="footer-handlres">
        <ul class="translate">
          <li class="<?php echo pll_current_language() === 'pt' ? 'ativa' : ''; ?>">
            <a href="<?php echo pll_the_languages(array('raw' => 1))['pt']['url']; ?>"><img class="bandeira"
                src="<?php echo get_template_directory_uri() ?>/assets/img/pt-br.svg"></a>
          </li>
          <li class="<?php echo pll_current_language() === 'en' ? 'ativa' : ''; ?>">
            <a href="<?php echo pll_the_languages(array('raw' => 1))['en']['url']; ?>"><img class="bandeira"
                src="<?php echo get_template_directory_uri() ?>/assets/img/en-us.svg"></a>
          </li>
          <li class="<?php echo pll_current_language() === 'es' ? 'ativa' : ''; ?>">
            <a href="<?php echo pll_the_languages(array('raw' => 1))['es']['url']; ?>"><img class="bandeira"
                src="<?php echo get_template_directory_uri() ?>/assets/img/es.svg"></a>
          </li>
        </ul>
        <div class="theme-toggle">
          <input type="checkbox" id="theme-toggle-checkbox-desktop">
          <label for="theme-toggle-checkbox-desktop" class="toggle-label">

            <span class="toggle-text"><?php echo $title_claro ?></span>
          </label>
        </div>
      </div>
    </div>
    <div class="footer-top mobile">
      <div class="menu">
        <a href="<?php echo $text_links['title_m12']['link']; ?>"
          class="title-footer"><?php echo $text_links['title_m12']['text']; ?></a>
      </div>
      <div class="menu">
        <a href="<?php echo $text_links['title_governance']['link']; ?>"
          class="title-footer"><?php echo $text_links['title_governance']['text']; ?></a>
      </div>
      <div class="menu">
        <a href="<?php echo $text_links['title_investors']['link']; ?>"
          class="title-footer"><?php echo $text_links['title_investors']['text']; ?></a>
      </div>
      <div class="menu">
        <a href="<?php echo $text_links['title_gallery']['link']; ?>"
          class="title-footer"><?php echo $text_links['title_gallery']['text']; ?></a>
      </div>
      <div class="menu">
        <p class="title-footer has-sub-menu"><?php echo $text_links['title_documents']['text']; ?></p>
        <div class="menu-footer">
          <?php
          $current_lang = function_exists('pll_current_language') ? pll_current_language() : 'pt';
          $menu_name = '';
          if ($current_lang == 'pt') {
            $menu_name = 'marcas';
          } elseif ($current_lang == 'es') {
            $menu_name = 'marcas-es';
          } else {
            $menu_name = 'marcas-en';
          }
          wp_nav_menu(array(
            'menu' => $menu_name,
            'menu_class' => 'menu-footer',
            'container' => false,
            'depth' => 4,
          ));
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="wrapper-copy">
    <p class="copy"><?php echo $copy ?></p>
    <p class="copy"><?php echo $cnpj ?></p>
  </div>
  <div class="wrapper-fz">
    <p class="first">Made with</p>
    <img src="<?php echo get_template_directory_uri() ?>/assets/img/heart.svg" alt="" class="heart">
    <p class="by">by</p>
    <img src="<?php echo get_template_directory_uri() ?>/assets/img/fz-logo.png" alt="" class="fz light">
    <img src="<?php echo get_template_directory_uri() ?>/assets/img/fz-branca.png" alt="" class="fz dark">
  </div>
</footer><!-- #colophon -->

<!-- <script>
  document.addEventListener('DOMContentLoaded', function () {
    const titles = document.querySelectorAll('.title-footer.has-sub-menu');

    // Adiciona a classe 'active' a todos os menus por padrão
    /*menus.forEach(menu => {
        menu.classList.add('active');
    });*/

    titles.forEach(title => {
      title.addEventListener('click', () => {
        const menu = title.closest('.menu');
        const submenu = menu.querySelector('.menu-footer')

        if (menu.classList.contains('active')) {
          submenu.style.height = submenu.scrollHeight + 'px';
          requestAnimationFrame(() => {
            submenu.style.height = '0';
          })
        } else {
          submenu.style.height = '0';
          requestAnimationFrame(() => {
            submenu.style.height = submenu.scrollHeight + 'px';
          });
        }

        menu.classList.toggle('active');
        title.classList.toggle('active');

        submenu.addEventListener('transitionend', () => {
          if (!menu.classList.contains('active')) {
            submenu.style.height = '';
          }
        });
      });
    });
  });
</script> -->

<!-- <script>
const titleClaro = <?php echo $title_claro_js; ?>;
const titleEscuro = <?php echo $title_escuro_js; ?>;

const checkbox = document.getElementById('theme-toggle-checkbox');
const checkboxDesk = document.getElementById('theme-toggle-checkbox-desktop');
const textElements = document.querySelectorAll('.toggle-text');

// Função para aplicar o tema com base no estado armazenado
function applyTheme(isDarkMode) {
  document.body.classList.toggle('dark-mode', isDarkMode);

  textElements.forEach(el => {
    el.textContent = isDarkMode ? titleEscuro : titleClaro;
  });

  checkbox.checked = isDarkMode;
  checkboxDesk.checked = isDarkMode;
}

// Recuperar o estado do tema do localStorage ao carregar a página
const savedTheme = localStorage.getItem('darkMode') === 'true';
applyTheme(savedTheme);

// Função para alternar o tema e salvar o estado no localStorage
function toggleDarkMode(source) {
  const isChecked = source.checked;

  applyTheme(isChecked);

  // Salvar o estado no localStorage
  localStorage.setItem('darkMode', isChecked);
}

// Adicionar os eventos de mudança nos checkboxes
checkbox.addEventListener('change', () => toggleDarkMode(checkbox));
checkboxDesk.addEventListener('change', () => toggleDarkMode(checkboxDesk));
</script> -->

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const titles = document.querySelectorAll('.title-footer.has-sub-menu');

        // Adiciona a classe 'active' a todos os menus por padrão
        /*menus.forEach(menu => {
            menu.classList.add('active');
        });*/

        titles.forEach(title => {
            title.addEventListener('click', () => {
                const menu = title.closest('.menu');
                const submenu = menu.querySelector('.menu-footer')

                if (menu.classList.contains('active')) {
                    submenu.style.height = submenu.scrollHeight + 'px';
                    requestAnimationFrame(() => {
                        submenu.style.height = '0';
                    })
                } else {
                    submenu.style.height = '0';
                    requestAnimationFrame(() => {
                        submenu.style.height = submenu.scrollHeight + 'px';
                    });
                }

                menu.classList.toggle('active');
                title.classList.toggle('active');

                submenu.addEventListener('transitionend', () => {
                    if (!menu.classList.contains('active')) {
                        submenu.style.height = '';
                    }
                });
            });
        });
    });
</script> -->




</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>