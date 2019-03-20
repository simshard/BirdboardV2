<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  use RecordsActivity;
    /**
     * Attributes to guard against mass assignment.
     *
     * @var array
     */
    protected $guarded = [];

protected static $recordableEvents=['created','deleted'];
    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['project'];
    /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'completed' => 'boolean'
        ];

        /**
         * Mark the task as complete.
         */
        public function complete()
        {
            $this->update(['completed' => true]);
            $this->recordActivity('completed_task');
        }

        /**
         * Mark the task as complete.
         */
        public function incomplete()
        {
            $this->update(['completed' => false]);
            $this->recordActivity('incompleted_task');
        }
    /**
     * Get the owning project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the path to the task.
     *
     * @return string
     */
    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }
}
