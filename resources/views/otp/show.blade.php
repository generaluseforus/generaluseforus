<!-- resources/views/otp/show.blade.php -->

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('otp.send') }}">
    @csrf
    <div class="form-group">
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Send OTP</button>
</form>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif