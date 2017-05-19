<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Specs;

class CategoriesController extends Controller
{
    /*
     * list category
     */
    public function index(Category $category){
        $list_category = $category->getList();
        return view('backend.category.list',[
            'list_category' => $list_category,
        ]);
    }

    /**
     * @param category $category
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewDetails(Category $category, Specs $specs, $id){
        $details_category = $category->getDetails($id);
//        $specs_list = $specs->getSpecsFromCategory($id);
        return view('backend.category.view',[
            'details_category' => $details_category,
//            'specs_list' => $specs_list
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreateForm(){
        return view('backend.category.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:categories'
        ]);
        $category = Category::create($request->all());
        return redirect(route('backend.category.viewDetails',['id' => $category['id'] ]))->with('created_message','Created !');
    }

    /**
     * @param Category $category
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditForm(Category $category, $id){
        $details_category = $category->getDetails($id);
        return view('backend.category.edit',[
            'details_category' => $details_category,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required',
        ]);
        $category = Category::findOrFail($request->id);
        $category->update($request->all());

        return redirect(route('backend.category.viewDetails',['id' => $category['id'] ]))->with('updated_message','Updated !');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request){
        $category = Category::findOrFail($request->category_id);
        $category->delete();
        return redirect(route('backend.category.list'))->with('deleted_message','Deleted !');
    }
}
