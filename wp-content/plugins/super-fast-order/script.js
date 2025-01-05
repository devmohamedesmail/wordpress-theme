

document.addEventListener("DOMContentLoaded",function (){
    const quantity = document.getElementById('quantity');
    const inc_btn = document.getElementById('inc_btn');
    const dec_btn = document.getElementById('dec_btn');
    
    
    
    
  // Increment button functionality
  inc_btn.addEventListener('click', function () {
    quantity.value = parseInt(quantity.value) + 1;
});

// Decrement button functionality
dec_btn.addEventListener('click', function () {
    if (parseInt(quantity.value) > 1) {
        quantity.value = parseInt(quantity.value) - 1;
    }
});
})