const menuButton = document.querySelector('.menu-toggle');
const navigation = document.querySelector('#menu-principal');
const smallScreen = window.matchMedia('(width < 42rem)');

function setMenuOpen(open) {
    menuButton.setAttribute('aria-expanded', String(open));
    navigation.hidden = smallScreen.matches && !open;
}

function updateMenuForScreenSize() {
    const navigationHadFocus = navigation.contains(document.activeElement);
    const buttonHadFocus = document.activeElement === menuButton;
    menuButton.hidden = !smallScreen.matches;
    setMenuOpen(false);

    if (smallScreen.matches && navigationHadFocus) {
        menuButton.focus();
    } else if (!smallScreen.matches && buttonHadFocus) {
        navigation.querySelector('a').focus();
    }
}

menuButton.addEventListener('click', () => {
    setMenuOpen(navigation.hidden);
});

navigation.addEventListener('click', (event) => {
    if (smallScreen.matches && event.target.closest('a')) {
        setMenuOpen(false);
    }
});

menuButton.parentElement.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && menuButton.getAttribute('aria-expanded') === 'true') {
        setMenuOpen(false);
        menuButton.focus();
    }
});

smallScreen.addEventListener('change', updateMenuForScreenSize);
updateMenuForScreenSize();

const form = document.querySelector('#formulario');
const phonePattern = /^(?:\([1-9][0-9]\)|[1-9][0-9]) ?[0-9]{4,5}-?[0-9]{4}$/;
const fields = [...form.querySelectorAll('input, select, textarea')];

function validateField(field) {
    const value = field.value.trim();
    const length = Array.from(value).length;

    switch (field.name) {
        case 'nome':
            return length >= 2 && length <= 80 ? '' : 'Informe um nome de 2 a 80 caracteres.';
        case 'telefone':
            return phonePattern.test(value) ? '' : 'Informe um telefone com DDD, como (41) 90000-0000.';
        case 'servico':
            return value ? '' : 'Selecione um dos serviços da lista.';
        case 'detalhes':
            return length <= 500 ? '' : 'Informe até 500 caracteres nos detalhes.';
    }
}

function showFieldError(field, message) {
    const error = document.getElementById(field.getAttribute('aria-describedby'));
    error.textContent = message;
    error.hidden = !message;

    if (message) {
        field.setAttribute('aria-invalid', 'true');
    } else {
        field.removeAttribute('aria-invalid');
    }
}

form.addEventListener('submit', (event) => {
    let firstInvalidField = null;
    for (const field of fields) {
        const message = validateField(field);
        showFieldError(field, message);
        if (message) {
            firstInvalidField ??= field;
        }
    }

    if (firstInvalidField) {
        event.preventDefault();
        firstInvalidField.focus();
    }
});

form.addEventListener('input', (event) => {
    const field = event.target;
    if (field.getAttribute('aria-invalid') === 'true') {
        showFieldError(field, validateField(field));
    }
});

// A validação nativa do HTML continua ativa quando o JavaScript não carrega.
form.noValidate = true;
