const modal01 = $('#exampleModal');
const templateItemCart = document.querySelector('.template-item-cart').content
const cartItemsContainer = document.querySelector('.cart-items');

let Cart = [];

document.addEventListener('DOMContentLoaded', async function() {
    
    loadCart();

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
    

    if (e.target.classList.contains('dt-size-btn')) {
       
        // Obtener todos los elementos dentro del div con id "contenedor" que tienen la clase "activo"
        var elementosActivos = e.target.parentElement.querySelectorAll('.btn-size-active');

        // Iterar sobre cada elemento activo y eliminar la clase "activo"
        elementosActivos.forEach(function(elemento) {
            elemento.classList.remove('btn-size-active');
        });
        
        e.target.classList.add('btn-size-active')

        const addToCartButton = document.querySelector('.btn-add-to-cart');

        // Verifica si se encontró el botón
        if (addToCartButton) {
            // Obtén el valor del atributo data como cadena JSON
            const dataString = addToCartButton.dataset.data;

            // Convierte la cadena JSON a un objeto JavaScript
            let dataObject = JSON.parse(dataString);

            // Realiza los cambios necesarios en el objeto JavaScript
            dataObject.s_size = e.target.dataset.data;

            // Convierte el objeto modificado de vuelta a una cadena JSON
            const newDataString = JSON.stringify(dataObject);

            // Guarda la cadena JSON actualizada de vuelta en el atributo data del elemento
            addToCartButton.dataset.data = newDataString;

        }
        


    }




    if (e.target.classList.contains('dt-sm-img')) {

        // Obtener todos los elementos dentro del div con id "contenedor" que tienen la clase "activo"
        var elementosActivos = e.target.parentElement.querySelectorAll('.btn-img-active');

        // Iterar sobre cada elemento activo y eliminar la clase "activo"
        elementosActivos.forEach(function(elemento) {
            elemento.classList.remove('btn-img-active');
        });
        
        e.target.classList.add('btn-img-active')


        const img = e.target.querySelector('img').getAttribute('src')
        document.querySelector('.dt-lg-img').setAttribute('src', img);



    }




    if (e.target.classList.contains('shc-btn') | e.target.classList.contains('dn-sct2')) {
        document.querySelector('.cart-container').classList.add('cart--show')
    }




    if (e.target.classList.contains('cart-close-btn')) {
        document.querySelector('.cart-container').classList.remove('cart--show')
    }

    


    if (e.target.classList.contains('btn-add-to-cart')) {



        // Obtén el valor del atributo 'data-data' del elemento
        const data = e.target.getAttribute('data-data');
    
        // Parsea los datos JSON del atributo 'data-data'
        const parsedData = JSON.parse(data);


        if (parsedData.s_size !== null && parsedData.s_size !== '' && parsedData.s_size !== 'none') {
            
            
            // Obtén el token CSRF del meta tag en tu HTML
            const token = document.head.querySelector('meta[name="csrf-token"]').content;
        
            fetch('/saveProd', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token // Asegúrate de incluir el token CSRF si es necesario
                },
                body: JSON.stringify({
                    s_product: parsedData.s_product,
                    s_size: parsedData.s_size,
                    s_quantity: parsedData.s_quantity
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text(); // Cambia a response.text() para obtener el texto plano
            })
            .then(data => {
                

                const responseData = data.split('&&&');

                if (responseData[0] === "0001") {

                    
                    const packageProd = {
                        sku: JSON.parse(responseData[1]).id,
                        productData: responseData[1],
                        size: responseData[2],
                        quantity: parseInt(responseData[3]) // Convertir a número usando parseInt()
                    };
                    
                    // Función para verificar y actualizar el carrito
                    function addToCart(packageProd) {
                        // Buscar si ya existe un elemento con el mismo SKU y size en el carrito
                        const index = Cart.findIndex(item => item.sku === packageProd.sku && item.size === packageProd.size);
                    
                        if (index !== -1) {
                            // Si existe, sumar la cantidad al elemento existente
                            Cart[index].quantity += packageProd.quantity;
                        } else {
                            // Si no existe, agregar el nuevo elemento al carrito
                            Cart.push(packageProd);
                        }
                        localStorage.setItem('cart', btoa(JSON.stringify(Cart)));
                    }
                    
                    // Llamar a la función para agregar el nuevo producto al carrito
                    addToCart(packageProd);
                    
                    // Mostrar el producto que se va a agregar al carrito
                    console.log(localStorage);
                    loadCart()

                } else {

                    showModal01('Oops!&&&Ha ocurrido un error inesperado, recargue la pagina e intente nuevamente.')

                }
                
                

                

            })
            .catch(error => {
                console.error('Fetch error:', error);
            });


        } else {
            
            showModal01('Oops!&&&Debes seleccionar una talla para continuar.')

        }
    
        
    }




    if (e.target.classList.contains('cart-item-btn-delete')) {
        const itemSelected = JSON.parse(atob(e.target.dataset.data));
        console.log(itemSelected);
    
        // Filtramos el array cart para excluir el elemento con el mismo sku y size
        Cart = Cart.filter(item => {
            // Parseamos item.productData para obtener id, size y sku
            let productData = JSON.parse(item.productData);
            let itemSku = productData.id.toString(); // Convertimos a string si es necesario
            let itemSize = item.size; // Suponiendo que el tamaño está directamente en el objeto item
    
            // Comparamos sku y size con los de itemSelected
            return !(itemSku === itemSelected.sku.toString() && itemSize === itemSelected.size);
        });
    
        localStorage.setItem('cart', btoa(JSON.stringify(Cart)));

        // Opcional: Mostramos un mensaje de éxito o actualización
        console.log('Cart actualizado y guardado en LocalStorage:', Cart);
        loadCart()

    }
    



    if (e.target.classList.contains('cart-delete-btn')) {
        localStorage.clear()
        Cart = [];
        loadCart();
    }




    if (e.target.classList.contains('dt-add-quantity')) {

        

        const addToCartButton = document.querySelector('.btn-add-to-cart');

        // Verifica si se encontró el botón
        if (addToCartButton) {
            // Obtén el valor del atributo data como cadena JSON
            const dataString = addToCartButton.dataset.data;

            // Convierte la cadena JSON a un objeto JavaScript
            let dataObject = JSON.parse(dataString);

            // Realiza los cambios necesarios en el objeto JavaScript
            dataObject.s_quantity = dataObject.s_quantity + 1;

            // Convierte el objeto modificado de vuelta a una cadena JSON
            const newDataString = JSON.stringify(dataObject);

            // Guarda la cadena JSON actualizada de vuelta en el atributo data del elemento
            addToCartButton.dataset.data = newDataString;
        }

        updateDetail()

    }



    if (e.target.classList.contains('dt-sub-quantity')) {

        

        const addToCartButton = document.querySelector('.btn-add-to-cart');

        // Verifica si se encontró el botón
        if (addToCartButton) {
            // Obtén el valor del atributo data como cadena JSON
            const dataString = addToCartButton.dataset.data;

            // Convierte la cadena JSON a un objeto JavaScript
            let dataObject = JSON.parse(dataString);

            // Realiza los cambios necesarios en el objeto JavaScript
            if (dataObject.s_quantity > 1) {
                dataObject.s_quantity = dataObject.s_quantity - 1;
            }
            

            // Convierte el objeto modificado de vuelta a una cadena JSON
            const newDataString = JSON.stringify(dataObject);

            // Guarda la cadena JSON actualizada de vuelta en el atributo data del elemento
            addToCartButton.dataset.data = newDataString;
        }

        updateDetail()

    }




    if (e.target.classList.contains('cart-pay-btn')) {

        // Obtén el token CSRF del meta tag en tu HTML
        const token = document.head.querySelector('meta[name="csrf-token"]').content;
        
        fetch('/gotopay', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token // Asegúrate de incluir el token CSRF si es necesario
            },
            body: JSON.stringify({
                cartItems: Cart,
                cartAmount: Cart.reduce((total, item) => total + JSON.parse(item.productData).price * item.quantity, 0)
            })
        })

        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text(); // Cambia a response.text() para obtener el texto plano
        })

        .then(data => {

            const info_pago = JSON.parse(data);

            console.log(info_pago)
            
            function submitForm() {
                // Crear un formulario
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/';
    
                // Crear y agregar los campos ocultos
                const fields = {
                    merchantId: info_pago.merchantId,
                    accountId: info_pago.accountId,
                    description: info_pago.description,
                    referenceCode: info_pago.referenceCode,
                    amount: info_pago.amount,
                    tax: info_pago.tax,
                    taxReturnBase: info_pago.taxReturnBase,
                    currency: info_pago.currency,
                    paymentMethods: info_pago.paymentMethods,
                    signature: info_pago.signature,
                    test: info_pago.test,
                    buyerEmail: info_pago.buyerEmail,
                    shippingAddress: info_pago.shippingAddress,
                    buyerFullName: info_pago.buyerFullName,
                    responseUrl: info_pago.responseUrl,
                    confirmationUrl: info_pago.confirmationUrl
                };
    
                for (const [name, value] of Object.entries(fields)) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    input.value = value;
                    form.appendChild(input);
                }
    
                // Agregar el formulario al body y enviarlo
                document.body.appendChild(form);
                form.submit();
            }
    
            // Ejecutar la función para enviar el formulario automáticamente
            submitForm();

        })

        .catch(error => {
            console.error('Fetch error:', error);
        });

    }


    
});


