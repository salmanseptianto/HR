<div">
    <div>
        <h2>Forgot Password</h2>
        @if (session('status'))
            <div>
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" required autofocus>
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <button type="submit">Send Password Reset Link</button>
        </form>
    </div>
    </div>
