<x-mail::message>
# Thanks for signing up for the event!

You have successfully signed up for event: **{{ $event->title }}**

**When:** {{ \Carbon\Carbon::parse($event->date)->format('F j, Y H:i') }} <br>
**Where:** {{ $event->address }}, {{ $event->city }}, {{ $event->country }}
<x-mail::button :url="$cancelUrl">
Cancel Attendance
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
<x-slot:subcopy>
        @lang(
            "If you're having trouble clicking the 'Cancel Attendance' button, copy and paste the URL below\n".
            'into your web browser:',
            [
                'actionText' => 'Cancel Attendance',
            ]
        ) <span class="break-all">[{{ $displayableActionUrl }}]({{ $cancelUrl }})</span>
</x-slot:subcopy>
</x-mail::message>
