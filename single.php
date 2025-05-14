<?php get_header(); 

$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';

$see_also_text = match ($current_lang) {
  "pt" => "Veja também",
  "en" => "See also",
  "es" => "Ver también",
  default => "Veja também",
};

$share_text = match ($current_lang) {
  "pt" => "Compartilhar",
  "en" => "Share",
  "es" => "Compartir",
  default => "Compartilhar",
};
?>
<section class="pag-post">
    <div id="container" class="container">

        <main id="main" class="site-main" role="main">
            <!-- <a href="/blog" class="link-back">Ver todas as postagens</a> -->

            <?php
			// Início do loop WordPress
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
			?>

            <div class="wrapper-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>

            <div class="wrapper-content">
                <p class="title-post-blog"><?php the_title(); ?></p>
                <?php the_content(); ?>
            </div>

            <?php
				} // Fim do loop WordPress
			}
			?>

        </main><!-- #main -->
        <div class="wrapper-compartilhar">
            <button id="shareBtn">
                <img class="share" src="<?php echo get_template_directory_uri() ?>/assets/img/share.svg">
                <?php echo $share_text; ?>
            </button>
        </div>


        <p class="tilte-more"><?php echo $see_also_text; ?></p>
        <div class="botom botom-desktop">
            <?php
                    $args = array(
                        'post_type' => 'post',
                        
                        'posts_per_page' => 3,
                    );

                    $the_query = new WP_Query( $args );

                    if ( $the_query->have_posts() ) :
                        while ( $the_query->have_posts() ) :
                        $the_query->the_post();
                        ?>
            <div class="post-blog">

                <?php if ( has_post_thumbnail() ) : ?>
                <a class="link-blog" href="<?php the_permalink(); ?>">
                    <div class="box-header">
                        <div class="thumbnail">
                            <img src="<?php echo get_the_post_thumbnail_url( $post->ID, 'full' ); ?>" alt="">
                            <div class="post-categories">
                                <?php $categories = get_the_category();
                if ($categories) :
                    foreach ($categories as $category) : ?>
                                <span class="category-badge">
                                    <?php echo esc_html($category->name); ?>
                                </span>
                                <?php endforeach;
                endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="wrapper-content-post-blog">
                        <div class="wrapper-text-blog">
                            <p class="title-post-blog"><?php the_title(); ?></p>
                            <div class="text-blog">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                        endwhile;
                    endif;

                    wp_reset_postdata();
                    ?>
        </div>

</section>


<script>
document.getElementById("shareBtn").addEventListener("click", function() {
    if (navigator.share) {
        navigator.share({
                title: document.title,
                url: window.location.href
            }).then(() => console.log('Compartilhado com sucesso!'))
            .catch((error) => console.log('Erro ao compartilhar:', error));
    } else {
        alert("Compartilhamento não suportado neste navegador.");
    }
});
</script>


<?php get_footer(); ?>