<x-layout>
    <div class="flex justify-center ">

                 {{-- doctor's information & rating --}}
                <div class="border-gray-300 border-2 mt-12 rounded-md pt-4" style="height: fit-content" >

                     <div class=
                     "flex justify-center">
                         <img src="/images/header.png" alt="" class="rounded-full" width="100">
                     </div>
                 
                     <div class="mt-8 m-12 flex flex-col justify-between">

                         <header>

                                 <div class="space-x-2">
                                     <a href="#" 
                                     class="px-3 py-1 border border-blue-200 rounded-full text-blue-300 text-xs uppercase font-semibold"
                                     style="font-size: 10px">
                                 $doctor->category->name</a>
                                 </div>
                             
                                 <div class="mt-4">
                                     <h1 class="text-xl">

                                         <a href="/doctors/$doctor->id">
                                             $doctor->name
                                         </a>
                                     </h1>
                                 
                                 
                                 </div>
                         </header>
                     
                         <div class="text-sm mt-4 text-gray-600 ">

                             <p>$doctor->description</p>



                         </div>
                     
                         <footer>
                             <div class=" text-right">
                                 <div class="flex justify-center items-center rounded-md px-4 py-2 my-2 ">

                                     <span class="mr-2 text-yellow-300 text-lg">4.5</span>
                                     <span class="text-yellow-300 text-4xl">&#9733;</span>
                                 </div>
                             </div>
                         </footer>
                     
                     
                     </div>
                 
                 
                 
                </div>
                 {{-- booking form --}}
                 @include('doctors.booking-form')
                
    </div>


    {{-- comments --}}
</x-layout>