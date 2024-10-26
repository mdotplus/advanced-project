@extends ('layouts.app')

@if (auth()->user()->authority_id === 1)
    @include ('adminpage.user_management')
@endif
@include ('adminpage.shop_management')
