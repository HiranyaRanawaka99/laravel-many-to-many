@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<div class="container mt-5">

  <h1> I miei progetti </h1>

  <a href="{{ route('admin.projects.create')}}" class="btn btn-success my-3"> Crea il tuo progetto </a>


<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titolo</th>
      <th scope="col">Categoria</th>
      <th scope="col">Dettagli</th>
      <th scope="col"><a href="{{ route('admin.projects.trash.index')}}" class="btn btn-danger my-3"> Cestino </a></th>
    </tr>
  </thead>
  <tbody>
    @forelse($projects as $project)
    <tr>
      <th scope="row"> {{ $project->id}} </th>
      <td> {{ $project->title }}  </td>
      <td>  {!! $project->getCategoryBadge() !!} </td>
      <td> 
        {{-- SHOW --}}
        <a href="{{ route('admin.projects.show', $project)}}" class="">  <i class="fa-solid fa-up-right-from-square"></i> </a>
        {{-- EDIT --}}
        <a href="{{ route('admin.projects.edit', $project)}}" class="">  <i class="fa-solid fa-pencil"></i> </a>
      </td>
      <td>
        {{-- DELETE --}}
        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$project->id}}" class="mx-1">
          <i class="fa-solid fa-trash text-danger"></i>  
        </a>
        {{-- Modal --}}
        <div class="modal fade" id="delete-modal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina progetto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  Sei sicuro di voler eliminare il progetto con tiolo "{{$project->title}}" con id "{{$project->id}}"?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                {{-- Delete Form --}}
                <form action="{{route('admin.projects.destroy', $project)}}" method="POST" class="mx-1">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger">Conferma</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </td>
  </tr>     
@empty
<tr>
    <td colspan="8">
        <i>No projects found</i>
    </td>
</tr> 
@endforelse
</tbody>
</table>

  
  {{ $projects->links('pagination::bootstrap-5') }}
</div>
  @endsection