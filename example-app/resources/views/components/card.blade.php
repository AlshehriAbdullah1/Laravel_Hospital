<div class="m-16 py-2 px-10 border-gray-300 border-2 mt-4 rounded-md">

    <div>
        <img src="/images/header.png" alt="" class="rounded-full">
    </div>

    <div class="mt-8 flex flex-col justify-between">

        <header>

                <div class="space-x-2">
                    <a href="#" 
                    class="px-3 py-1 border border-blue-200 rounded-full text-blue-300 text-xs uppercase font-semibold"
                    style="font-size: 10px">
                {{$doctor->category->name}}</a>
                </div>

                <div class="mt-4">
                    <h1 class="text-xl">

                        <a href="/doctors/{{$doctor->id}}">
                            {{$doctor->name}}
                        </a>
                    </h1>

                   
                </div>
        </header>

        <div class="text-sm mt-4 text-gray-600 ">

            <p>{{$doctor->description}}</p>

           

        </div>

        <footer>
            <div class=" text-center">
                <div    class="rounded-md bg-blue-300 inline-block px-4 py-2 my-2 text-white">

                    <a href="/book/doctors/{{$doctor->id}}">
                        Book
                    </a>
                </div>
            </div>
        </footer>


    </div>



</div>