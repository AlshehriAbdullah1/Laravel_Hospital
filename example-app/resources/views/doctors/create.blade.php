<x-layout>

    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 p-6 rounded-xl border-gray-200">
            <h1 class="text-center font-bold text-xl">Register!</h1>
            <form method="POST" action="/register" class="mt-10">
                @csrf
                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-cs text-gray700"
                        for="name">
                        name
                        </label>
                        <input type="text" name="name" id="name" required
                        class="border border-gray-400 p-2 w-full"
                        value="{{old('name')}}">
                    </div>
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    
                   

                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-cs text-gray700"
                        for="email">
                        Email
                        </label>
                        <input type="email" name="email" id="email" required
                        class="border border-gray-400 p-2 w-full"
                        value="{{old('email')}}">
                    </div>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror


                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-cs text-gray700"
                        for="phone">
                        phone number
                        </label>
                        <input type="number" name="phone" id="phone" required
                        class="border border-gray-400 p-2 w-full"
                        value="{{old('phone')}}">
                    </div>
                    @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror


                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-cs text-gray700"
                        for="password">
                        Password
                        </label>
                        <input type="password" name="password" id="password" required
                        class="border border-gray-400 p-2 w-full">
                    </div>
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <div class="mb-6">
                        <label class="block mb-2 uppercase font-bold text-cs text-gray-700" for="description">Description:</label>
                        <textarea name="description" id="description" class="border border-gray-400 p-2 w-full" rows="4">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mb-6">
                        <button
                        type="submit"
                        class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                        Submit
                    </button>
                    </div>
                
                  
                </ul>
            </form>
        </main>
    </section>

</x-layout>