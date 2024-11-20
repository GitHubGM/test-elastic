@extends('layouts.app')
@section('section')
    <div class="flex h-screen overflow-hidden">
    <x-partials.admin.sidebar />
    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
    <x-partials.admin.header/>

    {{ $slot }}
{{--   footer  --}}
    </div>
    </div>
@endsection


