<?php

namespace App\Http\Controllers;

use App\Models\Business;
use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

/**
 * Class BusinessController
 * @package App\Http\Controllers
 */
class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = Business::all();

        //$businesses = Business::where('user_id', Auth::user()->id)->get();

       
       return Inertia::render('Business/Index',compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //dd('create');
        return Inertia::render('Business/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    //request()->validate(Business::$rules);

    $business = new Business();
    $business->name = $request->input('name');
    $business->email = $request->input('email');
    $business->phone = $request->input('phone');
    $business->direction = $request->input('direction');
    $business->rif = $request->input('rif');
    $business->slug = Str::slug($request->input('name')); // Crear el slug

    $business->save();

    $business->users()->attach(auth()->id());

    return redirect()->route('business.index')
        ->with('success', 'Business created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business = Business::find($id);

        return view('business.show', compact('business'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($business)
    {
        //dd($business);
         $business = Business::find($business);

        // return view('business.edit', compact('business'));
        return Inertia::render('Business/Edit',compact('business'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Business $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        //request()->validate(Business::$rules);

        $business->update($request->all());

        return redirect()->route('business.index')
            ->with('success', 'Business updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $business = Business::find($id)->delete();

        return redirect()->route('business.index')
            ->with('success', 'Business deleted successfully');
    }

    public function shop($slug)
    {
        $business = Business::where('slug', $slug)
        ->with('products') // Cargar la relación products
        ->firstOrFail();

    $products = $business->products;

        //return view('shop', compact('business','products'));
        return Inertia::render('Shop/Shop',compact('products','slug'));
    }

    public function add(Request $request)
    {
        //dd($request);
        // dd(Cart::content());
        $cartItem = Cart::add(
            $request->product_id,
            $request->name,
            $request->quantity,
            $request->price,
            //[
            //    'img' => $request->img,
            //    'prueba' => $request->prueba
            //]
        );

        // $items = $cartItem->toArray()['items'];

        // dd(Cart::content());
        return redirect()->back();
    }
}
