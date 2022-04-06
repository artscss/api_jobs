<x-layout>
    <x-slot:title>show job</x-slot:title>
    <h3 class="text-center">show job</h3>
    <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="card text-center">
              <img src="{{ asset("images/". $jobs->image) }}" class="card-img-top hcard" alt="...">
              <div class="card-body">
                <h5 class="card-title">{{ $jobs->name }}</h5>
                <p class="card-text">{{ $jobs->description }}</p>
                  <a href="{{ url('apply', $jobs->id) }}" class="btn btn-info">apply</a>
              </div>
            </div>
          </div>
        </div>
    </div>
</x-layout>