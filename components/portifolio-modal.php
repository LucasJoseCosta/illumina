<?php
/**
 * Template part para exibir o modal de tráfego pago.
 * Os argumentos passados via get_template_part() estão disponíveis na variável $args.
 */

// Para depurar os argumentos recebidos (opcional):
if (isset($args) && !empty($args)) {
    echo "";
}
?>

<div id="portifolio-modal-<?php echo $args['index']; ?>" class="portifolio-modal-component container">
    <div class="portifolio-modal-wrapper">
        <div class="portifolio-modal-header">
            <div class="portifolio-modal-header-title">
                <?php if (isset($args['titulo_portifolio'])): ?>
                    <h3><?php echo esc_html($args['titulo_portifolio']) . $args['index']; ?></h3>
                <?php endif; ?>
            </div>
            <div class="portifolio-modal-header-image">
                <picture>
                    <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/traffic-paid.svg">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/traffic-paid.svg"
                        alt="<?php esc_attr_e('Tráfico pago', 'text-domain'); ?>">
                </picture>
            </div>
        </div>
        <div class="portifolio-modal-body">
            <div class="portifolio-modal-body-text-content">
                <?php echo $args['conteudo_modal_trafego_pago'] ?>
            </div>
            <div class="portifolio-modal-body-card">
                <div class="portifolio-modal-body-card-title">
                    <h3>
                        <?php echo $args['titulo_card_modal_trafego_pago'] ?>
                    </h3>
                </div>
                <div class="portifolio-modal-body-card-content">
                    <?php echo $args['texto_card_modal_trafego_pago'] ?>
                </div>
            </div>
            <div class="portifolio-modal-body-footer">
                <div class="portifolio-modal-body-footer-image">
                    <picture>
                        <source srcset="<?php echo $args['imagem__modal_trafego_pago'] ?>">
                        <img src="<?php echo $args['imagem__modal_trafego_pago'] ?>"
                            alt="<?php esc_attr_e('Tráfico pago', 'text-domain'); ?>">
                    </picture>
                </div>
                <div class="portifolio-modal-body-footer-actions">
                    <div class="portifolio-modal-body-footer-actions-text">
                        <?php echo $args['texto_destaque_modal_trafego_pago'] ?>
                    </div>
                    <div class="portifolio-modal-body-footer-actions-btn">
                        <button id="modal-scroll-btn">
                            <span><?php pll_e('Fazer um Orçamento'); ?> →</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>