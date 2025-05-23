<?php
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';

$args_footer = array(
  'post_type' => 'misc_info_contato',
  'posts_per_page' => 1,
  'orderby' => 'date',
  'order' => 'DESC',
  'lang' => $current_lang,
);

$footers = get_posts($args_footer);
$initial_footer = $footers[0] ?? null;

if (!$initial_footer) {
  echo '<p>Nenhum post de footer encontrado.</p>';
  return;
}
$logo_footer = get_field('logo_footer', $initial_footer->ID);
$contatos = get_field('contatos', $initial_footer->ID);
$redes_sociais = get_field('redes_sociais', $initial_footer->ID);

?>
<footer>
  <div class="footer-wrapper">
    <div class="footer-container container">
      <div class="footer-image">
        <?php if (!empty($logo_footer)): ?>
          <img src="<?php echo esc_url($logo_footer); ?>" alt="Logo Ilumina Design Studio" class="logo-footer">
        <?php endif; ?>

      </div>

      <div class="footer-info">
        <h3 class="title-ideias">IDEIAS BRILHANTES</h3>
        <div class="contact-details">
          <h3 class="email">illuminadesingstudio@gmail.com</h3>
          <h3 class="number">+ 55 45 99101-6622</h3>
        </div>
      </div>

      <div class="footer-social">
        <div class="contact-container">
          <a href="#contato" class="contact-link">Entre em Contato</a>
        </div>
        <div class="itens-footer">
          <h3 class="text-footer">SEGUE A GENTE</h3>
          <ul class="socials-list">
            <?php if (!empty($redes_sociais) && is_array($redes_sociais)): ?>
              <?php foreach ($redes_sociais as $rede): ?>
                <li>
                  <a href="<?php echo esc_url($rede['link']); ?>" target="_blank" rel="noopener noreferrer">
                    <?php if (!empty($rede['icone'])): ?>
                      <img src="<?php echo esc_url($rede['icone']); ?>"
                        alt="<?php echo esc_attr(!empty($rede['nome']) ? $rede['nome'] : 'Ícone rede social'); ?>">
                    <?php endif; ?>
                  </a>
                </li>
              <?php endforeach; ?>
            <?php else: ?>
              <p>Nenhuma rede social disponível.</p>
            <?php endif; ?>
          </ul>
        </div>
      </div>
     
    </div>
     <div class="info-company">
        <h4 class="text-company">@ 2025 Illumina Design Studio. Todos os direitos reservados</h4>
      </div>
  </div>

</footer>

<?php wp_footer(); ?>
</body>

</html>