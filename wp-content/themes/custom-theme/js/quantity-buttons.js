document.addEventListener('DOMContentLoaded', function () {
    const quantityInputs = document.querySelectorAll('.quantity-input');

    quantityInputs.forEach((input) => {
        const container = input.parentElement;
        const increaseButton = container.querySelector('.increase');
        const decreaseButton = container.querySelector('.decrease');

        increaseButton.addEventListener('click', () => {
            const max = parseInt(input.getAttribute('max')) || Infinity;
            const step = parseInt(input.getAttribute('step')) || 1;
            let value = parseInt(input.value) || 0;

            if (value < max) {
                input.value = value + step;
                input.dispatchEvent(new Event('change')); // For WooCommerce update
            }
        });

        decreaseButton.addEventListener('click', () => {
            const min = parseInt(input.getAttribute('min')) || 0;
            const step = parseInt(input.getAttribute('step')) || 1;
            let value = parseInt(input.value) || 0;

            if (value > min) {
                input.value = value - step;
                input.dispatchEvent(new Event('change')); // For WooCommerce update
            }
        });
    });
});
