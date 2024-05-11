@php
    //dd(Auth::guard('guest')->user()->mand);
    dd(
        Auth::guard('guest')->user()->mand,
        Auth::guard('guest')->user()->hovaten

    );
@endphp