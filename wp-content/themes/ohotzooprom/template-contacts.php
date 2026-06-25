<?php
/**
 * Template Name: Контакты
 *
 * @package Ohotzooprom
 */

get_header();

    $logo_title = function_exists( 'get_field' ) ? get_field( 'logo_title', 'option' ) : '';
    $contact_address = function_exists( 'get_field' ) ? get_field( 'contact_address', 'option' ) : '';
    $contact_phone = function_exists( 'get_field' ) ? get_field( 'contact_phone', 'option' ) : '';
    $contact_phone_raw = function_exists( 'get_field' ) ? get_field( 'contact_phone_raw', 'option' ) : '';
    $contact_email = function_exists( 'get_field' ) ? get_field( 'contact_email', 'option' ) : '';
    $contact_hours = function_exists( 'get_field' ) ? get_field( 'contact_hours', 'option' ) : '';
    $contact_map_btn_text = function_exists( 'get_field' ) ? get_field( 'contact_map_btn_text', 'option' ) : '';
    $contact_map_link = function_exists( 'get_field' ) ? get_field( 'contact_map_link', 'option' ) : '';
    $yandex_map_link = function_exists( 'get_field' ) ? get_field( 'yandex_map_link', 'option' ) : '';
    $contact_map_iframe = function_exists( 'get_field' ) ? get_field( 'contact_map_iframe', 'option' ) : '';
?>

    <section class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumbs__list">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumbs__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Главная' ) : __( 'Главная', 'ohotzooprom' ); ?></a></li>
                <li class="breadcrumbs__separator">/</li>
                <li class="breadcrumbs__current"><?php the_title(); ?></li>
            </ul>
        </div>
    </section>

    <section class="contacts-hero">
        <div class="container contacts-hero__container">
            <div class="contacts-hero__badge">
                <?php echo esc_html( $logo_title ? $logo_title : ( function_exists( 'pll__' ) ? pll__( 'ПО «Охотзоопром»' ) : __( 'ПО «Охотзоопром»', 'ohotzooprom' ) ) ); ?> · <?php echo function_exists( 'pll__' ) ? pll__( 'РЕСПУБЛИКА КАЗАХСТАН' ) : __( 'РЕСПУБЛИКА КАЗАХСТАН', 'ohotzooprom' ); ?>
            </div>
            <h1 class="contacts-hero__title"><?php the_title(); ?></h1>
            <p class="contacts-hero__desc">
                <?php
                if ( has_excerpt() ) {
                    echo esc_html( get_the_excerpt() );
                } else {
                    echo function_exists( 'pll__' ) ? pll__( 'Контактные данные, режим работы и схема проезда в территориальные подразделения предприятия.' ) : __( 'Контактные данные, режим работы и схема проезда в территориальные подразделения предприятия.', 'ohotzooprom' );
                }
                ?>
            </p>
        </div>
    </section>

    <main class="contacts-section">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();
                if ( get_the_content() ) :
                    ?>
                    <div class="contacts-editor-content" style="margin-bottom: 40px; line-height: 1.6;">
                        <?php the_content(); ?>
                    </div>
                    <?php
                endif;
            endwhile;
            ?>

            <div class="contacts-grid">
                <!-- Contact info Card -->
                <div class="contact-card">
                    <h2 class="contact-card__title"><?php echo esc_html( $logo_title ? $logo_title : ( function_exists( 'pll__' ) ? pll__( 'ПО «Охотзоопром»' ) : __( 'ПО «Охотзоопром»', 'ohotzooprom' ) ) ); ?></h2>
                    <ul class="contact-info-list">
                        <!-- Address -->
                        <?php if ( $contact_address ) : ?>
                            <li class="contact-info-item">
                                <div class="contact-info-icon contact-info-icon--address">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#d32f2f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                                <div class="contact-info-text">
                                    <span class="contact-info-label"><?php echo function_exists( 'pll__' ) ? pll__( 'Адрес' ) : __( 'Адрес', 'ohotzooprom' ); ?></span>
                                    <span class="contact-info-value"><?php echo esc_html( $contact_address ); ?></span>
                                </div>
                            </li>
                        <?php endif; ?>
                        
                        <!-- Phone -->
                        <?php if ( $contact_phone ) : ?>
                            <li class="contact-info-item">
                                <div class="contact-info-icon contact-info-icon--phone">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4a7a32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                </div>
                                <div class="contact-info-text">
                                    <span class="contact-info-label"><?php echo function_exists( 'pll__' ) ? pll__( 'Телефон' ) : __( 'Телефон', 'ohotzooprom' ); ?></span>
                                    <a href="tel:<?php echo esc_attr( $contact_phone_raw ? $contact_phone_raw : preg_replace('/[^0-9+]/', '', $contact_phone) ); ?>" class="contact-info-value contact-link"><?php echo esc_html( $contact_phone ); ?></a>
                                </div>
                            </li>
                        <?php endif; ?>
                        
                        <!-- Email -->
                        <?php if ( $contact_email ) : ?>
                            <li class="contact-info-item">
                                <div class="contact-info-icon contact-info-icon--email">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1976d2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </div>
                                <div class="contact-info-text">
                                    <span class="contact-info-label"><?php echo function_exists( 'pll__' ) ? pll__( 'Email' ) : __( 'Email', 'ohotzooprom' ); ?></span>
                                    <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="contact-info-value contact-link"><?php echo esc_html( $contact_email ); ?></a>
                                </div>
                            </li>
                        <?php endif; ?>
                        
                        <!-- Working Hours -->
                        <?php if ( $contact_hours ) : ?>
                            <li class="contact-info-item">
                                <div class="contact-info-icon contact-info-icon--hours">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#e67e22" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                </div>
                                <div class="contact-info-text">
                                    <span class="contact-info-label"><?php echo function_exists( 'pll__' ) ? pll__( 'Режим работы' ) : __( 'Режим работы', 'ohotzooprom' ); ?></span>
                                    <span class="contact-info-value"><?php echo esc_html( $contact_hours ); ?></span>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Map Canvas -->
                <div class="contacts-map-container">
                    <?php if ( $contact_map_iframe ) : ?>
                        <div class="contacts-map-canvas contacts-map-canvas--iframe">
                            <?php echo $contact_map_iframe; ?>
                        </div>
                    <?php elseif ( $yandex_map_link ) : ?>
                        <a href="<?php echo esc_url( $yandex_map_link ); ?>" target="_blank" rel="noopener" class="contacts-map-canvas" style="display: flex;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#2e5a1c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" fill="#355627"></path>
                                <circle cx="12" cy="10" r="3" fill="#cad9c0"></circle>
                            </svg>
                        </a>
                    <?php else : ?>
                        <div class="contacts-map-canvas">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#2e5a1c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" fill="#355627"></path>
                                <circle cx="12" cy="10" r="3" fill="#cad9c0"></circle>
                            </svg>
                        </div>
                    <?php endif; ?>
                    <?php if ( $contact_map_link ) : ?>
                        <a href="<?php echo esc_url( $contact_map_link ); ?>" class="contacts-map-link">
                            <?php echo esc_html( $contact_map_btn_text ? $contact_map_btn_text : ( function_exists( 'pll__' ) ? pll__( 'Схема проезда в территориальные подразделения →' ) : __( 'Схема проезда в территориальные подразделения →', 'ohotzooprom' ) ) ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

<?php
get_footer();
