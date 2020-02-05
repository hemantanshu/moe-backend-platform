<?php

namespace Drivezy\LaravelAdmin\Database\Definitions;

use Drivezy\LaravelRecordManager\Models\DataModel;
use Drivezy\LaravelUtility\Database\Definitions\DataModelDefinition;

/**
 * Class MenuDefinition
 * @package Drivezy\LaravelAdmin\Database\Definitions
 */
class MenuDefinition extends DataModelDefinition
{
    /**
     * MenuDefinition constructor.
     */
    public function __construct ()
    {
        $this->definition = [
            'name'    => [
                'description' => 'Name of the menu',
                'required'    => true,
                'nullable'    => false,
            ],
            'url'     => [
                'description' => 'public url which this model will point to',
                'nullable'    => true,
            ],
            'page_id' => [
                'column_type_id'     => 7,
                'reference_model_id' => DataModel::where('model_hash', '71cea5b803f79a0b83e928adcfac3bca')->first()->id,
            ],
        ];
    }
}
