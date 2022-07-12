<x-page>
    <h1>Home</h1>

    <form action="{{route("logout")}}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    @if(count($lists) > 0)
        <ul>
            @foreach ($lists as $list)
                <li><a href="{{route("list", ["slug" => $list->slug])}}">{{ $list->name }}</a></li>
            @endforeach
        </ul>
    @else
        <p>No lists!</p>
    @endif

    <form action="{{route("create-list")}}" method="POST">
        @csrf
        <x-input-field name="name" label="List Name">
            <x-input autocomplete="off" name="name" />
        </x-input-field>

        <button type="submit">Create</button>
    </form>

</x-page>