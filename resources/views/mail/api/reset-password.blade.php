<x-mail::message>
thanks for connecting please use the follwing code.
<x-mail::button :url="''">
{{ $code }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
