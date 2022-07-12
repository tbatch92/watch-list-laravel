<x-auth-layout>
    <h1>Register</h1>

    <form action="{{ route("do-register") }}" method="POST">
        @csrf
        

        <div>
            <label>
                <span>Name</span>
                <input type="text" name="name" autocomplete="name" value="{{old("name")}}" />
            </label>
        </div>

        <div>
            <label>
                <span>Email Address</span>
                <input type="email" name="email" autocomplete="email" value="{{old("email")}}" />
            </label>
        </div>

        <div>
            <label>
                <span>Password</span>
                <input type="password" name="password" autocomplete="new-password" />
            </label>
        </div>

        <div>
            <label>
                <span>Confirm Password</span>
                <input type="password" name="password_confirmation" autocomplete="new-password" />
            </label>
        </div>

        <button type="submit">Register</button>
    </form>

</x-auth-layout>