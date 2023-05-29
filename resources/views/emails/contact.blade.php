<x-mail::message>
# Message from {{ $name }}

{{ $message }}

From:
{{ $name }} ({{ $email }})

<x-mail::button :url="'https://penglobalinc.com/'">
Go to website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
