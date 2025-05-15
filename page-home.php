<?php
get_header();

// Verificar o idioma atual
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';


// Configurar os argumentos para pegar o post
$args = array(
  'post_type' => 'pag_home',
  'lang' => $current_lang,
  'posts_per_page' => 1
);

// Buscar o post correspondente
$initials = get_posts($args);

if (!empty($initials)) {
  $initial = $initials[0];
  $titulo_banner = get_field('titulo', $initial->ID);
  $conteudo_banner = get_field('conteudo', $initial->ID);
  $texto_btn_banner = get_field('texto_botao', $initial->ID);
  $link_btn_banner = get_field('link_botao', $initial->ID);
  $image_banner = get_field('imagem_desktop', $initial->ID);
  $image_mb_banner = get_field('imagem_mobile', $initial->ID);
} else {
  echo '<p>Nenhum post encontrado para o idioma atual.</p>';
  $banners = [];
}
?>

<?php if (!empty($initials)) : ?>
<div class="wrapper-banner-home" style="margin-top: 133px;">
    <div class="container">
        <div class="banner-content">
            <h1 class="banner-title"><?php echo $titulo_banner ?></h1>
            <p class="banner-text"><?php echo $conteudo_banner ?></p>
            <a href="<?php echo $link_btn_banner ?>" class="btn-banner"><span
                    class="btn-text"><?php echo $texto_btn_banner ?></span></a>
            <div class="banner-image">
                <picture>
                    <source media="(max-width: 768px)" srcset="<?php echo $image_mb_banner ?>">
                    <source media="(min-width: 769px)" srcset="<?php echo $image_banner ?>">
                    <img src="<?php echo $image_banner ?>" alt="<?php echo $image_banner ?>">
                </picture>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
<p><?php esc_html_e('No banners available', 'text-domain'); ?></p>
<?php endif; ?>

<?php
$args = array(
  'post_type' => 'pag_home',
  'lang' => $current_lang,
  'posts_per_page' => -1
);

$initials = get_posts($args);
$initial = $initials[0];
$titulo_segunda_sessao = get_field('titulo_segunda_sessao', $initial->ID);
$conteudo_segunda_sessao = get_field('conteudo_segunda_sessao', $initial->ID);
$cards = get_field('cards', $initial->ID);
$info_cards = get_field('info_cards', $initial->ID);
?>
<section class="section-our-brands-cards" style="height: 2000px;">
    <div class="container">
        <div class="our-brands-cards-wrapper">
            <div class="our-brands-header">
                <h2 class="our-brands-title"><?php echo $titulo_segunda_sessao ?></h2>
                <p class="our-brands-text"><?php echo $conteudo_segunda_sessao ?></p>
            </div>
            <div class="our-brands-cards">
                <div class="owl-carousel-cards owl-carousel owl-theme">
                    <?php foreach ($cards as $card) : ?>
                    <div class="card-item">

                        <a href="<?php echo $card['card_link']; ?>">
                            <img src="<?php echo $card['card_imagem_desktop'] ?>"
                                alt="<?php $card['card_imagem_desktop'] ?>">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="cards-quantity-wrapper">
                    <span class="cards-quantity">Marcas (<?php echo count($cards) ?>)</span>
                </div>
            </div>
        </div>
        <div class="home-info-cards-wrapper">
            <div class="home-info-cards">
                <?php foreach ($info_cards as $info_card) : ?>
                <div class="info-card">
                    <div class="info-card-icon">
                        <img class="light" src="<?php echo $info_card['icone'] ?>"
                            alt="<?php echo $info_card['titulo'] ?>">
                        <img class="dark" src="<?php echo $info_card['icone_dark'] ?>"
                            alt="<?php echo $info_card['titulo'] ?>">
                    </div>
                    <div class="info-card-content">
                        <h3 class="info-card-title"><?php echo $info_card['titulo'] ?></h3>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php
