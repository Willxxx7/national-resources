@extends('layouts.app')

@section('content')
    @if (isset($error))
        <p>{{ $error }}</p>
    @endif

    <form method="GET" action={{ route('events.show', compact('path')) }}>
        <input type="text" name="access_code" id="access_code" placeholder="Access code" />

        <button type="submit">Submit</button>
    </form>
@endsection