function updateDetail() {

    const addToCartButton = document.querySelector('.btn-add-to-cart');

    // Verifica si se encontró el botón
    if (addToCartButton) {
        // Obtén el valor del atributo data como cadena JSON
        const dataString = addToCartButton.dataset.data;

        // Convierte la cadena JSON a un objeto JavaScript
        let dataObject = JSON.parse(dataString);

        
        document.querySelector('.dt-price').textContent = `$${(dataObject.sp_data.price * dataObject.s_quantity).toLocaleString('en-US', { minimumFractionDigits: 2 })}`
        
        document.querySelector('.dt-show-quantity').textContent = dataObject.s_quantity
    }

}



function loadCart() {

    const cartHeadTxt = document.querySelector('.cart-head-text');
    cartItemsContainer.innerHTML=""
    cartHeadTxt.textContent = "Cart"
    document.querySelector('.dn-quantity-indicator').style.display ='none';
    document.querySelector('.cart-totally-text').textContent = '';
    document.querySelector('.cart-info').style.display="none"

    if (localStorage.getItem('cart')) {

        if (JSON.parse(atob(localStorage.getItem('cart')))) {

            const LSCart = JSON.parse(atob(localStorage.getItem('cart')));
            
            Cart = LSCart;
    
            
    
            if (Cart.length != 0) {
    
                document.querySelector('.dn-quantity-indicator').style.display ='flex'
    
                let totalQuantity = Cart.reduce((total, item) => total + item.quantity, 0);
    
                let totally = Cart.reduce((total, item) => total + JSON.parse(item.productData).price * item.quantity, 0);
    
                document.querySelector('.cart-totally-text').textContent = `Total: $${totally.toLocaleString('en-US', { minimumFractionDigits: 2 })}`
                
                document.querySelector('.dn-quantity-indicator').textContent = totalQuantity
        
                cartHeadTxt.textContent = `Cart(${totalQuantity})`
        
                
                Cart.forEach(item => {
                    try {
                        // Parseamos productData para acceder al campo price
                        let productData = JSON.parse(item.productData);
                        
                        // Multiplicamos price por quantity
                        let totalPrice = (productData.price * item.quantity).toLocaleString('en-US', { minimumFractionDigits: 2 });
        
                        const clonTemplateItemCart = templateItemCart.cloneNode(true);
        
                        clonTemplateItemCart.querySelector('.cart-item-btn-delete').dataset.data = btoa(JSON.stringify(item))
        
                        clonTemplateItemCart.querySelector('.cart-item-img').setAttribute('src', productData.media.split(',')[0])
                        clonTemplateItemCart.querySelector('.cart-item-name-product').textContent = productData.name
        
                        clonTemplateItemCart.querySelector('.cart-item-size').textContent = item.size;
        
                        clonTemplateItemCart.querySelector('.cart-item-quantity').textContent = `Quantity: ${item.quantity}`
        
                        clonTemplateItemCart.querySelector('.cart-item-totalp').textContent = `$${totalPrice}`
        
                        cartItemsContainer.appendChild(clonTemplateItemCart);
                        
                        
                        // Mostramos el resultado por consola
                        console.log(`Total price for this item: ${totalPrice}`);
                    } catch (error) {
                        console.error('Error parsing productData:', error);
                    }
        
                });
        
                document.querySelector('.cart-info').style.display="grid"
        
            } else {
        
                document.querySelector('.cart-info').style.display="none"
                cartHeadTxt.textContent = "Cart"
        
            }
    
        }
    
    }

    
    

    


    

    
}



function showModal01(strings) {

    //FORMATO MODAL texto1&&&texto2//

    const text1 = strings.split('&&&')[0];
    const text2 = strings.split('&&&')[1];

    var modalTitle = document.querySelector('.modal-title');
    var modalBody = document.querySelector('.modal-body');

    modalTitle.textContent = text1;
    modalBody.textContent = text2;

    modal01.modal('show');

}