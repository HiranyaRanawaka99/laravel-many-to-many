@extends('layouts.guest')

@section('content')
  {{-- <section class="container mt-5">
    <h1>{{ $title }}</h1>

    <div class="row g-3">

      @forelse($projects as $project)
      <div class="col-3">
        <div class="card">
          <div class="card-header"> {{ $projects->title }}</div>
          <div class="card-body">
            <div class="card-text"> </div>
          </div>
        </div>
      </div>
      @empty
      <h2> Non ci sono Featured Posts </h2>
      @endforelse
    </div>
  

    {{-- {{$projects->links('pagination::bootstrap-5')}} --}}


















  {{-- </section> --}}
@endsection
