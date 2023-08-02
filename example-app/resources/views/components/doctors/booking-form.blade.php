<div class="flex items-center justify-center p-9">
    <div class="mx-auto max-w-xl bg-white">
      <form action="/booking/{{$doctor->id}}" method="POST">
        @csrf
        <div class="mb-5">
          <label
            for="name"
            class="mb-3 block text-base font-medium text-[#07074D]"
          >
            Full Name
          </label>
          <input
            type="text"
            name="full_name"
            id="full_name"
            placeholder="Full Name"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
          />
        </div>
        <div class="mb-5">
          <label
            for="phone"
            class="mb-3 block text-base font-medium text-[#07074D]"
          >
            Phone Number
          </label>
          <input
            type="text"
            name="phone"
            id="phone"
            placeholder="Enter your phone number"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
          />
        </div>
        <div class="mb-5">
          <label
            for="email"
            class="mb-3 block text-base font-medium text-[#07074D]"
          >
            Email Address
          </label>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="Enter your email"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
          />
        </div>

        {{-- DATE-TIME Component --}}
        <div class="grid grid-cols-1 gap-6 my-3">
          <div>
            <label for="date" class="block mb-2 text-base font-medium text-[#07074D]">
              Date
            </label>
            <input
             min="{{ date('Y-m-d', strtotime('+1 day')) }}"
              type="date"
              name="date"
              id="date"
              class="w-full p-2 border rounded-md border-[#e0e0e0] bg-white text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              
            />
          </div>
          <div class="flex">

            <div class="flex flex-1 flex-col">
              <label for="from" class="block mb-2 text-base font-medium text-[#07074D]">
                From
              </label>
              <input
                type="time"
                name="datetime_from"
                id="datetime_from"
                class="w-full p-2 border rounded-md border-[#e0e0e0] bg-white text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />  
            </div>
            <div class="w-2.5"></div>
            <div class="flex flex-1 flex-col">
              <label for="to" class="block mb-2 text-base font-medium text-[#07074D]">
                To
              </label>
              <input
                type="time"
                name="datetime_to"
                id="datetime_to"
                class="w-full p-2 border rounded-md border-[#e0e0e0] bg-white text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                min="" 
              />
            </div>
          </div>
        </div>    
        <div>
          <button 
            class="hover:shadow-form w-full rounded-md bg-blue-400 hover:bg-blue-500 py-3 px-8 text-center text-base font-semibold text-white outline-none"
          >
            Book Appointment
          </button>
        </div>
      </form>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const fromInput = document.getElementById('from');
      const toInput = document.getElementById('to');
  
      fromInput.addEventListener('change', function () {
        toInput.min = fromInput.value;
      });
    });
  </script>
  