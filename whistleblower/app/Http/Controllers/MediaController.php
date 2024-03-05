<?php

namespace App\Http\Controllers;

use App\Models\CompanySettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;

class MediaController extends Controller
{
    private Media $media;

    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show(string $uuid)
    {
        // Check if user is logged in
        if (Auth::check()) {
            $path = $this->getImageByUuid($uuid);
            $file = Storage::get($path);
            $type = Storage::mimeType($path);
            // Send the file as a response
            return response($file, 200)->header('Content-Type', $type);
        }

        // If user is not logged in, return unauthorized response
        return response('Unauthorized', 401);
    }
    private function getImageByUuid(string $uuid): string
    {
        // Retrieve the file from storage
        $data = Media::where('uuid', $uuid)->first();
        $id = $data['id'];
        $fileName = $data['file_name'];
        $disk = $data['disk'];

        return "$disk/$id/$fileName";
    }

    private function publicImages(): array
    {
        $logos = CompanySettings::getAllLogoValues();
        $other = []; //waiting

        return array_merge($logos, $other);
    }

    /**
     * Display the public image.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function display($uuid)
    {
        /** public images display */
        $public = $this->publicImages();
        if (in_array($uuid, $public)) {
            $path = $this->getImageByUuid($uuid);
            $file = Storage::get($path);
            $type = Storage::mimeType($path);
            // Send the file as a response
            return response($file, 200)->header('Content-Type', $type);
        }
        return response('Not Found', 404);
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
}
