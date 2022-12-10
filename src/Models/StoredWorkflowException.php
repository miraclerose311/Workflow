<?php

declare(strict_types=1);

namespace Workflow\Models;

use Illuminate\Database\Eloquent\Model;

final class StoredWorkflowException extends Model
{
    public const UPDATED_AT = null;

    /**
     * @var string
     */
    protected $table = 'workflow_exceptions';

    /**
     * @var mixed[]
     */
    protected $guarded = [];

    protected $dateFormat = 'Y-m-d H:i:s.u';

    public function workflow(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config('workflows.stored_workflow_model', StoredWorkflow::class));
    }
}
