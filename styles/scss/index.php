<?php 
get_header(); 

$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';

$blog_page = get_page_by_path('blog');
$blog_id = !is_wp_error($blog_page) && $blog_page ? pll_get_post($blog_page->ID, $current_lang) : null;

$titulo = $blog_id ? get_field('titulo', $blog_id) : '';
$subtitulo = $blog_id ? get_field('subtitulo', $blog_id) : '';

$selected_categories = isset($_GET['categories']) ? explode(',', $_GET['categories']) : [];
$order = isset($_GET['sort_order']) && in_array($_GET['sort_order'], ['asc', 'desc']) ? $_GET['sort_order'] : 'desc';

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'lang'           => $current_lang,
    'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
    'orderby'        => 'date',
    'order'          => $order,
);

// Se houver categorias selecionadas, usa tax_query para realizar um filtro OR
if ( !empty($selected_categories) ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $selected_categories,
            'operator' => 'IN',  // Retorna posts que pertencem a pelo menos uma das categorias
        ),
    );
}

$query = new WP_Query($args);
$categories = get_categories(array('hide_empty' => true));
$current_lang = function_exists('pll_current_language') ? pll_current_language() : '';


$title_cat = match ($current_lang) {
    "pt" => "Filtre pelas categorias desejadas",
    "en" => "Filter by the desired categories",
    "es" => "Filtra por las categorías deseadas",
    default => "",
};
$todos_post = match ($current_lang) {
    "pt" => "Todos os posts",
    "en" => "All posts",
    "es" => "Todos los posts",
    default => "",
};
$cat = match ($current_lang) {
    "pt" => "Categorias",
    "en" => "Categories",
    "es" => "Categorías",
    default => "",
};

$limpar = match ($current_lang) {
    "pt" => "Limpar Filtros",
    "en" => "Clear Filters",
    "es" => "Limpiar Filtros",
    default => "",
};
$aplicar = match ($current_lang) {
    "pt" => "Aplicar Filtros",
    "en" => "Apply Filters",
    "es" => "Aplicar Filtros",
    default => "",
};

$recente = match ($current_lang) {
    "pt" => "Recentes",
    "en" => "Recent",
    "es" => "Recientes",
    default => "",
};
$antigo = match ($current_lang) {
    "pt" => "Antigos",
    "en" => "Oldest",
    "es" => "Antiguos",
    default => "",
};
$carregar = match ($current_lang) {
    "pt" => "Carregar mais",
    "en" => "Load more",
    "es" => "Cargar más",
    default => "",
};
$carregando = match ($current_lang) {
    "pt" => "Carregando...",
    "en" => "Loading...",
    "es" => "Cargando...",
    default => "",
};

$carregar_js = json_encode($carregar);
$carregando_js = json_encode($carregando);
?>

