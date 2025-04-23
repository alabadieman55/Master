
@component('mail::message')
    # New Contact Request

    **Name:** {{ $contact->name }}
    **Email:** {{ $contact->email }}
    @if ($contact->phone)
        **Phone:** {{ $contact->phone }}
    @endif
    **Subject:** {{ $contact->subject }}

    **Message:**
    {{ $contact->message }}

    @component('mail::button', ['url' => url('/admin/contact-requests/' . $contact->id)])
        View in Dashboard
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent