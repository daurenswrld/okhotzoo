<?php
/**
 * ПО «Охотзоопром» Theme Functions and Definitions
 *
 * @package Ohotzooprom
 */

if ( ! function_exists( 'ohotzooprom_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function ohotzooprom_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-primary' => esc_html__( 'Primary Menu', 'ohotzooprom' ),
            )
        );

        /*
         * Switch default core markup for search form, comment form, comments,
         * galleries, etc. to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
    }
endif;
add_action( 'after_setup_theme', 'ohotzooprom_setup' );

/**
 * Enqueue scripts and styles.
 */
function ohotzooprom_scripts() {
    $theme_dir = get_template_directory();

    // Load main theme stylesheet — version based on file modification time (auto cache-bust)
    $css_ver = file_exists( $theme_dir . '/style.css' )
        ? filemtime( $theme_dir . '/style.css' )
        : '1.0.0';
    wp_enqueue_style( 'ohotzooprom-style', get_stylesheet_uri(), array(), $css_ver );

    // Load custom scripts — version based on file modification time
    $js_ver = file_exists( $theme_dir . '/assets/js/main.js' )
        ? filemtime( $theme_dir . '/assets/js/main.js' )
        : '1.0.0';
    wp_enqueue_script( 'ohotzooprom-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), $js_ver, true );
}
add_action( 'wp_enqueue_scripts', 'ohotzooprom_scripts' );

/**
 * Enqueue Custom Admin & Login Styles
 */
function ohotzooprom_admin_styles() {
    // Load Google Font in Admin Panel
    wp_enqueue_style( 'ohotzooprom-admin-font', 'https://fonts.googleapis.com/css2?family=Geologica:wght,CRSV@100..900,0&display=swap', array(), null );
    
    // Load Admin Custom CSS
    wp_enqueue_style( 'ohotzooprom-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', array(), '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'ohotzooprom_admin_styles' );
add_action( 'login_enqueue_scripts', 'ohotzooprom_admin_styles' );

/**
 * Customize WordPress Login Logo URL and Title
 */
add_filter( 'login_headerurl', 'ohotzooprom_login_logo_url' );
function ohotzooprom_login_logo_url() {
    return home_url();
}

add_filter( 'login_headertext', 'ohotzooprom_login_logo_url_title' );
function ohotzooprom_login_logo_url_title() {
    return __( 'ПО «Охотзоопром»', 'ohotzooprom' );
}



/**
 * Add custom footer text in Admin Panel
 */
add_filter( 'admin_footer_text', 'ohotzooprom_admin_footer_text' );
function ohotzooprom_admin_footer_text() {
    return 'Сделано в <a href="https://ziz.kz" target="_blank" rel="noopener">ZIZ Inc.</a>';
}

/**
 * Disable comments globally
 */
// Disable support for comments and trackbacks in post types
add_action( 'admin_init', 'ohotzooprom_disable_comments_post_types_support' );
function ohotzooprom_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ( $post_types as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
}

// Close comments on the front-end
add_filter( 'comments_open', 'ohotzooprom_disable_comments_status', 20, 2 );
add_filter( 'pings_open', 'ohotzooprom_disable_comments_status', 20, 2 );
function ohotzooprom_disable_comments_status() {
    return false;
}

// Hide existing comments
add_filter( 'comments_array', 'ohotzooprom_disable_comments_hide_existing', 10, 2 );
function ohotzooprom_disable_comments_hide_existing( $comments ) {
    return array();
}

// Remove comments page from admin menu
add_action( 'admin_menu', 'ohotzooprom_disable_comments_admin_menu' );
function ohotzooprom_disable_comments_admin_menu() {
    remove_menu_page( 'edit-comments.php' );
}

// Redirect any user trying to access comments page directly
add_action( 'admin_init', 'ohotzooprom_disable_comments_admin_menu_redirect' );
function ohotzooprom_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ( $pagenow === 'edit-comments.php' ) {
        wp_redirect( admin_url() );
        exit;
    }
}

// Remove comments links from admin bar
add_action( 'init', 'ohotzooprom_disable_comments_admin_bar' );
function ohotzooprom_disable_comments_admin_bar() {
    if ( is_admin_bar_showing() ) {
        remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
    }
}

/**
 * Redirect info-block category archives to the news page with ?cat= filter
 */
add_action( 'template_redirect', 'ohotzooprom_redirect_info_categories' );
function ohotzooprom_redirect_info_categories() {
    $redirect_cat_slugs = array( 'obyavleniya', 'informaciya-grazhdanam' );
    if ( is_category() ) {
        $cat = get_queried_object();
        if ( $cat && in_array( $cat->slug, $redirect_cat_slugs, true ) ) {
            $news_pages = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'news.php' ) );
            if ( ! empty( $news_pages ) ) {
                $url = add_query_arg( 'cat', $cat->slug, get_permalink( $news_pages[0]->ID ) );
                wp_redirect( $url, 301 );
                exit;
            }
        }
    }
}

/**
 * Register default strings for Polylang translation
 */
