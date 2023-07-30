<header class="max-w-xl mx-auto mt-20 text-center">
  {{-- <img src="/images/header.png" alt=""> --}}
  <h1 class="text-4xl">
      Latest Shared <span class="text-blue-500">Blog Posts!</span> 
  </h1>

  <p class="text-sm mt-14">
      Don't Hesitate Reaching Us!

      Your Satisfaction is Our Priority 
  </p>

  <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4 flex">
      <div class="relative flex lg:inline-flex bg-gray-100 rounded-xl">
          <!-- Category -->
          <button id="dropdownRadioButton" data-dropdown-toggle="dropdownDefaultRadio" onchange="" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            @isset($categoryName)
                {{$categoryName}}
            @else 
                Select Category
            @endisset
              <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
              </svg>
          </button>
          
          <!-- Dropdown menu -->
          <x-dropdown>
            @foreach ($categories as $category)

            @if(isset($categoryName) && $categoryName == $category->name)
            <x-dropdown-item :category="$category" :active=true/>
            @else
            <x-dropdown-item :category="$category" :active=false/>

            @endif
            @endforeach
          </x-dropdown>
      <!-- Other Filters -->

      <!-- Search -->
      <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
          <form method="GET" action="/search">
            @csrf
              {{-- @if(request('category'))
              <input type="hidden" name="category" value="{{request('category')}}">
              @endif --}}
              <input type="text" name="search" placeholder="Find something..."
                     class="bg-transparent placeholder-gray-600 font-mono font-semibold text-sm">
          </form>
      </div> 
  </div>
</header>
<hr class="h-0.5 mt-5 bg-gray-400">
