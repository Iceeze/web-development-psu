<?php
require_once 'includes/db.php';
$pageTitle = 'Запись онлайн - МедЦентр "Здоровье++"';
$currentPage = 'appointment';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO appointments (patient_name, doctor_spec, appointment_date) VALUES (?, ?, ?)");
    $stmt->execute([
        $_POST['patient_name'], 
        $_POST['doctor_spec'], 
        $_POST['appointment_date']
    ]);
    
    header("Location: appointment.php?success=1");
    exit;
}

require_once 'includes/header.php';
?>

<div class="container">
    <section>
        <h2>Запись на прием</h2>
        
        <div class="card-item appointment-card">
            <?php if (isset($_GET['success'])): ?>
                <div class="success-message">
                    <strong>Спасибо!</strong> Вы успешно записаны. Мы ждем вас.
                </div>
            <?php endif; ?>

            <form action="appointment.php" method="POST" class="appointment-form">
                <div>
                    <label class="form-label">Ваше ФИО:</label>
                    <input type="text" name="patient_name" required class="form-input">
                </div>
                
                <div>
                    <label class="form-label">Специалист:</label>
                    <select name="doctor_spec" required class="form-input">
                        <option value="Терапевт">Терапевт</option>
                        <option value="Кардиолог">Кардиолог</option>
                        <option value="Хирург">Хирург</option>
                        <option value="Травматолог">Травматолог</option>
                    </select>
                </div>
                
                <div>
                    <label class="form-label">Желаемая дата:</label>
                    <input type="date" name="appointment_date" required class="form-input">
                </div>
                
                <button type="submit" class="geo-btn submit-btn">Подтвердить запись</button>
            </form>
        </div>
    </section>
</div>

<?php require_once 'includes/footer.php'; ?>