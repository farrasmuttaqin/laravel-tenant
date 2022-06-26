<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        @if(session()->has('register-tenant'))
            <div class="alert alert-success">
                {{ session()->get('register-tenant') }}
            </div>
        @endif

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register-new-tenant-post') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Phone number -->
            <div class="mt-4">
                <x-label for="phone_number" :value="__('Phone number')" />

                <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required />
            </div>

            <!-- Sub Domain -->
            <div class="mt-4">
                <x-label for="domain" :value="__('Sub Domain')" />

                <div class="flex items-baseline">
                    <x-input id="domain" class="block mt-1 mr-2 w-full" type="text" name="domain" :value="old('domain')" required />
                    <p style="padding-top:15px;">.{{ config('tenancy.central_domains')[0] }}</p>
                </div>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Register New Tenant') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
