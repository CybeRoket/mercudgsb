<?php

function load_stylesheets()
{

	wp_register_style( 'Bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), false, 'all');
	wp_enqueue_style('Bootstrap');

	wp_register_style( 'UniversLTStd', get_template_directory_uri() . '/font/UniversLTStd/UniversLTStd.ttf', array(), null );
	wp_enqueue_style('UniversLTStd');

	wp_register_style( 'UniversLTStd-Bold', get_template_directory_uri() . '/font/UniversLTStd/UniversLTStd-Bold.ttf', array(), null );
	wp_enqueue_style('UniversLTStd-Bold');

	wp_register_style( 'Owl_Carouselcss', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), false, 'all' );
	wp_enqueue_style('Owl_Carouselcss');

	wp_register_style('style', get_template_directory_uri() . '/style.css', array(), 1.0, 'all');
	wp_enqueue_style('style');

	wp_register_style('main_style', get_template_directory_uri() . '/css/main.css', array(), 1.0, 'all');
	wp_enqueue_style('main_style');

}
add_action('wp_enqueue_scripts', 'load_stylesheets');


function include_jquery()
{
	wp_deregister_script('jquery');

	wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', null, null, true );
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'include_jquery');


function loadjs()
{
	wp_register_script( 'Bootstrapjs', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', null, null, true );
	wp_enqueue_script('Bootstrapjs');

	wp_register_script( 'Owl_Carouseljs', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', null, null, true );
	wp_enqueue_script('Owl_Carouseljs');

	wp_register_script( 'Font_Awesomejs', 'https://kit.fontawesome.com/a32cf9c921.js', null, null, false );
	wp_enqueue_script('Font_Awesomejs');

	wp_register_script('mainjs', get_template_directory_uri() . '/js/main.js', null, 1.0, true);
	wp_enqueue_script('mainjs');

}
add_action('wp_enqueue_scripts', 'loadjs');



// theme supports
add_theme_support('menus');

add_theme_support('title-tag');

add_theme_support('post-thumbnails');

add_image_size('smallest', 400, 400, true);



// register nav menu
register_nav_menus(
	array(
		'header-menu' => __('Header Menu', 'theme'),
		'footer-menu' => __('Footer Menu', 'theme'),
		'social-menu' => __('Social Menu', 'theme'),
	)
);


// register bootstrap navbar class in wp
/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );


// post navigation custom
function wpdocs_add_post_link( $html ){
    $html = str_replace( '<a ', '<a class="page-link" ', $html );
    return $html;
}
add_filter( 'next_post_link', 'wpdocs_add_post_link' );
add_filter( 'previous_post_link', 'wpdocs_add_post_link' );



/**
* Add fields to General Settings page
*
* @reference
*/

$nf_reg = new General_Settings_Field('reg', 'Company Registration');
$nf_phone = new General_Settings_Field('phone', 'Company Tel Number');
$nf_email = new General_Settings_Field('email', 'Company Email');
$nf_street = new General_Settings_Field('street', 'Rua');
$nf_neighborhood = new General_Settings_Field('neighborhood', 'Bairro');
$nf_cep = new General_Settings_Field('zipcode', 'CEP');
$nf_city = new General_Settings_Field('city', 'Cidade');
$nf_state = new General_Settings_Field('state', 'Estado');

$nf_reg->init();
$nf_phone->init();
$nf_email->init();
$nf_street->init();
$nf_neighborhood->init();
$nf_cep->init();
$nf_city->init();
$nf_state->init();

class General_Settings_Field {

protected $name;
protected $value;

public function __construct($name, $value = null)
{
$this->setName($name);

if ($value == null)
$this->setValue( $name );
else
$this->setValue( $value );
}

public function setName($name) {
$this->name = $name;
}

public function setValue($value) {
$this->value = $value;
}

public function getName() {
return $this->name;
}

public function getValue() {
return $this->value;
}

public function init() {
add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
}

public function register_fields()
{
register_setting( 'general', $this->getName(), 'esc_attr' );
add_settings_field( $this->getName(), '<label for="'.$this->getName().'">'.__( ucfirst($this->getValue() ) , $this->getName() ).'</label>' , array(&$this, 'fields_html') , 'general' );
}

public function fields_html()
{
echo '<input type="text" name="'.$this->getName().'" value="'. get_option( $this->getName(), '' ) . '" >';
}

}

/**
* Function so we can get info from our WP Settings page (bloginfo) via a shortcode – e.g., [bloginfo key="fav_color"]
*/

function handle_shortcode_bloginfo($field)
{
return get_option($field['key']);
}
add_shortcode( 'bloginfo', 'handle_shortcode_bloginfo' );