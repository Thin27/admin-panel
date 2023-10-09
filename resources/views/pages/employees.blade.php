@php
    $factoryOptions = [['label' => 'Choose a factory', 'value' => '', 'isSelected' => true]];
    foreach ($factories as $factory) {
        $factoryOptions = [...$factoryOptions,
            ['label' => $factory->factory_name,
            'value' => $factory->id]];
    }
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status'))
                        <div id="statusMessage" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('status') }}</p>
                        </div>
                    @endif

                    <div class="flex items-center gap-4 mb-4">
                        <x-primary-button
                            class="ms-auto"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'add-employee')"
                        >{{ __('Add') }}</x-primary-button>
                    </div>

                    {{-- Table --}}
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                @if (count($employees) > 0)
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Firstname
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Lastname
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Factory
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        <span class="sr-only">Action</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($employees as $employee)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $employee->firstname }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $employee->lastname }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ isset($employee->factory) ? $employee->factory->factory_name : '---' }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            <x-secondary-button
                                                                class="ms-auto"
                                                                x-data=""
                                                                x-on:click.prevent="$dispatch('open-modal', 'update-employee{{ $employee->id }}')"
                                                            >{{ __('Edit') }}</x-secondary-button>
                                                            <x-danger-button
                                                                class="ms-2"
                                                                x-data=""
                                                                x-on:click.prevent="$dispatch('open-modal', 'delete-employee{{ $employee->id }}')"
                                                            >{{ __('Delete') }}</x-danger-button>
                                                        </td>

                                                        <x-modal name="{{'update-employee'.$employee->id}}" :show="$errors->isNotEmpty()" focusable>
                                                            <div class="p-6">
                                                                <x-employee-form 
                                                                    method="put" 
                                                                    action="{{route('employee.update', $employee->id)}}"
                                                                    :factory-options="$factoryOptions"
                                                                    :employee-data="$employee">
                                                                </x-employee-form>
                                                            </div>
                                                        </x-modal>

                                                        <x-modal name="{{'delete-employee'.$employee->id}}" focusable>
                                                            <div class="p-6">
                                                                <form method="post" action="{{ route('employee.destroy', $employee->id) }}">
                                                                    @csrf
                                                                    @method('delete')
                                                        
                                                                    <h2 class="text-lg font-medium text-gray-900">
                                                                        {{ __("Are you sure you want to remove ".$employee->firstname." as employee?") }}
                                                                    </h2>
                                                        
                                                                    <div class="mt-6 flex justify-end">
                                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                                            {{ __('No') }}
                                                                        </x-secondary-button>
                                                        
                                                                        <x-danger-button class="ml-3">
                                                                            {{ __('Yes') }}
                                                                        </x-danger-button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </x-modal>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-4">
                                        {{ $employees->links() }}
                                    </div>
                                @else
                                    <div class="bg-gray-50 px-6 py-4 text-sm text-gray-500 flex justify-center">{{__('No Record')}}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-modal name="add-employee" :show="$errors->isNotEmpty()" focusable>
        <div class="p-6">
            <x-employee-form 
                method="post" 
                action="{{route('employee.store')}}"
                :factory-options="$factoryOptions">
            </x-employee-form>
        </div>
    </x-modal>

    <script>
        $(function() {
            setTimeout(() => {
                $('#statusMessage').hide();
            }, 5000)
        })
    </script>
</x-app-layout>
