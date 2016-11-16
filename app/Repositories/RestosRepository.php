<?php
/**
 * Created by PhpStorm.
 * User: medard
 * Date: 26/09/16
 * Time: 18:37
 */

namespace App\Repositories;

use App\Resto;
use App\Repositories\Contracts\RestosContract;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class RestosRepository implements RestosContract
{

    private $s3;
    private $upload_dir;

    public function __construct(){
        $this->s3 = Storage::disk('s3');
        $this->upload_dir = config('filesystems.disks.s3.folder').'/restos';
    }

    public function all()
    {
        return Resto::with('address')->orderBy('name', 'asc')->paginate(20);
    }

    public function create(array $resto_data)
    {
        return Resto::create($resto_data);
    }

    public function find($resto_id)
    {
        return Resto::with('address')->findOrFail($resto_id);
    }

    public function update(Request $request, $resto_id)
    {
        $resto = Resto::find($resto_id);
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
    }

    public function delete($resto_id)
    {
        Resto::destroy($resto_id);
    }

    public function processImage(Request $request){
        $photoFile = $request->file('mainphoto');
        $filename = 'resto_' . time() . '.jpg';
        Image::make($photoFile)->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save('temp/'.$filename);
        $path = $this->s3->putFileAs($this->upload_dir, new File('temp/'.$filename), $filename, 'public');
        Storage::delete('temp/'.$filename);
        return $path;
    }
}