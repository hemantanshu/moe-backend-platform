<?php

namespace Drivezy\LaravelAdmin\Library;

use Drivezy\LaravelAdmin\Models\ClientScript;

class ClientScriptManager {
    /**
     * @param $identifier
     * @return array
     */
    public static function getClientScripts ($identifier) {
        $scripts = ClientScript::with('script')
            ->where('name', '' . $identifier . '')
            ->orWhere('name', 'LIKE', '' . $identifier . '.%')
            ->get();

        $records = [];
        foreach ( $scripts as $script ) {
            array_push($records, [
                'name'             => $script->name,
                'activity_type_id' => $script->activity_type_id,
                'script'           => $script->script->script,
                'column'           => $script->activity_type_id == 2 ? last(explode('.', $script->name)) : null,
            ]);
        }

        return $records;
    }
}