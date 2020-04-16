<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\ProjectPDATaskObserver;

/**
 * Class ProjectPDATask
 * @package App\Models\Moe
 */
class ProjectPDATask extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_project_pda_tasks';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project_pda ()
    {
        return $this->belongsTo(DevelopmentAgreement::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pda_task ()
    {
        return $this->belongsTo(PDATask::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ProjectPDATaskObserver());
    }
}
