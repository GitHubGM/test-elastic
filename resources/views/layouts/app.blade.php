<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Test' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('assets/css/satoshi.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    @livewireStyles
    @stack('styles')
</head>
<body
        x-data="{ sidebarToggle: false, darkMode: false, dropdownOpen: false, notifying: true }"
        x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
        :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}"
>
<x-ui.icons.preloader />
@yield('section')
@stack('scripts')
@livewireScripts
</body>
</html>
