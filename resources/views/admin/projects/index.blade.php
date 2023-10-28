@extends('layouts.app')

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
    </tr>
  </thead>
  <tbody>
    @forelse($projects as $project)
    <tr>
      <th scope="row"> {{ $project->id}} </th>
      <td> {{ $project->title }}  </td>
      <td>  {!! $project->getCategoryBadge() !!} </td>
      <td> 
        <a href="{{ route('admin.projects.show', $project)}}" class=""> Show </a>
        <a href="{{ route('admin.projects.edit', $project)}}" class=""> Modifica </a>
      </td>
    </tr>
    @empty
      @endforelse
    </tbody>
  </table>
  
  {{ $projects->links('pagination::bootstrap-5') }}
</div>
  @endsection