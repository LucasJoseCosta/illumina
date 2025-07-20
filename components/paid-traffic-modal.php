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

<a class="btn-home-traffic">
    <span class="btn-home-traffic-text"><?php pll_e('Quero Saber Mais'); ?> →</span>
</a>

<div id="paid-traffic-modal" class="paid-traffic-modal-component container open">
    <div class="paid-traffic-modal-wrapper">
        <div class="paid-traffic-modal-header">
            <div class="paid-traffic-modal-header-title">
                <?php if (isset($args['titulo_modal_trafego_pago'])): ?>
                    <h3><?php echo esc_html($args['titulo_modal_trafego_pago']); ?></h3>
                <?php endif; ?>
            </div>
            <div class="paid-traffic-modal-header-image">
                <picture>
                    <source srcset="<?php echo get_template_directory_uri() ?>/assets/img/traffic-paid.svg">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/traffic-paid.svg"
                        alt="<?php esc_attr_e('Tráfico pago', 'text-domain'); ?>">
                </picture>
            </div>
        </div>
        <div class="paid-traffic-modal-body">
            <div class="paid-traffic-modal-body-text-content">
                <?php echo $args['conteudo_modal_trafego_pago'] ?>
            </div>
            <div class="paid-traffic-modal-body-card">
                <div class="paid-traffic-modal-body-card-title">
                    <h3>
                        <?php echo $args['titulo_card_modal_trafego_pago'] ?>
                    </h3>
                </div>
                <div class="paid-traffic-modal-body-card-content">
                    <?php echo $args['texto_card_modal_trafego_pago'] ?>
                </div>
            </div>
            <div class="paid-traffic-modal-body-footer">
                <div class="paid-traffic-modal-body-footer-image">
                    <picture>
                        <img class="paid-traffic-modal-body-footer-image-desktop"
                            src="<?php echo $args['imagem__modal_trafego_pago'] ?>"
                            alt="<?php esc_attr_e('Tráfico pago', 'text-domain'); ?>">
                        <img class="paid-traffic-modal-body-footer-image-mobile"
                            src="<?php echo $args['imagem__modal_trafego_pago_mobile'] ?>"
                            alt="<?php esc_attr_e('Tráfico pago', 'text-domain'); ?>">
                    </picture>
                </div>
                <div class="paid-traffic-modal-body-footer-actions">
                    <div class="paid-traffic-modal-body-footer-actions-text">
                        <?php echo $args['texto_destaque_modal_trafego_pago'] ?>
                    </div>
                    <div class="paid-traffic-modal-body-footer-actions-btn">
                        <button id="modal-scroll-btn">
                            <span><?php pll_e('Fazer um Orçamento'); ?> →</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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

        function getScrollOffset() {
            const width = window.innerWidth;
            if (width < 768) return -20;
            if (width <= 1024) return 20;
            return 50;
        }

        const openBtn = document.querySelector('.btn-home-traffic');
        const modal = document.getElementById('paid-traffic-modal');
        const scrollBtn = document.getElementById('modal-scroll-btn');
        const orcamentoElement = document.getElementById('orcamento')

        // Abrir modal com animação
        openBtn.addEventListener('click', function (e) {
            e.preventDefault();
            modal.classList.remove('close');
            modal.classList.add('open');
            modal.style.display = 'block';
        });

        // Fechar modal e scrollar suavemente
        scrollBtn.addEventListener('click', function () {
            modal.classList.remove('open');
            modal.classList.add('close');
            scrollToElementWithOffset(orcamentoElement, getScrollOffset());
            setTimeout(() => {
                modal.style.display = 'none';
                modal.classList.remove('close');
                scrollToElementWithOffset(orcamentoElement, getScrollOffset());
            }, 500);
        });

        document.addEventListener('click', function (e) {
            if (
                modal.classList.contains('open') &&
                !modal.querySelector('.paid-traffic-modal-wrapper').contains(e.target) &&
                !openBtn.contains(e.target)
            ) {
                modal.classList.remove('open');
                modal.classList.add('close');
                setTimeout(() => {
                    modal.style.display = 'none';
                    modal.classList.remove('close');
                }, 500);
            }
        })
    });

</script>