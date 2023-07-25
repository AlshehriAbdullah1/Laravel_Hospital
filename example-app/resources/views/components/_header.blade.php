<header class="max-w-xl mx-auto mt-20 text-center">
    {{-- <img src="/images/header.png" alt=""> --}}
    <h1 class="text-4xl">
        Latest Shared <span class="text-blue-500">Blog Posts!</span> 
    </h1>

    <p class="text-sm mt-14">
        Don't Hesitate Reaching Us!

        Your Satisfaction is Our Priority 
    </p>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4 flex" >
        

        <div class="relative flex lg:inline-flex  bg-gray-100 rounded-xl">
        <!--  Category -->
        
                    
                    <button id="dropdownRadioButton" data-dropdown-toggle="dropdownDefaultRadio" 
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                     type="button">Dropdown radio<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                      </svg></button>
                  
                    <!-- Dropdown menu -->
                    <div id="dropdownDefaultRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioButton">
                          <li>
                            <div class="flex items-center">
                                <input id="default-radio-1" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Dentist</label>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center">
                                <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Optics</label>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center">
                                <input id="default-radio-3" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="default-radio-3" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Skin</label>
                            </div>
                          </li>
                        </ul>
                    </div>


        </div>

        <!-- Other Filters -->
     

        <!-- Search -->


        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="/">
                @if(request('category'))
                <input type="hidden" name="category" value="{{request('category')}}">
                @endif
                <input type="text" name="search" placeholder="Find something..."
                       class="bg-transparent placeholder-gray-600 font-mono font-semibold text-sm"
                       value="{{request('search')}}"
                       >
                       
            </form>
        </div>
    </div>
    </div>
   
</header>
<hr class="h-0.5 mt-5 bg-gray-400">