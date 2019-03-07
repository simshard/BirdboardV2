@extends ('layouts.app')

@section('content')
  <div class="lg:w-1/2 lg:mx-auto bg-white py-12 px-16 rounded shadow">
  <form method="POST" action="{{$project->path()}}" >
    @csrf
    @method('patch')
    <h1 class="text-2xl font-normal mb-10 text-center">Edit Your Project</h1>
  @include('projects.form',[
    'buttontext'=>'Update Project',
    'cancelurl'=>$project->path(),
  ])

</form>
</div>
@endsection
