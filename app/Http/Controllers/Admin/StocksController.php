<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Stock;
use Illuminate\Http\Request;

class StocksController extends Controller
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
            $stocks = Stock::where('product_id', 'LIKE', "%$keyword%")
				->orWhere('amount', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $stocks = Stock::paginate($perPage);
        }

        return view('admin.stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.stocks.create');
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
			'product_id' => 'required',
			'amount' => 'required'
		]);
        $requestData = $request->all();
        
        Stock::create($requestData);

        return redirect('admin/stocks')->with('flash_message', 'Stock added!');
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
        $stock = Stock::findOrFail($id);

        return view('admin.stocks.show', compact('stock'));
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
        $stock = Stock::findOrFail($id);

        return view('admin.stocks.edit', compact('stock'));
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
			'product_id' => 'required',
			'amount' => 'required'
		]);
        $requestData = $request->all();
        
        $stock = Stock::findOrFail($id);
        $stock->update($requestData);

        return redirect('admin/stocks')->with('flash_message', 'Stock updated!');
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
        Stock::destroy($id);

        return redirect('admin/stocks')->with('flash_message', 'Stock deleted!');
    }
}
