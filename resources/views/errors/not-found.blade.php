@extends('web.layouts.app')

@section('contents')
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>404</h1>
            </div>
            <h2>We are sorry, Page not found!</h2>
            <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
            @if (Auth::check())
                <a href="{{ route('user.dashboard.home') }}">Back To Homepage</a>
            @else
                <a href="/">Back To Homepage</a>
            @endif
        </div>
    </div>
@endsection
