<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = Auth::user();
        $businessId = $user->businesses->first()->id;
$products = Product::where('business_id', $businessId)->get();

return Inertia::render('Product/Index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //request()->validate(Product::$rules);

        $user = Auth::user(); // Obtener el usuario logueado
        //$business = $user->businesses->first()->id; // Obtener la empresa asociada al usuario logueado
//dd($business);
        $product = new Product();
        $product->fill($request->all());
        $product->business_id = $user->businesses->first()->id; // Asignar la empresa al producto
        $product->save();

        // Guarda una sola imagen
        // if ($request->hasFile('image')) {
        //     $product->addMediaFromRequest('image')
        //         ->toMediaCollection('image');
        // }

        // // Guarda multiples imagenes
        // if ($request->hasFile('gallery')) {
        //     $product->addMultipleMediaFromRequest(['gallery'])
        //         ->each(function ($fileAdder) {
        //             $fileAdder->toMediaCollection('galleries');
        //         });
        // }

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return Inertia::render('Product/Edit',compact('product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //request()->validate(Product::$rules);

        $product->update($request->all());

        // Guarda una sola imagen
        // if ($request->hasFile('image')) {
        //     $product->clearMediaCollection('image');
        //     $product->addMediaFromRequest('image')
        //         ->toMediaCollection('image');
        // }
        
        // // Guarda multiples imagenes
        // if ($request->hasFile('gallery')) {
        //     // $product->clearMediaCollection('galleries');
        //     $product->addMultipleMediaFromRequest(['gallery'])
        //         ->each(function ($fileAdder) {
        //             $fileAdder->toMediaCollection('galleries');
        //         });
        // }

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product deleted successfully');
    }

    public function eliminarImagen(Product $product, $imagenId)
    {
        $product->media()->findOrFail($imagenId)->delete();
        return redirect()->back();
    }

}
