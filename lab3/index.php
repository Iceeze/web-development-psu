<?php
require_once 'includes/db.php';

$pageTitle = 'Главная - МедЦентр "Здоровье++"';
$currentPage = 'index';

$days = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
$currentDate = date('d.m.Y');
$currentDay = $days[date('w')];

$promos = $pdo->query("SELECT * FROM page_blocks WHERE page_name = 'index' AND block_type = 'promo'")->fetchAll(PDO::FETCH_ASSOC);
$news = $pdo->query("SELECT * FROM page_blocks WHERE page_name = 'index' AND block_type = 'news'")->fetchAll(PDO::FETCH_ASSOC);

require_once 'includes/header.php';
?>

<div class="container">
    <div class="today-date">
        Сегодня: <?= $currentDate ?> (<?= $currentDay ?>)
    </div>

    <h1>Добро пожаловать в наш медицинский центр!</h1>
    <p class="intro-text">
        Мы используем современное оборудование и доказательную медицину. Ниже вы можете ознакомиться с нашими текущими выгодными предложениями и последними новостями из жизни клиники.
    </p>

    <section class="promo-section">
        <h2>Актуальные Акции</h2>
        <div class="grid-wrapper">
            <?php foreach ($promos as $promo): ?>
                <div class="card-item promo-item">
                    <h3><?= htmlspecialchars($promo['title']) ?></h3>
                    <p><?= htmlspecialchars($promo['content']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <hr>

    <section class="news-section">
        <h2>Новости клиники</h2>
        <div class="grid-wrapper">
            <?php foreach ($news as $item): ?>
                <div class="card-item news-item">
                    <h3><?= htmlspecialchars($item['title']) ?></h3>
                    <p><?= htmlspecialchars($item['content']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php require_once 'includes/footer.php'; ?>