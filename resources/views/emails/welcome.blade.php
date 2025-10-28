<x-mail::message>
# Bem-vindo ao CRM, {{ $user->name }}!

A sua conta foi criada com sucesso. Pode agora entrar ao seu dashboard.
<x-mail::button :url="route('dashboard')">
Aceder ao Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
