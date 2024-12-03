        <h2>Reset Password</h2>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email"  required>
            </div>
            <div>
                <label for="password">New Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</div>