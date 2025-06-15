<?php
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';

$args_footer = array(
  'post_type' => 'misc_info_contato',
  'lang' => $current_lang,
  'posts_per_page' => 1,
);

$footers = get_posts($args_footer);
$initial_footer = $footers[0] ?? null;

if (!$initial_footer) {
  echo '<p>Nenhum post de footer encontrado.</p>';
  return;
}
$logo_footer = get_field('logo_footer', $initial_footer->ID);
$contatos = get_field('contatos', $initial_footer->ID);
$redes_sociais = get_field('redes_socias', $initial_footer->ID);

?>
<footer>
  <div class="footer-wrapper container">
    <div class="footer-container ">
      <div class="footer-image">
        <?php if (!empty($logo_footer)): ?>
          <a href="<?php echo get_home_url() ?>">
            <picture>
              <source src="<?php echo esc_url($logo_footer); ?>">
              <img src="<?php echo esc_url($logo_footer); ?>" alt="Logo Ilumina Design Studio" class="logo-footer">
            </picture>
          </a>
        <?php endif; ?>
      </div>

      <div class="footer-info">
        <h3 class="title-ideias"><?php pll_e('IDEIAS BRILHANTES'); ?></h3>
        <div class="contact-details">
          <?php if (is_array($contatos) && count($contatos) > 0): ?>
            <?php foreach ($contatos as $contato): ?>
              <div class="contact-detail">
                <a href="<?php echo $contato["link_contato"] ?>">
                  <span class="contact-detail-text"><?php echo $contato["contato"] ?></span>
                </a>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p><?php pll_e('Nenhum contato disponível.'); ?></p>
          <?php endif; ?>
        </div>
      </div>

      <div class="footer-social">
        <div class="contact-container">
          <a href="#" class="contact-link"><span><span><?php pll_e('Entre em contato'); ?></span></a>
        </div>
        <div class="itens-footer">
          <h3 class="text-footer"><?php pll_e('SEGUE A GENTE'); ?></h3>
          <ul class="socials-list">
            <?php if (is_array($redes_sociais) && count($redes_sociais) > 0): ?>
              <?php foreach ($redes_sociais as $rede): ?>
                <li>
                  <a href="<?php echo esc_url($rede['link_social']); ?>" target="_blank" rel="noopener noreferrer">
                    <?php if (!empty($rede['icone_social'])): ?>
                      <picture>
                        <source src="<?php echo esc_url($rede['icone_social']); ?>">
                        <img src="<?php echo esc_url($rede['icone_social']); ?>">
                      </picture>
                    <?php endif; ?>
                  </a>
                </li>
              <?php endforeach; ?>
            <?php else: ?>
              <p><?php pll_e('Nenhuma rede social disponível.'); ?></p>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-container-mobile">

      <div class="footer-logo-social">
        <div class="footer-image">
          <?php if (!empty($logo_footer)): ?>
            <a href="<?php echo get_home_url() ?>">
              <picture>
                <source src="<?php echo esc_url($logo_footer); ?>">
                <img src="<?php echo esc_url($logo_footer); ?>" alt="Logo Ilumina Design Studio" class="logo-footer">
              </picture>
            </a>
          <?php endif; ?>
        </div>
        <div class="footer-social">
          <div class="contact-container">
            <a href="#" class="contact-link"><span><?php pll_e('Entre em contato'); ?></span></a>
          </div>
          <div class="itens-footer">
            <h3 class="text-footer"><?php pll_e('SEGUE A GENTE'); ?></h3>
            <ul class="socials-list">
              <?php if (is_array($redes_sociais) && count($redes_sociais) > 0): ?>
                <?php foreach ($redes_sociais as $rede): ?>
                  <li>
                    <a href="<?php echo esc_url($rede['link_social']); ?>" target="_blank" rel="noopener noreferrer">
                      <?php if (!empty($rede['icone_social'])): ?>
                        <picture>
                          <source src="<?php echo esc_url($rede['icone_social']); ?>">
                          <img src="<?php echo esc_url($rede['icone_social']); ?>">
                        </picture>
                      <?php endif; ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              <?php else: ?>
                <p><?php pll_e('Nenhuma rede social disponível.'); ?></p>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>


      <div class="footer-info">
        <h3 class="title-ideias"><?php pll_e('IDEIAS BRILHANTES'); ?></h3>
        <div class="contact-details">
          <?php if (is_array($contatos) && count($contatos) > 0): ?>
            <?php foreach ($contatos as $contato): ?>
              <div class="contact-detail">
                <a href="<?php echo $contato["link_contato"] ?>">
                  <span class="contact-detail-text"><?php echo $contato["contato"] ?></span>
                </a>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p><?php pll_e('Nenhum contato disponível.'); ?></p>
          <?php endif; ?>
        </div>
      </div>


    </div>
    <div class="info-company">
      <h4 class="text-company">@ <?php pll_e('2025 Illumina Design Studio. Todos os direitos reservados.'); ?></h4>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>