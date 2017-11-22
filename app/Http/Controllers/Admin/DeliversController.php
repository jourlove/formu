<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Deliver;
use Illuminate\Http\Request;
use App\Product;
use App\Stock;

class DeliversController extends Controller
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
            $delivers = Deliver::where('code', 'LIKE', "%$keyword%")
				->orWhere('weight', 'LIKE', "%$keyword%")
				->orWhere('price', 'LIKE', "%$keyword%")
				->orWhere('status', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $delivers = Deliver::paginate($perPage);
        }

        return view('admin.delivers.index', compact('delivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.delivers.create');
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
			'price' => 'required',
		]);
        $requestData = $request->all();
        $requestData['status'] = 0;
        $deliver = Deliver::create($requestData);

        foreach($requestData['jans'] as $key=>$jan) {
            if ($requestData['pid'][$key]=="") {
                $product = new Product();
                $product->category_id = 1;
                $product->name = $requestData['names'][$key];
                $product->description = $requestData['names'][$key];
                $product->jan = $jan;
                $product->save();
                $requestData['pid'][$key] = $product->id;
            }
            $deliver->products()->attach([$requestData['pid'][$key]=>['price'=>$requestData['prices'][$key]]]);
        }

        return redirect('admin/delivers')->with('flash_message', 'Deliver added!');
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
        $deliver = Deliver::findOrFail($id);

        return view('admin.delivers.show', compact('deliver'));
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
        $deliver = Deliver::findOrFail($id);
        return view('admin.delivers.edit', compact('deliver'));
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
			'price' => 'required',
		]);
        $requestData = $request->all();
        
        $deliver = Deliver::findOrFail($id);
        $deliver->update($requestData);
        $deliver->products()->detach();
        
        foreach($requestData['jans'] as $key=>$jan) {
            if ($requestData['pid'][$key]=="") {
                $product = new Product();
                $product->category_id = 1;                
                $product->name = $requestData['names'][$key];
                $product->description = $requestData['names'][$key];
                $product->jan = $jan;
                $product->save();
                $requestData['pid'][$key] = $product->id;
            }
            $deliver->products()->attach([$requestData['pid'][$key]=>['price'=>$requestData['prices'][$key]]]);            
        }

        return redirect('admin/delivers')->with('flash_message', 'Deliver updated!');
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
        Deliver::destroy($id);

        return redirect('admin/delivers')->with('flash_message', 'Deliver deleted!');
    }

    public function received($id)
    {
        $deliver = Deliver::findOrFail($id);
        $deliver->status = 2;
        $deliver->save();

        $products = [];
        foreach($deliver->products as $product) {
            if (isset($products[$product->id])) {
                $products[$product->id] = $products[$product->id] + 1;
            } else {
                $products[$product->id] = 1;
            }
        }

        foreach($products as $key=>$amount) {            
            $stock = Stock::find($key);
            if ($stock) {
                $stock->amount = $stock->amount + $amount;
                $stock->save();    
            } else {
                $stock = new Stock();
                $stock->product_id = $key;
                $stock->amount = $amount;
                $stock->save();    
            }
        }

        return redirect('admin/delivers')->with('flash_message', 'Deliver Received!');
    }

    public function delivering($id)
    {
        $deliver = Deliver::findOrFail($id);
        $deliver->status = 1;
        $deliver->save();

        return redirect('admin/delivers')->with('flash_message', 'Deliver Received!');
    }

}
