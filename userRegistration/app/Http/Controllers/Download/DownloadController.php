<?php

namespace App\Http\Controllers\Download;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        if(Auth::check()) {
            $filename = Auth::user()->id . '.txt';
            $headers = [
                'Content-Type'        => 'Content-Type: text/plain',
                'Content-Disposition' => 'attachment; filename="'. $filename .'"',
            ];
            return Response::make(Storage::disk('s3')->get('word-counter-files/'.$filename),200, $headers);
        }

        return redirect("login")->withSuccess('Oops! You do not have access');
    }
}
