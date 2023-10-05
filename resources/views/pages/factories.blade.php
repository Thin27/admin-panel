<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Factory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center gap-4 mb-4">
                        <x-primary-button
                            class="ms-auto"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'add-update-factory')"
                        >{{ __('Add') }}</x-primary-button>
                    </div>

                    {{-- Table --}}
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Factory Name
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($factories as $factory)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        {{ $factory->name }}
                                                    </td>
                                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="{{ route('tasks.edit', $factory) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="mt-4">
                                    {{ $factories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-modal name="add-update-factory" focusable>
                        <form method="post" action="{{ $factory ? route('factory.update', $factory->id) : route('factory.store') }}" class="p-6">
                            @csrf
                            @if($factory)
                                @method('put')
                            @endif
                
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ $factory ? __('Update '.$factory->factory_name.' Factory') : __('Add New Factory') }}
                            </h2>
                
                            <div class="mt-6">
                                <x-input-label for="factory_name" :value="__('Factory Name')" />
                                <x-text-input id="factory_name" name="factory_name" type="text" class="mt-1 block w-full" 
                                    :value={{ $factory ? old('factory_name', $factory->factory_name) : '' }} 
                                    required autofocus autocomplete="factory_name" />
                                <x-input-error class="mt-2" :messages="$errors->get('factory_name')" />
                            </div>
                
                            <div class="mt-6">
                                <x-input-label for="location" :value="__('Location')" />
                                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" 
                                :value={{ $factory ? old('location', $factory->location) : '' }}
                                required autofocus autocomplete="location" />
                                <x-input-error class="mt-2" :messages="$errors->get('location')" />
                            </div>
                
                            <div class="mt-6">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" 
                                :value={{ $factory ? old('email', $factory->email) : ''}}
                                required autofocus autocomplete="email" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                
                            <div class="mt-6">
                                <x-input-label for="website" :value="__('Website')" />
                                <x-text-input id="website" name="website" type="text" class="mt-1 block w-full" 
                                :value={{ $factory ? old('website', $factory->website) : ''}} 
                                required autofocus autocomplete="website" />
                                <x-input-error class="mt-2" :messages="$errors->get('website')" />
                            </div>
                
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                
                                <x-primary-button class="ml-3">
                                    {{ $factory ? __('Update') : __('Add') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
