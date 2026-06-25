<?php
/**
 * The template for displaying the footer
 *
 * @package Ohotzooprom
 */

        $cur_lang = function_exists( 'pll_current_language' ) ? pll_current_language() : '';
        $is_kk = in_array( $cur_lang, array( 'kk', 'kz' ), true );
        if ( $is_kk && function_exists( 'get_field' ) ) {
            remove_filter( 'acf/settings/current_language', 'ohotzooprom_acf_current_language' );
            $logo_title = get_field( 'logo_title_kk', 'option' );
            add_filter( 'acf/settings/current_language', 'ohotzooprom_acf_current_language' );
            if ( ! $logo_title ) { $logo_title = '«Охотзоопром» ӨБ'; }
        } else {
            $logo_title = function_exists( 'get_field' ) ? get_field( 'logo_title', 'option' ) : '';
            if ( ! $logo_title ) { $logo_title = 'ПО «Охотзоопром»'; }
        }
        $footer_description = function_exists( 'get_field' ) ? get_field( 'footer_description', 'option' ) : '';
        $footer_copyright = function_exists( 'get_field' ) ? get_field( 'footer_copyright', 'option' ) : '';
        $footer_agency = function_exists( 'get_field' ) ? get_field( 'footer_agency', 'option' ) : '';
?>
    <footer class="footer">
        <div class="container footer__container">
            <div class="footer__top">
                <div class="footer__col footer__col--info">
                    <h3 class="footer__brand"><?php echo esc_html( $logo_title ? $logo_title : 'ПО «Охотзоопром»' ); ?></h3>
                    <p class="footer__desc">
                        <?php echo esc_html( $footer_description ? $footer_description : 'РГКП «ПО Охотзоопром» - Комитет лесного хозяйства и животного мира Министерства экологии и природных ресурсов РК' ); ?>
                    </p>
                </div>
                
                <div class="footer__col">
                    <h4 class="footer__title"><?php echo function_exists( 'pll__' ) ? pll__( 'О предприятии' ) : __( 'О предприятии', 'ohotzooprom' ); ?></h4>
                    <ul class="footer__menu">
                        <li><a href="<?php echo esc_url( home_url( '/about#history' ) ); ?>" class="footer__link"><?php echo function_exists( 'pll__' ) ? pll__( 'История' ) : __( 'История', 'ohotzooprom' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/about#management' ) ); ?>" class="footer__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Руководство' ) : __( 'Руководство', 'ohotzooprom' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/about#structure' ) ); ?>" class="footer__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Структура' ) : __( 'Структура', 'ohotzooprom' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/about#departments' ) ); ?>" class="footer__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Подразделения' ) : __( 'Подразделения', 'ohotzooprom' ); ?></a></li>
                    </ul>
                </div>
                
                <div class="footer__col">
                    <h4 class="footer__title"><?php echo function_exists( 'pll__' ) ? pll__( 'Документы' ) : __( 'Документы', 'ohotzooprom' ); ?></h4>
                    <ul class="footer__menu">
                        <li><a href="<?php echo esc_url( home_url( '/documents' ) ); ?>" class="footer__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Нормативная база' ) : __( 'Нормативная база', 'ohotzooprom' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/documents' ) ); ?>" class="footer__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Отчёты' ) : __( 'Отчёты', 'ohotzooprom' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/documents' ) ); ?>" class="footer__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Открытые данные' ) : __( 'Открытые данные', 'ohotzooprom' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/goszakup' ) ); ?>" class="footer__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Госзакупки' ) : __( 'Госзакупки', 'ohotzooprom' ); ?></a></li>
                    </ul>
                </div>
                
                <div class="footer__col">
                    <h4 class="footer__title"><?php echo function_exists( 'pll__' ) ? pll__( 'Обращения' ) : __( 'Обращения', 'ohotzooprom' ); ?></h4>
                    <ul class="footer__menu">
                        <li><a href="<?php echo esc_url( home_url( '/appeal' ) ); ?>" class="footer__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Написать обращение' ) : __( 'Написать обращение', 'ohotzooprom' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/contacts' ) ); ?>" class="footer__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Контакты' ) : __( 'Контакты', 'ohotzooprom' ); ?></a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer__bottom">
                <div class="footer__copyright">
                    © <?php echo date( 'Y' ); ?> <?php echo esc_html( $footer_copyright ? $footer_copyright : 'РГКП «ПО Охотзоопром». Официальный сайт.' ); ?>
                </div>
                <div class="footer__agency">
                    <?php echo esc_html( $footer_agency ? $footer_agency : 'Комитет лесного хозяйства и животного мира - МЭиПР РК' ); ?>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
