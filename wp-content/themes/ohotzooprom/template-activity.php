<?php
/**
 * Template Name: Деятельность
 *
 * @package Ohotzooprom
 */

get_header();

// Determine activity type based on the page slug
$slug = get_post_field( 'post_name', get_post() );
$current_key = 'protection'; // default fallback

if ( strpos( $slug, 'monitoring' ) !== false ) {
    $current_key = 'monitoring';
} elseif ( strpos( $slug, 'hunting' ) !== false ) {
    $current_key = 'hunting';
} elseif ( strpos( $slug, 'relocation' ) !== false ) {
    $current_key = 'relocation';
} elseif ( strpos( $slug, 'dogs' ) !== false ) {
    $current_key = 'dogs';
}

// Fetch ACF values with fallbacks
$acf_desc = function_exists( 'get_field' ) ? get_field( 'activity_desc' ) : '';
$activity_desc = $acf_desc ? $acf_desc : $data['desc'];

$acf_directions = function_exists( 'get_field' ) ? get_field( 'activity_directions' ) : null;
$directions = array();
if ( $acf_directions && is_array( $acf_directions ) ) {
    foreach ( $acf_directions as $dir ) {
        $directions[] = array(
            'img' => $dir['img'],
            'title' => $dir['title'],
            'desc' => $dir['desc'],
            'color' => $dir['color']
        );
    }
} else {
    foreach ( $data['directions'] as $dir ) {
        $directions[] = array(
            'img' => get_template_directory_uri() . '/assets/img/' . $dir['img'],
            'title' => $dir['title'],
            'desc' => $dir['desc'],
            'color' => $dir['color']
        );
    }
}

$acf_achievements = function_exists( 'get_field' ) ? get_field( 'activity_achievements' ) : null;
$achievements = array();
if ( $acf_achievements && is_array( $acf_achievements ) ) {
    foreach ( $acf_achievements as $ach ) {
        $achievements[] = array(
            'num' => $ach['num'],
            'suffix' => $ach['suffix'],
            'img' => $ach['img'],
            'label' => $ach['label']
        );
    }
} else {
    foreach ( $data['achievements'] as $ach ) {
        $achievements[] = array(
            'num' => $ach['num'],
            'suffix' => $ach['suffix'],
            'img' => get_template_directory_uri() . '/assets/img/' . $ach['img'],
            'label' => $ach['label']
        );
    }
}

$acf_details_badge = function_exists( 'get_field' ) ? get_field( 'details_badge' ) : '';
$details_badge = $acf_details_badge ? $acf_details_badge : ( function_exists( 'pll__' ) ? pll__( 'о направлении' ) : __( 'о направлении', 'ohotzooprom' ) );

$details_text = function_exists( 'get_field' ) ? get_field( 'details_text' ) : '';

