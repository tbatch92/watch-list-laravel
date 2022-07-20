<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsRequest;
use App\Models\StreamingService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function getUserSettingsPage(Request $request)
    {
        return view("settings", [
            "services" => StreamingService::visibleInApp()->get(),
            "user_services" => $request->user()->streamingServices->pluck("id")
        ]);
    }

    function updateUserSettings(UpdateSettingsRequest $request)
    {
        $request->user()->streamingServices()->sync($request->streaming_services);
        return redirect()->route("settings")->with("message", "Your settings have been saved.");
    }
}