add_action( 'init', 'ohotzooprom_register_polylang_strings' );
function ohotzooprom_register_polylang_strings() {
    if ( function_exists( 'pll_register_string' ) ) {
        // General strings
        pll_register_string( 'main_news', 'Главная новость', 'Ohotzooprom Theme' );

        // Info blocks (homepage + news filter)
        pll_register_string( 'info_official_announcements', 'Официальные объявления', 'Ohotzooprom Info Blocks' );
        pll_register_string( 'info_citizens_info', 'Информация гражданам', 'Ohotzooprom Info Blocks' );
        pll_register_string( 'info_all_announcements', 'Все объявления', 'Ohotzooprom Info Blocks' );
        pll_register_string( 'info_all_citizens', 'Вся информация', 'Ohotzooprom Info Blocks' );
        pll_register_string( 'info_all_news', 'Все новости', 'Ohotzooprom Info Blocks' );

        // Documents page & sections
        pll_register_string( 'doc_desc_fallback', 'Нормативная база, отчёты и открытые данные предприятия.', 'Ohotzooprom Documents' );
        pll_register_string( 'doc_all', 'Все', 'Ohotzooprom Documents' );
        pll_register_string( 'doc_search', 'Поиск', 'Ohotzooprom Documents' );
        pll_register_string( 'doc_download', 'Скачать PDF', 'Ohotzooprom Documents' );
        
        // Procurement page & sections
        pll_register_string( 'proc_num', '№', 'Ohotzooprom Procurement' );
        pll_register_string( 'proc_subject', 'Предмет закупки', 'Ohotzooprom Procurement' );
        pll_register_string( 'proc_sum_tng_ru', 'Сумма (тнг)', 'Ohotzooprom Procurement' );
        pll_register_string( 'proc_sum_tng_symbol', 'Сумма (₸)', 'Ohotzooprom Procurement' );
        pll_register_string( 'proc_method', 'Способ', 'Ohotzooprom Procurement' );
        pll_register_string( 'proc_deadline', 'Срок подачи', 'Ohotzooprom Procurement' );
        pll_register_string( 'proc_status', 'Статус', 'Ohotzooprom Procurement' );
        
        pll_register_string( 'proc_open', 'Открыт', 'Ohotzooprom Procurement' );
        pll_register_string( 'proc_planned', 'Планируется', 'Ohotzooprom Procurement' );
        pll_register_string( 'proc_closed', 'Завершен', 'Ohotzooprom Procurement' );
        
        pll_register_string( 'proc_goszakup_btn', 'Все закупки на goszakup.gov.kz →', 'Ohotzooprom Procurement' );
        pll_register_string( 'proc_title', 'Государственные закупки', 'Ohotzooprom Procurement' );
        
        // Contacts
        pll_register_string( 'contact_title', 'Контакты', 'Ohotzooprom Contacts' );
        pll_register_string( 'contact_addr_label', 'Адрес', 'Ohotzooprom Contacts' );
        pll_register_string( 'contact_phone_label', 'Телефон', 'Ohotzooprom Contacts' );
        pll_register_string( 'contact_email_label', 'Email', 'Ohotzooprom Contacts' );
        pll_register_string( 'contact_hours_label', 'Режим работы', 'Ohotzooprom Contacts' );
        pll_register_string( 'contact_home_breadcrumb', 'Главная', 'Ohotzooprom Contacts' );
        pll_register_string( 'contact_fallback_desc', 'Контактные данные, режим работы и схема проезда в территориальные подразделения предприятия.', 'Ohotzooprom Contacts' );
        pll_register_string( 'contact_map_link_text', 'Схема проезда в территориальные подразделения →', 'Ohotzooprom Contacts' );
        pll_register_string( 'contact_country', 'РЕСПУБЛИКА КАЗАХСТАН', 'Ohotzooprom Contacts' );

        // Footer strings
        pll_register_string( 'footer_title_about', 'О предприятии', 'Ohotzooprom Footer' );
        pll_register_string( 'footer_history', 'История', 'Ohotzooprom Footer' );
        pll_register_string( 'footer_management', 'Руководство', 'Ohotzooprom Footer' );
        pll_register_string( 'footer_structure', 'Структура', 'Ohotzooprom Footer' );
        pll_register_string( 'footer_departments', 'Подразделения', 'Ohotzooprom Footer' );
        
        pll_register_string( 'footer_title_docs', 'Документы', 'Ohotzooprom Footer' );
        pll_register_string( 'footer_normative', 'Нормативная база', 'Ohotzooprom Footer' );
        pll_register_string( 'footer_reports', 'Отчёты', 'Ohotzooprom Footer' );
        pll_register_string( 'footer_data', 'Открытые данные', 'Ohotzooprom Footer' );
        pll_register_string( 'footer_goszakup', 'Госзакупки', 'Ohotzooprom Footer' );
        
        pll_register_string( 'footer_title_appeals', 'Обращения', 'Ohotzooprom Footer' );
        pll_register_string( 'footer_create_appeal', 'Написать обращение', 'Ohotzooprom Footer' );
        pll_register_string( 'footer_contacts', 'Контакты', 'Ohotzooprom Footer' );

        // About Page Fallbacks & Static UI Strings
        pll_register_string( 'about_tab_history', 'История', 'Ohotzooprom About' );
        pll_register_string( 'about_tab_mission', 'Миссия и цели', 'Ohotzooprom About' );
        pll_register_string( 'about_tab_management', 'Руководство', 'Ohotzooprom About' );
        pll_register_string( 'about_tab_structure', 'Структура', 'Ohotzooprom About' );
        pll_register_string( 'about_tab_departments', 'Подразделения', 'Ohotzooprom About' );
        
        // 404 Page Strings
        pll_register_string( '404_title', 'Страница не найдена', 'Ohotzooprom 404' );
        pll_register_string( '404_subtitle', 'Степная тропа ведет в тупик...', 'Ohotzooprom 404' );
        pll_register_string( '404_description', 'Похоже, эта страница скрылась в зарослях саксаула или убежала быстрее сайгака. Попробуйте вернуться на главную страницу.', 'Ohotzooprom 404' );
        pll_register_string( '404_button', 'Вернуться на главную', 'Ohotzooprom 404' );

        // Documents Page Strings
        pll_register_string( 'documents_breadcrumbs_home', 'Главная', 'Ohotzooprom Documents' );
        pll_register_string( 'documents_hero_badge', 'РГКП «ПО ОХОТЗООПРОМ» · РЕСПУБЛИКА КАЗАХСТАН', 'Ohotzooprom Documents' );

        // News Page Strings
        pll_register_string( 'news_title', 'Новости', 'Ohotzooprom News' );
        pll_register_string( 'news_featured_badge', 'Главная новость', 'Ohotzooprom News' );
        pll_register_string( 'news_more', 'Подробнее', 'Ohotzooprom News' );
        pll_register_string( 'news_not_found', 'Новости не найдены.', 'Ohotzooprom News' );
        // Деятельность
        pll_register_string('Activity', 'Деятельность', 'Ohotzooprom');
        pll_register_string('Main directions', 'Основные направления деятельности', 'Ohotzooprom');
        pll_register_string('Our Achievements', 'Наши достижения', 'Ohotzooprom');
    }
}

