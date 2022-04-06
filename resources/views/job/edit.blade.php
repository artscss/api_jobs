<x-layout>
    <x-slot:title>edit job</x-slot:title>
    <h3 class="text-center">edit job</h3>
    <div class="container">
        <div class="row">
            <form action="{{ route('job.update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" name="id" value="{{ $jobs->id }}" aria-describedby="emailHelp">
                <div class="mb-3">
                    <label class="form-label">name</label>
                    <input type="text" class="form-control" name="name" value="{{ $jobs->name }}" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">description</label>
                    <textarea class="form-control" name="description" rows="3">{{ $jobs->description }}</textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">image</label>
                  <input type="file" class="form-control" name="image" aria-describedby="emailHelp">
              </div>
                <button type="submit" class="btn btn-primary">edit</button>
            </form>
        </div>
    </div>
</x-layout>