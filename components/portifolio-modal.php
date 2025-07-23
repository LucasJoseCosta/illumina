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

                    <div class="portfolio-modal-title-and-arrows">
 <div class="portifolio-modal-category">
                        <h3><?php echo $post_category ?></h3>
                    </div>
                <div class="portifolio-modal-actions">
                    <?php if ($idx > 0): // só exibe voltar se não for o primeiro ?>
                        <div class="portifolio-modal-btn-previous-wrapper">
                            <button class="portifolio-modal-btn-previous" data-prev="<?php echo $idx - 1; ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>../assets/img/arrow-left.svg" alt="Seta para a direita" />
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if ($idx < $max_idx): // só exibe próximo se não for o último ?>
                        <div class="portifolio-modal-btn-next-wrapper">
                                <button class="portifolio-modal-btn-next" data-next="<?php echo $idx + 1; ?>">
                                 
                                   <img src="<?php echo get_template_directory_uri(); ?>../assets/img/arrow-rigth.svg" alt="Seta para a direita" />

                                </button>
                            </div>

                    <?php endif; ?>
                </div>
                </div>
                   
                </div>

                <div class="portfolio-modal-date-and-text">
                
                <div class="portifolio-modal-content-text">
                        <h3 class="portifolio-modal-content-text-about"><?php pll_e("Sobre:"); ?></h3>
                    <?php echo $post_content ?>
                </div>

                <div class="portfolio-date-and-rotate">
                <div class="portifolio-modal-date-actions">
                    <div class="portifolio-modal-date">
                        <h4><?php echo $post_data ?></h4>
                </div>
            </div>
<button class="rotate-toggle-btn" aria-label="Girar imagem 360°">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-rotate.svg" alt="Girar imagem" />
</button>

             </div>           

                </div>
                
            </div>
           
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
  const rotateButtons = document.querySelectorAll('.rotate-toggle-btn');

  rotateButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      const modal = btn.closest('.portifolio-modal-component');
      const img = modal.querySelector('.portifolio-modal-img img');
      
      if (!img) return;

      // Armazena o ângulo atual usando dataset
      const currentAngle = parseInt(img.dataset.rotate || '0');
      const newAngle = currentAngle + 90;

      img.style.transform = `rotate(${newAngle}deg)`;
      img.style.transition = 'transform 0.5s ease';
      img.dataset.rotate = newAngle % 360;
    });
  });
});


</script>