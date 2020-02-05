<?php

namespace Drivezy\LaravelAdmin\Controllers;

use Drivezy\LaravelAdmin\Library\ClientScriptManager;
use Drivezy\LaravelAdmin\Library\FormManager;
use Drivezy\LaravelAdmin\Models\CustomForm;
use Drivezy\LaravelRecordManager\Controllers\RecordController;
use Drivezy\LaravelRecordManager\Library\PreferenceManager;
use Illuminate\Http\Request;

class CustomFormController extends RecordController {
    /**
     * @var string
     */
    protected $model = CustomForm::class;

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFormDetails (Request $request, $id) {
        //validate if user has access to the form
        if ( !FormManager::validateFormAccess($id) ) return invalid_operation();

        $form = CustomForm::find($id);

        //validate if the form is actually present or not
        if ( !$form ) return invalid_operation();

        $columns = FormManager::getFormDictionary($form);

        return success_response([
            'dictionary'     => [
                strtolower('form_' . $form->id) => $columns->allowed,
            ],
            'form_layouts'   => PreferenceManager::getFormPreference(md5(CustomForm::class), $id),
            'form'           => $form,
            'client_scripts' => ClientScriptManager::getClientScripts('form_' . $form->id),
        ]);

    }
}