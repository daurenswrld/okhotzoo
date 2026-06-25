<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Ohotzooprom
 */

get_header();
?>

<section class="error-404">
    <div class="container error-404__container">
        <div class="error-404__illustration">
            <svg width="240" height="240" viewBox="0 0 240 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="120" cy="120" r="100" stroke="#eae5da" stroke-width="2" stroke-dasharray="8 6" />
                <path d="M40 180C70 175 90 185 120 180C150 175 170 185 200 180" stroke="#eae5da" stroke-width="2" stroke-linecap="round"/>
                <path d="M120 70V170M70 120H170" stroke="#d8d3c5" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M110 110C105 100 100 80 110 60C115 50 118 45 118 40" stroke="#4a7a32" stroke-width="3" stroke-linecap="round"/>
                <path d="M130 110C135 100 140 80 130 60C125 50 122 45 122 40" stroke="#4a7a32" stroke-width="3" stroke-linecap="round"/>
                <text x="120" y="150" font-family="'Geologica', sans-serif" font-size="54" font-weight="800" fill="#4a7a32" text-anchor="middle">404</text>
            </svg>
        </div>
        <div class="error-404__content">
            <h1 class="error-404__title"><?php echo function_exists( 'pll__' ) ? pll__( 'Страница не найдена' ) : __( 'Страница не найдена', 'ohotzooprom' ); ?></h1>
            <h3 class="error-404__subtitle"><?php echo function_exists( 'pll__' ) ? pll__( 'Степная тропа ведет в тупик...' ) : __( 'Степная тропа ведет в тупик...', 'ohotzooprom' ); ?></h3>
            <p class="error-404__text">
                <?php echo function_exists( 'pll__' ) ? pll__( 'Похоже, эта страница скрылась в зарослях саксаула или убежала быстрее сайгака. Попробуйте вернуться на главную страницу.' ) : __( 'Похоже, эта страница скрылась в зарослях саксаула или убежала быстрее сайгака. Попробуйте вернуться на главную страницу.', 'ohotzooprom' ); ?>
            </p>
            <div class="error-404__actions">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
                    <?php echo function_exists( 'pll__' ) ? pll__( 'Вернуться на главную' ) : __( 'Вернуться на главную', 'ohotzooprom' ); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