<div class="pag-blog">
    <div class="container">
        <div class="blog-header">
            <?php if ($titulo) : ?>
            <p class="title"><?php echo esc_html($titulo); ?></p>
            <?php endif; ?>
            <?php if ($subtitulo) : ?>
            <p class="text"><?php echo esc_html($subtitulo); ?></p>
            <?php endif; ?>
        </div>
        <div class="wrapper-flex">
            <div class="wrapper-filter">
                <div class="filter-categories">
                    <p class="title"><?php echo $title_cat?></p>
                    <ul class="lista-categoria">
                        <li>
                            <a href="#"
                                class="clear-categories <?php echo empty($selected_categories) ? 'selected' : ''; ?>"
                                data-category="">
                                <?php echo $todos_post?>
                            </a>
                        </li>
                        <?php if (!is_wp_error($categories) && !empty($categories)) : ?>
                        <?php foreach ($categories as $category) : ?>
                        <li>
                            <a href="#"
                                class="category-link <?php echo in_array($category->slug, $selected_categories) ? 'selected' : ''; ?>"
                                data-category="<?php echo esc_attr($category->slug); ?>">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="wrapper-left">
                <div class="filter-sorting">
                    <div class="wrapper-flex-sort">
                        <div class="drawer-filter">
                            <button class="toggle-filter"><?php echo $cat?></button>
                            <div class="wrapper-filter-mb">
                                <a id="close-button">
                                    <img class="arrow light"
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/close.svg">
                                    <img class="arrow dark"
                                        src="<?php echo get_template_directory_uri() ?>/assets/img/close-white.svg">
                                </a>
                                <!-- Filtro de categorias -->
                                <div class="filter-categories">
                                    <div class="wrapper-filter-drawer">
                                        <p class="title"><?php echo $title_cat?></p>
                                        <ul class="lista-categoria">
                                            <?php if (!is_wp_error($categories) && !empty($categories)) : ?>
                                            <?php foreach ($categories as $category) : ?>
                                            <li>
                                                <a href="#"
                                                    class="category-link <?php echo in_array($category->slug, $selected_categories) ? 'selected' : ''; ?>"
                                                    data-category="<?php echo esc_attr($category->slug); ?>">
                                                    <?php echo esc_html($category->name); ?>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>

                                    <div class="wrapper-btn">
                                        <button class="clear-categories"><?php echo $limpar?></button>
                                        <button class="apply-filters"><?php echo $aplicar?></button>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="wrapper-sort">
                            <select id="sort-order" name="sort_order">
                                <option value="desc"
                                    <?php echo isset($_GET['sort_order']) && $_GET['sort_order'] == 'desc' ? 'selected' : ''; ?>>
                                    <?php echo $recente?></option>
                                <option value="asc"
                                    <?php echo isset($_GET['sort_order']) && $_GET['sort_order'] == 'asc' ? 'selected' : ''; ?>>
                                    <?php echo $antigo?></option>
                            </select>
                        </div>
                    </div>


                    <div class="post-grid" id="posts-container">
                        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="post-card">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>

                                <div class="post-thumbnail">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <?php endif; ?>
                                <div class="post-content">
                                    <div class="post-categories">
                                        <?php $categories = get_the_category();
                                    if ($categories) :
                                        foreach ($categories as $category) : ?>
                                        <span class="category-badge">
                                            <?php echo esc_html($category->name); ?>
                                        </span>
                                        <?php endforeach; endif; ?>
                                    </div>

                                    <P class="post-title">

                                        <?php the_title(); ?>

                                    </P>

                                    <p class="post-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                    </p>
                                </div>
                            </a>

                        </div>
                        <?php endwhile; else : ?>
                        <p><?php _e('Nenhum post encontrado.', 'text-domain'); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php if ($query->max_num_pages > 1) : ?>
                    <div class="load-more-container">
                        <button id="load-more" class="load-more-button"
                            data-current-page="1"><?php echo $carregar?></button>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>



    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sortOrderSelect = document.getElementById('sort-order');
        sortOrderSelect.addEventListener('change', function() {
            const newUrl = new URL(window.location.href);
            newUrl.searchParams.set('sort_order', sortOrderSelect.value);
            window.location.href = newUrl.toString();
        });



        const loadMoreButton = document.getElementById('load-more');
        const loadMoreTextButton = <?php echo $carregar_js; ?>;
        const loadingTextButton = <?php echo $carregando_js; ?>;


        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function() {
                const currentPage = parseInt(this.getAttribute('data-current-page'));
                const nextPage = currentPage + 1;
                const postsContainer = document.getElementById('posts-container');

                loadMoreButton.textContent = loadingTextButton;
                loadMoreButton.disabled = true;

                fetch(`<?php echo admin_url('admin-ajax.php'); ?>?action=load_more_posts&page=${nextPage}`, {
                        method: 'GET',
                    })
                    .then(response => response.text())
                    .then(data => {
                        postsContainer.insertAdjacentHTML('beforeend', data);
                        loadMoreButton.textContent = loadMoreTextButton;
                        loadMoreButton.disabled = false;
                        loadMoreButton.setAttribute('data-current-page', nextPage);

                        if (data.trim() === '') {
                            loadMoreButton.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao carregar mais posts:', error);
                        loadMoreButton.textContent =
                            'Erro ao carregar. Tente novamente.';
                        loadMoreButton.disabled = false;
                    });
            });
        }

        const toggleFilterButton = document.querySelector('.toggle-filter');
        const wrapperFilter = document.querySelector('.wrapper-filter-mb');
        const closeButton = document.getElementById("close-button");

        if (toggleFilterButton && wrapperFilter) {
            toggleFilterButton.addEventListener('click', function() {
                wrapperFilter.classList.toggle('open');
            });


            closeButton.addEventListener("click", function() {
                wrapperFilter.classList.remove("open");
            });
        }


        const isMobile = window.innerWidth <= 768;
        const categoryLinks = document.querySelectorAll('.category-link');
        const clearButtons = document.querySelectorAll('.clear-categories'); // Corrigido para múltiplos botões
        const applyButton = document.querySelector('.apply-filters');
        let selectedCategories = [];

        // Função para atualizar a URL
        const updateUrl = () => {
            const newUrl = new URL(window.location.href);
            if (selectedCategories.length > 0) {
                newUrl.searchParams.set('categories', selectedCategories.join(','));
            } else {
                newUrl.searchParams.delete('categories');
            }
            window.location.href = newUrl.toString();
        };

        // Carregar categorias da URL inicial
        const loadInitialCategories = () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('categories')) {
                selectedCategories = urlParams.get('categories').split(',');
            }
        };

        loadInitialCategories();

        // Event listeners para os links de categorias
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Impede o redirecionamento padrão

                const category = this.getAttribute('data-category');
                if (selectedCategories.includes(category)) {
                    selectedCategories = selectedCategories.filter(cat => cat !== category);
                } else {
                    selectedCategories.push(category);
                }

                // Atualizar classe selecionada
                this.classList.toggle('selected', selectedCategories.includes(category));
            });
        });

        if (isMobile) {
            // Limpar filtros no mobile
            clearButtons.forEach(clearButton => {
                clearButton.addEventListener('click', function(e) {
                    e.preventDefault(); // Impede o redirecionamento padrão

                    selectedCategories = [];
                    categoryLinks.forEach(link => link.classList.remove('selected'));
                });
            });

            // Aplicar filtros no mobile
            applyButton?.addEventListener('click', function() {
                updateUrl();
            });
        } else {
            // Aplicar filtros diretamente no desktop
            categoryLinks.forEach(link => {
                link.addEventListener('click', function() {
                    updateUrl();
                });
            });

            // Botão "Todos os Posts" (limpar filtros no desktop)
            clearButtons.forEach(clearButton => {
                clearButton.addEventListener('click', function(e) {
                    e.preventDefault(); // Impede o redirecionamento padrão

                    selectedCategories = [];
                    updateUrl();
                });
            });
        }
    });
    </script>

    <?php 
 
get_footer(); 
?>