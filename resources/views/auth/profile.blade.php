<x-layout>
    <x-slot:title>profile</x-slot:title>
    <h3 class="text-center">profile</h3>
    <form action="{{ route('requestprofile') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">name</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">password</label>
            <input type="password" class="form-control" name="password" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">address</label>
            <input type="text" class="form-control" name="address" value="{{ $user->address }}" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">phone</label>
            <input type="tel" class="form-control" name="phone" value="{{ $user->phone }}" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">age</label>
            <input type="number" class="form-control" name="age" value="{{ $user->age }}" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">image</label>
            <input type="file" class="form-control" name="image" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">cv</label>
            <input type="file" class="form-control" name="cv" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary">update</button>
    </form>
</x-layout>