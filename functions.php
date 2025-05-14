<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if (version_compare($GLOBALS['wp_version'], '5.3', '<')) {
	require get_template_directory() . '/inc/back-compat.php';
}

if (! function_exists('twenty_twenty_one_setup')) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Twenty-One, use a find and replace
		 * to change 'twentytwentyone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('twentytwentyone', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support('title-tag');

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1568, 9999);

		register_nav_menus(
			array(
				'primary' => esc_html__('Primary menu', 'twentytwentyone'),
				'footer'  => esc_html__('Secondary menu', 'twentytwentyone'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Add support for editor styles.
		add_theme_support('editor-styles');
		$background_color = get_theme_mod('background_color', 'D1E4DD');
		if (127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex($background_color)) {
			add_theme_support('dark-editor-style');
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ($is_IE) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style($editor_stylesheet_path);

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__('Extra small', 'twentytwentyone'),
					'shortName' => esc_html_x('XS', 'Font size', 'twentytwentyone'),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__('Small', 'twentytwentyone'),
					'shortName' => esc_html_x('S', 'Font size', 'twentytwentyone'),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__('Normal', 'twentytwentyone'),
					'shortName' => esc_html_x('M', 'Font size', 'twentytwentyone'),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__('Large', 'twentytwentyone'),
					'shortName' => esc_html_x('L', 'Font size', 'twentytwentyone'),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__('Extra large', 'twentytwentyone'),
					'shortName' => esc_html_x('XL', 'Font size', 'twentytwentyone'),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__('Huge', 'twentytwentyone'),
					'shortName' => esc_html_x('XXL', 'Font size', 'twentytwentyone'),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__('Gigantic', 'twentytwentyone'),
					'shortName' => esc_html_x('XXXL', 'Font size', 'twentytwentyone'),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__('Black', 'twentytwentyone'),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__('Dark gray', 'twentytwentyone'),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__('Gray', 'twentytwentyone'),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__('Green', 'twentytwentyone'),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__('Blue', 'twentytwentyone'),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__('Purple', 'twentytwentyone'),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__('Red', 'twentytwentyone'),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__('Orange', 'twentytwentyone'),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__('Yellow', 'twentytwentyone'),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__('White', 'twentytwentyone'),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__('Purple to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__('Yellow to purple', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__('Green to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__('Yellow to green', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__('Red to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__('Yellow to red', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__('Purple to red', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__('Red to purple', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if (is_customize_preview()) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support('starter-content', twenty_twenty_one_get_starter_content());
		}

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Add support for custom line height controls.
		add_theme_support('custom-line-height');

		// Add support for experimental link color control.
		add_theme_support('experimental-link-color');

		// Add support for experimental cover block spacing.
		add_theme_support('custom-spacing');

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support('custom-units');

		// Remove feed icon link from legacy RSS widget.
		add_filter('rss_widget_feed_link', '__return_false');
	}
}
add_action('after_setup_theme', 'twenty_twenty_one_setup');

/**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init()
{

	register_sidebar(
		array(
			'name'          => esc_html__('Footer', 'twentytwentyone'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here to appear in your footer.', 'twentytwentyone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'twenty_twenty_one_widgets_init');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('twenty_twenty_one_content_width', 750);
}
add_action('after_setup_theme', 'twenty_twenty_one_content_width', 0);

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_scripts()
{
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ($is_IE) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		//wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		//wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	//owl carrousel
	wp_enqueue_style('owl-carrousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css');
	wp_enqueue_style('owl-carrousel', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css');

	wp_enqueue_script('jquery');

	wp_enqueue_script('owl-carrousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), null, false);


	// RTL styles.
	wp_style_add_data('twenty-twenty-one-style', 'rtl', 'replace');

	// Print styles.
	//wp_enqueue_style( 'twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get('Version'),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get('Version'),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	// if ( has_nav_menu( 'primary' ) ) {
	// 	wp_enqueue_script(
	// 		'twenty-twenty-one-primary-navigation-script',
	// 		get_template_directory_uri() . '/assets/js/primary-navigation.js',
	// 		array( 'twenty-twenty-one-ie11-polyfills' ),
	// 		wp_get_theme()->get( 'Version' ),
	// 		true
	// 	);
	// }

	// Responsive embeds script.
	// wp_enqueue_script(
	// 	'twenty-twenty-one-responsive-embeds-script',
	// 	get_template_directory_uri() . '/assets/js/responsive-embeds.js',
	// 	array( 'twenty-twenty-one-ie11-polyfills' ),
	// 	wp_get_theme()->get( 'Version' ),
	// 	true
	// );
}
add_action('wp_enqueue_scripts', 'twenty_twenty_one_scripts');

/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script()
{

	wp_enqueue_script('twentytwentyone-editor', get_theme_file_uri('/assets/js/editor.js'), array('wp-blocks', 'wp-dom'), wp_get_theme()->get('Version'), true);
}

add_action('enqueue_block_editor_assets', 'twentytwentyone_block_editor_script');

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix()
{

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	} else {
		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
?>
		<script>
			/(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window
				.addEventListener("hashchange", (function() {
					var t, e = location.hash.substring(1);
					/^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i
						.test(t.tagName) || (t.tabIndex = -1), t.focus())
				}), !1);
		</script>
	<?php
	}
}
add_action('wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix');

/**
 * Enqueue non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages()
{
	$custom_css = twenty_twenty_one_get_non_latin_css('front-end');

	if ($custom_css) {
		wp_add_inline_style('twenty-twenty-one-style', $custom_css);
	}
}
add_action('wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages');

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init()
{
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri('/assets/js/customize-helpers.js'),
		array(),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri('/assets/js/customize-preview.js'),
		array('customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers'),
		wp_get_theme()->get('Version'),
		true
	);
}
add_action('customize_preview_init', 'twentytwentyone_customize_preview_init');

/**
 * Enqueue scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts()
{

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri('/assets/js/customize-helpers.js'),
		array(),
		wp_get_theme()->get('Version'),
		true
	);
}
add_action('customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts');

/**
 * Calculate classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes()
{
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters('twentytwentyone_html_classes', '');
	if (! $classes) {
		return;
	}
	echo 'class="' . esc_attr($classes) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class()
{
	?>
	<script>
		if (-1 !== navigator.userAgent.indexOf('MSIE') || -1 !== navigator.appVersion.indexOf('Trident/')) {
			document.body.classList.add('is-IE');
		}
	</script>
	<?php
}
add_action('wp_footer', 'twentytwentyone_add_ie_class');

if (! function_exists('wp_get_list_item_separator')) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator()
	{
		/* translators: Used between list items, there is a space after the comma. */
		return __(', ', 'twentytwentyone');
	}
endif;

add_filter('show_admin_bar', '__return_false');

function get_google_maps_api_key()
{
	return rest_ensure_response([
		'apiKey' => GOOGLE_MAPS_API_KEY
	]);
}

add_action('rest_api_init', function () {
	register_rest_route('custom/v1', '/google-maps-key/', [
		'methods'  => 'GET',
		'callback' => 'get_google_maps_api_key',
		'permission_callback' => '__return_true'
	]);
});

function enqueue_filter_script()
{
	wp_enqueue_script('filter-script', get_template_directory_uri() . '/assets/js/filters.js', array('jquery'), null, true);
	wp_localize_script('filter-script', 'ajax_params', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'lang' => function_exists('pll_current_language') ? pll_current_language() : ''
	));
}
add_action('wp_enqueue_scripts', 'enqueue_filter_script');


function filter_products_ajax()
{
	// Verifica se o parâmetro 'marcas' foi enviado
	if (! isset($_POST['marcas'])) {
		wp_die();
	}
	// Limpa e separa os valores enviados
	$marcas_raw    = sanitize_text_field($_POST['marcas']);
	$selected_brands = explode(",", $marcas_raw);
	// Se o array conter apenas uma string vazia, consideramos que nenhum filtro foi selecionado.
	if (count($selected_brands) === 1 && empty($selected_brands[0])) {
		$selected_brands = array();
	}
	$current_lang = sanitize_text_field($_POST['lang']);
	$filter_no_results =  match ($current_lang) {
		"pt" => "Nenhum resultado encontrado",
		"en" => "No results found",
		"es" => "No se encontraron resultados",
		default => "",
	};
	$args = array(
		'post_type'      => 'produto',
		'lang'           => $current_lang,
		'posts_per_page' => -1,
	);
	/*
     * Se houver filtros selecionados E se o filtro "Todos os produtos" NÃO estiver selecionado,
     * adicionamos a condição na consulta.
     */
	if (! empty($selected_brands) && ! in_array("Todos os produtos", $selected_brands)) {
		$args['meta_query'] = array(
			array(
				'key'     => 'marca',
				'value'   => $selected_brands,
				'compare' => 'IN'
			)
		);
	}
	$filtered_products = get_posts($args);
	if ($filtered_products) {
		foreach ($filtered_products as $product) {
			$product_name  = get_field('nome_produto', $product->ID);
			$product_image = get_field('imagem_destaque', $product->ID);
			$product_image = set_url_scheme($product_image, 'https');
			$product_link = get_field('link_botao', $product->ID);
	?>
			<div class="product-item">
				<div class="product-item-image">
					<picture>
						<source srcset="<?php echo esc_url($product_image); ?>">
						<img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($product_name); ?>">
					</picture>
				</div>
				<div class="product-name-wrapper">
					<h3 class="product-name"><?php echo esc_html($product_name); ?></h3>
				</div>
				<div class="product-btn-wrapper">
					<a href="<?php echo esc_url($product_link); ?>" class="product-btn">
						<span class="product-btn-text">Saiba mais</span>
					</a>
				</div>
			</div>
			<?php
		}
	} else {
		echo '<p>' . $filter_no_results . '</p>';
	}
	wp_die();
}
add_action('wp_ajax_filter_products', 'filter_products_ajax');
add_action('wp_ajax_nopriv_filter_products', 'filter_products_ajax');

function filter_brands_ajax()
{
	// Verifica se o parâmetro 'marcas' foi enviado
	if (! isset($_POST['marcas'])) {
		wp_die();
	}

	// Limpa e separa os valores enviados
	$marcas_raw      = sanitize_text_field($_POST['marcas']);
	$selected_brands = explode(",", $marcas_raw);

	// Se o array conter apenas uma string vazia, consideramos que nenhum filtro foi selecionado.
	if (count($selected_brands) === 1 && empty($selected_brands[0])) {
		$selected_brands = array();
	}

	$current_lang = sanitize_text_field($_POST['lang']);

	$filter_all_products = match ($current_lang) {
		"pt" => "Todos os produtos",
		"en" => "All products",
		"es" => "Todos los productos",
		default => "",
	};

	$args = array(
		'post_type'      => 'produto',
		'lang'           => $current_lang,
		'posts_per_page' => -1,
	);

	/*
     * Se houver filtros selecionados E se o filtro "Todos os produtos" NÃO estiver selecionado,
     * adicionamos a condição na consulta.
     */
	// if (! empty($selected_brands) && ! in_array($filter_all_products, $selected_brands)) {
	// 	$args['meta_query'] = array(
	// 		array(
	// 			'key'     => 'marca',
	// 			'value'   => $selected_brands,
	// 			'compare' => 'IN'
	// 		)
	// 	);
	// }

	$filtered_products = get_posts($args);

	if ($filtered_products) {
		$marcas_exibidas = [];
		foreach ($filtered_products as $product) {
			$marca = get_field('marca', $product->ID);

			if ($marca && !in_array($marca, $marcas_exibidas)) {
				$marcas_exibidas[] = $marca;

				// Verifica se a marca está dentro dos filtros selecionados
				$checked = in_array($marca, $selected_brands) ? 'checked' : '';
			?>
				<li class="products-filter-option">
					<input type="checkbox" id="<?php echo esc_attr(pll__($marca)); ?>" name="marca"
						value="<?php echo esc_attr(pll__($marca)); ?>">
					<label for="<?php echo esc_attr(pll__($marca)); ?>"><?php echo esc_html(pll__($marca)); ?></label>
				</li>
		<?php
			}
		}
		// Adicionando o checkbox de "Todos os Produtos"
		$checked_all = in_array($filter_all_products, $selected_brands) ? 'checked' : '';
		?>
		<li class="products-filter-option">
			<input type="checkbox" id="<?php echo esc_attr($filter_all_products); ?>" name="marca"
				value="<?php echo esc_attr($filter_all_products); ?>" <?php echo $checked_all; ?>>
			<label for="<?php echo esc_attr($filter_all_products); ?>"><?php echo esc_html($filter_all_products); ?></label>
		</li>
		<?php
	} else {
		echo '<p>Nenhum produto encontrado.</p>';
	}
	wp_die();
}
add_action('wp_ajax_filter_brands', 'filter_brands_ajax');
add_action('wp_ajax_nopriv_filter_brands', 'filter_brands_ajax');



function load_more_posts()
{
	$page = $_GET['page'];
	$args = [
		'post_type' => 'post',
		'posts_per_page' => 6,
		'paged' => $page,
	];

	$query = new WP_Query($args);

	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();


		?>
			<div class="post-card">
				<a href="<?php the_permalink(); ?>">
					<?php if (has_post_thumbnail()) : ?>
						<div class="post-thumbnail">

							<img class="foto-desktop" src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>"
								alt="<?php the_title(); ?>">

						</div>
					<?php endif; ?>

					<div class="post-content">
						<div class="post-categories">
							<?php $categories = get_the_category();
							if ($categories) :
								foreach ($categories as $category) : ?>
									<span class="category-badge ">
										<?php echo esc_html($category->name); ?>
									</span>
							<?php endforeach;
							endif; ?>
						</div>

						<p class="post-title">

							<?php the_title(); ?>

						</p>

						<p class="post-excerpt">
							<?php echo wp_trim_words(get_the_excerpt(), 20); ?>
						</p>
					</div>
				</a>
			</div>
		<?php
		endwhile;
	endif;

	wp_reset_postdata();
	die();
}
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

function enqueue_fullcalendar_scripts()
{
	// Carregando o CSS e JavaScript do FullCalendar 4.x ou superior
	wp_enqueue_style('fullcalendar-css', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css', [], '6.1.8');
	wp_enqueue_script('fullcalendar-js', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js', [], '6.1.8', true);
}
add_action('wp_enqueue_scripts', 'enqueue_fullcalendar_scripts');


function criar_taxonomia_evento()
{
	$labels = array(
		'name'              => 'Tipo de evento',
		'singular_name'     => 'Tipo de evento',
		'search_items'      => 'Buscar Tipo de evento',
		'all_items'         => 'Todos Tipos de eventos',
		'edit_item'         => 'Editar Tipo de evento',
		'update_item'       => 'Atualizar Tipo de evento',
		'add_new_item'      => 'Adicionar Novo Tipo de evento',
		'new_item_name'     => 'Novo Nome do Tipo de evento',
		'menu_name'         => 'Tipo de evento',
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'tipo-de-evento'),
		'show_in_rest'      => true,
	);

	register_taxonomy('tipo_de_evento', array('eventos'), $args);
}
add_action('init', 'criar_taxonomia_evento');

function adicionar_campo_hex($term)
{
	// Verifica se $term é um objeto e tem a propriedade term_id
	$term_id = is_object($term) && isset($term->term_id) ? $term->term_id : 0;
	$cor_hex = get_term_meta($term_id, 'cor_hex', true);

	// Verifica se estamos na tela de edição ou adição
	$is_edit = is_object($term) && isset($term->term_id);

	if ($is_edit) {
		// Tela de edição
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="cor_hex">Cor HEX</label>
			</th>
			<td>
				<input type="text" name="cor_hex" id="cor_hex" value="<?php echo esc_attr($cor_hex); ?>"
					placeholder="#ffffff" />
				<p class="description">Digite o código HEX para a cor do evento (ex: #ff0000).</p>
			</td>
		</tr>
	<?php
	} else {
		// Tela de adição
	?>
		<div class="form-field">
			<label for="cor_hex">Cor HEX</label>
			<input type="text" name="cor_hex" id="cor_hex" value="" placeholder="#ffffff" />
			<p class="description">Digite o código HEX para a cor do evento (ex: #ff0000).</p>
		</div>
<?php
	}
}
function adicionar_coluna_hex($columns)
{
	$columns['cor_hex'] = 'Cor HEX';
	return $columns;
}
add_filter('manage_edit-tipo_de_evento_columns', 'adicionar_coluna_hex');

function preencher_coluna_hex($content, $column_name, $term_id)
{
	if ($column_name === 'cor_hex') {
		$cor_hex = get_term_meta($term_id, 'cor_hex', true);
		$content = $cor_hex ? '<span style="display:inline-block; width:20px; height:20px; background:' . esc_attr($cor_hex) . ';"></span> ' . esc_html($cor_hex) : '—';
	}
	return $content;
}
add_filter('manage_tipo_de_evento_custom_column', 'preencher_coluna_hex', 10, 3);



add_action('tipo_de_evento_edit_form_fields', 'adicionar_campo_hex');
add_action('tipo_de_evento_add_form_fields', 'adicionar_campo_hex');

function salvar_campo_hex($term_id)
{
	if (isset($_POST['cor_hex'])) {
		$cor_hex = sanitize_hex_color($_POST['cor_hex']);
		if ($cor_hex) {
			update_term_meta($term_id, 'cor_hex', $cor_hex);
		} else {
			delete_term_meta($term_id, 'cor_hex');
		}
	}
}
add_action('edited_tipo_de_evento', 'salvar_campo_hex');
add_action('created_tipo_de_evento', 'salvar_campo_hex');

function add_custom_hidden_fields($form_tag)
{
	if ($form_tag['name'] === 'evento_nome') {
		$form_tag['values'][] = isset($_GET['evento']) ? sanitize_text_field($_GET['evento']) : '';
	}
	if ($form_tag['name'] === 'evento_data') {
		$form_tag['values'][] = isset($_GET['data']) ? sanitize_text_field($_GET['data']) : '';
	}
	return $form_tag;
}
add_filter('wpcf7_form_tag', 'add_custom_hidden_fields');

function register_polylang_strings()
{
	if (function_exists('pll_register_string')) {
		pll_register_string('filter_h7', 'H-7', 'Filter Item');
		pll_register_string('filter_tf7', 'TF-7', 'Filter Item');
		pll_register_string('filter_revestik', 'Revestik', 'Filter Item');
		pll_register_string('filter_xadrez', 'Pigmento em Pó Xadrez', 'Filter Item');
		pll_register_string('filter_remox', 'Remox', 'Filter Item');
		pll_register_string('filter_poxipol', 'Poxipol / Poxilina', 'Filter Item');
	}
}
add_action('init', 'register_polylang_strings');

add_action('phpmailer_init', 'my_phpmailer_smtp');
function my_phpmailer_smtp($phpmailer)
{
	$phpmailer->isSMTP();
	$phpmailer->Host = SMTP_SERVER;
	$phpmailer->SMTPAuth = SMTP_AUTH;
	$phpmailer->Port = SMTP_PORT;
	$phpmailer->Username = SMTP_USERNAME;
	$phpmailer->Password = SMTP_PASSWORD;
	$phpmailer->SMTPSecure = SMTP_SECURE;
	$phpmailer->From = SMTP_FROM;
	$phpmailer->FromName = SMTP_NAME;
}


function custom_meta_title()
{
	if (is_front_page()) {
		echo "Illumina";
	} else {
		echo wp_title('', false) . " - Illumina";
	}
}

function ativar_pesquisa_uma_letra($block_searches)
{
	return false;
}
add_filter('relevanssi_block_one_letter_searches', 'ativar_pesquisa_uma_letra');


// add_action('init', function () {
//     if (isset($_GET['lang'])) {
//         $locale = sanitize_text_field($_GET['lang']);
//         switch_to_locale($locale);
//     }
// });