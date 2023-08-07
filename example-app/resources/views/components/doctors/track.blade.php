
<x-layout>
    <style>
        #notification {
    position: fixed;
    top: 10px;
    right: 10px;
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border-radius: 5px;
    display: none;
}
    </style>
    {{-- <div class="justify-cent">
    <h1>Enter Your Tracking Number</h1>
    <form action="" method="POST">
        @csrf
        <input type="text" name="tracking_number" required>
        <button type="submit">Track</button>
    </form> --}}

  
    @isset($bookings)
       <div class="flex mt-10 mb-3 justify-between">
        <h1 class="text-2xl text-center ">Booking Requests</h1>
        <div>



            <h1>search goes here</h1>
            {{-- <div class="flex">
                <h1 class="mr-4">Enter A Tracking Number</h1>

                <form action="" method="POST">
               @csrf
               <input type="text" name="tracking_number" required>
               <button class="bg-gray-300 p-1  pr-2 rounded-xl hover:bg-blue-400" type="submit">Track</button>
           </form>
                
            </div> --}}
            
        </div>
       
          

          
       </div>

       <table class="min-w-full">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Time</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tracking Number</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"></th>

            </tr>
        </thead>

        <tbody class="bg-white">



            @foreach ($bookings as $booking)
               
                <x-doctors.booking-component :booking="$booking" /> 

            @endforeach
           {{-- something was here --}}
       </tbody>
       </table>

    @else   
    <h1 class="text-center m-5">Sorry, You Have No Booking Requests </h1>
    @endisset

</div>
<script>
 const tracking = document.querySelector("#tracking");
const notification = document.querySelector("#notification");

tracking.onclick = function() {
    document.execCommand("copy");
}

tracking.addEventListener("copy", function(event) {
    event.preventDefault();
    if (event.clipboardData) {
        event.clipboardData.setData("text/plain", tracking.textContent);
        // Show the notification
        notification.style.display = "block";
        // Hide the notification after 2 seconds
        setTimeout(() => {
            notification.style.display = "none";
        }, 2000);
    }
});

</script>
</x-layout>




