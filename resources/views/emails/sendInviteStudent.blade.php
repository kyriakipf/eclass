@component('mail::message')
# Email Ενεργοποίησης

Για να ενεργοποιήσετε τον λογαριασμό σας στην πλατφόρμα eClass, ακολουθήστε τον παρακάτω σύνδεσμο.

@component('mail::button', ['url' => route('student.accept', $invite->token)])
Ενεργοποίηση Λογαριασμού
@endcomponent

{{ config('app.name') }}
@endcomponent
