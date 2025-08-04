<?php
$idx = isset($args['index']) ? (int) $args['index'] : 0;
$max_idx = isset($args['max_index']) ? (int) $args['max_index'] : 0;
$titulo_post = isset($args['titulo_post']) ? $args['titulo_post'] : '(sem título)';
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
                <img src="<?php echo $post_img_modal_highlight ?>" alt="<?php echo $titulo_post; ?>" srcset="">
            </div>
            <div class="floating-rotation-controls">
                <button class="rotation-button">
                    <span>
                        <img class="light"
                            src="<?php echo get_template_directory_uri(); ?>/assets/img/rotation-button.svg" alt=""
                            srcset="">
                        <img class="dark"
                            src="<?php echo get_template_directory_uri(); ?>/assets/img/rotation-button-dark.svg" alt=""
                            srcset="">
                    </span>
                </button>
                <div>
                    <?php if ($idx > 0): // só exibe voltar se não for o primeiro ?>
                        <button class="portifolio-modal-btn-previous" data-prev="<?php echo $idx - 1; ?>">
                            <span>
                                <img class="light"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-left.svg"
                                    alt="" srcset="">
                                <img class="dark"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-left-dark.svg"
                                    alt="" srcset="">
                            </span>
                        </button>
                    <?php endif; ?>
                    <?php if ($idx < $max_idx): // só exibe próximo se não for o último ?>
                        <button class="portifolio-modal-btn-next" data-next="<?php echo $idx + 1; ?>">
                            <span>
                                <img class="light"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-rigth.svg"
                                    alt="" srcset="">
                                <img class="dark"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-rigth-dark.svg"
                                    alt="" srcset="">
                            </span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="portifolio-modal-body">
            <div class="portifolio-modal-body-content">
                <div class="portifolio-modal-body-content-wrapper">
                    <div class="portifolio-modal-title-category">
                        <div class="portifolio-modal-title">
                            <h2><?php echo $titulo_post; ?></h2>
                        </div>
                        <div class="portifolio-modal-category">
                            <h3><?php echo $post_category ?></h3>
                        </div>
                    </div>
                    <div class="portifolio-modal-actions">
                        <?php if ($idx > 0): // só exibe voltar se não for o primeiro ?>
                            <div class="portifolio-modal-btn-previous-wrapper">
                                <button class="portifolio-modal-btn-previous" data-prev="<?php echo $idx - 1; ?>">
                                    <span>
                                        <img class="light"
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-left.svg"
                                            alt="" srcset="">
                                        <img class="dark"
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-left-dark.svg"
                                            alt="" srcset="">
                                    </span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if ($idx < $max_idx): // só exibe próximo se não for o último ?>
                            <div class="portifolio-modal-btn-next-wrapper">
                                <button class="portifolio-modal-btn-next" data-next="<?php echo $idx + 1; ?>">
                                    <span>
                                        <img class="light"
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-rigth.svg"
                                            alt="" srcset="">
                                        <img class="dark"
                                            src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-rigth-dark.svg"
                                            alt="" srcset="">
                                    </span>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="portifolio-modal-content">
                    <div class="portifolio-modal-content-text">
                        <h3><?php pll_e("Sobre:"); ?></h3>
                        <?php echo $post_content ?>
                    </div>
                    <div class="portifolio-modal-date-action">
                        <h4><?php echo $post_data ?></h4>
                        <div class="portifolio-modal-rotation-button">
                            <button class="rotation-button">
                                <span>
                                    <img class="light"
                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/rotation-button.svg"
                                        alt="" srcset="">
                                    <img class="dark"
                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/rotation-button-dark.svg"
                                        alt="" srcset="">
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="portifolio-modal-date-action-desktop">
                <div class="portifolio-modal-date-action">
                    <h4><?php echo $post_data ?></h4>
                </div>
                <div class="portifolio-modal-actions">
                    <?php if ($idx > 0): // só exibe voltar se não for o primeiro ?>
                        <div class="portifolio-modal-btn-previous-wrapper">
                            <button class="portifolio-modal-btn-previous" data-prev="<?php echo $idx - 1; ?>">
                                <span>
                                    <img class="light"
                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-left.svg"
                                        alt="" srcset="">
                                    <img class="dark"
                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-left-dark.svg"
                                        alt="" srcset="">
                                </span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if ($idx < $max_idx): // só exibe próximo se não for o último ?>
                        <div class="portifolio-modal-btn-next-wrapper">
                            <button class="portifolio-modal-btn-next" data-next="<?php echo $idx + 1; ?>">
                                <span>
                                    <img class="light"
                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-rigth.svg"
                                        alt="" srcset="">
                                    <img class="dark"
                                        src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-portifolio-rigth-dark.svg"
                                        alt="" srcset="">
                                </span>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>