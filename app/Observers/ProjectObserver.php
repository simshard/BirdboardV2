<?php

namespace App\Observers;

use App\Project;


class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
      //$this->recordActivity('created', $project);
      $project->recordActivity('project_created');
    }

    /**
     * Handle the project "updated" event.
     *
     * @param  \App\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
      //$this->recordActivity('updated', $project);
       $project->recordActivity('project_updated');
    }



}
