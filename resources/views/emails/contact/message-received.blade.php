@component('mail::message')
# New Contact Message Received

You have received a new contact message from your website.

**Name:** {{ $message->name }}
**Email:** {{ $message->email }}
**Phone:** {{ $message->phone ?? 'Not provided' }}
**Subject:** {{ $message->subject }}

**Message:**
{{ $message->message }}

@component('mail::button', ['url' => route('admin.contact-messages.show', $message->id)])
View Message
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
