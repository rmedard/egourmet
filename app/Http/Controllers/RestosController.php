<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\AddressesContract;
use App\Resto;
use App\Address;
use App\Repositories\Contracts\RestosContract;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

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
            $resto->mainphoto = $this->processImage($request);
        }

        $address = new Address();
        $address->rue = $request['rue'];
        $address->numero = $request['numero'];
        $address->codepostal = $request['zip'];
        $address->commune = $request['commune'];
        $address = Address::create($address->toArray());
        $address->resto()->save($resto);
        $results[] = ['id'=>$resto->id,'value'=>$resto->name];
        if($request->ajax()){
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
        if(isset($resto->mainphoto) and $this->s3->exists($resto->mainphoto)){
            $resto->mainphoto = $this->s3->url($resto->mainphoto);
        }else{
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
        $resto = $this->restosRepo->find($id);
        $restoData = [
            'name' => $request->name,
            'tel' => $request->tel,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'enabled' => isset($request->enabled)
        ];
        if($request->hasFile('mainphoto')){
            $restoData['mainphoto'] = $this->processImage($request);
        }
        $addressData = [
            'rue' => $request->rue,
            'numero' => $request->numero,
            'codepostal' => $request->zip,
            'commune' => $request->commune
        ];
        $resto->update($restoData);
        $resto->address->update($addressData);

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

    private function processImage(Request $request){
        $photoFile = $request->file('mainphoto');
        $filename = 'resto_' . time() . '.png';
        Image::make($photoFile)->fit(200, 200, function ($constraint) {
            $constraint->upsize();
        })->save('temp/'.$filename);
        $path = $this->s3->putFileAs($this->upload_dir, new File('temp/'.$filename), $filename, 'public');
        Storage::delete('temp/' . $filename);
        return $path;
    }
}
