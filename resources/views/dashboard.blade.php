<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Trang chủ') }}
        </h2>
    </x-slot>

    <div class="flex-1 w-full">
        @include('trangchu')
    </div>

</x-app-layout>