<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <div class="topbar">
        <div class="container">
            <div class="topbar__body">
                <div class="topbar__lang" >
                    <?php
                    if ( function_exists( 'pll_the_languages' ) ) {
                        $languages = pll_the_languages( array( 'dropdown' => 0, 'raw' => 1 ) );
                        if ( ! empty( $languages ) ) {
                            $langs_output = array();
                            foreach ( $languages as $lang ) {
                                $class = $lang['current_lang'] ? 'selected_lang' : '';
                                $name = strtoupper( $lang['slug'] );
                                if ( $name === 'KK' || $name === 'KZ' ) {
                                    $name = 'ҚАЗ';
                                } elseif ( $name === 'RU' ) {
                                    $name = 'РУС';
                                }
                                $langs_output[] = sprintf(
                                    '<a href="%s" class="%s">%s</a>',
                                    esc_url( $lang['url'] ),
                                    esc_attr( $class ),
                                    esc_html( $name )
                                );
                            }
                            echo implode( '<span class="topbar__divider"></span>', $langs_output );
                        }
                    } else {
                        ?>
                        <a href="#!">ҚАЗ</a>
                        <span class="topbar__divider"></span>
                        <a href="#!" class="selected_lang">РУС</a>
                        <?php
                    }
                    ?>
                </div>
                <div class="topbar__social">
                    <?php
                    $instagram = function_exists( 'get_field' ) ? get_field( 'social_instagram', 'option' ) : '';
                    $twitter   = function_exists( 'get_field' ) ? get_field( 'social_twitter', 'option' ) : '';
                    $whatsapp  = function_exists( 'get_field' ) ? get_field( 'social_whatsapp', 'option' ) : '';
                    $mailru    = function_exists( 'get_field' ) ? get_field( 'social_mailru', 'option' ) : '';

                    if ( $instagram ) : ?>
                        <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/instagram.svg" alt="instagram"></a>
                    <?php endif; ?>
                    <?php if ( $twitter ) : ?>
                        <a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/twitter.svg" alt="twitter"></a>
                    <?php endif; ?>
                    <?php if ( $whatsapp ) : ?>
                        <a href="<?php echo esc_url( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/whatsapp.svg" alt="whatsapp"></a>
                    <?php endif; ?>
                    <?php if ( $mailru ) : ?>
                        <a href="<?php echo esc_url( $mailru ); ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/mailru.svg" alt="mailru"></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <div class="header__body">
                <?php
                $site_logo = function_exists( 'get_field' ) ? get_field( 'site_logo', 'option' ) : '';
                if ( ! $site_logo ) {
                    $site_logo = get_template_directory_uri() . '/assets/img/logo.webp';
                }
                $cur_lang = function_exists( 'pll_current_language' ) ? pll_current_language() : '';
                $is_kk = in_array( $cur_lang, array( 'kk', 'kz' ), true );

                if ( $is_kk && function_exists( 'get_field' ) ) {
                    // Temporarily remove language filter to read from global options
                    remove_filter( 'acf/settings/current_language', 'ohotzooprom_acf_current_language' );
                    $logo_title = get_field( 'logo_title_kk', 'option' );
                    $logo_subtitle = get_field( 'logo_subtitle_kk', 'option' );
                    add_filter( 'acf/settings/current_language', 'ohotzooprom_acf_current_language' );

                    if ( ! $logo_title )    { $logo_title    = '«Охотзоопром» ӨБ'; }
                    if ( ! $logo_subtitle ) { $logo_subtitle = 'РМҚК - Орман шаруашылығы<br>және жануарлар дүниесі комитеті'; }
                } else {
                    $logo_title    = function_exists( 'get_field' ) ? get_field( 'logo_title', 'option' ) : '';
                    $logo_subtitle = function_exists( 'get_field' ) ? get_field( 'logo_subtitle', 'option' ) : '';

                    if ( ! $logo_title )    { $logo_title    = 'ПО «Охотзоопром»'; }
                    if ( ! $logo_subtitle ) { $logo_subtitle = 'РГКП - Комитет лесного хозяйства<br>и животного мира'; }
                }
                ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo">
                    <img src="<?php echo esc_url( $site_logo ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>">
                    <div class="header__logo-text">
                        <div class="header__logo-title"><?php echo esc_html( $logo_title ); ?></div>
                        <div class="header__logo-subtitle"><?php echo wp_kses_post( $logo_subtitle ); ?></div>
                    </div>
                </a>
                <nav class="header__nav">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-primary',
                            'menu_class'     => 'header__menu',
                            'container'      => false,
                            'fallback_cb'    => false,
                        )
                    );
                    ?>
                </nav>
                <div class="header__actions">
                    <button class="search-btn" aria-label="Поиск">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4A7A32" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                    <button class="burger-btn" aria-label="Открыть меню" id="burgerBtn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </header>
