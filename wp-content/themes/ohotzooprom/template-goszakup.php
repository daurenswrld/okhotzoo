<?php
/**
 * Template Name: Госзакупки
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
                <li class="breadcrumbs__current"><?php the_title(); ?></li>
            </ul>
        </div>
    </section>

    <section class="purchase-hero">
        <div class="container purchase-hero__container">
            <div class="purchase-hero__badge">
                РГКП «ПО ОХОТЗООПРОМ» · РЕСПУБЛИКА КАЗАХСТАН
            </div>
            <h1 class="purchase-hero__title">Государственные <span class="accent">закупки</span></h1>
            <p class="purchase-hero__desc">
                Информация о проводимых закупках предприятия.<br>
                Полный перечень и подача заявок — на портале государственных закупок.
            </p>
            <a href="https://www.goszakup.gov.kz" target="_blank" rel="noopener" class="purchase-hero__btn">Все закупки на goszakup.gov.kz →</a>
        </div>
    </section>

    <main class="purchase-section">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();
                if ( get_the_content() ) :
                    ?>
                    <div class="purchase-editor-content" style="margin-bottom: 40px; line-height: 1.6;">
                        <?php the_content(); ?>
                    </div>
                    <?php
                endif;
            endwhile;
            ?>

            <div class="purchase-header">
                <h2 class="purchase-header__title"><?php echo function_exists( 'pll__' ) ? pll__( 'Государственные закупки' ) : __( 'Государственные закупки', 'ohotzooprom' ); ?></h2>
                <a href="https://www.goszakup.gov.kz" target="_blank" rel="noopener" class="purchase-header__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Все закупки на goszakup.gov.kz →' ) : __( 'Все закупки на goszakup.gov.kz →', 'ohotzooprom' ); ?></a>
            </div>

            <div class="purchase-table-wrapper">
                <div class="table-responsive">
                    <table class="purchase-table">
                        <thead>
                            <tr>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( '№' ) : __( '№', 'ohotzooprom' ); ?></th>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( 'Предмет закупки' ) : __( 'Предмет закупки', 'ohotzooprom' ); ?></th>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( 'Сумма (₸)' ) : __( 'Сумма (₸)', 'ohotzooprom' ); ?></th>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( 'Способ' ) : __( 'Способ', 'ohotzooprom' ); ?></th>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( 'Срок подачи' ) : __( 'Срок подачи', 'ohotzooprom' ); ?></th>
                                <th><?php echo function_exists( 'pll__' ) ? pll__( 'Статус' ) : __( 'Статус', 'ohotzooprom' ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $purchases_list = function_exists( 'get_field' ) ? get_field( 'purchases_list' ) : null;
                            if ( $purchases_list && is_array( $purchases_list ) ) :
                                foreach ( $purchases_list as $purch ) :
                                    $num = isset( $purch['purch_num'] ) ? $purch['purch_num'] : '';
                                    $title = isset( $purch['purch_title'] ) ? $purch['purch_title'] : '';
                                    $price = isset( $purch['purch_price'] ) ? $purch['purch_price'] : '';
                                    $method = isset( $purch['purch_method'] ) ? $purch['purch_method'] : '';
                                    $deadline = isset( $purch['purch_deadline'] ) ? $purch['purch_deadline'] : '';
                                    $status = isset( $purch['purch_status'] ) ? $purch['purch_status'] : 'open';
                                    ?>
                                    <tr>
                                        <td><?php echo esc_html( $num ); ?></td>
                                        <td><?php echo esc_html( $title ); ?></td>
                                        <td class="sum"><?php echo esc_html( $price ); ?></td>
                                        <td><?php echo esc_html( $method ); ?></td>
                                        <td><?php echo esc_html( $deadline ); ?></td>
                                        <td>
                                            <?php if ( $status === 'open' ) : ?>
                                                <span class="badge badge--open"><?php echo function_exists( 'pll__' ) ? pll__( 'Открыт' ) : __( 'Открыт', 'ohotzooprom' ); ?></span>
                                            <?php elseif ( $status === 'planned' ) : ?>
                                                <span class="badge badge--planned"><?php echo function_exists( 'pll__' ) ? pll__( 'Планируется' ) : __( 'Планируется', 'ohotzooprom' ); ?></span>
                                            <?php else : ?>
                                                <span class="badge badge--closed"><?php echo function_exists( 'pll__' ) ? pll__( 'Завершен' ) : __( 'Завершен', 'ohotzooprom' ); ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right aligned Pagination -->
            <div class="purchase-pagination">
                <div class="pagination">
                    <a href="#!" class="pagination__btn pagination__btn--prev">&lt;</a>
                    <a href="#!" class="pagination__num active">1</a>
                    <a href="#!" class="pagination__num">2</a>
                    <a href="#!" class="pagination__num">3</a>
                    <a href="#!" class="pagination__num">4</a>
                    <a href="#!" class="pagination__num">5</a>
                    <span class="pagination__dots">...</span>
                    <a href="#!" class="pagination__num">65</a>
                    <a href="#!" class="pagination__btn pagination__btn--next">&gt;</a>
                </div>
            </div>
        </div>
    </main>

<?php
get_footer();
