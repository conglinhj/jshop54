<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specs;
use App\Models\Hardware;
use App\Models\Product;


class SpecsController extends Controller
{
    /**
     * show Specs list
     * @param Specs $specs
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function index(Specs $specs)
    {
        $list_specs = $specs->getAll();
        return view('backend.specs.list',[
            'list_specs' => $list_specs,
        ]);
    }

    /**
     * get details of Specs has $id
     * @param Specs $specs
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewDetails(Specs $specs, $id)
    {
        $details_specs = $specs->viewDetail($id);
        return view('backend.specs.view',[
            'details_specs' => $details_specs,
        ]);
    }

    /**
     * show create form, create new Specs
     */
    public  function showCreateForm(Hardware $hardware)
    {
        $hardwares = $hardware->getAll();
        return view('backend.specs.create',[
            'hardwares' => $hardwares,
        ]);
    }
    public function store(Product $product, Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255|unique:specs',
        ]);
        $specs = Specs::create($request->all());
        // attach to product_specs with value = ""
        $productId_list = $product->getListId();
        $proId_array = array();
        foreach ($productId_list as $pro_id){
            $proId_array[] = $pro_id['id'];
        }
        $specs->storeToPivotTable($proId_array);

    }

    /**
     * show edit form with Specs $id, update Specs
     */
    public function showEditForm(Specs $specs, Hardware $hardware, $id)
    {
        $details_specs = $specs->viewDetail($id);
        $hardwares = $hardware->getAll();
        return view('backend.specs.edit',[
            'details_specs' => $details_specs,
            'hardwares' => $hardwares,
        ]);
    }
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
        ]);
        $specs = Specs::findOrFail($request->id);
        $specs->update($request->all());

        return redirect(route('backend.specs.viewDetails',[ 'id' => $request->id ]))->with('updated_message','Updated !');
    }

    /**
     * delete Specs in Database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product, Request $request)
    {
        $specs = Specs::findOrFail($request->id);

        // step 1 : detach to product_specs tables
        $productId_list = $product->getListId();
        $proId_array = array();
        foreach ($productId_list as $pro_id){
            $proId_array[] = $pro_id['id'];
        }
        $specs->destroyToPivotTable($proId_array);
        // step 2 : delete in specs table
        $specs->delete();

    }

    public function changeStatus(Request $request)
    {
        $specs_detail = Specs::find($request->specsId);
        $specs_detail->status = $request->status;
        $specs_detail->save();
    }

    public function changeSpotlight(Request $request)
    {
        $specs_detail = Specs::find($request->specsId);
        $specs_detail->spotlight = $request->spotlight;
        $specs_detail->save();
    }

}
