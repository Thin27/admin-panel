@props(['method' => 'POST'])

@php
    $propsMethod = '';
    $method = str($method)->upper();
    $title = 'Add New Employee';

    if ($method == 'PUT' && $employeeData) {
        $propsMethod = $method;
        $method = 'POST';
        $title = "Edit Employee {$employeeData->firstname}";
    }
@endphp

<div>
    <form {{ 'method='.$method }} {{ $attributes }}>
        @csrf
        @if ($propsMethod)
            @method($propsMethod)
        @endif

        <h2 class="text-lg font-medium text-gray-900"> {{__($title)}} </h2>

        <div class="mt-6">
            <x-input-label for="firstname" :value="__('First Name')" />
            <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" 
                value="{{ $errors->any() ? old('firstname') : ($employeeData ? $employeeData->firstname : '') }}" 
                required autofocus autocomplete="firstname" />
            <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
        </div>

        <div class="mt-6">
            <x-input-label for="lastname" :value="__('Last Name')" />
            <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full" 
                value="{{ $errors->any() ? old('lastname') : ($employeeData ? $employeeData->lastname : '') }}"
                required autofocus autocomplete="lastname" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>

        <div class="mt-6">
            <x-input-label for="factory" :value="__('Factory')" />
            <x-input-select id="factory" name="factory" class="mt-1 block w-full"
                value="{{ $errors->any() ? old('factory') : ($employeeData && isset($employeeData->factory) ? $employeeData->factory->id : '') }}"
                :options="$factoryOptions"
                autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('factory')" />
        </div>

        <div class="mt-6">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" 
                value="{{ $errors->any() ? old('email') : ($employeeData ? $employeeData->email : '') }}"
                autofocus autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="mt-6">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" 
                value="{{ $errors->any() ? old('phone') : ($employeeData ? $employeeData->phone : '') }}" 
                autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button class="cancel" x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ml-3">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</div>