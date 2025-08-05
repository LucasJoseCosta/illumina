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
    $banners = get_field('slider_home', $initial->ID);
    $titulo_marca = get_field('titulo_marcas', $initial->ID);
    $marcas = get_field('marcas', $initial->ID);
    $titulo_trafego = get_field('titulo_trafego', $initial->ID);
    $conteudo_trafego = get_field('conteudo_trafego', $initial->ID);
    $modal_trafego_pago = get_field('modal_trafego_pago', $initial->ID);
    $img_conteudo_trafego = get_field('imagem_conteudo_trafego', $initial->ID);
    $img_conteudo_trafego_mobile_1 = get_field('imagem_conteudo_trafego_mobile_1', $initial->ID);
    $img_conteudo_trafego_mobile_2 = get_field('imagem_conteudo_trafego_mobile_2', $initial->ID);
    $titulo_portifolio = get_field('titulo_portifolio', $initial->ID);
    $termos_portifolio = get_field('termos_portifolio', $initial->ID);
    $imagem_portifolio = get_field('imagem_portifolio', $initial->ID);
    $imagem_portifolio_mobile = get_field('imagem_portifolio_mobile', $initial->ID);
    $titulo_orcamento = get_field('titulo_orcamento', $initial->ID);
    $texto_orcamento = get_field('texto_orcamento', $initial->ID);
    $banner_final = get_field('banner_final', $initial->ID);
    $banner_final_mobile = get_field('banner_final_mobile', $initial->ID);
    $link_banner_final = get_field('link_banner_final', $initial->ID);
} else {
    echo '<p>Nenhum post encontrado para o idioma atual.</p>';
    $banners = [];
}
?>

<?php if (!empty($initials)): ?>
    <section class="home-slider-banner">
        <div class="home-slider-banner-wrapper container">
            <div class="home-slider-banner-content">
                <div class="home-slider-work-button">
                    <a href="#" class="btn-home-slider-work">
                        <span class="btn-home-slider-work-text"><?php pll_e('Trabalhos Destaques'); ?></span>
                    </a>
                </div>
                <div class="owl-home-slider-banner owl-carousel owl-theme">
                    <?php if (is_array($banners) && count($banners) > 0): ?>
                        <?php foreach ($banners as $banner): ?>
                            <div class="banner-item">
                                <div class="banner-item-image">
                                    <picture>
                                        <img class="banner-image" src="<?php echo $banner['banner'] ?>"
                                            alt="<?php echo esc_attr($banner['titulo']) ?>">
                                        <img class="banner-image-mobile" src="<?php echo $banner['banner_mobile'] ?>"
                                            alt="<?php echo esc_attr($banner['titulo']) ?>">
                                    </picture>
                                </div>
                                <!-- <div class="banner-item-content">
                                    <h2 class="banner-item-title"><?php echo esc_html($banner['titulo']) ?></h2>
                                    <p class="banner-item-text"><?php echo esc_html($banner['texto']) ?></p>
                                    <a href="<?php echo esc_url($banner['link']) ?>" class="btn-banner">
                                        <span class="btn-banner-text"><?php echo esc_html($banner['texto_botao']) ?></span>
                                    </a>
                                </div> -->
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="home-slider-see-more-button">
                    <a href="#" class="btn-home-slider-see-more">
                        <span class="btn-home-slider-see-more-text"><?php pll_e('Ver Mais'); ?> →</span>
                    </a>
                </div>
            </div>

            <div class="section-divider"></div>
        </div>
    </section>
<?php else: ?>
    <p><?php esc_html_e('No banners available', 'text-domain'); ?></p>
<?php endif; ?>

