@component('mail::message')
# @if($sub != null) {{$sub}} @else Email Διαχειριστή @endif

{{$request->emailContent}}

{{ config('app.name') }}
@endcomponent
