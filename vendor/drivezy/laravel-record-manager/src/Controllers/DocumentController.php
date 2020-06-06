<?php

namespace Drivezy\LaravelRecordManager\Controllers;

use Drivezy\LaravelRecordManager\Library\FileManager;
use Drivezy\LaravelRecordManager\Models\DocumentManager;
use Illuminate\Http\Request;

/**
 * Class DocumentController
 * @package Drivezy\LaravelRecordManager\Controllers
 */
class DocumentController extends RecordController
{
    /**
     * @var string
     */
    public $model = DocumentManager::class;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile (Request $request)
    {
        if ( !$request->hasFile('file') ) return failed_response('Invalid file uploaded');

        return success_response(FileManager::uploadFileToS3($request->file('file')));
    }
}
