<x-jet-validation-errors class="mb-4 alert-danger alert-dismissible alert"/>


@if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600 alert-dismissible alert">
        {{ session('status') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 font-medium text-sm alert-danger alert-dismissible alert">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="mb-4 font-medium text-sm alert-success alert-dismissible alert">
        {{ session('success') }}
    </div>
@endif
