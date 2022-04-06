<x-layout>
    <x-slot:title>edit job</x-slot:title>
    <h3 class="text-center">edit job</h3>
    <div class="container">
        <div class="row">
            <form action="{{ route('requestdetails') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">expected salary</label>
                    <input type="number" class="form-control" name="expected_salary" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">current_salary</label>
                    <input type="number" class="form-control" name="current_salary" aria-describedby="emailHelp">
                </div>
                <input type="hidden" value="{{ $data->user_id }}" name="user_id">
                <input type="hidden" value="{{ $data->job_id }}" name="job_id">
                <button type="submit" class="btn btn-primary">add details</button>
            </form>
        </div>
    </div>
</x-layout>