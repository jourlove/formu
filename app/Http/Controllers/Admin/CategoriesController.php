<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
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
            $categories = Category::where('parent_id', 'LIKE', "%$keyword%")
				->orWhere('name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $categories = Category::paginate($perPage);
        }

        return view('admin.categories.index', compact('categories'));
    }

    public function getOptions() {
        $categories = Category::all();
        $categories_option = [''=>'-----'];
        foreach($categories as $category) {
            $categories_option[$category->id] = $category->name;
        }
        $options = [
            'categories' => $categories_option,
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
        return view('admin.categories.create', ['options'=>$this->getOptions()]);
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        if (trim($requestData['parent_id'])) {
            $pcategory = Category::find(trim($requestData['parent_id']));
            $requestData['layer'] = $pcategory->layer+1;
        } else {
            $requestData['layer'] = 0;
        }
        
        Category::create($requestData);

        return redirect('admin/categories')->with('flash_message', 'Category added!');
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
        $category = Category::findOrFail($id);

        return view('admin.categories.show', compact('category'));
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
        $category = Category::findOrFail($id);
        $options = $this->getOptions();
        return view('admin.categories.edit', compact('category','options'));
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        if (trim($requestData['parent_id'])) {
            $pcategory = Category::find(trim($requestData['parent_id']));
            $requestData['layer'] = $pcategory->layer+1;
        } else {
            $requestData['layer'] = 0;
        }
        
        $category = Category::findOrFail($id);
        $category->update($requestData);

        return redirect('admin/categories')->with('flash_message', 'Category updated!');
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
        Category::destroy($id);

        return redirect('admin/categories')->with('flash_message', 'Category deleted!');
    }
}
