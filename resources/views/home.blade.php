<x-page>
    <h1>Home</h1>

    <form action="{{route("logout")}}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</x-page>