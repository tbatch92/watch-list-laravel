<x-auth-layout>
    <h1>Register</h1>

    <form action="{{ route("do-register") }}" method="POST">
        @csrf
        
        <x-input-field name="name" label="Name">
            <x-input type="text" name="name" autocomplete="name" />
        </x-input-field>

        <x-input-field name="email" label="Email Address">
            <x-input type="email" name="email" autocomplete="email" />
        </x-input-field>

        <x-input-field name="password" label="Password">
            <x-input type="password" name="password" autocomplete="new-password" />
        </x-input-field>

        <x-input-field name="password_confirmation" label="Confirm Password">
            <x-input type="password" name="password_confirmation" autocomplete="new-password" />
        </x-input-field>

        <button type="submit">Register</button>
    </form>

</x-auth-layout>