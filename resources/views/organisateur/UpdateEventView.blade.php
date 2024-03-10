<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<style>
    /* Custom style */
    .header-right {
        width: calc(100% - 3.5rem);
    }

    .sidebar:hover {
        width: 16rem;
    }

    @media only screen and (min-width: 768px) {
        .header-right {
            width: calc(100% - 16rem);
        }
    }

    .rating-wrapper {
        align-self: center;
        box-shadow: 7px 7px 25px rgba(198, 206, 237, .7),
            -7px -7px 35px rgba(255, 255, 255, .7),
            inset 0px 0px 4px rgba(255, 255, 255, .9),
            inset 7px 7px 15px rgba(198, 206, 237, .8);
        border-radius: 5rem;
        display: inline-flex;
        direction: rtl !important;
        padding: .6rem 2.5rem;
        margin-left: auto;


        label {
            color: #E1E6F6;
            cursor: pointer;
            display: inline-flex;
            font-size: 3rem;
            padding: 1rem .6rem;
            transition: color 0.5s;
        }

        svg {
            -webkit-text-fill-color: transparent;
            -webkit-filter: drop-shadow (4px 1px 6px rgba(198, 206, 237, 1));
            filter: drop-shadow(5px 1px 3px rgba(198, 206, 237, 1));
        }

        input {
            height: 100%;
            width: 100%;
        }

        input {
            display: none;
        }

        label:hover,
        label:hover~label,
        input:checked~label {
            color: #34AC9E;
        }

        label:hover,
        label:hover~label,
        input:checked~label {
            color: #34AC9E;
        }
    }
</style>

<body>
    <div x-data="setup()" :class="{ 'dark': isDark }">
        <div
            class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black dark:text-white">

            <!-- Header -->
            <div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
                <div
                    class="flex items-center justify-end md:justify-center pl-3 w-14 md:w-64 h-14 bg-black dark:bg-gray-800 border-none">
                    <img class="w-5 h-5 md:w-10 md:h-10 mr-2 rounded-full overflow-hidden"
                        src="https://therminic2018.eu/wp-content/uploads/2018/07/dummy-avatar.jpg" />
                    <span class="hidden md:block">{{ auth()->user()->name }}</span>
                </div>
                <div class="flex justify-end items-center h-14 bg-black dark:bg-gray-800 header-right">
                    <ul class="flex items-center">

                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-end justify-end mr-4 hover:text-blue-100">
                                <span class="inline-flex mr-1">
                                </span>
                                Home
                            </a>
                        </li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="index.php?action=logOut"
                                class="flex items-end justify-end mr-4 hover:text-blue-100">
                                <span class="inline-flex mr-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                </span>
                                <button type="submit">Logout</button>
                            </a>
                        </form>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ./Header -->

            <!-- Sidebar -->
            <div
            class="fixed flex flex-col top-14 left-0 w-14 hover:w-64 md:w-64 bg-gray-500 dark:bg-gray-900 h-full text-white transition-all duration-300 border-none z-10 sidebar">
            <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
                <ul class="flex flex-col py-4 space-y-1">
                    <li class="px-5 hidden md:block">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-sm font-light tracking-wide text-gray-400 uppercase">Main</div>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('organisateurDash') }}"
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-black dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-white dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px"
                                    viewBox="0 0 24 24" fill="none">
                                    <path clip-rule="evenodd"
                                        d="m12 3.75c-4.55635 0-8.25 3.69365-8.25 8.25 0 4.5563 3.69365 8.25 8.25 8.25 4.5563 0 8.25-3.6937 8.25-8.25 0-4.55635-3.6937-8.25-8.25-8.25zm-9.75 8.25c0-5.38478 4.36522-9.75 9.75-9.75 5.3848 0 9.75 4.36522 9.75 9.75 0 5.3848-4.3652 9.75-9.75 9.75-5.38478 0-9.75-4.3652-9.75-9.75zm9.75-.75c.4142 0 .75.3358.75.75v3.5c0 .4142-.3358.75-.75.75s-.75-.3358-.75-.75v-3.5c0-.4142.3358-.75.75-.75zm0-3.25c-.5523 0-1 .44772-1 1s.4477 1 1 1h.01c.5523 0 1-.44772 1-1s-.4477-1-1-1z"
                                        fill="white" fill-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Statistiques</span>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-black dark:hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-white dark:hover:border-gray-800 pr-6">
                            <span class="inline-flex justify-center items-center ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px"
                                    viewBox="0 0 24 24" fill="none">
                                    <path clip-rule="evenodd"
                                        d="m12 3.75c-4.55635 0-8.25 3.69365-8.25 8.25 0 4.5563 3.69365 8.25 8.25 8.25 4.5563 0 8.25-3.6937 8.25-8.25 0-4.55635-3.6937-8.25-8.25-8.25zm-9.75 8.25c0-5.38478 4.36522-9.75 9.75-9.75 5.3848 0 9.75 4.36522 9.75 9.75 0 5.3848-4.3652 9.75-9.75 9.75-5.38478 0-9.75-4.3652-9.75-9.75zm9.75-.75c.4142 0 .75.3358.75.75v3.5c0 .4142-.3358.75-.75.75s-.75-.3358-.75-.75v-3.5c0-.4142.3358-.75.75-.75zm0-3.25c-.5523 0-1 .44772-1 1s.4477 1 1 1h.01c.5523 0 1-.44772 1-1s-.4477-1-1-1z"
                                        fill="white" fill-rule="evenodd" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Listes des evénements</span>
                        </a>
                    </li>
                </ul>
                <p class="mb-14 px-5 py-3 hidden md:block text-center text-xs">Copyright @2024</p>
            </div>
        </div>
            <!-- ./Sidebar -->
