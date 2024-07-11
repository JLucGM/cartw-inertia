<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index($slug)
    {
        //dd('cart');
        $user = User::first();
        //$phone = $user->phone;
        $business = Business::where('slug', $slug)->first();
        //dd($business);
        if ($business) {
            $phone = $business->phone;
        }
        
        $cart = Cart::content();
        $tax = Cart::tax();
        $total = Cart::total(2, ',', '.');


        return Inertia::render('Shop/Cart', compact('phone','cart','tax','total','business'));
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

    public function eliminarElemento($rowId)
    {
        Cart::remove($rowId);

        return redirect()->back();
    }

    // public function pedidos()
    // {
    //     $orders = Orders::all();

    //     // $images = json_decode($orders->content);
    //     // dd($images );
    //     return view('orders/pedido', compact('orders'));
    // }



    public function finalizarPedido()
    {
        if (Auth::check()) {

            // Lógica para finalizar y confirmar el pedido

            // Obtener el contenido del carrito
            $contenidoCarrito = Cart::content();
            // dd(Cart::content());
            $contentArray = [];

            foreach ($contenidoCarrito as $item) {
                // Accede a los datos del producto
                $id = $item->id;
                $name = $item->name;
                $qty = $item->qty;
                $price = $item->price;
                $options = $item->options;

                // Agrega los datos al array
                $contentArray[] = [
                    'id' => $id,
                    'name' => $name,
                    'qty' => $qty,
                    'price' => $price,
                    'options' => $options
                ];
            }

            // $order = new Orders();
            // $order->content = json_encode($contentArray);
            // $order->save();

            // Vaciar el carrito después de finalizar el pedido
            Cart::destroy();
        } else {
            return redirect()->route('login');
        }

        // Redirigir a una página de confirmación de pedido
        return redirect()->back();
    }

    // public function pedidosShow($id)
    // {
    //     $orders = Orders::findOrFail($id);
    //     $orderContents = json_decode($orders->content);

    //     // dd($orderContents);
    //     return view('orders/pedidoShow', compact('orders', 'orderContents'));
    // }


}