$status_stopwatch = get_field('cronometro_ativo', $initial->ID);
$titulo_stopwatch = get_field('titulo_cronometro', $initial->ID);
$conteudo_stopwatch = get_field('conteudo_cronometro', $initial->ID);
$txt_btn_stopwatch = get_field('texto_botao_cronometro', $initial->ID);
$link_btn_stopwatch = get_field('link_botao_cronometro', $initial->ID);
$data_hora_stopwatch = get_field('data_e_hora_cronometro', $initial->ID);
$cor_fundo_stopwatch = get_field('cor_de_fundo_cronometro', $initial->ID);
$imagem_fundo_stopwatch = get_field('imagem_de_fundo_cronometro', $initial->ID);
if ($status_stopwatch) :
?>
<section class="section-stopwatch" style="background-color: <?php echo $cor_fundo_stopwatch; ?>;">
    <div class="container">
        <div class="stopwatch-wrapper">
            <div class="stopwatch-header">
                <h2 class="stopwatch-title"><?php echo $titulo_stopwatch; ?></h2>
                <p class="stopwatch-text"><?php echo $conteudo_stopwatch; ?></p>
            </div>
            <div class="stopwatch">
                <div class="stopwatch-timer">
                    <div class="stopwatch-timer-item days">
                        <span class="stopwatch-timer-number" id="days">00</span>
                        <span class="stopwatch-timer-text">Dias</span>
                    </div>
                    <div class="stopwatch-timer-hour">
                        <div class="stopwatch-timer-item hour">
                            <span class="stopwatch-timer-number" id="hours">00</span>
                            <span class="stopwatch-timer-text">Horas</span>
                        </div>
                        <div class="stopwatch-timer-item">
                            <span class="stopwatch-timer-number">:</span>
                        </div>
                        <div class="stopwatch-timer-item minute">
                            <span class="stopwatch-timer-number" id="minutes">00</span>
                            <span class="stopwatch-timer-text">Minutos</span>
                        </div>
                        <div class="stopwatch-timer-item">
                            <span class="stopwatch-timer-number">:</span>
                        </div>
                        <div class="stopwatch-timer-item second">
                            <span class="stopwatch-timer-number" id="seconds">00</span>
                            <span class="stopwatch-timer-text">Segundos</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="stopwatch-btn-wrapper">
                <a href="<?php echo $link_btn_stopwatch; ?>" class="stopwatch-btn">
                    <span class="stopwatch-btn-text"><?php echo $txt_btn_stopwatch; ?></span>
                </a>
            </div>
        </div>
        <div class="stopwatch_background_image">
            <img src="<?php echo $imagem_fundo_stopwatch; ?>" alt="<?php echo $imagem_fundo_stopwatch; ?>">
        </div>
    </div>
</section>
<?php endif; ?>

