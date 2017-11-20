<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Http\Request;
use App\Category;

class ProductsController extends Controller
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
            $products = Product::where('category_id', 'LIKE', "%$keyword%")
				->orWhere('name', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->orWhere('color', 'LIKE', "%$keyword%")
				->orWhere('size', 'LIKE', "%$keyword%")
				->orWhere('suitable_age', 'LIKE', "%$keyword%")
				->orWhere('suitable_gender', 'LIKE', "%$keyword%")
				->orWhere('material', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $products = Product::paginate($perPage);
        }

        return view('admin.products.index', compact('products'));
    }

    public function getOptions() {
        $categories = Category::all();
        $categories_option = [];
        foreach($categories as $category) {
            $categories_option[$category->id] = $category->name;
        }
        $colors_option = ['0'=>'红色','1'=>'白色','2'=>'黑色','3'=>'蓝色'];
        $size_option = ['0'=>'xs','1'=>'s','2'=>'m','3'=>'l'];
        $age_option = ['0'=>'0-6','1'=>'18~','2'=>'40~','3'=>'60~'];
        $gender_option = ['0'=>'男','1'=>'女','2'=>'都行'];

        $options = [
            'categories' => $categories_option,
            'colors' => $colors_option,
            'size' => $size_option,
            'age' => $age_option,
            'gender' => $gender_option,

        ];
        return $options;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.products.create',['options'=>$this->getOptions()]);
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
			'category_id' => 'required',
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        Product::create($requestData);

        return redirect('admin/products')->with('flash_message', 'Product added!');
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
        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product'));
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
        $product = Product::findOrFail($id);
        $options = $this->getOptions();
        return view('admin.products.edit', compact('product','options'));
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
			'category_id' => 'required',
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        $product = Product::findOrFail($id);
        $product->update($requestData);

        return redirect('admin/products')->with('flash_message', 'Product updated!');
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
        Product::destroy($id);

        return redirect('admin/products')->with('flash_message', 'Product deleted!');
    }
}
