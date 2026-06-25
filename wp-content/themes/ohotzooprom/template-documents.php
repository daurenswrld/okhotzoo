<?php
/**
 * Template Name: Документы
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
                <li class="breadcrumbs__current"><?php the_title(); ?></li>
            </ul>
        </div>
    </section>

    <section class="docs-hero">
        <div class="container docs-hero__container">
            <div class="docs-hero__badge">
                <?php echo function_exists( 'pll__' ) ? pll__( 'РГКП «ПО ОХОТЗООПРОМ» · РЕСПУБЛИКА КАЗАХСТАН' ) : __( 'РГКП «ПО ОХОТЗООПРОМ» · РЕСПУБЛИКА КАЗАХСТАН', 'ohotzooprom' ); ?>
            </div>
            <h1 class="docs-hero__title"><?php the_title(); ?></h1>
            <p class="docs-hero__desc">
                <?php
                if ( has_excerpt() ) {
                    echo esc_html( get_the_excerpt() );
                } else {
                    echo function_exists( 'pll__' ) ? pll__( 'Нормативная база, отчёты и открытые данные предприятия.' ) : __( 'Нормативная база, отчёты и открытые данные предприятия.', 'ohotzooprom' );
                }
                ?>
            </p>
        </div>
    </section>

    <main class="docs-section">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();
                if ( get_the_content() ) :
                    ?>
                    <div class="docs-editor-content" style="margin-bottom: 40px; line-height: 1.6;">
                        <?php the_content(); ?>
                    </div>
                    <?php
                endif;
            endwhile;
            ?>

            <div class="docs-filter-bar">
                <div class="docs-filter-tabs">
                    <button class="filter-tab active" data-filter="all"><?php echo function_exists( 'pll__' ) ? pll__( 'Все' ) : __( 'Все', 'ohotzooprom' ); ?></button>
                    <?php
                    $document_tabs = function_exists( 'get_field' ) ? get_field( 'document_tabs' ) : null;
                    if ( $document_tabs && is_array( $document_tabs ) ) :
                        foreach ( $document_tabs as $index => $tab ) :
                            $tab_title = isset( $tab['tab_title'] ) ? $tab['tab_title'] : '';
                            $tab_slug = 'tab-' . $index;
                            if ( $tab_title ) :
                                ?>
                                <button class="filter-tab" data-filter="<?php echo esc_attr( $tab_slug ); ?>"><?php echo esc_html( $tab_title ); ?></button>
                                <?php
                            endif;
                        endforeach;
                    else :
                        // Default Fallbacks
                        ?>
                        <button class="filter-tab" data-filter="tab-0"><?php echo function_exists( 'pll__' ) ? pll__( 'Нормативная база' ) : __( 'Нормативная база', 'ohotzooprom' ); ?></button>
                        <button class="filter-tab" data-filter="tab-1"><?php echo function_exists( 'pll__' ) ? pll__( 'Отчёты' ) : __( 'Отчёты', 'ohotzooprom' ); ?></button>
                        <button class="filter-tab" data-filter="tab-2"><?php echo function_exists( 'pll__' ) ? pll__( 'Открытые данные' ) : __( 'Открытые данные', 'ohotzooprom' ); ?></button>
                        <?php
                    endif;
                    ?>
                </div>
                <div class="docs-search-wrapper">
                    <input type="text" class="docs-search-input" placeholder="<?php echo esc_attr( function_exists( 'pll__' ) ? pll__( 'Поиск' ) : __( 'Поиск', 'ohotzooprom' ) ); ?>" id="docSearch">
                    <svg class="docs-search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7c8370" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
            </div>

            <div class="docs-grid" id="docsGrid">
                <?php
                if ( $document_tabs && is_array( $document_tabs ) ) :
                    foreach ( $document_tabs as $index => $tab ) :
                        $tab_slug = 'tab-' . $index;
                        $tab_docs = isset( $tab['tab_documents'] ) ? $tab['tab_documents'] : null;
                        if ( $tab_docs && is_array( $tab_docs ) ) :
                            foreach ( $tab_docs as $doc ) :
                                $title = isset( $doc['doc_title'] ) ? $doc['doc_title'] : '';
                                $meta = isset( $doc['doc_meta'] ) ? $doc['doc_meta'] : '';
                                $file_url = isset( $doc['doc_file'] ) ? $doc['doc_file'] : '';
                                if ( ! $file_url ) {
                                    $file_url = '#!';
                                }
                                ?>
                                <div class="doc-card" data-category="<?php echo esc_attr( $tab_slug ); ?>">
                                    <div class="doc-card__content">
                                        <h3 class="doc-card__title"><?php echo esc_html( $title ); ?></h3>
                                        <p class="doc-card__meta"><?php echo esc_html( $meta ); ?></p>
                                    </div>
                                    <a href="<?php echo esc_url( $file_url ); ?>" class="doc-card__download" target="_blank" rel="noopener noreferrer">
                                        <?php echo function_exists( 'pll__' ) ? pll__( 'Скачать PDF' ) : __( 'Скачать PDF', 'ohotzooprom' ); ?> <span class="arrow">→</span>
                                    </a>
                                </div>
                                <?php
                            endforeach;
                        endif;
                    endforeach;
                else :
                    // Fallback default documents if ACF is empty
                    ?>
                    <div class="doc-card" data-category="tab-0">
                        <div class="doc-card__content">
                            <h3 class="doc-card__title">Закон Республики Казахстан «Об охране, воспроизводстве и использовании животного мира»</h3>
                            <p class="doc-card__meta">Закон РК · 2004 г.</p>
                        </div>
                        <a href="#!" class="doc-card__download" target="_blank">Скачать PDF <span class="arrow">→</span></a>
                    </div>
                    <div class="doc-card" data-category="tab-1">
                        <div class="doc-card__content">
                            <h3 class="doc-card__title">Годовой отчет о деятельности предприятия за 2023 год</h3>
                            <p class="doc-card__meta">Отчет · 2023 г.</p>
                        </div>
                        <a href="#!" class="doc-card__download" target="_blank">Скачать PDF <span class="arrow">→</span></a>
                    </div>
                    <div class="doc-card" data-category="tab-2">
                        <div class="doc-card__content">
                            <h3 class="doc-card__title">Реестр разрешений на пользование животным миром</h3>
                            <p class="doc-card__meta">Открытые данные · 2024 г.</p>
                        </div>
                        <a href="#!" class="doc-card__download" target="_blank">Скачать PDF <span class="arrow">→</span></a>
                    </div>
                <?php
                endif;
                ?>
            </div>

            <!-- Empty state shown when no docs match filter/search -->
            <div class="docs-empty" id="docsEmpty" style="display:none;">
                <div class="docs-empty__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" fill="none">
                        <rect x="12" y="8" width="40" height="48" rx="5" stroke="currentColor" stroke-width="2" opacity="0.15" fill="currentColor"/>
                        <path d="M22 22h20M22 30h20M22 38h12" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                        <circle cx="46" cy="46" r="9" fill="white" stroke="currentColor" stroke-width="2"/>
                        <path d="M43 46h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 class="docs-empty__title">
                    <?php echo function_exists( 'pll__' ) ? pll__( 'Документы не найдены' ) : __( 'Документы не найдены', 'ohotzooprom' ); ?>
                </h3>
                <p class="docs-empty__desc">
                    <?php echo function_exists( 'pll__' ) ? pll__( 'По вашему запросу или выбранной вкладке документов не найдено. Попробуйте изменить фильтр или поисковый запрос.' ) : __( 'По вашему запросу или выбранной вкладке документов не найдено. Попробуйте изменить фильтр или поисковый запрос.', 'ohotzooprom' ); ?>
                </p>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.filter-tab');
            const cards = document.querySelectorAll('.doc-card');
            const searchInput = document.getElementById('docSearch');
            let currentFilter = 'all';
            let searchQuery = '';

            function filterDocs() {
                let visibleCount = 0;
                cards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    const title = card.querySelector('.doc-card__title').textContent.toLowerCase();
                    const matchesCategory = currentFilter === 'all' || category === currentFilter;
                    const matchesSearch = title.includes(searchQuery);
                    const visible = matchesCategory && matchesSearch;
                    card.style.display = visible ? '' : 'none';
                    if ( visible ) visibleCount++;
                });
                const emptyEl = document.getElementById('docsEmpty');
                if ( emptyEl ) emptyEl.style.display = visibleCount === 0 ? 'flex' : 'none';
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    currentFilter = tab.getAttribute('data-filter');
                    filterDocs();
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    searchQuery = e.target.value.toLowerCase();
                    filterDocs();
                });
            }
        });
    </script>

<?php
get_footer();
