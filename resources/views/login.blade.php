<x-auth-layout>
    <h1>Login</h1>

    @if($errors->any())
        {{ implode('', $errors->all(':message')) }}
    @endif

    <form action="{{ route("do-login") }}" method="POST">
        @csrf

        <div>
            <label>
                <span>Email Address</span>
                <input type="email" name="email" autocomplete="email" value="{{old("email")}}" />
            </label>
        </div>

        <div>
            <label>
                <span>Password</span>
                <input type="password" name="password" autocomplete="current-password" />
            </label>
        </div>

        <button type="submit">Log In</button>
    </form>
</x-auth-layout>