$acf_details_info = function_exists( 'get_field' ) ? get_field( 'details_info' ) : null;
$details_info = array();
if ( $acf_details_info && is_array( $acf_details_info ) ) {
    foreach ( $acf_details_info as $info ) {
        $details_info[] = array(
            'img' => $info['img'],
            'text' => $info['text']
        );
    }
} else {
    foreach ( $data['details_info'] as $info ) {
        $details_info[] = array(
            'img' => get_template_directory_uri() . '/assets/img/' . $info['img'],
            'text' => $info['text']
        );
    }
}
?>

    <section class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumbs__list">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="breadcrumbs__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Главная' ) : __( 'Главная', 'ohotzooprom' ); ?></a></li>
                <li class="breadcrumbs__separator">/</li>
                <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'activity-protection' ) ) ); ?>" class="breadcrumbs__link"><?php echo function_exists( 'pll__' ) ? pll__( 'Деятельность' ) : __( 'Деятельность', 'ohotzooprom' ); ?></a></li>
                <li class="breadcrumbs__separator">/</li>
                <li class="breadcrumbs__current"><?php the_title(); ?></li>
            </ul>
        </div>
    </section>

    <section class="activity-hero">
        <div class="container activity-hero__container">
            <div class="activity-hero__badge">
                <?php echo function_exists( 'pll__' ) ? pll__( 'РГКП «ПО ОХОТЗООПРОМ» · РЕСПУБЛИКА КАЗАХСТАН' ) : __( 'РГКП «ПО ОХОТЗООПРОМ» · РЕСПУБЛИКА КАЗАХСТАН', 'ohotzooprom' ); ?>
            </div>
            <h1 class="activity-hero__title"><?php the_title(); ?></h1>
            <p class="activity-hero__desc">
                <?php echo esc_html( $activity_desc ); ?>
            </p>
        </div>
    </section>

    <!-- Core areas of activity -->
    <section class="activity-section activity-directions">
        <div class="container">
            <h2 class="activity-section-title"><?php echo function_exists( 'pll__' ) ? pll__( 'Основные направления деятельности' ) : __( 'Основные направления деятельности', 'ohotzooprom' ); ?></h2>
            
            <div class="activity-directions-grid">
                <?php foreach ( $directions as $dir ) : ?>
                    <div class="direction-card">
                        <div class="direction-card__icon-wrapper">
                            <div class="direction-card__icon direction-card__icon--<?php echo esc_attr( $dir['color'] ); ?>">
                                <img src="<?php echo esc_url( $dir['img'] ); ?>" alt="<?php echo esc_attr( $dir['title'] ); ?>">
                            </div>
                        </div>
                        <h3 class="direction-card__title"><?php echo esc_html( $dir['title'] ); ?></h3>
                        <p class="direction-card__desc">
                            <?php echo esc_html( $dir['desc'] ); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section class="activity-section activity-achievements">
        <div class="container">
            <h2 class="activity-section-title"><?php echo function_exists( 'pll__' ) ? pll__( 'Наши достижения' ) : __( 'Наши достижения', 'ohotzooprom' ); ?></h2>
            
            <div class="activity-achievements-grid">
                <?php foreach ( $achievements as $ach ) : ?>
                    <div class="achievement-card">
                        <div class="achievement-card__head">
                            <div class="achievement-card__number"><?php echo esc_html( $ach['num'] ); ?><span class="plus"><?php echo esc_html( $ach['suffix'] ); ?></span></div>
                            <div class="achievement-card__icon">
                                <img src="<?php echo esc_url( $ach['img'] ); ?>" alt="icon">
                            </div>
                        </div>
                        <div class="achievement-card__label"><?php echo esc_html( $ach['label'] ); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Details Section -->
    <section class="activity-section activity-details">
        <div class="container">
            <div class="activity-details-grid">
                <!-- Left text content -->
                <div class="activity-details-content">
                    <span class="activity-details-badge"><?php echo esc_html( $details_badge ); ?></span>
                    <?php 
                    if ( $details_text ) {
                        // Automatically replace standard <p> tags with <p class="activity-details-text"> to preserve layout styling
                        echo wp_kses_post( str_replace( '<p>', '<p class="activity-details-text">', $details_text ) );
                    } else {
                        ?>
                        <p class="activity-details-text">
                            <?php echo wp_kses_post( nl2br( $data['details_text_1'] ) ); ?>
                        </p>
                        <p class="activity-details-text">
                            <?php echo wp_kses_post( nl2br( $data['details_text_2'] ) ); ?>
                        </p>
                        <?php
                    }
                    ?>
                </div>
                
                <!-- Right status info panel -->
                <div class="activity-details-card">
                    <ul class="details-info-list">
                        <?php foreach ( $details_info as $info ) : ?>
                            <li class="details-info-item">
                                <div class="details-info-icon">
                                    <img src="<?php echo esc_url( $info['img'] ); ?>" alt="info">
                                </div>
                                <span class="details-info-text"><?php echo esc_html( $info['text'] ); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <?php
            while ( have_posts() ) :
                the_post();
                if ( get_the_content() ) :
                    ?>
                    <div class="activity-editor-content" style="margin-top: 50px; line-height: 1.6; border-top: 1px solid rgba(0,0,0,0.08); padding-top: 40px;">
                        <?php the_content(); ?>
                    </div>
                    <?php
                endif;
            endwhile;
            ?>
        </div>
    </section>

<?php
get_footer();
