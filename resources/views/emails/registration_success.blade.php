<h2>Hello {{ $attendee->first_name }}</h2>

<p>Your registration has been successfully completed 🎉</p>

<p><strong>Event:</strong> {{ $attendee->event->title ?? '' }}</p>
<p><strong>Registration ID:</strong> #{{ $attendee->serial_number }}</p>

<p>We look forward to seeing you on race day!</p>

<br>
<p>Thanks,<br>Event Team</p>