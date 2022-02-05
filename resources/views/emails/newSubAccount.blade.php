@component('mail::message')
    # New Account

    Hi {{$datas['name']}},

    An account has been created for you on {{$datas['businessName']}}.

    Find below your login credentials.
    URL: {{route('login')}}
    Phone Number: {{$datas['phone']}}
    Password: {{$datas['password']}}

    @slot('subcopy')
        You received this email because an Agent create an account for you on {{ config('app.name') }}.
    @endslot

    Thanks,
    {{ config('app.name') }}
@endcomponent
