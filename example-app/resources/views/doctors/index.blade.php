<x-layout>
    <div class="flex justify-around p-20 ">

                 {{-- doctor's information & rating --}}
                <div class="border-gray-300 border-2 mt-12 rounded-md pt-4" style="height: fit-content" >

                     <div class=
                     "flex justify-center">
                         <img src="/images/header.png" alt="" class="rounded-full" width="100">
                     </div>
                 
                     <div class="mt-8 m-12 flex flex-col justify-between">

                         <header>

                                 <div class="space-x-2">
                                     <a href="/category?id={{$doctor->category->id}}" 
                                     class="px-3 py-1 border border-blue-200 rounded-full text-blue-300 text-xs uppercase font-semibold"
                                     style="font-size: 10px">
                                 {{$doctor->category->name}}
                                </a>
                                 </div>
                             
                                 <div class="mt-4">
                                     <h1 class="text-xl">

                                        
                                             {{$doctor->name}}
                                         
                                     </h1>
                                 
                                 
                                 </div>
                         </header>
                     
                         <div class="text-sm mt-4 text-gray-600 ">

                             <p>
                                {{$doctor->description}}
                            </p>



                         </div>
                     
                         <footer>
                             <div class=" text-right">
                                 <div class="flex justify-center items-center rounded-md px-4 py-2 my-2 ">

                                     <span class="mr-2 text-yellow-300 text-lg">
                                        {{$doctor->rating}}
                                    </span>
                                     <span class="text-yellow-300 text-4xl">&#9733;</span>
                                 </div>
                             </div>
                         </footer>
                     
                     
                     </div>
                 
                 
                 
                </div>
                 {{-- booking form --}}
                 <div class="text-center">
                    <h1 class="mt-10 text-xl text-bold">Book!</h1>
                    <x-doctors.booking-form :doctor="$doctor"/>
                </div>

                
                 {{-- @include('doctors.booking-form') --}}
            
    </div>       
    <div class="flex max-h-100">
        <!-- Comments Section -->
        <div class="flex-1 bg-gray-100 p-8 overflow-y-scroll"> 
            <h3 class="text-center text-bold text-xl">Comments</h3>
            @foreach ($doctor->comments as $comment)
                <x-doctors.comment :comment="$comment" />
            @endforeach
        </div>
    
        <!-- Comment Form -->
        <div class="bg-gray-200  p-8">
           
            <x-doctors.comment-form :doctor="$doctor" :patient="$patient" />
        </div>
    </div>
    

    {{-- comments --}}
</x-layout>