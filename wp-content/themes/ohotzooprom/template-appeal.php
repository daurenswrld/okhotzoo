<?php
/**
 * Template Name: Обращение граждан
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

    <section class="activity-hero">
        <div class="container activity-hero__container">
            <div class="activity-hero__badge">
                РГКП «ПО ОХОТЗООПРОМ» · РЕСПУБЛИКА КАЗАХСТАН
            </div>
            <h1 class="activity-hero__title"><?php the_title(); ?></h1>
            <p class="activity-hero__desc">
                <?php
                if ( has_excerpt() ) {
                    echo esc_html( get_the_excerpt() );
                } else {
                    echo 'Задайте вопрос, оставьте обращение или получите консультацию по вопросам охраны и использования животного мира.';
                }
                ?>
            </p>
        </div>
    </section>

    <!-- Order of review -->
    <section class="appeal-order-section">
        <div class="container">
            <h2 class="appeal-section-title">Порядок рассмотрения обращения</h2>
            
            <div class="appeal-order-grid">
                <!-- Card 1 -->
                <div class="appeal-order-card">
                    <div class="appeal-order-number">1</div>
                    <h3 class="appeal-order-title">Подача обращения</h3>
                    <p class="appeal-order-desc">
                        Заполните форму или направьте обращение по электронной почте предприятия.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="appeal-order-card">
                    <div class="appeal-order-number">2</div>
                    <h3 class="appeal-order-title">Регистрация и рассмотрение</h3>
                    <p class="appeal-order-desc">
                        Обращение регистрируется и направляется профильному специалисту для рассмотрения.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="appeal-order-card">
                    <div class="appeal-order-number">3</div>
                    <h3 class="appeal-order-title">Официальный ответ</h3>
                    <p class="appeal-order-desc">
                        Ответ направляется заявителю в сроки, установленные законодательством РК.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Grid Section -->
    <section class="appeal-main-section">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();
                if ( get_the_content() ) :
                    ?>
                    <div class="appeal-editor-content" style="margin-bottom: 40px; line-height: 1.6;">
                        <?php the_content(); ?>
                    </div>
                    <?php
                endif;
            endwhile;
            ?>

            <div class="appeal-grid">
                <!-- Left Form Card -->
                <div class="appeal-form-card">
                    <span class="appeal-form-badge">Форма обращения</span>
                    
                    <form action="#" class="appeal-form" onsubmit="event.preventDefault(); alert('Обращение успешно отправлено!');">
                        <div class="form-group">
                            <label class="form-label">Тип обращения <span class="required">*</span></label>
                            <div class="select-wrapper">
                                <select class="form-select" required>
                                    <option value="question">Вопрос</option>
                                    <option value="appeal">Обращение</option>
                                    <option value="complaint">Жалоба</option>
                                    <option value="suggestion">Предложение</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">ФИО <span class="required">*</span></label>
                                <input type="text" class="form-input" placeholder="Иванов Иван Иванович" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Регион</label>
                                <div class="select-wrapper">
                                    <select class="form-select">
                                        <option value="" disabled selected>Выберите область</option>
                                        <option value="1">Акмолинская область</option>
                                        <option value="2">Актюбинская область</option>
                                        <option value="3">Алматинская область</option>
                                        <option value="4">Атырауская область</option>
                                        <option value="5">Восточно-Казахстанская область</option>
                                        <option value="6">Жамбылская область</option>
                                        <option value="7">Западно-Казахстанская область</option>
                                        <option value="8">Карагандинская область</option>
                                        <option value="9">Костанайская область</option>
                                        <option value="10">Кызылординская область</option>
                                        <option value="11">Мангистауская область</option>
                                        <option value="12">Павлодарская область</option>
                                        <option value="13">Северо-Казахстанская область</option>
                                        <option value="14">Туркестанская область</option>
                                        <option value="15">Область Абай</option>
                                        <option value="16">Область Жетысу</option>
                                        <option value="17">Область Улытау</option>
                                        <option value="18">г. Астана</option>
                                        <option value="19">г. Алматы</option>
                                        <option value="20">г. Шымкент</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Email <span class="required">*</span></label>
                                <input type="email" class="form-input" placeholder="name@example.kz" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Телефон</label>
                                <input type="tel" class="form-input" placeholder="+7 (___) ___-__-__">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Текст обращения <span class="required">*</span></label>
                            <textarea class="form-textarea" placeholder="Опишите ваш вопрос или обращение" required></textarea>
                        </div>

                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" class="form-checkbox" required>
                                <span class="checkbox-custom"></span>
                                <span class="checkbox-text">Я согласен(на) на обработку персональных данных в соответствии с законодательством Республики Казахстан.</span>
                            </label>
                        </div>

                        <button type="submit" class="submit-btn">
                            Отправить обращение <span class="btn-arrow">→</span>
                        </button>
                    </form>
                </div>

                <!-- Right Sidebar Cards -->
                <div class="appeal-sidebar">
                    <!-- Card 1 -->
                    <div class="sidebar-card">
                        <h3 class="sidebar-card__title">Сроки рассмотрения</h3>
                        <ul class="sidebar-card__list">
                            <li>Регистрация — в течение рабочего дня</li>
                            <li>Ответ — в сроки, установленные законодательством РК</li>
                            <li>Уведомление — на указанный email</li>
                        </ul>
                    </div>

                    <!-- Card 2 -->
                    <div class="sidebar-card">
                        <h3 class="sidebar-card__title">Контакты приёмной</h3>
                        <ul class="sidebar-card__list">
                            <li>+7 (7172) 00-00-00</li>
                            <li>info@ohotzooprom.kz</li>
                            <li>Пн-Пт: 09:00–18:00</li>
                        </ul>
                    </div>

                    <!-- Card 3 -->
                    <div class="sidebar-card">
                        <h3 class="sidebar-card__title">Уже отправляли обращение?</h3>
                        <p class="sidebar-card__text">
                            Проверьте статус по номеру в разделе «Статус обращения».
                        </p>
                        <a href="#!" class="status-btn" onclick="event.preventDefault(); alert('Сервис проверки статуса в данный момент недоступен. Пожалуйста, обратитесь в приёмную.');">
                            Проверить статус <span class="btn-arrow">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
