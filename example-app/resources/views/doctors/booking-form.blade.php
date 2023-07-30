

<div class="flex items-center justify-center p-12">
    <!-- Author: FormBold Team -->
    <!-- Learn More: https://formbold.com -->
    <div class="mx-auto w-full max-w-[550px] bg-white">
      <form action="/book" method="POST">
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
            name="name"
            id="name"
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
        <div class="grid grid-cols-2 gap-6">
          <div>
            <label for="date" class="block mb-2 text-base font-medium text-[#07074D]">
              Date
            </label>
            <input
              type="date"
              name="date"
              id="date"
              class="w-full p-2 border rounded-md border-[#e0e0e0] bg-white text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
          </div>
          <div>
            <label for="from" class="block mb-2 text-base font-medium text-[#07074D]">
              From
            </label>
            <input
              type="time"
              name="from"
              id="from"
              class="w-full p-2 border rounded-md border-[#e0e0e0] bg-white text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
          </div>
          <div>
            <label for="to" class="block mb-2 text-base font-medium text-[#07074D]">
              To
            </label>
            <input
              type="time"
              name="to"
              id="to"
              class="w-full p-2 border rounded-md border-[#e0e0e0] bg-white text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
          </div>
        </div>
        {{-- <div class="-mx-3 flex">
          <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
              <label
                for="date"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Date
              </label>
              <input
                type="date"
                name="date"
                id="date"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
            </div>
          </div>
          <div class="w-full px-3 sm:w-1/2">
            <div class="mb-5">
              <label
                for="from"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                From 
              </label>
              <input
                type="time"
                name="from"
                id="time"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
            </div>

            <div class="mb-5">
              <label
                for="To"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                To 
              </label>
              <input
                type="time"
                name="To"
                id="time"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
            </div>

          </div>
        </div> --}}
    
    
    
        <div>
          <button 
            class="hover:shadow-form w-full rounded-md bg-blue-300 py-3 px-8 text-center text-base font-semibold text-white outline-none"
          >
            Book Appointment
          </button>
        </div>
      </form>
    </div>
  </div>