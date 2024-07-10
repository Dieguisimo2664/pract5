var categoryDisplayed = "mix"
const templateProduct = document.querySelector('.template-product').content;
const templateDetailP = document.querySelector('.template-p-detail').content;
const productsContainer = document.querySelector('.products-container');

let products = [];


document.addEventListener('DOMContentLoaded', async function() {

    

});


document.addEventListener('scroll', function() {
    // Verificar si el scroll es mayor a 200
    if (window.scrollY > 200) {

        document.querySelector('.nav-logo').classList.add('nav-logo-hidden')
        document.querySelector('.nav-options-container').classList.add('nav-options-container-scrolled')

    } else {

        document.querySelector('.nav-logo').classList.remove('nav-logo-hidden')
        document.querySelector('.nav-options-container').classList.remove('nav-options-container-scrolled')

    }
});




// EVENTO CLICK //
document.addEventListener('click', function(e) {
    
    
    if (e.target.classList.contains('mcc-btn-category-mix')) {
        
        
    }

    if (e.target.classList.contains('mcc-btn-category-summer')) {

        
    }

    if (e.target.classList.contains('mcc-btn-category-winter')) {

        
    }

    if (e.target.classList.contains('product-body')) {
        
    }

    /* if (e.target.closest('.product-body')) {
       console.log(e.target)
    } */

    
});


