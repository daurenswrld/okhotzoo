<?php
/**
 * Template Name: О предприятии
 *
 * @package Ohotzooprom
 */

    get_header();

    $about_hero_badge = function_exists( 'get_field' ) ? get_field( 'about_hero_badge' ) : '';
    $about_hero_desc = function_exists( 'get_field' ) ? get_field( 'about_hero_desc' ) : '';
    $about_hero_stats = function_exists( 'get_field' ) ? get_field( 'about_hero_stats' ) : '';

    if ( ! $about_hero_badge ) {
        $about_hero_badge = 'РГКП «ПО Охотзоопром» · Республика Казахстан';
    }
    if ( ! $about_hero_desc ) {
        $about_hero_desc = 'РГКП «ПО Охотзоопром» — республиканское государственное казённое предприятие, созданное для управления охотничьими ресурсами, охраны и воспроизводства животного мира Казахстана. Предприятие подчинено Комитету лесного хозяйства и животного мира МЭиПР РК.';
    }
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

    <section class="about-hero">
        <div class="container about-hero__container">
            <div class="about-hero__badge">
                <?php echo esc_html( $about_hero_badge ); ?>
            </div>
            <h1 class="about-hero__title"><?php the_title(); ?></h1>
            <p class="about-hero__desc">
                <?php echo esc_html( $about_hero_desc ); ?>
            </p>
            
            <?php if ( $about_hero_stats ) : ?>
                <div class="about-hero__stats">
                    <?php foreach ( $about_hero_stats as $stat ) : ?>
                        <div class="about-hero__stat-card">
                            <div class="about-hero__stat-number">
                                <?php echo esc_html( $stat['number'] ); ?>
                                <?php if ( ! empty( $stat['suffix'] ) ) : ?>
                                    <span class="about-hero__stat-suffix <?php echo ( $stat['suffix'] === 'г.' || $stat['suffix'] === 'обл.' ) ? 'about-hero__stat-suffix--text' : ''; ?>"><?php echo esc_html( $stat['suffix'] ); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="about-hero__stat-label"><?php echo esc_html( $stat['label'] ); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <div class="page-tabs">
        <div class="container">
            <ul class="page-tabs__list">
                <li><a href="#history" class="page-tabs__link active" data-tab="history"><?php echo function_exists( 'pll__' ) ? pll__( 'История' ) : __( 'История', 'ohotzooprom' ); ?></a></li>
                <li><a href="#mission" class="page-tabs__link" data-tab="mission"><?php echo function_exists( 'pll__' ) ? pll__( 'Миссия и цели' ) : __( 'Миссия и цели', 'ohotzooprom' ); ?></a></li>
                <li><a href="#management" class="page-tabs__link" data-tab="management"><?php echo function_exists( 'pll__' ) ? pll__( 'Руководство' ) : __( 'Руководство', 'ohotzooprom' ); ?></a></li>
                <li><a href="#structure" class="page-tabs__link" data-tab="structure"><?php echo function_exists( 'pll__' ) ? pll__( 'Структура' ) : __( 'Структура', 'ohotzooprom' ); ?></a></li>
                <li><a href="#departments" class="page-tabs__link" data-tab="departments"><?php echo function_exists( 'pll__' ) ? pll__( 'Подразделения' ) : __( 'Подразделения', 'ohotzooprom' ); ?></a></li>
            </ul>
        </div>
    </div>

    <?php
        $about_history_title = function_exists( 'get_field' ) ? get_field( 'about_history_title' ) : '';
        $about_history_intro = function_exists( 'get_field' ) ? get_field( 'about_history_intro' ) : '';
        $about_history_timeline = function_exists( 'get_field' ) ? get_field( 'about_history_timeline' ) : '';

        if ( ! $about_history_title ) {
            $about_history_title = function_exists( 'pll__' ) ? pll__( 'История предприятия' ) : __( 'История предприятия', 'ohotzooprom' );
        }
        if ( ! $about_history_intro ) {
            $about_history_intro = 'РГКП «ПО Охотзоопром» основано в 1994 году. За более чем 30 лет работы предприятие стало одной из ключевых государственных организаций в сфере охраны, воспроизводства и рационального использования животного мира Республики Казахстан.';
        }
    ?>
    <section class="history-section section" data-tab-content="history">
        <div class="container history-section__container">
            <h2 class="section-title"><?php echo esc_html( $about_history_title ); ?></h2>
            <p class="history-section__intro">
                <?php echo wp_kses_post( nl2br( $about_history_intro ) ); ?>
            </p>

            <div class="timeline">
                <?php if ( $about_history_timeline ) : ?>
                    <?php foreach ( $about_history_timeline as $item ) : ?>
                        <div class="timeline__item">
                            <div class="timeline__marker"></div>
                            <div class="timeline__content">
                                <div class="timeline__header">
                                    <span class="timeline__date"><?php echo esc_html( $item['date'] ); ?></span>
                                    <h3 class="timeline__title"><?php echo esc_html( $item['title'] ); ?></h3>
                                </div>
                                <p class="timeline__text"><?php echo wp_kses_post( nl2br( $item['text'] ) ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
        $about_mission_title = function_exists( 'get_field' ) ? get_field( 'about_mission_title' ) : '';
        $about_mission_intro = function_exists( 'get_field' ) ? get_field( 'about_mission_intro' ) : '';
        $about_mission_quote_label = function_exists( 'get_field' ) ? get_field( 'about_mission_quote_label' ) : '';
        $about_mission_quote_text = function_exists( 'get_field' ) ? get_field( 'about_mission_quote_text' ) : '';
        $about_tasks_title = function_exists( 'get_field' ) ? get_field( 'about_tasks_title' ) : '';
        $about_mission_tasks = function_exists( 'get_field' ) ? get_field( 'about_mission_tasks' ) : '';
        $about_values_title = function_exists( 'get_field' ) ? get_field( 'about_values_title' ) : '';
        $about_mission_values = function_exists( 'get_field' ) ? get_field( 'about_mission_values' ) : '';

        if ( ! $about_mission_title ) {
            $about_mission_title = function_exists( 'pll__' ) ? pll__( 'Миссия и цели' ) : __( 'Миссия и цели', 'ohotzooprom' );
        }
        if ( ! $about_mission_intro ) {
            $about_mission_intro = 'Деятельность предприятия направлена на сохранение биологического разнообразия и устойчивое использование животного мира в интересах государства и будущих поколений.';
        }
        if ( ! $about_mission_quote_label ) {
            $about_mission_quote_label = 'миссия';
        }
        if ( ! $about_mission_quote_text ) {
            $about_mission_quote_text = 'Сохранение животного мира Казахстана через охрану, воспроизводство и рациональное использование биологических ресурсов на основе государственной природоохранной политики.';
        }
        if ( ! $about_tasks_title ) {
            $about_tasks_title = function_exists( 'pll__' ) ? pll__( 'Основные задачи' ) : __( 'Основные задачи', 'ohotzooprom' );
        }
        if ( ! $about_values_title ) {
            $about_values_title = function_exists( 'pll__' ) ? pll__( 'Ценности' ) : __( 'Ценности', 'ohotzooprom' );
        }
    ?>
    <section class="mission-section section" data-tab-content="mission">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html( $about_mission_title ); ?></h2>
            <p class="mission-section__intro">
                <?php echo wp_kses_post( nl2br( $about_mission_intro ) ); ?>
            </p>

            <div class="mission-quote">
                <span class="mission-quote__label"><?php echo esc_html( $about_mission_quote_label ); ?></span>
                <p class="mission-quote__text">
                    <?php echo wp_kses_post( nl2br( $about_mission_quote_text ) ); ?>
                </p>
            </div>

            <h2 class="section-title section-title--mt"><?php echo esc_html( $about_tasks_title ); ?></h2>
            <div class="tasks-grid">
                <?php if ( $about_mission_tasks ) : ?>
                    <?php 
                    $counter = 1;
                    foreach ( $about_mission_tasks as $task ) : ?>
                        <div class="task-item">
                            <div class="task-item__num"><?php echo $counter++; ?></div>
                            <div class="task-item__content">
                                <h4 class="task-item__title"><?php echo esc_html( $task['title'] ); ?></h4>
                                <p class="task-item__text"><?php echo wp_kses_post( nl2br( $task['text'] ) ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="task-item">
                        <div class="task-item__num">1</div>
                        <div class="task-item__content">
                            <h4 class="task-item__title">Основные задачи</h4>
                            <p class="task-item__text">Защита диких животных от браконьерства и незаконного оборота, сохранение мест обитания.</p>
                        </div>
                    </div>
                    <div class="task-item">
                        <div class="task-item__num">2</div>
                        <div class="task-item__content">
                            <h4 class="task-item__title">Воспроизводство популяций</h4>
                            <p class="task-item__text">Восстановление численности редких и исчезающих видов, программы реинтродукции.</p>
                        </div>
                    </div>
                    <div class="task-item">
                        <div class="task-item__num">3</div>
                        <div class="task-item__content">
                            <h4 class="task-item__title">Учёт и мониторинг</h4>
                            <p class="task-item__text">Ежегодный учёт численности диких животных, сбор и анализ данных о состоянии популяций.</p>
                        </div>
                    </div>
                    <div class="task-item">
                        <div class="task-item__num">4</div>
                        <div class="task-item__content">
                            <h4 class="task-item__title">Рациональное использование ресурсов</h4>
                            <p class="task-item__text">Управление охотничьими угодьями и регулирование изъятия охотничьих ресурсов.</p>
                        </div>
                    </div>
                    <div class="task-item">
                        <div class="task-item__num">5</div>
                        <div class="task-item__content">
                            <h4 class="task-item__title">Взаимодействие с госорганами</h4>
                            <p class="task-item__text">Участие в государственных программах по сохранению биоразнообразия.</p>
                        </div>
                    </div>
                    <div class="task-item">
                        <div class="task-item__num">6</div>
                        <div class="task-item__content">
                            <h4 class="task-item__title">Информирование населения</h4>
                            <p class="task-item__text">Обеспечение открытости деятельности и доступа граждан к официальной информации.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <h2 class="section-title section-title--mt"><?php echo esc_html( $about_values_title ); ?></h2>
            <div class="values-grid">
                <?php if ( $about_mission_values ) : ?>
                    <?php foreach ( $about_mission_values as $val ) : ?>
                        <div class="value-card">
                            <div class="value-card__header">
                                <?php if ( ! empty( $val['icon'] ) ) : ?>
                                    <img src="<?php echo esc_url( $val['icon'] ); ?>" alt="<?php echo esc_attr( $val['title'] ); ?>" class="value-card__icon">
                                <?php endif; ?>
                                <h4 class="value-card__title"><?php echo esc_html( $val['title'] ); ?></h4>
                            </div>
                            <p class="value-card__text"><?php echo wp_kses_post( nl2br( $val['text'] ) ); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="value-card">
                        <div class="value-card__header">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/value-01.webp" alt="Законность" class="value-card__icon">
                            <h4 class="value-card__title">Законность</h4>
                        </div>
                        <p class="value-card__text">Работа в строгом соответствии с законодательством Республики Казахстан.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-card__header">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/value-02.webp" alt="Открытость" class="value-card__icon">
                            <h4 class="value-card__title">Открытость</h4>
                        </div>
                        <p class="value-card__text">Прозрачность деятельности и доступность информации для граждан.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-card__header">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/value-03.webp" alt="Ответственность" class="value-card__icon">
                            <h4 class="value-card__title">Ответственность</h4>
                        </div>
                        <p class="value-card__text">Бережное отношение к природным ресурсам и долгосрочная устойчивость.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
        $about_management_title = function_exists( 'get_field' ) ? get_field( 'about_management_title' ) : '';
        $about_management_intro = function_exists( 'get_field' ) ? get_field( 'about_management_intro' ) : '';
        $about_management_members = function_exists( 'get_field' ) ? get_field( 'about_management_members' ) : '';

        if ( ! $about_management_title ) {
            $about_management_title = function_exists( 'pll__' ) ? pll__( 'Руководство предприятия' ) : __( 'Руководство предприятия', 'ohotzooprom' );
        }
        if ( ! $about_management_intro ) {
            $about_management_intro = 'Управление РГКП «ПО Охотзоопром» осуществляется руководящим составом, назначенным в установленном порядке в соответствии с законодательством Республики Казахстан. Руководители предприятия несут ответственность за реализацию государственной политики в области охраны, воспроизводства и рационального использования животного мира.';
        }
    ?>
    <section class="management-section section" data-tab-content="management">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html( $about_management_title ); ?></h2>
            <p class="management-section__intro">
                <?php echo wp_kses_post( nl2br( $about_management_intro ) ); ?>
            </p>
            
            <div class="management-grid">
                <?php if ( $about_management_members ) : ?>
                    <?php foreach ( $about_management_members as $member ) : ?>
                        <div class="management-card <?php echo ! empty( $member['highlight'] ) ? 'management-card--highlight' : ''; ?>">
                            <div class="management-card__img-wrapper">
                                <?php if ( ! empty( $member['photo'] ) ) : ?>
                                    <img src="<?php echo esc_url( $member['photo'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else : ?>
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="3" y="3" width="18" height="18" rx="2" stroke="#9CA3AF" stroke-width="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5" fill="#9CA3AF"/>
                                        <path d="M21 15L16 10L5 21" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <div class="management-card__info">
                                <h4 class="management-card__name"><?php echo esc_html( $member['name'] ); ?></h4>
                                <p class="management-card__position"><?php echo esc_html( $member['position'] ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="management-card management-card--highlight">
                        <div class="management-card__img-wrapper">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="3" width="18" height="18" rx="2" stroke="#9CA3AF" stroke-width="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5" fill="#9CA3AF"/>
                                <path d="M21 15L16 10L5 21" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="management-card__info">
                            <h4 class="management-card__name">Ахметов Б.С</h4>
                            <p class="management-card__position">Генеральный директор</p>
                        </div>
                    </div>

                    <div class="management-card">
                        <div class="management-card__img-wrapper">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="3" width="18" height="18" rx="2" stroke="#9CA3AF" stroke-width="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5" fill="#9CA3AF"/>
                                <path d="M21 15L16 10L5 21" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="management-card__info">
                            <h4 class="management-card__name">Нурланов Д. М.</h4>
                            <p class="management-card__position">Первый заместитель генерального директора</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
        $about_structure_title = function_exists( 'get_field' ) ? get_field( 'about_structure_title' ) : '';
        $about_structure_intro = function_exists( 'get_field' ) ? get_field( 'about_structure_intro' ) : '';
        $org_chart_top_title = function_exists( 'get_field' ) ? get_field( 'org_chart_top_title' ) : '';
        $org_chart_top_desc = function_exists( 'get_field' ) ? get_field( 'org_chart_top_desc' ) : '';
        $org_chart_bottom = function_exists( 'get_field' ) ? get_field( 'org_chart_bottom' ) : '';
        $about_structure_subtitle = function_exists( 'get_field' ) ? get_field( 'about_structure_subtitle' ) : '';
        $about_structure_departments = function_exists( 'get_field' ) ? get_field( 'about_structure_departments' ) : '';

        if ( ! $about_structure_title ) {
            $about_structure_title = function_exists( 'pll__' ) ? pll__( 'Структура предприятия' ) : __( 'Структура предприятия', 'ohotzooprom' );
        }
        if ( ! $about_structure_intro ) {
            $about_structure_intro = 'Организационная структура РГКП «ПО Охотзоопром» построена по функциональному принципу и обеспечивает реализацию задач в области охраны, учёта и воспроизводства животного мира.';
        }
        if ( ! $org_chart_top_title ) {
            $org_chart_top_title = 'Генеральный директор';
        }
        if ( ! $org_chart_top_desc ) {
            $org_chart_top_desc = 'Руководство предприятием';
        }
        if ( ! $about_structure_subtitle ) {
            $about_structure_subtitle = function_exists( 'pll__' ) ? pll__( 'Структурные подразделения аппарата' ) : __( 'Структурные подразделения аппарата', 'ohotzooprom' );
        }
    ?>
    <section class="structure-section section" data-tab-content="structure">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html( $about_structure_title ); ?></h2>
            <p class="structure-section__intro">
                <?php echo wp_kses_post( nl2br( $about_structure_intro ) ); ?>
            </p>

            <div class="org-chart">
                <div class="org-chart__level org-chart__level--top">
                    <div class="org-box org-box--main">
                        <h4 class="org-box__title"><?php echo esc_html( $org_chart_top_title ); ?></h4>
                        <p class="org-box__desc"><?php echo esc_html( $org_chart_top_desc ); ?></p>
                    </div>
                </div>
                
                <div class="org-chart__lines"></div>

                <div class="org-chart__level org-chart__level--bottom">
                    <?php if ( $org_chart_bottom ) : ?>
                        <?php foreach ( $org_chart_bottom as $box ) : ?>
                            <div class="org-box">
                                <h4 class="org-box__title"><?php echo esc_html( $box['title'] ); ?></h4>
                                <p class="org-box__desc"><?php echo esc_html( $box['desc'] ); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="org-box">
                            <h4 class="org-box__title">Первый заместитель директора</h4>
                            <p class="org-box__desc">Основная деятельность</p>
                        </div>
                        <div class="org-box">
                            <h4 class="org-box__title">Заместитель по охране ЖМ</h4>
                            <p class="org-box__desc">Охрана и учёт</p>
                        </div>
                        <div class="org-box">
                            <h4 class="org-box__title">Заместитель по финансам</h4>
                            <p class="org-box__desc">Экономика и закупки</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <h3 class="structure-section__subtitle"><?php echo esc_html( $about_structure_subtitle ); ?></h3>
            
            <div class="departments-grid">
                <?php if ( $about_structure_departments ) : ?>
                    <?php foreach ( $about_structure_departments as $dep ) : ?>
                        <div class="department-card">
                            <h4 class="department-card__title"><?php echo esc_html( $dep['title'] ); ?></h4>
                            <p class="department-card__desc"><?php echo esc_html( $dep['desc'] ); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="department-card">
                        <h4 class="department-card__title">Управление охраны животного мира</h4>
                        <p class="department-card__desc">Охрана угодий, рейдовая деятельность</p>
                    </div>
                    <div class="department-card">
                        <h4 class="department-card__title">Управление учёта и мониторинга</h4>
                        <p class="department-card__desc">Учётные работы, анализ данных</p>
                    </div>
                    <div class="department-card">
                        <h4 class="department-card__title">Управление охотничьего хозяйства</h4>
                        <p class="department-card__desc">Угодья, разрешения, лимиты</p>
                    </div>
                    <div class="department-card">
                        <h4 class="department-card__title">Центр переселения диких животных</h4>
                        <p class="department-card__desc">Реинтродукция и выпуск</p>
                    </div>
                    <div class="department-card">
                        <h4 class="department-card__title">Центр казахских пород собак</h4>
                        <p class="department-card__desc">Селекция и сохранение пород</p>
                    </div>
                    <div class="department-card">
                        <h4 class="department-card__title">Финансово-экономический отдел</h4>
                        <p class="department-card__desc">Бюджет, отчётность, госзакупки</p>
                    </div>
                    <div class="department-card">
                        <h4 class="department-card__title">Юридический отдел</h4>
                        <p class="department-card__desc">Правовое сопровождение</p>
                    </div>
                    <div class="department-card">
                        <h4 class="department-card__title">Отдел кадров и документооборота</h4>
                        <p class="department-card__desc">Кадры, делопроизводство</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
        $about_departments_title = function_exists( 'get_field' ) ? get_field( 'about_departments_title' ) : '';
        $about_departments_intro = function_exists( 'get_field' ) ? get_field( 'about_departments_intro' ) : '';
        $about_departments_branches = function_exists( 'get_field' ) ? get_field( 'about_departments_branches' ) : '';
    ?>
    <section class="departments-section section" data-tab-content="departments">
        <div class="container">
            <h2 class="section-title"><?php echo esc_html( $about_departments_title ); ?></h2>
            <p class="departments-section__intro">
                <?php echo esc_html( $about_departments_intro ); ?>
            </p>

            <div class="departments-cards-grid">
                <?php if ( $about_departments_branches ) : ?>
                    <?php foreach ( $about_departments_branches as $branch ) : ?>
                        <div class="dep-card">
                            <h4 class="dep-card__title"><?php echo esc_html( $branch['title'] ); ?></h4>
                            <div class="dep-card__info">
                                <?php if ( ! empty( $branch['address'] ) ) : ?>
                                    <div class="dep-card__info-item">
                                        <svg class="dep-card__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#e05a47" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <span class="dep-card__text"><?php echo esc_html( $branch['address'] ); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if ( ! empty( $branch['phone'] ) ) : ?>
                                    <div class="dep-card__info-item">
                                        <svg class="dep-card__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4b5563" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                        </svg>
                                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $branch['phone'] ) ); ?>" class="dep-card__link"><?php echo esc_html( $branch['phone'] ); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="dep-card">
                        <h4 class="dep-card__title">Центральный региональный филиал</h4>
                        <div class="dep-card__info">
                            <div class="dep-card__info-item">
                                <svg class="dep-card__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#e05a47" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span class="dep-card__text">Акмолинская область, г. Астана, Аркат 2.</span>
                            </div>
                            <div class="dep-card__info-item">
                                <svg class="dep-card__icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4b5563" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <a href="tel:+7712416106" class="dep-card__link">+7 (712) 41-61-06</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php
get_footer();