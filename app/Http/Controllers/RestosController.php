<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\AddressesContract;
use App\Resto;
use App\Address;
use App\Repositories\Contracts\RestosContract;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RestosController extends Controller
{

    protected $restosRepo;
    protected $addressesRepo;
    private $upload_dir;
    private $s3;

    private $rules = [
        'rue' => ['required'],
        'numero' => ['required'],
        'commune' => ['required'],
        'zip' => ['required'],
        'mainphoto' => ['mimes:jpg,jpeg,png,gif']
    ];

    /**
     * RestosController constructor.
     * @param $restoRepo
     */
    public function __construct(RestosContract $restosRepo, AddressesContract $addressesRepo)
    {
        $this->restosRepo = $restosRepo;
        $this->addressesRepo = $addressesRepo;
        $this->upload_dir = config('filesystems.disks.s3.folder').'/restos';
        $this->s3 = Storage::disk('s3');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restos = $this->restosRepo->all();
        return view('admin.data.restos.index', compact('restos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.data.restos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->rules['name'] = ['required', Rule::unique('restos', 'name')];
        $this->validate($request, $this->rules, array(
            'name.required' => trans('messages.restoname_required'),
            'name.unique' => trans('messages.restoname_unique'),
            'rue.required' => trans('messages.restorue_required'),
            'numero.required' => trans('messages.restonumero_exists'),
            'commune.required' => trans('messages.restocommune_required'),
            'zip.required' => trans('messages.restozip_required')
        ));

        //Use this to get the map view
        //$address_str = $data->get('rue').'+'.$data->get('numero').',+'.$data->get('zip').'+'.$data->get('commune');
        $resto = new Resto();
        $resto->name = $request['name'];
        $resto->mainphoto = $request['mainphoto'];
        $resto->tel = $request['tel'];
        $resto->website = $request['website'];
        $resto->facebook = $request['facebook'];
        $resto->enabled = isset($request['enabled']);

        if($request->hasFile('mainphoto')){
            $resto->mainphoto = $this->restosRepo->processImage($request);
        }

        $address = new Address();
        $address->rue = $request['rue'];
        $address->numero = $request['numero'];
        $address->codepostal = $request['zip'];
        $address->commune = $request['commune'];
        $address = Address::create($address->toArray());
        $address->resto()->save($resto);
        if($request->ajax()){
            $results[] = ['id'=>$resto->id,'value'=>$resto->name];
            return $results;
        }else{
            $restos = $this->restosRepo->all();
            session()->flash('flash_message', trans('messages.resto_creat_success'));
            return view('admin.data.restos.index', compact('restos'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resto = Resto::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resto = $this->restosRepo->find($id);
        $old_photo = null;
        if(isset($resto->mainphoto) and $this->s3->exists($resto->mainphoto)){
            session(['old_photo' => $resto->mainphoto]);
            $resto->mainphoto = $this->s3->url($resto->mainphoto);
        }else{
            session()->forget('old_photo');
            $resto->mainphoto = config('constants.noresto');
        }
        return view('admin.data.restos.edit', compact('resto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->rules['name'] = ['required', Rule::unique('restos', 'name')->ignore($id)];
        $this->validate($request, $this->rules, array(
            'name.required' => trans('messages.restoname_required'),
            'name.unique' => trans('messages.restoname_unique'),
            'rue.required' => trans('messages.restorue_required'),
            'numero.required' => trans('messages.restonumero_exists'),
            'commune.required' => trans('messages.restocommune_required'),
            'zip.required' => trans('messages.restozip_required')
        ));
        if(session()->has('old_photo')){
            if(isset($request->mainphoto)){
                $this->s3->delete(session('old_photo'));
            }
            session()->forget('old_photo');
        }
        $this->restosRepo->update($request, $id);
        $restos = $this->restosRepo->all();
        session()->flash('flash_message', trans('messages.resto_update_success'));
        return redirect('admin/restos')->with('restos', $restos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
