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
use Intervention\Image\Facades\Image;

class RestosController extends Controller
{

    protected $restosRepo;
    protected $addressesRepo;
    private $upload_dir;
    private $max_image_size;

    private $rules = [
        'name' => ['required', 'unique:restos,name'],
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
        $this->upload_dir = config('constants.s3_resto_img_dir');
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
        $this->validate($request, $this->rules, array(
            'name.required' => trans('messages.restoname_required'),
            'name.unique' => trans('messages.restoname_unique'),
            'rue.required' => trans('messages.restorue_required'),
            'numero.required' => trans('messages.restonumero_exists'),
            'commune.required' => trans('messages.restocommune_required'),
            'zip.required' => trans('messages.restozip_required')
        ));
        $data = $this->getRequest($request);

        $address = new Address();
        $address->rue = $data->get('rue');
        $address->numero = $data->get('numero');
        $address->codepostal = $data->get('zip');
        $address->commune = $data->get('commune');
        $address->save();

        //Use this to get the map view
        //$address_str = $data->get('rue').'+'.$data->get('numero').',+'.$data->get('zip').'+'.$data->get('commune');
        $resto = new Resto();
        $resto->name = $data->get('name');
        $resto->mainphoto = $data->get('mainphoto');
        $resto->tel = $data->get('tel');
        $resto->website = $data->get('website');
        $resto->facebook = $data->get('facebook');
        $resto->save();
        $resto->address()->associate($address)->save();
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
        //
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
        //
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

    /*
     * Clean up the photo field
     */
    private function getRequest(Request $req){
        $data = $req->all();
        if($req->hasFile('mainphoto')){
            $photoFile = $req->file('mainphoto');
            $filename = 'resto_' . time() . '.' . $photoFile->getClientOriginalExtension();
            Image::make($photoFile)->fit(200, 200, function ($constraint) {
                $constraint->upsize();
            })->save('temp/'. $filename);
            $s3 = Storage::disk('s3');
            $path = $s3->putFileAs($this->upload_dir, new File('temp/' . $filename), $filename, 'public');
            $data['mainphoto'] = $path;
            //Storage::disk('app_public')->delete('temp/' . $filename);
        }
        return collect($data);
    }
}
