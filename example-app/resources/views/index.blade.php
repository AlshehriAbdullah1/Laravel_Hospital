<x-layout>
    @isset($categoryName)
    <x-_header :categories="$categories" :categoryName="$categoryName" />
    @else
    <x-_header :categories="$categories"/>

    @endisset


    <div>

    </div>
<div class="lg:grid lg:grid-cols-3 m-5 max-w-screen-xl">
    {{-- loop for each doctor,create their specific card =) --}}
    {{-- pass data to the card--}}
    @foreach ($doctors as $doctor)
         <x-card :doctor="$doctor"/>
    @endforeach
   


</div>

{{$doctors->links()}}
    
</x-layout>