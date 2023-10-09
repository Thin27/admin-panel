@props(['options' => [], 'value' => null])

<select {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    @foreach ($options as $option)
        @php
            $isSelected = isset($option['isSelected']) ? 'selected' : '';
            if ($value) {
                $isSelected = $value == $option['value'] ? 'selected' : $isSelected;
            }
        @endphp

        <option 
            {{ isset($option['isDisabled']) ? 'disabled' : '' }} 
            {{ $isSelected }} 
            value="{{ $option['value'] }}"
            >
            {{ $option['label'] }}
        </option>
    @endforeach
</select>