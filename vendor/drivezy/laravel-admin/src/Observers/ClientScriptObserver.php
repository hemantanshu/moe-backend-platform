<?php

namespace Drivezy\LaravelAdmin\Observers;

use Drivezy\LaravelAdmin\Models\ClientScript;
use Drivezy\LaravelRecordManager\Models\SystemScript;
use Drivezy\LaravelUtility\Observers\BaseObserver;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class ClientScriptObserver
 * @package Drivezy\LaravelAdmin\Observers
 */
class ClientScriptObserver extends BaseObserver
{
    /**
     * @var array
     */
    protected $rules = [
        'source_type' => 'required',
        'source_id'   => 'required',
    ];

    /**
     * @param Eloquent $model
     */
    public function created (Eloquent $model)
    {
        parent::created($model);

        //automatically create a system script against the object
        $script = SystemScript::create([
            'source_type'    => md5(ClientScript::class),
            'source_id'      => $model->id,
            'name'           => 'Client Script',
            'description'    => $model->name,
            'script_type_id' => 11,
        ]);

        $model->script_id = $script->id;
        $model->save();
    }
}
