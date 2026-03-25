<?php require_once 'includes/header.php'; ?>

<div class="container">
    <section>
        <h2>Как нас найти</h2>
        
        <div class="contacts-container">
            <div class="contact-block">
                <h3>Контактная информация</h3>
                <p style="margin-top: 20px;"><strong>Адрес:</strong><br> г. Пермь, ул. Ленина, д. 49</p>
                <p style="margin-top: 10px;"><strong>Режим работы:</strong><br> Пн-Пт: 08:00 - 20:00<br> Сб-Вс: 09:00 - 18:00</p>
                <p style="margin-top: 10px;"><strong>Телефон:</strong><br> +7 (999) 000-00-00</p>
                <p style="margin-top: 10px;"><strong>Email:</strong><br> info@med-plus.ru</p>
                
                <hr style="margin: 20px 0;">
                
                <p>Нажмите кнопку ниже, чтобы построить маршрут:</p>
                <button class="geo-btn" onclick="getLocation()">Найти меня</button>
                <p id="geo-result" style="margin-top: 15px; font-weight: bold;"></p>
            </div>
        </div>
    </section>
</div>

<script>
    const geoOptions = {
        enableHighAccuracy: true,
        timeout: 10000,
        maximumAge: 0
    };

    function getLocation() {
        const resultDisplay = document.getElementById("geo-result");
        if (navigator.geolocation) {
            resultDisplay.innerHTML = "Запрос разрешения...";
            navigator.geolocation.getCurrentPosition(showPosition, showError, geoOptions);
        } else {
            resultDisplay.innerHTML = "Геолокация не поддерживается вашим браузером.";
        }
    }

    function showPosition(position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;
        
        const mapLink = `https://yandex.ru/maps/?pt=${lon},${lat}&z=14&l=map`;
        
        document.getElementById("geo-result").innerHTML = 
            `Ваши координаты:<br>Широта: ${lat.toFixed(4)}, Долгота: ${lon.toFixed(4)}<br>` +
            `<a href="${mapLink}" target="_blank" style="color: var(--primary-color);">Открыть маршрут на карте</a>`;
    }

    function showError(error) {
        let msg = "";
        switch(error.code) {
            case error.PERMISSION_DENIED: msg = "Вы запретили доступ к геолокации."; break;
            case error.POSITION_UNAVAILABLE: msg = "Местоположение недоступно."; break;
            case error.TIMEOUT: msg = "Время ожидания истекло."; break;
            default: msg = "Неизвестная ошибка."; break;
        }
        document.getElementById("geo-result").innerHTML = msg;
    }
</script>

<?php require_once 'includes/footer.php'; ?>

