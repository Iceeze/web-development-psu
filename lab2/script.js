const fromSelect = document.getElementById('fromSystem');
const toSelect = document.getElementById('toSystem');
const display = document.getElementById('display');
const keypad = document.getElementById('keypad');

const digits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];
var isResult = false;

// Заполнение списков
function initSelects() {
    for (let i = 2; i <= 16; i++) {
        let optionFrom = document.createElement('option');
        optionFrom.value = i;
        optionFrom.text = `Base ${i}`;
        fromSelect.appendChild(optionFrom);

        let optionTo = document.createElement('option');
        optionTo.value = i;
        optionTo.text = `Base ${i}`;
        toSelect.appendChild(optionTo);
    }
    fromSelect.value = 10;
    toSelect.value = 2;
}

function createButtons() {
    digits.forEach((digit, index) => {
        const btn = document.createElement('button');
        btn.textContent = digit;
        btn.className = 'btn-digit';
        btn.dataset.value = index;
        
        btn.onclick = () => handleInput(digit);
        
        keypad.appendChild(btn);
    });

    const resetBtn = document.createElement('button');
    resetBtn.textContent = 'Сброс';
    resetBtn.className = 'btn-reset btn-func';
    resetBtn.onclick = clearDisplay;
    keypad.appendChild(resetBtn);

    const calcBtn = document.createElement('button');
    calcBtn.textContent = 'Перевести';
    calcBtn.className = 'btn-func';
    calcBtn.onclick = calculateResult;
    keypad.appendChild(calcBtn);
}

function updateButtonState() {
    const currentBase = parseInt(fromSelect.value);
    const buttons = document.querySelectorAll('.btn-digit');

    buttons.forEach(btn => {
        const btnValue = parseInt(btn.dataset.value);
        
        if (btnValue >= currentBase) {
            btn.disabled = true;
        } else {
            btn.disabled = false;
        }
    });
}

function handleInput(char) {
    if (isResult) {
        display.value = char;
        isResult = false;
        return;
    }
    if (display.value === '0' || display.value === 'Ошибка') {
        display.value = char;
    } else {
        display.value += char;
    }
}

function clearDisplay() {
    display.value = '';
    display.placeholder = '0';
}

function calculateResult() {
    const inputStr = display.value;
    const fromBase = parseInt(fromSelect.value);
    const toBase = parseInt(toSelect.value);

    if (!inputStr) return;

    try {
        const decimalValue = parseInt(inputStr, fromBase);

        if (isNaN(decimalValue)) {
            display.value = "Ошибка";
            return;
        }

        const result = decimalValue.toString(toBase).toUpperCase();
        display.value = result;
        isResult = true;
    } catch (e) {
        display.value = "Ошибка";
    }
}

fromSelect.addEventListener('change', () => {
    updateButtonState();
    clearDisplay();
});

initSelects();
createButtons();
updateButtonState();