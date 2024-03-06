@props(['isMobile' => false])

@php
    $contentClasses = $contentClasses ?? 'py-1 bg-white';

    if ($isMobile) {
        $containerClasses = 'ms-3 relative z-50';
        $width = 'w-48';
        $contentClasses = null;
        $align = 'right';
    } else {
        $contentClasses = 'flex flex-col-reverse ';
        $width = 'w-40';
        $containerClasses = 'mx-1 my-2.5 relative hidden md:block';
        $align = 'bottom';
    }

@endphp

<!-- Settings Dropdown -->
<div class="{{ $containerClasses }}">
    <x-dropdown align="{{ $align }}" width="{{ $width }}" contentClasses="{{ $contentClasses }}">
        <x-slot name="trigger">
            {{ $trigger ?? '' }}
        </x-slot>
        <x-slot name="content">
            <!-- Account Management -->
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Manage Account') }}
            </div>

            <x-dropdown-link wire:navigate href="{{ route('profile.show') }}">
                {{ __('Profile') }}
            </x-dropdown-link>


            <div class="border-t border-gray-200"></div>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</div>
