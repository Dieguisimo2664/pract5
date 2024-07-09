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


    public function allCategorys() {
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

        
        return view('welcome', compact('uniqueCategories'));
    }
   

}
