<x-auth-layout>
    <h1>Login</h1>

    <form action="{{ route("do-login") }}" method="POST">
        @csrf

        <x-input-field name="email" label="Email Address">
            <x-input type="email" name="email" autocomplete="email" />
        </x-input-field>

        <x-input-field name="password" label="Password">
            <x-input type="password" name="password" autocomplete="current-password" />
        </x-input-field>      

        <button type="submit">Log In</button>
    </form>
</x-auth-layout>