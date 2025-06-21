<?php
$idx = isset($args['index']) ? (int) $args['index'] : 0;
$max_idx = isset($args['max_index']) ? (int) $args['max_index'] : 0;
$post_title = !empty($args['post_title']) ? (string) $args['post_title'] : '';
$post_content = !empty($args['post_content']) && is_string($args['post_content'])
    ? $args['post_content']
    : '';
$post_img_modal_highlight = !empty($args['post_img_modal_highlight']) && is_string($args['post_img_modal_highlight'])
    ? esc_url($args['post_img_modal_highlight'])
    : '';
$post_data = !empty($args['post_data']) ? (string) $args['post_data'] : '';
$post_category = !empty($args['post_category']) ? (string) $args['post_category'] : '';

?>
<div id="portifolio-modal-<?php echo $idx; ?>" class="portifolio-modal-component container">
    <div class="portifolio-modal-wrapper">
        <div class="portifolio-modal-header">
            <div class="portifolio-modal-img">
                <picture>
                    <source src="<?php echo $post_img_modal_highlight ?>" type="">
                    <img src="<?php echo $post_img_modal_highlight ?>" alt="<?php echo $post_title ?>" srcset="">
                </picture>
            </div>
        </div>
        <div class="portifolio-modal-body">
            <div class="portifolio-modal-content">
                <div class="portifolio-modal-title-category">
                    <div class="portifolio-modal-title">
                        <h2><?php echo $post_title ?></h2>
                    </div>
                    <div class="portifolio-modal-category">
                        <h3><?php echo $post_category ?></h3>
                    </div>
                </div>
                <div class="portifolio-modal-content-text">
                    <h3><?php pll_e("Sobre:"); ?></h3>
                    <?php echo $post_content ?>
                </div>
            </div>
            <div class="portifolio-modal-date-actions">
                <div class="portifolio-modal-date">
                    <h4><?php echo $post_data ?></h4>
                </div>
                <div class="portifolio-modal-actions">
                    <?php if ($idx > 0): // só exibe voltar se não for o primeiro ?>
                        <div class="portifolio-modal-btn-previous-wrapper">
                            <button class="portifolio-modal-btn-previous" data-prev="<?php echo $idx - 1; ?>">
                                Voltar
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if ($idx < $max_idx): // só exibe próximo se não for o último ?>
                        <div class="portifolio-modal-btn-next-wrapper">
                            <button class="portifolio-modal-btn-next" data-next="<?php echo $idx + 1; ?>">
                                Próximo
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>