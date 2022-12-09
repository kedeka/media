<?php
namespace Kedeka\Media\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestroyController
{
    public function __invoke($id, Request $request)
    {
        $file = app(config('kedeka.media.models.file'))->find($id);

        if($file){
            Storage::disk($file->disk)->delete($file->path);
            $file->attachments()->delete();
            $file->delete();
        }

        if($request->header('X-Inertia')){
            return redirect()->back();
        }else{
            return response()->json([
                'success' => true,
                'message' => 'File telah dihapus',
            ]);
        }
        
    }
}