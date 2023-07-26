<x-layout>
    <x-_header :categories="$categories"/>

<div class="lg:grid lg:grid-cols-3 m-5">
    {{-- loop for each doctor,create their specific card =) --}}
    {{-- pass data to the card--}}
    @foreach ($doctors as $doctor)
         <x-card :doctor="$doctor"/>
    @endforeach
   


</div>

{{$doctors->links()}}
        








    
</x-layout>