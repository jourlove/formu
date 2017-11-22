<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\Stock;
use App\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $orders = Order::where('code', 'LIKE', "%$keyword%")
				->orWhere('weight', 'LIKE', "%$keyword%")
				->orWhere('postage', 'LIKE', "%$keyword%")
				->orWhere('status', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $orders = Order::paginate($perPage);
        }

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $options = $this->getOptions();
        return view('admin.orders.create',compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'code' => 'required',
			'weight' => 'required',
			'postage' => 'required',
		]);
        $requestData = $request->all();
        $requestData['status'] = 0;        
        $order = Order::create($requestData);

        foreach($requestData['pid'] as $key=>$pid) {
            $order->products()->attach([$pid=>['price'=>$requestData['prices'][$key],'amount'=>$requestData['amounts'][$key]]]);                
        }

        return redirect('admin/orders')->with('flash_message', 'Order added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $options = $this->getOptions();
        return view('admin.orders.edit', compact('order','options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'code' => 'required',
			'weight' => 'required',
			'postage' => 'required'
		]);
        $requestData = $request->all();      
        $order = Order::findOrFail($id);
        $order->update($requestData);

        $order->products()->detach();        
        foreach($requestData['pid'] as $key=>$pid) {
            $order->products()->attach([$pid=>['price'=>$requestData['prices'][$key],'amount'=>$requestData['amounts'][$key]]]);                
        }

        return redirect('admin/orders')->with('flash_message', 'Order updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return redirect('admin/orders')->with('flash_message', 'Order deleted!');
    }

    public function received($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 2;
        $order->save();

        $products = [];
        foreach($order->products as $product) {
            if (isset($products[$product->id])) {
                $products[$product->id] = $products[$product->id] + $product->pivot->amount;
            } else {
                $products[$product->id] = $product->pivot->amount;
            }
        }

        foreach($products as $key=>$amount) {            
            $stock = Stock::where('product_id',$key)->first();
            $stock->amount = $stock->amount - $amount;
            $stock->save();    
        }

        return redirect('admin/orders')->with('flash_message', 'Order Received!');
    }

    public function delivering($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 1;
        $order->save();

        return redirect('admin/orders')->with('flash_message', 'Order Received!');
    }

    public function getOptions() {
        $stocks = Stock::all();
        $products_option = [''=>'-----'];
        foreach($stocks as $stock) {
            $products_option[$stock->product_id] = $stock->product->name;
        }
        $options = [
            'products' => $products_option,
        ];
        return $options;
    }

}
