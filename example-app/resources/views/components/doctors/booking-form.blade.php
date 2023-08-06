<div class="flex items-center justify-center p-9">
    <div class="mx-auto max-w-xl bg-white">
      <form action="/booking/{{$doctor->id}}" method="POST">
        @csrf
        
       
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
  