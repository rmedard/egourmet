<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\AddressesContract;
use App\Resto;
use App\Address;
use App\Repositories\Contracts\RestosContract;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class RestosController extends Controller
{

    protected $restosRepo;
    protected $addressesRepo;
    private $upload_dir;

    private $rules = [
        'name' => ['required', 'min:3'],
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
        $this->validate($request, $this->rules);
        $data = $this->getRequest($request);

        $address = new Address();
        $address->rue = $data->get('rue');
        $address->numero = $data->get('numero');
        $address->codepostal = $data->get('zip');
        $address->commune = $data->get('commune');

        $address_str = $data->get('rue').' '.$data->get('numero').', '.$data->get('zip').' '.$data->get('commune');
        $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address_str).'&sensor=false');
        $geo = json_decode($geo, true);
        if($geo['status'] = 'OK'){
            $address->latitude = $geo['results'][0]['geometry']['location']['lat'];
            $address->longitude = $geo['results'][0]['geometry']['location']['lng'];
        }

        $resto = new Resto();
        $resto->name = $data->get('name');
        $resto->mainphoto = $data->get('mainphoto');
        $resto->tel = $data->get('tel');
        $resto->website = $data->get('website');
        $resto->facebook = $data->get('facebook');
        $address->save();
        $resto->address()->associate($address);
        $resto->save();
        $this->show($resto->id);
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
        dd($resto);
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
            $filename = 'resto_' . time() . $photoFile->getClientOriginalExtension();
            $img = Image::make($filename)->fit(200, 200, function ($constraint) {
                $constraint->upsize();
            });
            $path = Storage::putFileAs($this->upload_dir, $img->psrResponse(), $filename, 'public');
            $data['mainphoto'] = $path;
        }
        return collect($data);
    }
}
