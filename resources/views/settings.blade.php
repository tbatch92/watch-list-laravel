<x-page>
    <form action="{{route("update-settings")}}" method="POST">
        @csrf
        @method("PUT")

        <ul>
            @foreach ($services as $service)
                <li>
                    <div>
                        <label>
                            <input type="checkbox" name="streaming_services[]" value="{{$service->id}}" @checked($user_services->contains($service->id)) />
                            <span>{{$service->name}}</span>
                        </label>
                    </div>
                    
                </li>
            @endforeach
        </ul>

        <button type="submit">Save</button>
    </form>
</x-page>