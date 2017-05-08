<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hardware;
use App\Models\Specs;

class HardwareController extends Controller
{
    /*
     * list hardware
     */
    public function index(Hardware $hardware){
        $list_hardware = $hardware->getList();
        return view('backend.hardware.list',[
            'list_hardware' => $list_hardware,
        ]);
    }

    /**
     * @param Hardware $hardware
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewDetails(Hardware $hardware, Specs $specs, $id){
        $details_hardware = $hardware->getDetails($id);
        $specs_list = $specs->getSpecsFromHardware($id);
        return view('backend.hardware.view',[
            'details_hardware' => $details_hardware,
            'specs_list' => $specs_list
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreateForm(){
        return view('backend.hardware.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:hardwares'
        ]);
        $hardware = Hardware::create($request->all());
        return redirect(route('backend.hardware.viewDetails',['id' => $hardware['id'] ]))->with('created_message','Created !');
    }

    /**
     * @param Hardware $hardware
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditForm(Hardware $hardware, $id){
        $details_hardware = $hardware->getDetails($id);
        return view('backend.hardware.edit',[
            'details_hardware' => $details_hardware,
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
        $hardware = Hardware::findOrFail($request->id);
        $hardware->update($request->all());

        return redirect(route('backend.hardware.viewDetails',['id' => $hardware['id'] ]))->with('updated_message','Updated !');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request){
        $hardware = Hardware::findOrFail($request->hardware_id);
        $hardware->delete();
        return redirect(route('backend.hardware.list'))->with('deleted_message','Deleted !');
    }
}
