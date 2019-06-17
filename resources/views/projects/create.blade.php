@extends ('layouts.app')

@section('content')
  <div class="lg:w-1/2 lg:mx-auto bg-card py-12 px-16 rounded shadow">
  <form method="POST" action="/projects" >
    @csrf
    <h1 class="text-2xl font-normal mb-10 text-center">Create New Project</h1>
    @include('projects.form',[
      'project'=>new App\Project,
      'buttontext'=>'Create Project',
      'cancelurl'=>'/projects',
    ])

    </form>
   </div>
@endsection
