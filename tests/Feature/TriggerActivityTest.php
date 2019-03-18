<?php

namespace Tests\Feature;

use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityFeedTest extends TestCase
{
  use RefreshDatabase;

    /** @test */
  function creating_a_project()
    {
       $project = ProjectFactory::create();
       $this->assertCount(1, $project->activity);
      $this->assertEquals('project_created', $project->activity[0]->description);
    }

    /** @test */
  function updating_a_project()
    {
       $project = ProjectFactory::create();
       $project->update(['title'=>'changed']);

       $this->assertCount(2, $project->activity);
       $this->assertEquals('project_updated', $project->activity->last()->description);
    }

    /** @test */
    function creating_a_task()
    {
        $project = ProjectFactory::create();
        $project->addTask('Some task');
        //dd($project->activity);
         $this->assertCount(2, $project->activity);
       $this->assertEquals('created_task', $project->activity->last()->description);
    }
    /** @test */
    function completing_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => true,
            ]);
        $this->assertCount(3, $project->activity);
        $this->assertEquals('completed_task', $project->activity->last()->description);
    }
    /** @test */
    function uncompleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => true,
            ]);
        $this->assertCount(3, $project->activity);
        $this ->patch($project->tasks[0]->path(), [
                'body' => 'foobar',
                'completed' => false,
            ]);
            $project->refresh();
              $this->assertCount(4, $project->activity);
      $this->assertEquals('incompleted_task', $project->activity->last()->description);
    }

    /** @test */
    function deleting_a_task()
    {
      $project = ProjectFactory::withTasks(1)->create();
      $project->tasks[0]->delete();
      $this->assertCount(3, $project->activity);
    }





}