<br><br><br><br>
            <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
                <body style="overflow: hidden visible;">
                    <div id="page-container" class="flex items-center justify-center h-screen">
                        <div class="bg-white w-full md:w-1/2 p-8 shadow-lg rounded-md">
                            <h1 class="text-3xl font-bold mb-6">Modifier Evenement</h1>
                            <form action="{{route('UpdateEvent', $event->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="titre" class="text-sm font-semibold text-gray-600">titre</label>
                                    <input type="text" id="titre" name="titre" value="{{$event->titre}}"
                                        class="w-full px-4 py-2 border rounded-md mt-1 focus:outline-none focus:border-indigo-500"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="text-sm font-semibold text-gray-600">description</label>
                                    <input type="text" id="description" name="description" value="{{$event->description}}"
                                        class="w-full px-4 py-2 border rounded-md mt-1 focus:outline-none focus:border-indigo-500"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="date" class="text-sm font-semibold text-gray-600">date</label>
                                    <input type="date" id="date" name="date" value="{{$dateForInput}}"
                                        class="w-full px-4 py-2 border rounded-md mt-1 focus:outline-none focus:border-indigo-500"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="places" class="text-sm font-semibold text-gray-600">places</label>
                                    <input type="number" id="places" name="places" value="{{$event->places}}"
                                        class="w-full px-4 py-2 border rounded-md mt-1 focus:outline-none focus:border-indigo-500"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="duree" class="text-sm font-semibold text-gray-600">duree</label>
                                    <input type="time" id="duree" name="duree" value="{{$event->duree}}"
                                        class="w-full px-4 py-2 border rounded-md mt-1 focus:outline-none focus:border-indigo-500"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="lieu" class="text-sm font-semibold text-gray-600">lieu</label>
                                    <input type="text" id="lieu" name="lieu" value="{{$event->lieu}}"
                                        class="w-full px-4 py-2 border rounded-md mt-1 focus:outline-none focus:border-indigo-500"
                                        required>
                                </div>
                                <div class="mb-4">
                                    <label for="category" class="text-sm font-semibold text-gray-600">category</label>
                                    <select name="categorie" id="categorie" class="w-full px-4 py-2 border rounded-md mt-1 focus:outline-none focus:border-indigo-500">
                                        @foreach ($categories as $categorie)
                                        <option value="{{$categorie->id}}"  {{$event->category_id == $categorie->id ? 'selected' : ''}}>{{$categorie->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="image" class="text-sm font-semibold text-gray-600">image</label>
                                    <img src="{{ asset('storage/event_images/' . $event->image) }}" alt="Image de l'événement" class="w-24 h-24 object-cover rounded-lg mb-2">
                                    <input type="file" id="image" name="image"
                                        class="w-full px-4 py-2 border rounded-md mt-1 focus:outline-none focus:border-indigo-500"
                                        required>
                                </div>
                                <!-- End Tags Section -->
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="bg-indigo-500 text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

            </div>
        </div>
    </div>
</body>

</html>
