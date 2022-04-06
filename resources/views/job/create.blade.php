<x-layout>
    <x-slot:title>job create</x-slot:title>
    <h3 class="text-center">job create</h3>
    <form action="{{ route('job.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">description</label>
            <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">image</label>
          <input type="file" class="form-control" name="image" aria-describedby="emailHelp">
      </div>
        <button type="submit" class="btn btn-primary">create</button>
    </form>
</x-layout>