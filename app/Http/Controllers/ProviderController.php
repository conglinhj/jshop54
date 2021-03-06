<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    /*
     * list provider
     */
    public function index(Provider $provider){
        $list_provider = $provider->paginate();
        return view('backend.provider.list',[
            'list_provider' => $list_provider,
        ]);
    }

    /**
     * @param Provider $provider
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewDetails(Provider $provider, $id){
        $details_provider = $provider->where('id','=',$id)->with('city','county','township')->first();
        return view('backend.provider.view',[
            'details_provider' => $details_provider,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreateForm(){
        return view('backend.provider.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $this->validator($request);
        $provider = Provider::create($request->all());
        return redirect(route('backend.provider.viewDetails',['id' => $provider['id'] ]))->with('created_message','Created !');
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
     * @param Provider $provider
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showEditForm(Provider $provider, $id){
        $details_provider = $provider->where('id','=',$id)->with('city','county','township')->first();
        return view('backend.provider.edit',[
            'details_provider' => $details_provider,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        $this->validator($request);
        $provider = Provider::findOrFail($request->id);
        $provider->update($request->all());

        return redirect(route('backend.provider.viewDetails',['id' => $provider['id'] ]))->with('updated_message','Updated !');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request){
        $provider = Provider::findOrFail($request->provider_id);
        $provider->delete();
        return redirect(route('backend.provider.list'))->with('deleted_message','Deleted !');
    }
}
