@props([
 'type'=>'submit',
 'value'=>'Submit',
 'borderColor'=>'border-primary',
 'bgColor'=>  'bg-primary'
    ])
<input
        type="{{$type}}"
        value="{{$value}}"
        class="w-full cursor-pointer rounded-lg border  {{$borderColor}} {{$bgColor}} p-4 font-medium text-white transition hover:bg-opacity-90"
/>