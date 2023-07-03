@if ($message = Session::get('success_message'))
    <div class="p-4 mb-3 bg-green-400 rounded">
        <p class="text-green-800">{{ $message }}</p>
    </div>
@endif

@if ($message = Session::get('error_message'))
    <div class="p-4 mb-3 bg-red-400 rounded">
        <p class="text-red-800">{{ $message }}</p>
    </div>
@endif

@if ($message = Session::get('warning_message'))
    <div class="p-4 mb-3 bg-yellow-400 rounded">
        <p class="text-yellow-800">{{ $message }}</p>
    </div>
@endif
