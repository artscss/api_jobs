<x-layout>
    <x-slot:title>register</x-slot:title>
    <h3 class="text-center">register</h3>
    <form action="{{ route('auth.requestregister') }}" method="post" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label class="form-label">name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">password</label>
            <input type="password" class="form-control" name="password" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">password confirmation</label>
            <input type="password" class="form-control" name="password_confirmation" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary">register</button>
    </form>
</x-layout>