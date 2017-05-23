<?php

namespace App\Http\Controllers;

use App\Models\PhieuNhap;
use App\Models\Provider;
use Illuminate\Http\Request;

class PhieuNhapController extends Controller
{
    /*
     * list phieunhap
     */
    public function index(PhieuNhap $phieunhap){
        $list_phieunhap = $phieunhap->paginate();
        return view('backend.phieunhap.list',[
            'list_phieunhap' => $list_phieunhap,
        ]);
    }

    /**
     * @param PhieuNhap $phieunhap
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewDetails(PhieuNhap $phieunhap, $id){
        $details_phieunhap = $phieunhap->where('id','=',$id)->with('city','county','township')->first();
        return view('backend.phieunhap.view',[
            'details_phieunhap' => $details_phieunhap,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreateForm(Provider $provider){
        $list_provider = $provider->all();
        return view('backend.phieunhap.create', compact('list_provider'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $this->validator($request);
        $phieunhap = PhieuNhap::create($request->all());
        return redirect(route('backend.phieunhap.viewDetails',['id' => $phieunhap['id'] ]))->with('created_message','Created !');
    }

    public function validator($request) {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'city_id' => 'not_in:0',
            'county_id' => 'not_in:0',
            'township_id' => 'not_in:0',
            'address' => 'required',
            'phone' => 'required|digits_between:9,16|numeric',
        ];
        $messages = [
            'customer_name.required' => 'Mời quý khách nhập tên thật của mình.',
            'address.required' => 'Không được để trống.',
            'county_id.not_in' => 'Mời quý khách chọn một',
            'phone.required' => 'Không được để trống.',
            'phone.digits_between' => 'Nhập đúng số điện thoại của quý khách',
            'phone.numeric' => 'Số điện thoại phải là số',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();
    }

    /**
     * @param PhieuNhap $phieunhap
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditForm(PhieuNhap $phieunhap, $id){
        $details_phieunhap = $phieunhap->where('id','=',$id)->with('city','county','township')->first();
        return view('backend.phieunhap.edit',[
            'details_phieunhap' => $details_phieunhap,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        $this->validator($request);
        $phieunhap = PhieuNhap::findOrFail($request->id);
        $phieunhap->update($request->all());

        return redirect(route('backend.phieunhap.viewDetails',['id' => $phieunhap['id'] ]))->with('updated_message','Updated !');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request){
        $phieunhap = PhieuNhap::findOrFail($request->phieunhap_id);
        $phieunhap->delete();
        return redirect(route('backend.phieunhap.list'))->with('deleted_message','Deleted !');
    }
}
