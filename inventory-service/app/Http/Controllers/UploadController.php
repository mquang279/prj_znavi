<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function getPresignedUrl(Request $request) {
        $client = Storage::disk('s3')->getClient();
        $fileName = Str::random(10) . '_' . $request->file_name;
        $filePath = 'uploads/' . $fileName;

        $command = $client->getCommand('PutObject', [
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key' => $filePath,
        ]);

        $request = $client->createPresignedRequest($command, '+20 minutes');

        return response()->json(200, [
            'file_path' => $filePath,
            'pre_signed' => (string) $request->getUri(),
        ]);
    }

    public function destroy(Request $request) {
        $disk = 's3';

        if (Storage::disk($disk)->exists($request->filename)) {
            Storage::disk($disk)->delete($request->filename);
        }
        return response()->json(204);
    }
}