/**
 * Register ACF Option Page
 */
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( array(
        'page_title' => 'Основные настройки',
        'menu_title' => 'Основные настройки',
        'menu_slug'  => 'general',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ) );
}

/**
 * Translate ACF Options page with Polylang
 */
function ohotzooprom_acf_current_language( $lang ) {
    if ( function_exists( 'pll_current_language' ) ) {
        return pll_current_language();
    }
    return $lang;
}
add_filter( 'acf/settings/current_language', 'ohotzooprom_acf_current_language' );

/**
 * Fallback to global options values if language-specific values are empty
 */
add_filter( 'acf/load_value', 'ohotzooprom_acf_options_fallback', 10, 3 );
function ohotzooprom_acf_options_fallback( $value, $post_id, $field ) {
    if ( is_string( $post_id ) && strpos( $post_id, 'options_' ) === 0 && ( $value === null || $value === '' || $value === false || empty( $value ) ) ) {
        remove_filter( 'acf/settings/current_language', 'ohotzooprom_acf_current_language' );
        $global_value = get_field( $field['name'], 'option' );
        add_filter( 'acf/settings/current_language', 'ohotzooprom_acf_current_language' );
        
        if ( ! empty( $global_value ) ) {
            $value = $global_value;
        }
    }
    return $value;
}

/**
 * Add active class to nav menu links
 */
add_filter( 'nav_menu_link_attributes', 'ohotzooprom_nav_menu_link_attributes', 10, 4 );
function ohotzooprom_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
    if ( isset( $args->theme_location ) && $args->theme_location === 'menu-primary' ) {
        $active_classes = array(
            'current-menu-item',
            'current-menu-ancestor',
            'current-menu-parent',
            'current_page_item',
            'current_page_parent',
            'current_page_ancestor'
        );
        $is_active = false;
        foreach ( $active_classes as $class ) {
            if ( in_array( $class, $item->classes ) ) {
                $is_active = true;
                break;
            }
        }
        if ( $is_active ) {
            if ( isset( $atts['class'] ) ) {
                $atts['class'] .= ' active';
            } else {
                $atts['class'] = 'active';
            }
        }
    }
    return $atts;
}

/**
 * Add menu arrow to parent menu links
 */
add_filter( 'nav_menu_item_title', 'ohotzooprom_nav_menu_item_title', 10, 4 );
function ohotzooprom_nav_menu_item_title( $title, $item, $args, $depth ) {
    if ( isset( $args->theme_location ) && $args->theme_location === 'menu-primary' ) {
        if ( in_array( 'menu-item-has-children', $item->classes ) ) {
            $title .= ' <span class="menu-arrow">▼</span>';
        }
    }
    return $title;
}




