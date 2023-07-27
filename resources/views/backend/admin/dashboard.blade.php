<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <br>
                    <a href="{{ route('permission.index') }}">Permission All</a>
                    <br>
                    <a href="{{ route('role.index') }}">Role All</a>
                    <br>
                    <a href="{{ route('assign.role.permission') }}">Assign Role Permission</a>

                    <a href="{{ route('all.admin') }}">All Admin</a>

                    @if (Auth::user()->can('default.setting'))
                    <a href="{{ route('all.admin') }}">default.setting</a>
                    @endif

                    @if (Auth::user()->can('mail.setting'))
                    <a href="{{ route('all.admin') }}">mail.setting</a>
                    @endif

                    @if (Auth::user()->can('sms.setting'))
                    <a href="{{ route('all.admin') }}">sms.setting</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
