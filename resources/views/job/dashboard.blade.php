<x-layout>
    <x-slot:title>login</x-slot:title>
    <h3 class="text-center">login</h3>
    <form action="{{ route('auth.requestlogin') }}" method="post" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label class="form-label">email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label class="form-label">password</label>
            <input type="password" class="form-control" name="password" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary">login</button>
    </form>
</x-layout>