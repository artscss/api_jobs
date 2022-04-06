<x-layout>
    <x-slot:title>dashboard</x-slot:title>
    <h3 class="text-center">dashboard</h3>
    <div class="container">
        <div class="row">
          @foreach ($jobs as $job)
          <div class="col-md-3">
            <div class="card text-center">
              <img src="{{ asset("images/". $job->image) }}" class="card-img-top hcard" alt="...">
              <div class="card-body">
                <h5 class="card-title">{{ $job->name }}</h5>
                <p class="card-text">{{ $job->description }}</p>
                <a href="{{ url("job/show", $job->id) }}" class="btn btn-primary">show</a>
                @if(Auth::check() && Auth::user()->role > 0)
                  <a href="{{ url("job/edit", $job->id) }}" class="btn btn-warning">edit</a>
                  <a href="{{ url("job/destroy", $job->id) }}" class="btn btn-danger">delete</a>
                @endif
              </div>
            </div>
          </div>
          @endforeach
        </div>
    </div>
</x-layout>