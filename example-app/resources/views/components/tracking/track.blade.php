
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
    <div class="justify-cent">
    <h1>Enter Your Tracking Number</h1>
    <form action="" method="POST">
        @csrf
        <input type="text" name="tracking_number" required>
        <button type="submit">Track</button>
    </form>


    @isset($booking)
    
       <p>your tracking number is {{$booking->tracking_number}}</p>

       <table class="min-w-full">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Tracking Number</th>
            </tr>
        </thead>

        <tbody class="bg-white">
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                        </div>

                        <div class="ml-4">
                            <div class="text-sm leading-5 font-medium text-gray-900">John Doe</div>
                            <div class="text-sm leading-5 text-gray-500">0540692371</div>
                        </div>
                    </div>
                </td>
                
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">example@example.com</div>
                    {{-- <div class="text-sm leading-5 text-gray-500">Web dev</div> --}}
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Pending</span>
                </td>

                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">22 Jun, 2023</td>

                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
                    
                    {{-- <a href="#" class="text-indigo-600 hover:text-indigo-900">(HsxTtzyZ)</a> --}}
                    <div id="notification" class="hidden">
                        Text copied successfully!
                    </div>
                    <span id="tracking" class="text-indigo-600 hover:text-indigo-900 cursor-pointer">HsxTtzyZ</span>

                </td>
            </tr>
        </tr>
       </tbody>
       </table>

    @else   
    <p>No booking found with the entered tracking number.</p>
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