<section id="clientes" class="home-brands">
    <div class="home-brands-wrapper container">
        <div class="home-brands-header">
            <h2 class="home-brands-title">
                <?php if (!empty($titulo_marca)): ?>
                    <?php echo esc_html($titulo_marca); ?>
                <?php else: ?>
                    <?php esc_html_e('Marcas', 'text-domain'); ?>
                <?php endif; ?>
            </h2>
        </div>

        <div class="home-brands-content">
            <div class="home-brands-content-wrapper">
                <div class="home-brands-list">
                    <?php if (is_array($marcas) && count($marcas) > 0): ?>
                        <?php
                        $total = count($marcas);
                        $primeira_linha = array_slice($marcas, 0, 5); // primeiros 5
                        $segunda_linha = array_slice($marcas, 5);     // o resto
                        ?>

                        <div class="home-brands-content">
                            <div class="home-brands-content-wrapper">
                                <div class="home-brands-list-wrapper linha-1">
                                    <?php foreach ($primeira_linha as $marca): ?>
                                        <div class="home-brands-item"
                                            style="max-width: <?php echo $marca['largura_img_marca'] ?>px;">
                                            <div class="home-brands-item-image">
                                                <a href="<?php echo esc_url($marca['link_marca']) ?>"
                                                    class="home-brands-item-link" target="_blank" rel="noopener noreferrer">
                                                    <picture>
                                                        <source srcset="<?php echo esc_url($marca['logo_marca']) ?>">
                                                        <img src="<?php echo esc_url($marca['logo_marca']) ?>"
                                                            alt="<?php echo esc_attr($marca['titulo_marca']) ?>">
                                                    </picture>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="home-brands-list-wrapper linha-2">
                                    <?php foreach ($segunda_linha as $marca): ?>
                                        <div class="home-brands-item"
                                            style="max-width: <?php echo $marca['largura_img_marca'] ?>px;">
                                            <div class="home-brands-item-image">
                                                <a href="<?php echo esc_url($marca['link_marca']) ?>"
                                                    class="home-brands-item-link" target="_blank" rel="noopener noreferrer">
                                                    <picture>
                                                        <source srcset="<?php echo esc_url($marca['logo_marca']) ?>">
                                                        <img src="<?php echo esc_url($marca['logo_marca']) ?>"
                                                            alt="<?php echo esc_attr($marca['titulo_marca']) ?>">
                                                    </picture>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <p><?php esc_html_e('No brands available', 'text-domain'); ?></p>
                    <?php endif; ?>
                </div>

                <div class="home-brands-list-mobile">
                    <?php if (is_array($marcas) && count($marcas) > 0): ?>
                        <div class="owl-home-brands-mobile owl-carousel owl-theme">
                            <?php foreach ($marcas as $marca): ?>
                                <div class="home-brands-item"
                                    style="max-width: <?php echo $marca['largura_img_marca_mobile'] ?>px;">
                                    <div class="home-brands-item-image">
                                        <a href="<?php echo esc_url($marca['link_marca']) ?>" class="home-brands-item-link"
                                            target="_blank" rel="noopener noreferrer">
                                            <picture>
                                                <source srcset="<?php echo esc_url($marca['logo_marca']) ?>">
                                                <img src="<?php echo esc_url($marca['logo_marca']) ?>"
                                                    alt="<?php echo esc_attr($marca['titulo_marca']) ?>">
                                            </picture>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p><?php esc_html_e('No brands available', 'text-domain'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="section-divider"></div>
    </div>
</section>

<section id="servicos" class="home-traffic">
    <div class="home-traffic-wrapper container">
        <div class="home-traffic-content">
            <div class="home-traffic-content-wrapper">
                <div class="home-traffic-image-wrapper">
                    <div class="home-traffic-image-wrapper-left">
                        <div class="home-traffic-image">
                            <picture>
                                <img class="light"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/img/traffic-paid.svg"
                                    alt="<?php esc_attr_e('Tráfego pago', 'text-domain'); ?>">
                                <img class="dark"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/img/traffic-paid-dark.svg"
                                    alt="<?php esc_attr_e('Tráfego pago', 'text-domain'); ?>">
                            </picture>
                        </div>
                        <div class="home-traffic-text-mobile">
                            <h2 class="home-traffic-title">
                                <?php if (!empty($titulo_trafego)): ?>
                                    <?php echo esc_html($titulo_trafego); ?>
                                <?php else: ?>
                                    <?php esc_html_e('Traffic', 'text-domain'); ?>
                                <?php endif; ?>
                            </h2>
                        </div>
                        <div class="home-traffic-content-image-mobile">
                            <img src="<?php echo esc_url($img_conteudo_trafego_mobile_1) ?>"
                                alt="<?php esc_attr_e('Tráfico pago', 'text-domain'); ?>">
                        </div>
                    </div>
                    <div class="home-traffic-image-wrapper-right">
                        <div class="home-traffic-content-image-mobile-2">
                            <picture>
                                <source srcset="<?php echo esc_url($img_conteudo_trafego_mobile_2) ?>">
                                <img src="<?php echo esc_url($img_conteudo_trafego_mobile_2) ?>"
                                    alt="<?php esc_attr_e('Tráfico pago', 'text-domain'); ?>">
                            </picture>
                        </div>
                    </div>
                </div>

                <div class="home-traffic-text">
                    <h2 class="home-traffic-title">
                        <?php if (!empty($titulo_trafego)): ?>
                            <?php echo esc_html($titulo_trafego); ?>
                        <?php else: ?>
                            <?php esc_html_e('Traffic', 'text-domain'); ?>
                        <?php endif; ?>
                    </h2>
                    <?php if (!empty($conteudo_trafego)): ?>
                        <?php echo $conteudo_trafego; ?>
                    <?php else: ?>
                        <?php esc_html_e('No traffic content available', 'text-domain'); ?>
                    <?php endif; ?>
                </div>
                <div class="home-traffic-button">

                    <?php
                    $modal_trafego_pago_item;

                    if (is_array($modal_trafego_pago) && count($modal_trafego_pago) > 0) {
                        $modal_trafego_pago_item = $modal_trafego_pago[0];
                        $args_modal = array(
                            'titulo_modal_trafego_pago' => $modal_trafego_pago_item['titulo_modal_trafego_pago'],
                            'conteudo_modal_trafego_pago' => $modal_trafego_pago_item['conteudo_modal_trafego_pago'],
                            'titulo_card_modal_trafego_pago' => $modal_trafego_pago_item['titulo_card_modal_trafego_pago'],
                            'texto_card_modal_trafego_pago' => $modal_trafego_pago_item['texto_card_modal_trafego_pago'],
                            'imagem__modal_trafego_pago' => $modal_trafego_pago_item['imagem__modal_trafego_pago'],
                            'imagem__modal_trafego_pago_mobile' => $modal_trafego_pago_item['imagem__modal_trafego_pago_mobile'],
                            'texto_destaque_modal_trafego_pago' => $modal_trafego_pago_item['texto_destaque_modal_trafego_pago']
                        );

                        get_template_part('components/paid-traffic-modal', null, $args_modal);
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="home-traffic-img">
            <div class="home-traffic-img-wrapper">
                <picture>
                    <source srcset="<?php echo esc_url($img_conteudo_trafego) ?>">
                    <img src="<?php echo esc_url($img_conteudo_trafego) ?>"
                        alt="<?php esc_attr_e('Tráfico pago', 'text-domain'); ?>">
                </picture>
            </div>
        </div>
    </div>
</section>

<section class="home-portifolio">
    <div class="home-portifolio-wrapper container">
        <div class="home-portifolio-header">
            <h2 class="home-portifolio-title">
                <?php if (!empty($titulo_portifolio)): ?>
                    <?php echo esc_html($titulo_portifolio); ?>
                <?php else: ?>
                    <?php esc_html_e('Portfolio', 'text-domain'); ?>
                <?php endif; ?>
            </h2>
        </div>

        <div class="home-portifolio-terms">
            <div class="home-portifolio-terms-wrapper">
                <div class="home-portifolio-terms-content">
                    <?php if (is_array($termos_portifolio) && count($termos_portifolio) > 0): ?>
                        <?php foreach ($termos_portifolio as $termo): ?>
                            <?php
                            $base_portfolio_url = get_home_url(null, 'portifolio');
                            $base_url_no_trailing_slash = untrailingslashit($base_portfolio_url);
                            $term_link = add_query_arg('cat_slug', $termo["categoria_do_termo"], $base_url_no_trailing_slash);
                            ?>
                            <div class="home-portifolio-terms-item">
                                <div class="home-portifolio-terms-item-button">
                                    <a href="<?php echo esc_url($term_link); ?>" class="btn-home-portifolio-terms">
                                        <span
                                            class="btn-home-portifolio-terms-text"><?php echo esc_html($termo['termo']); ?></span>
                                        <span
                                            class="btn-home-portifolio-terms-text-mobile"><?php echo esc_html($termo['termo_mobile']); ?></span>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p><?php esc_html_e('No portfolio terms available', 'text-domain'); ?></p>
                    <?php endif; ?>
                </div>
                <!-- <div class="home-portifolio-terms-content-mobile">
                    <div class="owl-home-portifolio-terms owl-carousel owl-theme">
                        <?php if (is_array($termos_portifolio) && count($termos_portifolio) > 0): ?>
                            <?php foreach ($termos_portifolio as $termo): ?>
                                <?php
                                $portfolio_archive_url = get_post_type_archive_link('pag_portifolio');

                                $term_link = add_query_arg('cat_slug', $termo["categoria_do_termo"], get_home_url() . '/portifolio');
                                ?>
                                <div class="home-portifolio-terms-item">
                                    <div class="home-portifolio-terms-item-button">
                                        <a href="<?php echo esc_url($term_link); ?>" class="btn-home-portifolio-terms">
                                            <span
                                                class="btn-home-portifolio-terms-text"><?php echo esc_html($termo['termo']); ?></span>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p><?php esc_html_e('No portfolio terms available', 'text-domain'); ?></p>
                        <?php endif; ?>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="home-portifolio-banner">
            <div class="home-portifolio-banner-img">
                <picture>
                    <img class="home-portifolio-banner-img-desktop" src="<?php echo esc_url($imagem_portifolio) ?>"
                        alt="<?php esc_attr_e('Portfolio', 'text-domain'); ?>">
                    <img class="home-portifolio-banner-img-desktop-mobile"
                        src="<?php echo esc_url($imagem_portifolio_mobile) ?>"
                        alt="<?php esc_attr_e('Portfolio', 'text-domain'); ?>">
                </picture>
            </div>
            <div class="home-portifolio-banner-button">
                <a href="#" class="home-portifolio-banner-button-link">
                    <span class="home-portifolio-banner-button-text">
                        <?php pll_e('IDEIAS BRILHANTES'); ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<section id="orcamento" class="home-budget">
    <div class="home-budget-container container">
        <div class="home-budget-wrapper">
            <div class="home-budget-content-title-mobile">
                <h2 class="home-budget-content-title-text">
                    <?php if (!empty($titulo_orcamento)): ?>
                        <?php echo esc_html($titulo_orcamento); ?>
                    <?php else: ?>
                        <?php esc_html_e('Budget', 'text-domain'); ?>
                    <?php endif; ?>
                </h2>
            </div>
            <div class="home-budget-form">
                <div class="home-budget-form-wrapper">
                    <?php echo do_shortcode('[contact-form-7 id="fd7222c" title="Contato"]'); ?>
                </div>
            </div>

            <div class="home-budget-content">
                <div class="home-budget-content-wrapper">
                    <div class="home-budget-content-title">
                        <h2 class="home-budget-content-title-text">
                            <?php if (!empty($titulo_orcamento)): ?>
                                <?php echo esc_html($titulo_orcamento); ?>
                            <?php else: ?>
                                <?php esc_html_e('Budget', 'text-domain'); ?>
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="home-budget-content-text">
                        <?php if (!empty($texto_orcamento)): ?>
                            <?php echo $texto_orcamento; ?>
                        <?php else: ?>
                            <?php esc_html_e('No budget content available', 'text-domain'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="home-budget-content-button">
                        <button class="btn-home-budget">
                            <span class="btn-home-budget-text">
                                <?php pll_e('Enviar Orçamento'); ?> →</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-last-banner">
    <div class="home-last-banner-wrapper container">
        <div class="home-last-banner-img">
            <a href="<? echo esc_url($link_banner_final) ?>">
                <picture>
                    <img class="home-last-banner-img-desktop" src="<?php echo esc_url($banner_final) ?>"
                        alt="<?php esc_attr_e('Métrica', 'text-domain'); ?>">
                    <img class="home-last-banner-img-mobile" src="<?php echo esc_url($banner_final_mobile) ?>"
                        alt="<?php esc_attr_e('Métrica', 'text-domain'); ?>">
                </picture>
            </a>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('.owl-home-slider-banner').owlCarousel({
            loop: true,
            // nav: true,
            dots: false,
            autoplay: true,
            autoplayHoverPause: true,
            smartSpeed: 1000,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                1025: {
                    items: 1,
                    nav: true
                },
            }
        });

        $('.owl-home-brands-mobile').owlCarousel({
            loop: true,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 1000,
            smartSpeed: 1000,
            autoplayHoverPause: true,
            slideTransition: 'linear',
            margin: 16,
            responsive: {
                0: {
                    items: 3
                },
                767: {
                    items: 4
                }
            }
        });

        // $('.owl-home-portifolio-terms').owlCarousel({
        //     nav: false,
        //     dots: false,
        //     margin: 10,
        //     responsive: {
        //         0: {
        //             items: 1
        //         },
        //         767: {
        //             items: 2
        //         }
        //     }
        // });

    });
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Choices !== 'undefined') {
            const selects = document.querySelectorAll('.wpcf7-select');
            selects.forEach(function (select) {
                new Choices(select, {
                    searchEnabled: false,
                    shouldSort: false,
                    itemSelectText: '',
                    classNames: {
                        containerOuter: 'choices-container',
                        containerInner: 'choices-inner',
                        listDropdown: 'choices-dropdown',
                        itemChoice: 'choices-item',
                    }
                });
            });
        } else {
            console.error('Choices is not defined yet.');
        }


        //Submit form whatsapp
        const form = document.querySelector('.wpcf7 form');
        const button = document.querySelector('.btn-home-budget');

        function getWhatsAppLink() {
            const nome = document.querySelector('#nome-completo')?.value || '';
            const empresa = document.querySelector('#empresa-marca')?.value || '';
            const contato = document.querySelector('#email-whatsapp')?.value || '';
            const assunto = document.querySelector('#assunto')?.value || '';
            const mensagem = document.querySelector('#mensagem')?.value || '';

            if (!nome || !contato || !assunto || !mensagem) {
                return '#';
            }

            const texto = `
            *Solicitação de Orçamento:*
             *Nome:* ${nome}
             *Empresa:* ${empresa}
             *Contato:* ${contato}
             *Assunto:* ${assunto}
             *Mensagem:* ${mensagem}
                `;

            const url = `https://wa.me/5599999999999?text=${encodeURIComponent(texto)}`;

            return url;
        }

        // Ao submeter o formulário (de forma padrão)
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            event.stopPropagation();// Impede o envio padrão do formulário
            const url = getWhatsAppLink();
            if (url !== '#') {
                window.open(url, '_blank');

                const rootStyles = getComputedStyle(document.documentElement);
                const bgColor = rootStyles.getPropertyValue('--bg').trim();
                const textColor = rootStyles.getPropertyValue('--color-primary').trim();

                // Aplica estilos imediatamente
                button.style.backgroundColor = bgColor;
                button.style.color = textColor;

                // Aplica a animação com efeito "spring" (simulado com keyframes)
                button.animate([
                    { transform: 'scale(1)', offset: 0 },
                    { transform: 'scale(1.1)', offset: 0.3 },
                    { transform: 'scale(0.95)', offset: 0.6 },
                    { transform: 'scale(1)', offset: 1 }
                ], {
                    duration: 600,
                    easing: 'ease-out' // alternativa ao "spring", mais suave
                });
                // Atualiza o texto do botão
                const label = button.querySelector('.btn-home-budget-text');
                if (label) {
                    label.innerText = 'Orçamento Enviado!';
                }
            }
        });

        // Ao clicar diretamente no botão (sem precisar submeter o formulário)

        if (button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                // Dispara o evento submit do formulário, que será tratado pelo CF7
                form?.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
            })
        }
        // Máscara de entrada para o campo de email/whatsapp
        const input = document.getElementById('email-whatsapp');

        input.addEventListener('input', function (e) {
            let value = input.value.trim();

            // Remove caracteres não numéricos para validação de telefone
            const onlyNumbers = value.replace(/\D/g, '');

            if (isEmail(value)) {
                input.setAttribute('type', 'email');
                input.value = value; // não aplica máscara
            } else if (isBrazilPhone(onlyNumbers)) {
                input.setAttribute('type', 'tel');
                input.value = formatBrazilPhone(onlyNumbers);
            } else if (isInternationalPhone(onlyNumbers)) {
                input.setAttribute('type', 'tel');
                input.value = formatInternationalPhone(onlyNumbers);
            } else {
                input.setAttribute('type', 'text'); // neutro enquanto digita
            }
        });

        function isEmail(value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(value);
        }

        function isBrazilPhone(value) {
            return value.length >= 10 && value.length <= 11 && value.startsWith('1') === false;
        }

        function isInternationalPhone(value) {
            return value.length > 11 && value.startsWith('1'); // Ex: EUA começa com 1
        }

        function formatBrazilPhone(value) {
            if (value.length === 11) {
                return `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
            } else if (value.length === 10) {
                return `(${value.slice(0, 2)}) ${value.slice(2, 6)}-${value.slice(6)}`;
            }
            return value;
        }

        function formatInternationalPhone(value) {
            // Exemplo simples: +1 (234) 567-8900
            return `+${value[0]} (${value.slice(1, 4)}) ${value.slice(4, 7)}-${value.slice(7, 11)}`;
        }
    });
</script>

<?php get_footer(); ?>