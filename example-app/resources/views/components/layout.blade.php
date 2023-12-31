
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/cs">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Digital Clinic</title>
</head>
<style>
    html {
        scroll-behavior: smooth;
    }
    .clamp{
        display:-webkit-box;
        -webkit-box-wrient:vertical;
        overflow:hidden;
    }
    .clamp.one-line {
        -webkit-line-clamp:1;
    }
    </style>
<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/Logo.png" alt="Logo" width="80" height="10">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">

                <a href="" class="ml-3  text-xs font-semibold text-black uppercase  mr-5">About us</a>





                @auth('patient')

                <a href="/bookings" class="ml-3  text-xs font-semibold text-black uppercase  mr-5">Your bookings</a>

                @elseauth('web')

                <a href="/bookings/all" class="ml-3  text-xs font-semibold text-black uppercase  mr-5">Bookings Requests</a>

                @endauth
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                @auth('patient')
                <!-- Show content for authenticated 'patient' users -->
                <p>Welcome! {{ auth('patient')->user()->name }}</p>
                <a href="/logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="text-blue-400 ml-5">
                   Logout
                </a>
              @elseauth('web')
                <!-- Show content for authenticated 'web' users -->
                <p>Welcome! {{ auth('web')->user()->name }}</p>
                <a href="/logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="text-blue-400 ml-5">
                   Logout
                </a>
            @else
                <!-- Show content for guest users (not authenticated) -->
                <a href="/login" class="bg-gray-400 ml-3 rounded-full text-xs font-semibold hover:bg-blue-400 text-white uppercase py-3 px-5 mr-5">
                    Log in
                </a>
                <a href="/register" class="bg-gray-400 ml-3 rounded-full text-xs font-semibold hover:bg-blue-400 text-white uppercase py-3 px-5 mr-5">
                    Register
                </a>
            @endauth
            
           
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                @csrf
            </form>
            
       
            </div>
            
        </nav>
        <hr class="bg-gray-300 h-0.5"  >
    
        

       {{$slot}} 
       

        <footer id="newsletter"class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            {{-- <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;"> --}}
            <h5 class="text-2xl">Don't Hesitate Reaching Us!</h5>
            <p class="text-xs text-gray-500">Your Satisfaction is Our Priority </p>

            <div class="mt-10">
             
            </div>
            <div class="mt-8">
                <a href="/about" class="text-gray-800 hover:underline mx-2">About Us</a>
                <a href="/contact" class="text-gray-800 hover:underline mx-2">Contact</a>
                <a href="/" class="text-gray-800 hover:underline mx-2">Doctors</a>
                <a href="/join" class="text-gray-800 hover:underline mx-2">Become a member</a>
                <!-- Add more hyperlinks as needed -->
            </div>
        </footer>
    </section>

 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
  
</body>
</html>