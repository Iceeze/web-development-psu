<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'МедЦентр "Здоровье++"' ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">
                <img src="https://placehold.co/40x40/white/blue?text=M" alt="Лого">
                МедЦентр "Здоровье+"
            </div>
            <nav>
                <ul>
                    <li><a href="index.php" class="<?= ($currentPage === 'index') ? 'active' : '' ?>">Новости и Акции</a></li>
                    <li><a href="services.php" class="<?= ($currentPage === 'services') ? 'active' : '' ?>">Услуги</a></li>
                    <li><a href="doctors.php" class="<?= ($currentPage === 'doctors') ? 'active' : '' ?>">Врачи</a></li>
                    <li><a href="schedule.php" class="<?= ($currentPage === 'schedule') ? 'active' : '' ?>">Расписание</a></li>
                    <li><a href="contacts.php" class="<?= ($currentPage === 'contacts') ? 'active' : '' ?>">Контакты</a></li>
                    <li><a href="appointment.php" class="<?= ($currentPage === 'appointment') ? 'active' : '' ?>" style="color: #ffd700;">Запись онлайн</a></li>
                </ul>
            </nav>
        </div>
    </header>