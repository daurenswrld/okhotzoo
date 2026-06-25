<?php
/**
 * The template for displaying all single posts
 *
 * @package Ohotzooprom
 */

get_header();
?>

    <section class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumbs__list">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumbs__link">Главная</a></li>
                <li class="breadcrumbs__separator">/</li>
                <li><a href="<?php echo esc_url( home_url( '/news' ) ); ?>" class="breadcrumbs__link">Новости</a></li>
                <li class="breadcrumbs__separator">/</li>
                <li class="breadcrumbs__current"><?php the_title(); ?></li>
            </ul>
        </div>
    </section>

    <main class="news-single-section">
        <div class="container">
            <div class="news-single__back">
                <a href="<?php echo esc_url( home_url( '/news' ) ); ?>" class="back-link">
                    <span class="arrow">←</span> Все новости
                </a>
            </div>

            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'news-single__article' ); ?>>
                    <div class="news-single__meta">
                        <span class="news-single__category">
                            <?php
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) {
                                echo esc_html( $categories[0]->name );
                            } else {
                                echo 'Новости';
                            }
                            ?>
                        </span>
                        <span class="news-single__date"><?php echo esc_html( get_the_date() ); ?></span>
                    </div>

                    <h1 class="news-single__title"><?php the_title(); ?></h1>
                    
                    <?php if ( has_excerpt() ) : ?>
                        <p class="news-single__lead">
                            <?php echo esc_html( get_the_excerpt() ); ?>
                        </p>
                    <?php endif; ?>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="news-single__image-wrapper">
                            <div class="news-single__image" style="background-image: url('<?php the_post_thumbnail_url( 'full' ); ?>');">
                                <?php
                                $caption = get_the_post_thumbnail_caption();
                                if ( $caption ) :
                                    ?>
                                    <div class="news-single__image-caption">
                                        <?php echo esc_html( $caption ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="news-single__image-author">
                            <?php
                            $photo_author = get_post_meta( get_the_ID(), 'photo_author', true );
                            if ( $photo_author ) {
                                echo esc_html( $photo_author );
                            } else {
                                echo 'Фото: пресс-служба РГКП «ПО Охотзоопром»';
                            }
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="news-single__content">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    $tags = get_the_tags();
                    if ( $tags ) :
                        ?>
                        <div class="news-single__tags">
                            <?php foreach ( $tags as $tag ) : ?>
                                <span class="tag"><?php echo esc_html( $tag->name ); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </article>
                <?php
            endwhile;
            ?>
        </div>
    </main>

    <section class="related-news">
        <div class="container">
            <h2 class="related-news__title">Другие новости</h2>
            <div class="related-news__grid">
                <?php
                // Query related news (excluding current post)
                $related_query = new WP_Query(
                    array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                        'post__not_in'   => array( get_the_ID() ),
                    )
                );

                if ( $related_query->have_posts() ) :
                    while ( $related_query->have_posts() ) :
                        $related_query->the_post();
                        ?>
                        <a href="<?php the_permalink(); ?>" class="related-news-card">
                            <div class="related-news-card__date"><?php echo esc_html( get_the_date() ); ?></div>
                            <h3 class="related-news-card__title"><?php the_title(); ?></h3>
                        </a>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback static items if there are no other posts yet
                    ?>
                    <div class="related-news-card">
                        <div class="related-news-card__date">10 мая 2025</div>
                        <h3 class="related-news-card__title">Подписано соглашение о сотрудничестве с МСОП в области охраны снежного барса</h3>
                    </div>
                    <div class="related-news-card">
                        <div class="related-news-card__date">5 мая 2025</div>
                        <h3 class="related-news-card__title">Проведён рейд по пресечению браконьерства в Алматинской области: изъято 12 капканов</h3>
                    </div>
                    <div class="related-news-card">
                        <div class="related-news-card__date">12 мая 2025</div>
                        <h3 class="related-news-card__title">Опубликован годовой отчёт о деятельности предприятия за 2024 год</h3>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php
get_footer();
