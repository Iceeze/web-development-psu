<?php
require_once 'includes/db.php';
$pageTitle = 'Врачи - МедЦентр "Здоровье++"';
$currentPage = 'doctors';

$doctors = $pdo->query("SELECT * FROM page_blocks WHERE page_name = 'doctors' AND block_type = 'doctor'")->fetchAll(PDO::FETCH_ASSOC);

require_once 'includes/header.php';
?>

<div class="container">
    <section>
        <h2>Наши специалисты</h2>
        <p style="text-align: center; margin-bottom: 30px;">Гордость нашей клиники — опытные врачи, регулярно повышающие свою квалификацию.</p>

        <div class="doctors-grid">
            <?php foreach ($doctors as $doc): ?>
                <div class="doctor-card">
                    <img src="<?= htmlspecialchars($doc['image_url']) ?>" alt="<?= htmlspecialchars($doc['title']) ?>" class="doctor-photo">
                    <div class="doctor-info">
                        <div class="doctor-name"><?= htmlspecialchars($doc['title']) ?></div>
                        <div class="doctor-spec"><?= htmlspecialchars($doc['extra_info']) ?></div>
                        <div class="doctor-desc"><?= htmlspecialchars($doc['content']) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php require_once 'includes/footer.php'; ?>