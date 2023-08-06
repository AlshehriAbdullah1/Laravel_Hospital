<style>
    /* Add the star styling CSS here */
    input[type="radio"].star {
        display: none;
    }

    label.star {
        cursor: pointer;
        font-size: 2rem;
        color: #ccc;
    }

    label.star:hover,
    label.star:hover ~ label.star {
        color: #ffca08; /* Yellow color for the stars when hovered */
    }

    input[type="radio"].star:checked ~ label.star {
        color: #ffca08; /* Yellow color for the selected stars */
    }
</style>

<div class="flex items-center justify-center ">
   {{-- @dd($patient->name) --}}
    <div class="bg-gray-200 rounded-xl p-4 w-full max-w-md">
        <header>
            <h1 class="font-bold mb-4 text-center">Leave a Review</h1>
            <form action="/doctor/comment/{{$doctor->id}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                    <input type="text" name="title" id="title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Body</label>
                    <textarea name="body" id="body" cols="30" rows="5"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="mb-4">
                    <input type="checkbox" id="anonymous" class="mr-2" onchange="toggleNameInput()" >
                    <label for="anonymous" class="text-gray-700">Send Anonymously</label>
                </div>
                <div class="mb-4" id="nameInputContainer" style="display: none">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Your Name</label>
                    <input type="text" name="name" id="name" value="{{$patient->name}}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="rating" class="block text-gray-700 text-sm font-bold mb-2">Rating</label>
                    <div class="flex items-center justify-center">
                        <input type="radio" name="rating" id="rating5" value="5" class="star">
                        <label for="rating5" class="star">&#9733;</label>

                        <input type="radio" name="rating" id="rating4" value="4" class="star">
                        <label for="rating4" class="star">&#9733;</label>

                        <input type="radio" name="rating" id="rating3" value="3" class="star">
                        <label for="rating3" class="star">&#9733;</label>

                        <input type="radio" name="rating" id="rating2" value="2" class="star">
                        <label for="rating2" class="star">&#9733;</label>

                        <input type="radio" name="rating" id="rating1" value="1" class="star">
                        <label for="rating1" class="star">&#9733;</label>
                    </div>
                </div>
                <button type="submit"
                    class="w-full rounded-md bg-blue-500 hover:bg-blue-600 py-2 px-4 text-center text-base font-semibold text-white focus:outline-none focus:shadow-outline">Submit
                    Review</button>
            </form>
        </header>
    </div>
</div>

<script>
    function toggleNameInput() {
        const nameInputContainer = document.getElementById('nameInputContainer');
        const anonymousCheckbox = document.getElementById('anonymous');
       
        if (anonymousCheckbox.checked) {
            nameInputContainer.style.display = 'none';
            document.getElementById('name').value = '';
           
        } else {
            document.getElementById('name').value = {{$patient->name}}
            // document.getElementById('name').value = {{auth('patient')->user()->name}}
        }
    }
</script>
