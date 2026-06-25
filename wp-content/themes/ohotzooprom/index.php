<?php
/**
 * Template Name: Главная
 *
 * @package Ohotzooprom
 */

get_header();
?>

    <?php
        $hero_badge = function_exists( 'get_field' ) ? get_field( 'hero_badge' ) : '';
        $hero_title = function_exists( 'get_field' ) ? get_field( 'hero_title' ) : '';
        $hero_subtitle = function_exists( 'get_field' ) ? get_field( 'hero_subtitle' ) : '';
        $hero_btn1_text = function_exists( 'get_field' ) ? get_field( 'hero_btn1_text' ) : '';
        $hero_btn1_link = function_exists( 'get_field' ) ? get_field( 'hero_btn1_link' ) : '';
        if ( $hero_btn1_link ) {
            $hero_btn1_link = user_trailingslashit( home_url( $hero_btn1_link ) );
        }
        $hero_btn2_text = function_exists( 'get_field' ) ? get_field( 'hero_btn2_text' ) : '';
        $hero_btn2_link = function_exists( 'get_field' ) ? get_field( 'hero_btn2_link' ) : '';
        if ( $hero_btn2_link ) {
            $hero_btn2_link = user_trailingslashit( home_url( $hero_btn2_link ) );
        }
    ?>
    <section class="hero">
        <div class="container hero__container">
            <div class="hero__circles-wrapper">
                <svg class="hero__circles" width="800" height="800" viewBox="0 0 800 800" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="400" cy="400" r="180" stroke="rgba(255, 255, 255, 0.03)" stroke-width="1.5"/>
                    <circle cx="400" cy="400" r="280" stroke="rgba(255, 255, 255, 0.03)" stroke-width="1.5"/>
                    <circle cx="400" cy="400" r="380" stroke="rgba(255, 255, 255, 0.03)" stroke-width="1.5"/>
                </svg>
            </div>
            
            <div class="hero__content">
                <?php if ( $hero_badge ) : ?>
                    <div class="hero__badge">
                        <span class="hero__badge-line"></span>
                        <span class="hero__badge-text"><?php echo esc_html( $hero_badge ); ?></span>
                    </div>
                <?php endif; ?>
                <?php if ( $hero_title ) : ?>
                    <h1 class="hero__title"><?php echo wp_kses_post( $hero_title ); ?></h1>
                <?php endif; ?>
                <?php if ( $hero_subtitle ) : ?>
                    <p class="hero__subtitle"><?php echo wp_kses_post( $hero_subtitle ); ?></p>
                <?php endif; ?>
                <div class="hero__buttons">
                    <?php if ( $hero_btn1_text && $hero_btn1_link ) : ?>
                        <a href="<?php echo esc_url( $hero_btn1_link ); ?>" class="btn btn--primary"><?php echo esc_html( $hero_btn1_text ); ?></a>
                    <?php endif; ?>
                    <?php if ( $hero_btn2_text && $hero_btn2_link ) : ?>
                        <a href="<?php echo esc_url( $hero_btn2_link ); ?>" class="btn btn--outline"><?php echo esc_html( $hero_btn2_text ); ?> <span class="arrow">→</span></a>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="hero__stats">
                <div class="stats-grid">
                    <?php
                    $stats = function_exists( 'get_field' ) ? get_field( 'hero_stats' ) : null;
                    if ( $stats && is_array( $stats ) ) :
                        foreach ( $stats as $stat ) :
                            $num = isset( $stat['stat_number'] ) ? $stat['stat_number'] : '';
                            $suffix = isset( $stat['stat_suffix'] ) ? $stat['stat_suffix'] : '';
                            $label = isset( $stat['stat_label'] ) ? $stat['stat_label'] : '';
                            $suffix_class = ( $suffix === 'лет' || $suffix === 'млн' || $suffix === 'обл.' ) ? 'stat-card__suffix stat-card__suffix--text' : 'stat-card__suffix';
                            ?>
                            <div class="stat-card">
                                <div class="stat-card__number"><?php echo esc_html( $num ); ?><span class="<?php echo esc_attr( $suffix_class ); ?>"><?php echo esc_html( $suffix ); ?></span></div>
                                <div class="stat-card__label"><?php echo wp_kses_post( $label ); ?></div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php
        $directions_title = function_exists( 'get_field' ) ? get_field( 'directions_title' ) : '';
        $directions_btn_text = function_exists( 'get_field' ) ? get_field( 'directions_btn_text' ) : '';
        $directions_btn_link = function_exists( 'get_field' ) ? get_field( 'directions_btn_link' ) : '';
        if ( $directions_btn_link ) {
            $directions_btn_link = user_trailingslashit( home_url( $directions_btn_link ) );
        }
        $directions_list = function_exists( 'get_field' ) ? get_field( 'directions_list' ) : null;
    ?>
    <section class="directions">
        <div class="container">
            <?php if ( $directions_title ) : ?>
                <div class="directions__header">
                    <h2 class="directions__title"><?php echo esc_html( $directions_title ); ?></h2>
                    <?php if ( $directions_btn_text && $directions_btn_link ) : ?>
                        <a href="<?php echo esc_url( $directions_btn_link ); ?>" class="directions__more">
                            <?php echo esc_html( $directions_btn_text ); ?> <span class="arrow">→</span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if ( $directions_list && is_array( $directions_list ) ) : ?>
                <div class="directions__grid">
                    <?php foreach ( $directions_list as $item ) : 
                        $icon = isset( $item['direction_icon'] ) ? $item['direction_icon'] : '';
                        $title = isset( $item['direction_title'] ) ? $item['direction_title'] : '';
                        $text = isset( $item['direction_text'] ) ? $item['direction_text'] : '';
                        ?>
                        <div class="direction-card">
                            <?php if ( $icon ) : ?>
                                <img src="<?php echo esc_url( $icon ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="direction-card__icon">
                            <?php endif; ?>
                            <h3 class="direction-card__title"><?php echo esc_html( $title ); ?></h3>
                            <p class="direction-card__text"><?php echo wp_kses_post( $text ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php
        $news_title = function_exists( 'get_field' ) ? get_field( 'news_title' ) : '';
        $news_btn_text = function_exists( 'get_field' ) ? get_field( 'news_btn_text' ) : '';
        $news_btn_link = function_exists( 'get_field' ) ? get_field( 'news_btn_link' ) : '';
        if ( $news_btn_link ) {
            $news_btn_link = user_trailingslashit( home_url( $news_btn_link ) );
        }
        
        // Info-block category slugs (Russian = canonical) → resolved for current language via Polylang
        $info_slugs = array(
            'obyavleniya'           => array(
                'bullet'     => 'gold',
                'title'      => function_exists( 'pll__' ) ? pll__( 'Официальные объявления' ) : __( 'Официальные объявления', 'ohotzooprom' ),
                'more_label' => function_exists( 'pll__' ) ? pll__( 'Все объявления' )          : __( 'Все объявления', 'ohotzooprom' ),
            ),
            'informaciya-grazhdanam' => array(
                'bullet'     => 'green',
                'title'      => function_exists( 'pll__' ) ? pll__( 'Информация гражданам' ) : __( 'Информация гражданам', 'ohotzooprom' ),
                'more_label' => function_exists( 'pll__' ) ? pll__( 'Вся информация' )       : __( 'Вся информация', 'ohotzooprom' ),
            ),
        );

        // Resolve term IDs for the current Polylang language
        $info_cards    = array();
        $exclude_cat_ids = array();
        foreach ( $info_slugs as $slug => $meta ) {
            $cat = get_category_by_slug( $slug );
            if ( ! $cat ) continue;
            // If Polylang is active, get the translated term for the current language
            $term_id = $cat->term_id;
            if ( function_exists( 'pll_get_term' ) ) {
                $translated_id = pll_get_term( $term_id );
                if ( $translated_id ) { $term_id = $translated_id; }
            }
            $exclude_cat_ids[] = $term_id;
            $info_cards[] = array_merge( $meta, array( 'slug' => $slug, 'term_id' => $term_id ) );
        }

        $news_query = new WP_Query( array(
            'post_type'        => 'post',
            'posts_per_page'   => 3,
            'post_status'      => 'publish',
            'category__not_in' => $exclude_cat_ids,
        ) );
    ?>
    <section class="news">
        <div class="container">
            <?php if ( $news_title ) : ?>
                <div class="news__header">
                    <h2 class="news__title"><?php echo esc_html( $news_title ); ?></h2>
                    <?php if ( $news_btn_text && $news_btn_link ) : ?>
                        <a href="<?php echo esc_url( $news_btn_link ); ?>" class="news__more">
                            <?php echo esc_html( $news_btn_text ); ?> <span class="arrow">→</span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if ( $news_query->have_posts() ) : ?>
                <div class="news__grid">
                    <?php 
                    $counter = 0;
                    while ( $news_query->have_posts() ) : $news_query->the_post();
                        $is_featured = ( $counter === 0 );
                        $card_class = $is_featured ? 'news-card news-card--featured' : 'news-card';
                        $img_class = $is_featured ? 'news-card__image news-card__image--featured' : 'news-card__image news-card__image--secondary';
                        $badge = function_exists( 'get_field' ) ? get_field( 'news_badge', get_the_ID() ) : '';
                        if ( ! $badge && $is_featured ) {
                             $badge = function_exists( 'pll__' ) ? pll__( 'Главная новость' ) : __( 'Главная новость', 'ohotzooprom' );
                        }
                        
                        $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                        if ( ! $thumbnail_url ) {
                            $thumbnail_url = get_template_directory_uri() . '/assets/img/news-bg.webp';
                        }
                        ?>
                        <a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( $card_class ); ?>">
                            <div class="news-card__image-wrapper">
                                <div class="<?php echo esc_attr( $img_class ); ?>" style="background: url('<?php echo esc_url( $thumbnail_url ); ?>') center/cover no-repeat;"></div>
                                <?php if ( $badge ) : ?>
                                    <span class="news-card__badge"><?php echo esc_html( $badge ); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="news-card__content">
                                <div class="news-card__date"><?php echo get_the_date( 'd F Y' ); ?></div>
                                <h3 class="news-card__title"><?php the_title(); ?></h3>
                                <p class="news-card__text"><?php echo wp_strip_all_tags( get_the_excerpt() ); ?></p>
                                <?php if ( ! $is_featured ) : ?>
                                    <span class="news-card__link">Подробнее <span class="arrow">→</span></span>
                                <?php endif; ?>
                            </div>
                        </a>
                        <?php
                        $counter++;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php
    // Check if any info-block card has posts
    $has_any_card = false;
    foreach ( $info_cards as $card ) {
        $test_q = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 1, 'cat' => $card['term_id'], 'fields' => 'ids' ) );
        if ( $test_q->have_posts() ) { $has_any_card = true; break; }
        wp_reset_postdata();
    }
    ?>
    <?php if ( $has_any_card ) : ?>
    <section class="info-blocks">
        <div class="container">
            <div class="info-blocks__grid">
                <?php foreach ( $info_cards as $card ) :
                    $cat_query = new WP_Query( array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                        'cat'            => $card['term_id'],
                    ) );
                    if ( ! $cat_query->have_posts() ) continue;

                    // Link to the news page with category filter (always use Russian slug for ?cat= param)
                    $news_page = get_page_by_path( 'novosti' );
                    if ( ! $news_page ) {
                        $news_pages = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'news.php' ) );
                        $news_page = ! empty( $news_pages ) ? $news_pages[0] : null;
                    }
                    $more_url = $news_page
                        ? add_query_arg( 'cat', $card['slug'], get_permalink( $news_page->ID ) )
                        : get_category_link( $card['term_id'] );
                    ?>
                    <div class="info-card">
                        <div class="info-card__header">
                            <span class="info-card__bullet info-card__bullet--<?php echo esc_attr( $card['bullet'] ); ?>"></span>
                            <h3 class="info-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
                        </div>
                        <div class="info-card__body">
                            <div class="info-card__list">
                                <?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); ?>
                                    <a href="<?php the_permalink(); ?>" class="info-item">
                                        <div class="info-item__date"><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></div>
                                        <div class="info-item__title"><?php the_title(); ?></div>
                                    </a>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                            <a href="<?php echo esc_url( $more_url ); ?>" class="info-card__more">
                                <?php echo esc_html( $card['more_label'] ); ?> <span class="arrow">→</span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
        $about_title = function_exists( 'get_field' ) ? get_field( 'about_title' ) : '';
        $about_text = function_exists( 'get_field' ) ? get_field( 'about_text' ) : '';
        $about_btn_text = function_exists( 'get_field' ) ? get_field( 'about_btn_text' ) : '';
        $about_btn_link = function_exists( 'get_field' ) ? get_field( 'about_btn_link' ) : '';
        if ( $about_btn_link ) {
            $about_btn_link = user_trailingslashit( home_url( $about_btn_link ) );
        }
        $about_stats = function_exists( 'get_field' ) ? get_field( 'about_stats' ) : null;
    ?>
    <section class="about-enterprise">
        <div class="container about-enterprise__container">
            <div class="about-enterprise__content">
                <?php if ( $about_title ) : ?>
                    <h2 class="about-enterprise__title"><?php echo esc_html( $about_title ); ?></h2>
                <?php endif; ?>
                <?php if ( $about_text ) : ?>
                    <p class="about-enterprise__text">
                        <?php echo wp_kses_post( $about_text ); ?>
                    </p>
                <?php endif; ?>
                <?php if ( $about_btn_text && $about_btn_link ) : ?>
                    <a href="<?php echo esc_url( $about_btn_link ); ?>" class="about-enterprise__btn">
                        <?php echo esc_html( $about_btn_text ); ?> <span class="arrow">→</span>
                    </a>
                <?php endif; ?>
            </div>
            
            <?php if ( $about_stats && is_array( $about_stats ) ) : ?>
                <div class="about-enterprise__stats">
                    <div class="about-stats-grid">
                        <?php foreach ( $about_stats as $stat ) :
                            $num = isset( $stat['stat_number'] ) ? $stat['stat_number'] : '';
                            $suffix = isset( $stat['stat_suffix'] ) ? $stat['stat_suffix'] : '';
                            $label = isset( $stat['stat_label'] ) ? $stat['stat_label'] : '';
                            ?>
                            <div class="about-stat-card">
                                <div class="about-stat-card__number">
                                    <?php echo esc_html( $num ); ?>
                                    <?php if ( $suffix ) : ?>
                                        <span class="about-stat-card__suffix"><?php echo esc_html( $suffix ); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="about-stat-card__label"><?php echo wp_kses_post( $label ); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php
        $docs_title = function_exists( 'get_field' ) ? get_field( 'docs_title' ) : '';
        $docs_btn_text = function_exists( 'get_field' ) ? get_field( 'docs_btn_text' ) : '';
        $docs_archive_title = function_exists( 'get_field' ) ? get_field( 'docs_archive_title' ) : '';
        $docs_archive_meta = function_exists( 'get_field' ) ? get_field( 'docs_archive_meta' ) : '';
        
        $docs_page = get_pages( array(
            'meta_key'   => '_wp_page_template',
            'meta_value' => 'template-documents.php',
            'number'     => 1,
        ) );
        $docs_page_id = ! empty( $docs_page ) ? $docs_page[0]->ID : 0;
        if ( $docs_page_id && function_exists( 'pll_get_post' ) ) {
            $docs_page_id = pll_get_post( $docs_page_id );
        }
        $documents_list = array();
        $document_tabs = $docs_page_id && function_exists( 'get_field' ) ? get_field( 'document_tabs', $docs_page_id ) : null;
        if ( $document_tabs && is_array( $document_tabs ) ) {
            foreach ( $document_tabs as $tab ) {
                if ( isset( $tab['tab_documents'] ) && is_array( $tab['tab_documents'] ) ) {
                    foreach ( $tab['tab_documents'] as $doc ) {
                        $documents_list[] = $doc;
                    }
                }
            }
        } else {
            $old_list = $docs_page_id && function_exists( 'get_field' ) ? get_field( 'documents_list', $docs_page_id ) : null;
            if ( $old_list && is_array( $old_list ) ) {
                $documents_list = $old_list;
            }
        }
        $documents_archive_link = user_trailingslashit( home_url( '/documents' ) );
    ?>
    <section class="docs-section">
        <div class="container">
            <?php if ( $docs_title ) : ?>
                <div class="docs-section__header">
                    <h2 class="docs-section__title"><?php echo esc_html( $docs_title ); ?></h2>
                    <?php if ( $docs_btn_text ) : ?>
                        <a href="<?php echo esc_url( $documents_archive_link ); ?>" class="docs-section__more">
                            <?php echo esc_html( $docs_btn_text ); ?> <span class="arrow">→</span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <div class="docs-grid">
                <?php 
                $doc_count = 0;
                if ( $documents_list && is_array( $documents_list ) ) :
                    foreach ( $documents_list as $doc ) :
                        if ( $doc_count >= 7 ) {
                            break;
                        }
                        $title = isset( $doc['doc_title'] ) ? $doc['doc_title'] : '';
                        $meta = isset( $doc['doc_meta'] ) ? $doc['doc_meta'] : '';
                        $file_url = isset( $doc['doc_file'] ) ? $doc['doc_file'] : '';
                        if ( ! $file_url ) {
                            $file_url = '#!';
                        }
                        ?>
                        <a href="<?php echo esc_url( $file_url ); ?>" class="doc-card" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/pdf-icon.webp" alt="PDF" class="doc-card__icon">
                            <div class="doc-card__content">
                                <h3 class="doc-card__title"><?php echo esc_html( $title ); ?></h3>
                                <div class="doc-card__meta"><?php echo esc_html( $meta ); ?></div>
                            </div>
                        </a>
                        <?php
                        $doc_count++;
                    endforeach;
                endif;
                ?>
                <a href="<?php echo esc_url( $documents_archive_link ); ?>" class="doc-card doc-card--archive">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/pdf-icon.webp" alt="PDF" class="doc-card__icon">
                    <div class="doc-card__content">
                        <?php if ( $docs_archive_title ) : ?>
                            <h3 class="doc-card__title"><?php echo esc_html( $docs_archive_title ); ?></h3>
                        <?php endif; ?>
                        <?php if ( $docs_archive_meta ) : ?>
                            <div class="doc-card__meta"><?php echo esc_html( $docs_archive_meta ); ?> <span class="arrow">→</span></div>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <?php
        $procurement_title = function_exists( 'get_field' ) ? get_field( 'procurement_title' ) : '';
        $procurement_btn_text = function_exists( 'get_field' ) ? get_field( 'procurement_btn_text' ) : '';
        $procurement_btn_link = function_exists( 'get_field' ) ? get_field( 'procurement_btn_link' ) : '';
        
        $procurement_page = get_pages( array(
            'meta_key'   => '_wp_page_template',
            'meta_value' => 'template-goszakup.php',
            'number'     => 1,
        ) );
        $procurement_page_id = ! empty( $procurement_page ) ? $procurement_page[0]->ID : 0;
        if ( $procurement_page_id && function_exists( 'pll_get_post' ) ) {
            $procurement_page_id = pll_get_post( $procurement_page_id );
        }
        $purchases_list = $procurement_page_id && function_exists( 'get_field' ) ? get_field( 'purchases_list', $procurement_page_id ) : null;
    ?>
    <section class="procurement-section">
        <div class="container">
            <?php if ( $procurement_title ) : ?>
                <div class="procurement-section__header">
                    <h2 class="procurement-section__title"><?php echo esc_html( $procurement_title ); ?></h2>
                    <?php if ( $procurement_btn_text && $procurement_btn_link ) : ?>
                        <a href="<?php echo esc_url( $procurement_btn_link ); ?>" target="_blank" rel="noopener" class="procurement-section__more">
                            <?php echo esc_html( $procurement_btn_text ); ?> <span class="arrow">→</span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if ( $purchases_list && is_array( $purchases_list ) ) : ?>
                <div class="procurement-table-wrapper">
                    <table class="procurement-table">
                        <thead>
                            <tr>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( '№' ) : __( '№', 'ohotzooprom' ); ?></th>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( 'Предмет закупки' ) : __( 'Предмет закупки', 'ohotzooprom' ); ?></th>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( 'Сумма (тнг)' ) : __( 'Сумма (тнг)', 'ohotzooprom' ); ?></th>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( 'Способ' ) : __( 'Способ', 'ohotzooprom' ); ?></th>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( 'Срок подачи' ) : __( 'Срок подачи', 'ohotzooprom' ); ?></th>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( 'Статус' ) : __( 'Статус', 'ohotzooprom' ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $purch_count = 0;
                            foreach ( $purchases_list as $purch ) :
                                if ( $purch_count >= 3 ) {
                                    break;
                                }
                                $num = isset( $purch['purch_num'] ) ? $purch['purch_num'] : '';
                                $title = isset( $purch['purch_title'] ) ? $purch['purch_title'] : '';
                                $price = isset( $purch['purch_price'] ) ? $purch['purch_price'] : '';
                                $method = isset( $purch['purch_method'] ) ? $purch['purch_method'] : '';
                                $deadline = isset( $purch['purch_deadline'] ) ? $purch['purch_deadline'] : '';
                                $status = isset( $purch['purch_status'] ) ? $purch['purch_status'] : 'open';
                                ?>
                                <tr>
                                    <td class="procurement-table__num"><?php echo esc_html( $num ); ?></td>
                                    <td class="procurement-table__title"><?php echo esc_html( $title ); ?></td>
                                    <td class="procurement-table__price"><?php echo esc_html( $price ); ?></td>
                                    <td><?php echo esc_html( $method ); ?></td>
                                    <td><?php echo esc_html( $deadline ); ?></td>
                                    <td>
                                        <?php if ( $status === 'open' ) : ?>
                                            <span class="status-badge status-badge--open"><?php echo function_exists( 'pll__' ) ? pll__( 'Открыт' ) : __( 'Открыт', 'ohotzooprom' ); ?></span>
                                        <?php elseif ( $status === 'planned' ) : ?>
                                            <span class="status-badge status-badge--planned"><?php echo function_exists( 'pll__' ) ? pll__( 'Планируется' ) : __( 'Планируется', 'ohotzooprom' ); ?></span>
                                        <?php else : ?>
                                            <span class="status-badge status-badge--closed"><?php echo function_exists( 'pll__' ) ? pll__( 'Завершен' ) : __( 'Завершен', 'ohotzooprom' ); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                $purch_count++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php
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
    <section class="contacts-section">
        <div class="container contacts-section__container">
            <div class="contacts-card">
                <h2 class="contacts-card__title"><?php echo function_exists( 'pll__' ) ? pll__( 'Контакты' ) : __( 'Контакты', 'ohotzooprom' ); ?></h2>
                
                <div class="contacts-card__list">
                    <?php if ( $contact_address ) : ?>
                        <div class="contacts-card__item">
                            <div class="contacts-card__icon-wrapper">
                                <svg class="contacts-card__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#db4437"/>
                                </svg>
                            </div>
                            <div class="contacts-card__content">
                                <div class="contacts-card__label"><?php echo function_exists( 'pll__' ) ? pll__( 'Адрес' ) : __( 'Адрес', 'ohotzooprom' ); ?></div>
                                <div class="contacts-card__value"><?php echo esc_html( $contact_address ); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ( $contact_phone ) : ?>
                        <div class="contacts-card__item">
                            <div class="contacts-card__icon-wrapper">
                                <svg class="contacts-card__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="#20251b"/>
                                </svg>
                            </div>
                            <div class="contacts-card__content">
                                <div class="contacts-card__label"><?php echo function_exists( 'pll__' ) ? pll__( 'Телефон' ) : __( 'Телефон', 'ohotzooprom' ); ?></div>
                                <div class="contacts-card__value">
                                    <a href="tel:<?php echo esc_attr( $contact_phone_raw ? $contact_phone_raw : preg_replace('/[^0-9+]/', '', $contact_phone) ); ?>" class="contacts-card__link"><?php echo esc_html( $contact_phone ); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ( $contact_email ) : ?>
                        <div class="contacts-card__item">
                            <div class="contacts-card__icon-wrapper">
                                <svg class="contacts-card__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="#4285f4"/>
                                </svg>
                            </div>
                            <div class="contacts-card__content">
                                <div class="contacts-card__label"><?php echo function_exists( 'pll__' ) ? pll__( 'Email' ) : __( 'Email', 'ohotzooprom' ); ?></div>
                                <div class="contacts-card__value">
                                    <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="contacts-card__email-link"><?php echo esc_html( $contact_email ); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ( $contact_hours ) : ?>
                        <div class="contacts-card__item">
                            <div class="contacts-card__icon-wrapper">
                                <svg class="contacts-card__icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z" fill="#f4b400"/>
                                </svg>
                            </div>
                            <div class="contacts-card__content">
                                <div class="contacts-card__label"><?php echo function_exists( 'pll__' ) ? pll__( 'Режим работы' ) : __( 'Режим работы', 'ohotzooprom' ); ?></div>
                                <div class="contacts-card__value"><?php echo esc_html( $contact_hours ); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="contacts-map-wrapper">
                <?php if ( $contact_map_iframe ) : ?>
                    <div class="contacts-map contacts-map--iframe">
                        <?php echo $contact_map_iframe; ?>
                    </div>
                <?php elseif ( $yandex_map_link ) : ?>
                    <a href="<?php echo esc_url( $yandex_map_link ); ?>" target="_blank" rel="noopener" class="contacts-map" style="display: block;">
                        <!-- Map Mock Visual Pin -->
                        <div class="map-marker">
                            <div class="map-marker__pulse"></div>
                            <svg class="map-marker__icon" width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#3d6529"/>
                            </svg>
                        </div>
                    </a>
                <?php else : ?>
                    <div class="contacts-map">
                        <!-- Map Mock Visual Pin -->
                        <div class="map-marker">
                            <div class="map-marker__pulse"></div>
                            <svg class="map-marker__icon" width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#3d6529"/>
                            </svg>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ( $contact_map_link ) : ?>
                    <a href="<?php echo esc_url( $contact_map_link ); ?>" class="contacts-map__link">
                        <?php echo esc_html( $contact_map_btn_text ? $contact_map_btn_text : 'Схема проезда в территориальные подразделения' ); ?> <span class="arrow">→</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php
get_footer();