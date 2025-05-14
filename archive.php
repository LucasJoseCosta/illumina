<?php
get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$args = [
    'post_type' => 'post',
    'posts_per_page' => 8,
    'paged' => $paged,
];
$query = new WP_Query($args);
?>

<section class="pag-blog">
    <div class="container">
        <div class="wrapper-blog">
            <!-- Filtro de Categorias -->
            <aside class="filter-categories">
                <h3>Filtrar por Categorias</h3>
                <ul>
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category) {
                        echo '<li><a href="#" data-category="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</a></li>';
                    }
                    ?>
                </ul>
            </aside>

            <!-- Posts -->
            <div class="wrapper-blog-grid">
                <?php if ($query->have_posts()) : ?>
                    <?php $count = 0; ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <?php if ($count === 0) : ?>
                            <!-- Último Post em Destaque -->
                            <div class="post-highlight" style="grid-column: 1 / -1;">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>">
                                    </a>
                                <?php endif; ?>
                                <h2><?php the_title(); ?></h2>
                                <p><?php the_excerpt(); ?></p>
                            </div>
                        <?php else : ?>
                            <!-- Outros Posts em Grade -->
                            <div class="post-blog">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>">
                                    </a>
                                <?php endif; ?>
                                <h3><?php the_title(); ?></h3>
                                <p><?php the_excerpt(); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php $count++; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <!-- Botão Carregar Mais -->
            <?php if ($query->max_num_pages > 1) : ?>
                <button id="load-more" data-page="2">Carregar Mais</button>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const loadMoreBtn = document.getElementById('load-more');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            const currentPage = parseInt(this.getAttribute('data-page'));
            const container = document.querySelector('.wrapper-blog-grid');
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo admin_url('admin-ajax.php'); ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.status === 200) {
                    const response = JSON.parse(this.responseText);
                    container.insertAdjacentHTML('beforeend', response.content);
                    if (!response.hasMore) {
                        loadMoreBtn.remove();
                    } else {
                        loadMoreBtn.setAttribute('data-page', currentPage + 1);
                    }
                }
            };
            xhr.send('action=load_more_posts&paged=' + currentPage);
        });
    }
});
</script>
