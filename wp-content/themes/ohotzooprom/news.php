<?php
/**
 * Template Name: Новости
 *
 * @package Ohotzooprom
 */

get_header();
?>

    <section class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumbs__list">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumbs__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Главная' ) : __( 'Главная', 'ohotzooprom' ); ?></a></li>
                <li class="breadcrumbs__separator">/</li>
                <li class="breadcrumbs__current"><?php echo function_exists( 'pll__' ) ? pll__( 'Новости' ) : __( 'Новости', 'ohotzooprom' ); ?></li>
            </ul>
        </div>
    </section>

    <?php
        $news_hero_bg = function_exists( 'get_field' ) ? get_field( 'news_hero_bg' ) : '';
        $hero_style = '';
        if ( $news_hero_bg ) {
            $hero_style = ' style="background-image: linear-gradient(rgba(32, 37, 27, 0.65), rgba(32, 37, 27, 0.65)), url(\'' . esc_url( $news_hero_bg ) . '\');"';
        }
    ?>
    <section class="news-hero"<?php echo $hero_style; ?>>
        <div class="container news-hero__container">
            <div class="news-hero__badge">
                <?php 
                $news_hero_badge = function_exists( 'get_field' ) ? get_field( 'news_hero_badge' ) : '';
                if ( ! $news_hero_badge ) {
                    $news_hero_badge = 'РГКП «ПО Охотзоопром» · Республика Казахстан';
                }
                echo esc_html( $news_hero_badge );
                ?>
            </div>
            <?php
            $news_hero_title = function_exists( 'get_field' ) ? get_field( 'news_hero_title' ) : '';
            $news_hero_desc = function_exists( 'get_field' ) ? get_field( 'news_hero_desc' ) : '';

            if ( ! $news_hero_title || ! $news_hero_desc ) {
                $hero_post_query = new WP_Query(
                    array(
                        'post_type'      => 'post',
                        'posts_per_page' => 1,
                    )
                );

                if ( $hero_post_query->have_posts() ) {
                    while ( $hero_post_query->have_posts() ) {
                        $hero_post_query->the_post();
                        if ( ! $news_hero_title ) {
                            $news_hero_title = get_the_title();
                        }
                        if ( ! $news_hero_desc ) {
                            $news_hero_desc = wp_strip_all_tags( get_the_excerpt() );
                        }
                    }
                    wp_reset_postdata();
                }
            }

            if ( ! $news_hero_title ) {
                $news_hero_title = 'Новые меры по защите редких видов животных';
            }
            if ( ! $news_hero_desc ) {
                $news_hero_desc = 'Инспекторы РГКП «ПО Охотзоопром» усилили работу по борьбе с браконьерством и охране редких видов, участвуя в республиканских природоохранных акциях и совместных рейдах с государственными органами.';
            }
            ?>
            <h1 class="news-hero__title"><?php echo esc_html( $news_hero_title ); ?></h1>
            <p class="news-hero__desc">
                <?php echo esc_html( $news_hero_desc ); ?>
            </p>
            
            <div class="news-hero__stats">
                <?php 
                $news_stats = function_exists( 'get_field' ) ? get_field( 'news_hero_stats' ) : null;
                if ( $news_stats && is_array( $news_stats ) ) {
                    foreach ( $news_stats as $stat ) {
                        $num = isset( $stat['stat_number'] ) ? $stat['stat_number'] : '';
                        $suffix = isset( $stat['stat_suffix'] ) ? $stat['stat_suffix'] : '';
                        $label = isset( $stat['stat_label'] ) ? $stat['stat_label'] : '';
                        $suffix_class = ( $suffix === 'лет' || $suffix === 'млн' || $suffix === 'обл.' || $suffix === 'г.' ) ? 'news-hero__stat-suffix news-hero__stat-suffix--text' : 'news-hero__stat-suffix';
                        ?>
                        <div class="news-hero__stat-card">
                            <div class="news-hero__stat-number"><?php echo esc_html( $num ); ?><span class="<?php echo esc_attr( $suffix_class ); ?>"><?php echo esc_html( $suffix ); ?></span></div>
                            <div class="news-hero__stat-label"><?php echo esc_html( $label ); ?></div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="news-hero__stat-card">
                        <div class="news-hero__stat-number">1994<span class="news-hero__stat-suffix news-hero__stat-suffix--text">г.</span></div>
                        <div class="news-hero__stat-label"><?php echo function_exists( 'pll__' ) ? pll__( 'Год основания предприятия' ) : __( 'Год основания предприятия', 'ohotzooprom' ); ?></div>
                    </div>
                    
                    <div class="news-hero__stat-card">
                        <div class="news-hero__stat-number">17<span class="news-hero__stat-suffix">+</span></div>
                        <div class="news-hero__stat-label"><?php echo function_exists( 'pll__' ) ? pll__( 'Территориальных подразделений' ) : __( 'Территориальных подразделений', 'ohotzooprom' ); ?></div>
                    </div>
                    
                    <div class="news-hero__stat-card">
                        <div class="news-hero__stat-number">14<span class="news-hero__stat-suffix news-hero__stat-suffix--text">обл.</span></div>
                        <div class="news-hero__stat-label"><?php echo function_exists( 'pll__' ) ? pll__( 'Регионов присутствия' ) : __( 'Регионов присутствия', 'ohotzooprom' ); ?></div>
                    </div>
                    
                    <div class="news-hero__stat-card">
                        <div class="news-hero__stat-number">500<span class="news-hero__stat-suffix">+</span></div>
                        <div class="news-hero__stat-label"><?php echo function_exists( 'pll__' ) ? pll__( 'Сотрудников по всему Казахстану' ) : __( 'Сотрудников по всему Казахстану', 'ohotzooprom' ); ?></div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <section class="news news-list-section">
        <div class="container">

            <?php
            // --- Category filter ---
            $filter_cats = array(
                array( 'slug' => 'obyavleniya',           'label' => function_exists( 'pll__' ) ? pll__( 'Официальные объявления' ) : __( 'Официальные объявления', 'ohotzooprom' ) ),
                array( 'slug' => 'informaciya-grazhdanam','label' => function_exists( 'pll__' ) ? pll__( 'Информация гражданам' )    : __( 'Информация гражданам', 'ohotzooprom' ) ),
            );

            // Only show filter if at least one of these categories exists and has posts
            $show_filter = false;
            foreach ( $filter_cats as $fc ) {
                $fc_obj = get_category_by_slug( $fc['slug'] );
                if ( $fc_obj && $fc_obj->count > 0 ) { $show_filter = true; break; }
            }

            // Active filter from URL
            $active_cat_slug = isset( $_GET['cat'] ) ? sanitize_key( $_GET['cat'] ) : '';
            $active_cat_id   = 0;
            if ( $active_cat_slug ) {
                $active_cat_obj = get_category_by_slug( $active_cat_slug );
                if ( $active_cat_obj ) {
                    $active_cat_id = $active_cat_obj->term_id;
                }
            }

            $news_page_url = get_permalink();
            ?>

            <?php if ( $show_filter ) : ?>
            <div class="news-filter">
                <a href="<?php echo esc_url( $news_page_url ); ?>" class="news-filter__btn <?php echo ! $active_cat_slug ? 'news-filter__btn--active' : ''; ?>">
                    <?php echo function_exists( 'pll__' ) ? pll__( 'Все новости' ) : __( 'Все новости', 'ohotzooprom' ); ?>
                </a>
                <?php foreach ( $filter_cats as $fc ) :
                    $fc_obj = get_category_by_slug( $fc['slug'] );
                    if ( ! $fc_obj || $fc_obj->count < 1 ) continue;
                    $is_active = ( $active_cat_slug === $fc['slug'] );
                    ?>
                    <a href="<?php echo esc_url( add_query_arg( 'cat', $fc['slug'], $news_page_url ) ); ?>" class="news-filter__btn <?php echo $is_active ? 'news-filter__btn--active' : ''; ?>">
                        <?php echo esc_html( $fc['label'] ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <h2 class="section-title">
                <?php
                if ( $active_cat_slug && $active_cat_id ) {
                    echo esc_html( get_cat_name( $active_cat_id ) );
                } else {
                    echo function_exists( 'pll__' ) ? pll__( 'Новости' ) : __( 'Новости', 'ohotzooprom' );
                }
                ?>
            </h2>

            <div class="news-all-grid">
                <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
                $news_args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 10,
                    'paged'          => $paged,
                );
                if ( $active_cat_id ) {
                    $news_args['cat'] = $active_cat_id;
                }
                $news_query = new WP_Query( $news_args );

                if ( $news_query->have_posts() ) {
                    $count = 0;
                    while ( $news_query->have_posts() ) {
                        $news_query->the_post();
                        $count++;
                        $is_featured = ( $count === 1 && $paged === 1 && ! $active_cat_id );
                        ?>
                        <a href="<?php the_permalink(); ?>" class="news-card <?php echo $is_featured ? 'news-card--featured' : ''; ?>">
                            <div class="news-card__image-wrapper">
                                <div class="news-card__image <?php echo $is_featured ? 'news-card__image--featured' : 'news-card__image--secondary'; ?>"
                                     style="background: url('<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : esc_url( get_template_directory_uri() ) . '/assets/img/news-bg.webp'; ?>') center/cover no-repeat;">
                                </div>
                                <?php if ( $is_featured ) : ?>
                                    <span class="news-card__badge"><?php echo function_exists( 'pll__' ) ? pll__( 'Главная новость' ) : __( 'Главная новость', 'ohotzooprom' ); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="news-card__content">
                                <div class="news-card__date"><?php echo esc_html( get_the_date() ); ?></div>
                                <h3 class="news-card__title"><?php the_title(); ?></h3>
                                <p class="news-card__text">
                                    <?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?>
                                </p>
                                <span class="news-card__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Подробнее' ) : __( 'Подробнее', 'ohotzooprom' ); ?> <span class="arrow">→</span></span>
                            </div>
                        </a>
                        <?php
                    }
                    wp_reset_postdata();
                } else {
                    ?>
                    <div class="news-empty">
                        <div class="news-empty__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
                                <circle cx="32" cy="32" r="30" stroke="currentColor" stroke-width="2" opacity="0.15"/>
                                <path d="M20 24h24M20 32h16M20 40h10" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                                <circle cx="46" cy="42" r="8" fill="currentColor" opacity="0.12"/>
                                <path d="M43 42h6M46 39v6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <h3 class="news-empty__title">
                            <?php echo function_exists( 'pll__' ) ? pll__( 'Новостей пока нет' ) : __( 'Новостей пока нет', 'ohotzooprom' ); ?>
                        </h3>
                        <p class="news-empty__desc">
                            <?php echo function_exists( 'pll__' ) ? pll__( 'Здесь появятся последние новости и публикации предприятия. Загляните позже.' ) : __( 'Здесь появятся последние новости и публикации предприятия. Загляните позже.', 'ohotzooprom' ); ?>
                        </p>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="news-empty__btn">
                            <?php echo function_exists( 'pll__' ) ? pll__( 'На главную' ) : __( 'На главную', 'ohotzooprom' ); ?>
                            <span class="arrow">→</span>
                        </a>
                    </div>
                <?php } ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php
                echo paginate_links(
                    array(
                        'total'              => $news_query->max_num_pages,
                        'current'            => $paged,
                        'prev_text'          => '&lt;',
                        'next_text'          => '&gt;',
                        'before_page_number' => '',
                        'type'               => 'plain',
                        'add_args'           => $active_cat_slug ? array( 'cat' => $active_cat_slug ) : array(),
                    )
                );
                ?>
            </div>
        </div>
    </section>

<?php
get_footer();

