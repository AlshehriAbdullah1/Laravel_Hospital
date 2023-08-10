<tr>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
            </div>

            <div class="ml-4">
                <div class="text-sm leading-5 font-medium text-gray-900">{{$booking['name']}}</div>
                <div class="text-sm leading-5 text-gray-500">{{$booking['phone']}}</div>
            </div>
        </div>
    </td>
   
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
        <div class="text-sm leading-5 text-gray-900">{{$booking['email']}}</div>
        {{-- <div class="text-sm leading-5 text-gray-500">Web dev</div> --}}
    </td>

    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
        @if ($booking['status'] == 'Pending'|| $booking['status'] == 'pending')
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-500 text-white-800">{{$booking['status']}}</span>
        @elseif ($booking['status'] == 'Completed')
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{$booking['status']}}</span>
        @elseif ($booking['status'] == 'Suspended')
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-400 text-white-800">{{$booking['status']}}</span>
        @else 
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full  text-white-800">NAN</span>
        @endif

    </td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{ $booking['date']}}</td>
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">{{ $booking['datetime_from'] }} - {{ $booking['datetime_to'] }}</td>

    <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium">
        
        {{-- <a href="#" class="text-indigo-600 hover:text-indigo-900">(HsxTtzyZ)</a> --}}
        <div id="notification" class="hidden">
            Text copied successfully!
        </div>
        <span id="tracking" class="text-indigo-600 hover:text-indigo-900 cursor-pointer">{{$booking['tracking_number']}}</span>

    </td >


    @auth('web')
    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
        <form action="/bookings/suspend/{{ $booking['id'] }}" method="POST">
            @csrf
            <button class="hover:text-red-600" type="submit">Suspend</button>
        </form>

    </td>

    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
        <form action="/bookings/complete/{{ $booking['id'] }}" method="POST">
            @csrf
            <button class="hover:text-red-600" type="submit">Complete</button>
        </form>

    </td>

    @endauth




{{-- </tr> --}}
</tr>