<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;

class ProductController extends Controller
{
    /*Por convencion se nombra el metodo index, para listar desde la base de datos,
    el metodo create cuando vamos a hacer el registro de un producto o nueva entidad
    y el metodo store para guardar o registrar los cambios*/
    public function index(){
      $products = Product::paginate(10);
      return view('admin.products.index')->with(compact('products')); //listado de productos
    }

    public function create(){
      return view('admin.products.create'); //Formulario de registro
    }

    // registrar el nuevo producto en la base de datos
    public function store(Request $request){

      //VALIDACION DE LOS DATOS DEL PRODUCTO
      $messages = [
        'name.required' => 'Es necesario ingresar un nombre para el producto.',
        'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
        'description.required' => 'La descripcion corta es un campo obligatorio.',
        'description.max' => 'La descripcion corta solo admite hasta 200 caracteres.',
        'price.required' => 'Es obligatorio definir un precio para el producto.',
        'price.numeric' => 'Ingrese un precio valido.',
        'price.min' => 'No se admiten precios negativos.'
      ];
      $rules = [
        'name' => 'required|min:3', //el nombre es un campo obligatorio
        'description' => 'required|max:200', //el nombre debe contener por lo menos 3 caracteres
        'price' => 'required|numeric|min:0' //El precio del producto debe ser numerico y minimo 0
      ];
      $this->validate($request, $rules, $messages);

      //dd($request->all());
      $product = new Product();
      $product->name = $request->input('name');
      $product->price = $request->input('price');
      $product->description = $request->input('description');
      $product->long_description = $request->input('long_description');
      $product->save(); //INSERT
      return redirect('/admin/products');
    }

    public function edit($id){
      // return "Mostrar aqui el form de edicion para el producto con id $id";
      $product = Product::find($id);
      return view('admin.products.edit')->with(compact('product'));
    }

    public function update(Request $request, $id){

      $messages = [
        'name.required' => 'Es necesario ingresar un nombre para el producto.',
        'name.min' => 'El nombre del producto debe tener al menos 3 caracteres.',
        'description.required' => 'La descripcion corta es un campo obligatorio.',
        'description.max' => 'La descripcion corta solo admite hasta 200 caracteres.',
        'price.required' => 'Es obligatorio definir un precio para el producto.',
        'price.numeric' => 'Ingrese un precio valido.',
        'price.min' => 'No se admiten precios negativos.'
      ];
      $rules = [
        'name' => 'required|min:3', //el nombre es un campo obligatorio
        'description' => 'required|max:200', //el nombre debe contener por lo menos 3 caracteres
        'price' => 'required|numeric|min:0' //El precio del producto debe ser numerico y minimo 0
      ];
      $this->validate($request, $rules, $messages);

      $product = Product::find($id);
      $product->name = $request->input('name');
      $product->price = $request->input('price');
      $product->description = $request->input('description');
      $product->long_description = $request->input('long_description');
      $product->save(); //Realiza la opcion de UPDATE EN LA BASE DE DATOS

      return redirect('/admin/products');
    }

    public function destroy($id){
      ProductImage::where('product_id', $id)->delete();

       $product = Product::find($id);
       $product->delete(); // DELETE

       //regresa la vista anteriror
       return back();
    }
}
