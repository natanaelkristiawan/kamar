<?php 

namespace Master\Upload\Http\Traits;

use Illuminate\Http\Request;
use Validator;
use Master\Upload\Filer;
use Illuminate\Support\Facades\Hash;
use Upload;


trait UploadTrait
{
	public function upload(Request $request, $config, $path)
	{
		$path = explode('/', $path);
        $file = array_pop($path);
        $field = array_pop($path);
        $folder = implode('/', $path);

        if ($request->hasFile($file)) {
            $ufolder = $this->uploadFolder($config, $folder, $field);
            $array = $this->filer->upload($request->file($file), $ufolder);
            $array['folder'] = $folder.'/'.$field;
            $array['path'] = $ufolder.'/'.$array['file'];

            $ext = pathinfo($array['file'], PATHINFO_EXTENSION);

            if (in_array($ext, config('filer.image_extensions'))) {
                $array['url'] = url('image/original/'.$ufolder.'/'.$array['file']);
            } else {
                $array['url'] = url('file/display/'.$ufolder.'/'.$array['file']);
            }

            return response()->json($array)
                ->setStatusCode(203, 'UPLOAD_SUCCESS');
        } else {
            return response()->json(array(
                'status' => false
            ), 403);
        }
	}


	public function uploadFolder($config, $folder, $field)
    {
        $path = config($config.'.upload_folder');
        if (empty($path)) {
            throw new FileNotFoundException('Invalid upload configuration value.');
        }

        return "{$path}/{$folder}/{$field}";
    }
}