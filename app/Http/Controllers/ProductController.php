<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;



class ProductController extends Controller {

    
    

    public function index() {

        $products=Product::all();
        return view('welcome', compact('products'));
        
    }

    public function viewProducts($texto = null) {

        // Obtener todos los productos
        $products = Product::all();
    
        // Inicializar un array vacío para almacenar categorías únicas
        $uniqueCategories = [];
    
        // Iterar sobre cada producto para obtener la categoría y agregarla al array único
        foreach ($products as $product) {
            $category = $product->category;
    
            // Verificar si la categoría ya existe en el array único
            if (!in_array($category, $uniqueCategories)) {
                // Si no existe, agregarla al array único
                $uniqueCategories[] = $category;
            }
        }
    
        // Ahora $uniqueCategories contiene todas las categorías únicas
        // Puedes hacer lo que necesites con este array, como devolverlo desde la función
        
        

        if (empty($texto)) {
           
            $products=Product::all();
            /* dd($texto); */
            return view('welcome', compact('products','uniqueCategories'));
           
        } else {

            $cadenaS = str_replace(['{', '}'], '', $texto);

            // Filter products based on the sanitized $cadenaS
            $products = Product::where('category', $cadenaS)->get();

            // Return the filtered products to the view

            /* dd($texto); */

            
            return view('welcome', compact('products','uniqueCategories'));

        }
  
    }


    public function viewDetailP($idp = null) {
        // Decodificar $idp de base64
        $decodedIdp = base64_decode($idp);
    
        // Obtener todos los productos
        $products = Product::all();
    
        // Buscar el producto cuyo id coincida con $decodedIdp
        $selectedProduct = $products->first(function ($product) use ($decodedIdp) {
            return $product->id == $decodedIdp;
        });
    
        // Verificar si se encontró un producto
        if ($selectedProduct) {
            // Retornar la vista con el producto encontrado
            /* dd($selectedProduct); */
            return view('product.detail-view', compact('selectedProduct'));
        } else {
            // Manejar el caso donde no se encontró el producto (puedes redirigir, mostrar un mensaje de error, etc.)
            // Por ejemplo, podrías redirigir a una página de error 404
            abort(404);
        }
    }
   

}