<?php
$titulo_new_products = get_field('titulo_novos_produtos', $initial->ID);
$txt_btn_new_products = get_field('texto_botao_novos_produtos', $initial->ID);
$link_btn_new_products = get_field('link_botao_novos_produtos', $initial->ID);
$new_products = get_field('novos_produtos', $initial->ID);
?>
<section class="section-new-products">
    <div class="new-products-wrapper">
        <div class="container">
            <div class="new-products-content">
                <div class="new-products-header">
                    <h2 class="new-products-title"><?php echo $titulo_new_products ?></h2>
                    <a class="btn-new-products" href="<?php echo $link_btn_new_products ?>">
                        <span class="btn-new-products-text"><?php echo $txt_btn_new_products ?></span>
                    </a>
                </div>
                <div class="new-products">
                    <div class="owl-new-products owl-carousel owl-theme">
                        <?php foreach ($new_products as $product) : ?>
                        <?php
              $product_id = $product['produto'];
              $product_name = get_field('nome_produto', $product_id);
              $product_image = get_field('imagem_destaque', $product_id);
              $product_link = $product['link_saiba_mais'];
              ?>
                        <div class="product-item">
                            <div class="product-item-image">
                                <picture>
                                    <source srcset="<?php echo $product_image ?>">
                                    <img src="<?php echo $product_image ?>"
                                        alt="<?php echo esc_attr($product_name); ?>">
                                </picture>
                            </div>
                            <div style="width: 100%;">
                                <div class="product-name-wrapper">
                                    <h3 class="product-name"><?php echo esc_html($product_name); ?></h3>
                                </div>
                                <div class="product-btn-wrapper">
                                    <a href="<?php echo $product_link ?>" class="product-btn">
                                        <span class="product-btn-text">Saiba mais</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="wrapper-faq-home">
    <?php
  $args = array(
    'post_type' => 'faq',
    'lang' => $current_lang,
    'posts_per_page' => -1
  );

  $initials = get_posts($args);
  $initial = $initials[0];
  $faq = get_field('faqs', $initial->ID);
  $titulo_faq = get_field('titulo_faq', $initial->ID);
  $segundo_titulo_faq = get_field('segundo_titulo_faq', $initial->ID);
  $link_faq = get_field('link_faq', $initial->ID);
  // var_dump($faq); // Para depuração
  ?>

    <div class="wrapper-flex-faq container">
        <div class="wrapper-title">
            <p class="titulo"><?php echo $titulo_faq ?></p>
            <p class="sub-titulo"><?php echo $segundo_titulo_faq ?></p>
        </div>
        <div class="acordion">
            <?php foreach ($faq as $content_faq) : ?>
            <?php
        $pergunta = isset($content_faq['pergunta']) ? $content_faq['pergunta'] : null;
        $resposta = isset($content_faq['resposta']) ? $content_faq['resposta'] : null;
        $destaque = isset($content_faq['destaque']) ? $content_faq['destaque'] : false;
        ?>
            <?php if ($destaque && $pergunta && $resposta): ?>
            <div class="wrapper-foreach">
                <div class="wrapper-accordion">
                    <a class="accordion"><?php echo $pergunta; ?>
                        <img class="arrow light" src="<?php echo get_template_directory_uri() ?>/assets/img/arrow.svg">
                        <img class="arrow dark"
                            src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-w.svg"></a>
                    <div class="panel">
                        <p class="texto-info"><?php echo wp_kses_post($resposta); ?></p>
                    </div>

                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="wrapper-btn">
            <a href="/perguntas-frequentes/" class="link">
                <p class="btn">
                    Ver todas perguntas <img class="arrow"
                        src="<?php echo get_template_directory_uri() ?>/assets/img/arrow-btn-blue.svg">
                </p>

            </a>
        </div>
    </div>
</section>




<script>
$(document).ready(function() {
    $('.owl-carousel-cards').owlCarousel({
        loop: true,
        nav: true,
        responsive: {
            0: {
                items: 1.25,
                margin: 16,
            },
            600: {
                items: 1.25,
                margin: 16,
            },
            1000: {
                items: 3,
                margin: 18.5,
            },
            1800: {
                items: 4,
                margin: 18.5,
            }
        }
    });

});

$(document).ready(function() {
    $('.owl-new-products').owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 1.25,
                margin: 16,
            },
            600: {
                items: 1.25,
                margin: 16,
            },
            1000: {
                items: 4,
                margin: 18.5,
            }
        }
    });

});

document.addEventListener('DOMContentLoaded', function() {
    // Data e hora alvo vinda do PHP
    const targetDate = new Date('<?php echo $data_hora_stopwatch; ?>').getTime();

    // Atualiza o contador a cada segundo
    const interval = setInterval(function() {
        const now = new Date().getTime();
        const timeLeft = targetDate - now;

        if (timeLeft <= 0) {
            clearInterval(interval);
            document.getElementById('days').innerText = '00';
            document.getElementById('hours').innerText = '00';
            document.getElementById('minutes').innerText = '00';
            document.getElementById('seconds').innerText = '00';
            return;
        }

        // Calcula dias, horas, minutos e segundos restantes
        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        // Atualiza os elementos do DOM
        document.getElementById('days').innerText = String(days).padStart(2, '0');
        document.getElementById('hours').innerText = String(hours).padStart(2, '0');
        document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
        document.getElementById('seconds').innerText = String(seconds).padStart(2, '0');
    }, 1000);
});

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
        }
    });
}
</script>

<?php get_footer(); ?>