<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    {{$name}}
                </div>
            </div>
        </div>

        <div>
            <h1 class="p-2 text-center" style="font-size: larger;">Changhao Comment Bank</h1>
            <div class="p-2 text-center">
                <h2>show all the comments</h2>
                <h2>upload comments</h2>
                <h3>adminmode(edit, delete, verify)</h3>
            </div>
        </div>
    </div>
</x-app-layout>