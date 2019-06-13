<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Facades\Tests\Setup\ProjectFactory;

class InvitationsTest extends TestCase
{
  use WithFaker, RefreshDatabase;

    /** @test */
    public function a_project_can_invite_a_user()
    {
      //$this->withoutExceptionHandling();
      $project = ProjectFactory::create();
      $project->invite($newUser=factory(User::class)->create() );
    //  dd($project->members);
    $this
         ->actingAs($newUser)
        ->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);
     $this->assertDatabaseHas('tasks', $task);
    //$this->assertTrue($project->members->contains($newUser));
    }
}
