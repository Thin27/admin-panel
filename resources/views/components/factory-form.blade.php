@props(['method' => 'POST'])

@php
    $propsMethod = '';
    $method = str($method)->upper();
    $title = 'Add New Factory';

    // test 2

    if ($method == 'PUT' && $factoryData) {
        $propsMethod = $method;
        $method = 'POST';
        $title = "Edit {$factoryData->factory_name} Factory";
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
            <x-input-label for="factory_name" :value="__('Factory Name')" />
            <x-text-input id="factory_name" name="factory_name" type="text" class="mt-1 block w-full" 
                value="{{ $errors->any() ? old('factory_name') : ($factoryData ? $factoryData->factory_name : '') }}" 
                required autofocus autocomplete="factory_name" />
            <x-input-error class="mt-2" :messages="$errors->get('factory_name')" />
        </div>

        <div class="mt-6">
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" 
                value="{{ $errors->any() ? old('location') : ($factoryData ? $factoryData->location : '') }}"
                required autofocus autocomplete="location" />
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        </div>

        <div class="mt-6">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" 
                value="{{ $errors->any() ? old('email') : ($factoryData ? $factoryData->email : '') }}"
                autofocus autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="mt-6">
            <x-input-label for="website" :value="__('Website')" />
            <x-text-input id="website" name="website" type="text" class="mt-1 block w-full" 
                value="{{ $errors->any() ? old('website') : ($factoryData ? $factoryData->website : '') }}" 
                autofocus autocomplete="website" />
            <x-input-error class="mt-2" :messages="$errors->get('website')" />
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