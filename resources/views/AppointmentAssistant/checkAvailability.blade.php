For service: {{ $service->name }} - {{ $service->description }}

There is available slot(s) on {{ $date }}:
@foreach ($slots as $slot)
    - {{ $slot->start_time->format('H:i') }} with ID: {{ $slot->id }}
@endforeach