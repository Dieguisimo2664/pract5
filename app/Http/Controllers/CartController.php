<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use stdClass;

class CartController extends Controller
{

    
    
    public function saveProductIntoCart($product = null) {
        if (!$product) {
            abort(404); // Manejar caso cuando $product es null
        }
        
        // Decodificar la cadena base64 y decodificar el JSON
        $productData = json_decode(base64_decode($product), true);
    
        // Verificar si se pudo decodificar correctamente y validar s_size
        if (!$productData || !isset($productData['s_product']) || !isset($productData['s_size'])) {
            abort(400); // Retornar un error 400 si los datos no son válidos
        }
    
        $s_product = $productData['s_product'];
        $s_size = $productData['s_size'];
    
        $products = Product::all();

        // Verificar si s_size es nulo, vacío o "none"
        if (!$s_size || $s_size === 'none') {
            // Retornar una vista o modal que indique que s_size es inválido
            return compact('s_size');
            // Puedes también retornar una modal, utilizando la técnica previamente discutida para invocar modales en Laravel
            // return view('modals.invalid_size');
        }
    
        // Retornar la vista 'welcome' con los productos
        return view('welcome', compact('products'));
    }



    

    public function saveProductIntoCart2(Request $request) {
        // Obtener todos los productos desde la base de datos
        $products = Product::all();
    
        // Decodificar los datos JSON enviados en la solicitud
        $data = json_decode($request->getContent(), true);
        $productId = $data['s_product'];
        $size = $data['s_size'];
        $quantity = $data['s_quantity'];
    
        // Buscar el producto que coincide con el productId dentro de la colección $products
        $selectedProduct = $products->firstWhere('id', $productId);
    
        if ($selectedProduct) {
            // Obtener el campo sizes y dividirlo en elementos individuales
            $sizes = explode(',', $selectedProduct->sizes);
    
            // Iterar sobre los tamaños y verificar si $size está presente
            foreach ($sizes as $individualSize) {
                if (trim(strtolower($individualSize)) === trim(strtolower($size))) {
                    // Si coincide, realizar la acción deseada (por ejemplo, agregar al carrito)
                    // Puedes devolver el tamaño encontrado o hacer cualquier otra operación aquí
                    return "0001&&& $selectedProduct&&&$size&&&$quantity";
                }
            }
    
            // Si no se encontró coincidencia
            return "0000&&& Ha ocurrido un error inesperado, recargue la pagina e intente nuevamente";
        }
    
        // Manejar el caso donde no se encuentra el producto (esto es opcional según tu lógica)
        /* return "Producto con ID $productId no encontrado."; */
        return "0000&&& Ha ocurrido un error inesperado, recargue la pagina e intente nuevamente";
    }




    public function goToPayCart(Request $request) {
        $amount = $request->cartAmount;
    

        $api_key="4Vj8eK4rloUd272L48hsrarnUA";
        $info_pago=new stdClass();


        $info_pago->merchantId="508029";
        $info_pago->accountId="512321";
        $info_pago->description="Manhattan Clothes";
        $info_pago->referenceCode=uniqid();
        $info_pago->amount=$amount;
        $info_pago->tax="0";
        $info_pago->taxReturnBase="0";
        $info_pago->currency="COP";
        $info_pago->paymentMethods="VISA,MASTERCARD,PSE";
        $info_pago->signature=md5($api_key."~".$info_pago->merchantId."~".$info_pago->referenceCode."~".$amount."~".$info_pago->currency."~".$info_pago->paymentMethods);
        $info_pago->test="1";
        $info_pago->buyerEmail="ejemplo@mail.com";
        $info_pago->responseUrl="http://192.168.0.5/plantillatienda/";
        $info_pago->confirmationUrl="http://192.168.0.5/confirmacionPago.php";
        $info_pago->shippingAddress="direccion de ejemplo";
        $info_pago->buyerFullName="nombre de ejemplo";

        

        return $info_pago;
    }

}
