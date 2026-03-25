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
        
        <div class="card-item" style="max-width: 500px; margin: 0 auto; padding: 30px;">
            <?php if (isset($_GET['success'])): ?>
                <div style="background: #eaffea; border: 2px solid #28a745; padding: 15px; margin-bottom: 20px; border-radius: 5px; text-align: center;">
                    <strong>Спасибо!</strong> Вы успешно записаны. Мы ждем вас.
                </div>
            <?php endif; ?>

            <form action="appointment.php" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                <div>
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Ваше ФИО:</label>
                    <input type="text" name="patient_name" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                
                <div>
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Специалист:</label>
                    <select name="doctor_spec" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="Терапевт">Терапевт</option>
                        <option value="Кардиолог">Кардиолог</option>
                        <option value="Хирург">Хирург</option>
                        <option value="Травматолог">Травматолог</option>
                    </select>
                </div>
                
                <div>
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Желаемая дата:</label>
                    <input type="date" name="appointment_date" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                
                <button type="submit" class="geo-btn" style="width: 100%; margin-top: 10px;">Подтвердить запись</button>
            </form>
        </div>
    </section>
</div>

<?php require_once 'includes/footer.php'; ?>