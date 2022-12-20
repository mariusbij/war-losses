<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Equipment Losses in War</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"
    />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>
<body class="bg-gray-200">
<nav class="flex items-center justify-between px-4 py-3 bg-sky-900">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <span class="font-semibold text-xl tracking-tight">War Losses</span>
    </div>
    <div class="block lg:hidden">
        <button
            class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
            </svg>
        </button>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
            <a href="{{ route('home') }}"
               class="block mt-4 lg:inline-block lg:mt-0 text-sky-100 hover:text-white mr-4">
                List
            </a>
            <a href="{{ route('stats') }}" class="block mt-4 lg:inline-block lg:mt-0 text-sky-100 hover:text-white mr-4">
                Stats
            </a>
            <a href="{{ route('reportNewPage') }}"
               class="block mt-4 lg:inline-block lg:mt-0 text-sky-100 hover:text-white">
                Report New
            </a>
        </div>
    </div>
</nav>
<div class="">
    <div class="flex flex-row bg-gray-200 py-4 px-2">

        <div class="shadow p-4 rounded-lg bg-white w-48 h-min">
            <div class="">
                <form class="" action="" method="GET">
                    <div class="px-2">
                        <label class="font-semibold" for="name">Name:</label><br>
                        <input class="rounded bg-gray-100 w-32 px-1" type="search" id="name" name="name"
                               value="{{ request()->name }}" placeholder="Search by name..">
                    </div>
                    <div class="py-2 px-2">
                        <label class="font-semibold" for="side_country">Side Country:</label><br>
                        <select class="rounded bg-gray-100 w-32 px-1" id="side_country" name="side_country">
                            <option @if (request()->side_country == '')
                                        {{ 'selected' }}
                                    @endif value="">All
                            </option>
                            <option @if (request()->side_country == 10)
                                        {{ 'selected' }}
                                    @endif value="10">Ukraine
                            </option>
                            <option @if (request()->side_country == 20)
                                        {{ 'selected' }}
                                    @endif value="20">Russia
                            </option>
                        </select>
                    </div>
                    <div class="py-2 px-2">
                        <label class="font-semibold" for="category">Category:</label><br>
                        <select class="rounded bg-gray-100 w-32 px-1" id="category" name="category_id">
                            <option @if (request()->category_id == '')
                                        {{ 'selected' }}
                                    @endif value="">All
                            </option>
                            @foreach($categories as $category)
                                <option @if (request()->category_id == $category->id)
                                            {{ 'selected' }}
                                        @endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="py-2 px-2">
                        <label class="font-semibold" for="date_from">Date From:</label><br>
                        <input @if (request()->date_from !== '') value="{{ request()->date_from }}"
                               @endif class="rounded bg-gray-100 w-32 px-1" type="date" id="date_from" name="date_from">
                    </div>
                    <div class="py-2 px-2">
                        <label class="font-semibold" for="date_to">Date To:</label><br>
                        <input @if (request()->date_to !== '') value="{{ request()->date_to }}"
                               @endif class="rounded bg-gray-100 w-32 px-1" type="date" id="date_to" name="date_to">
                    </div>

                    <div class="py-2 px-2">
                        <label class="font-semibold" for="tags">Tags:</label><br>
                        <div id="tags">
                            <div class="flex flex-row">
                                <input @if(!is_null(request()->tags))@if (in_array('destroyed', request()->tags )) checked @endif @endif type="checkbox" name="tags[]" value="destroyed" id="destroyed"/>
                                <label class="pl-2" for="destroyed">Destroyed</label>
                            </div>
                            <div class="flex flex-row">
                                <input @if(!is_null(request()->tags))@if (in_array('damaged', request()->tags )) checked @endif @endif type="checkbox" name="tags[]" value="damaged" id="damaged"/>
                                <label class="pl-2" for="damaged">Damaged</label>
                            </div>
                            <div class="flex flex-row">
                                <input @if(!is_null(request()->tags))@if (in_array('abandoned', request()->tags )) checked @endif @endif type="checkbox" name="tags[]" value="abandoned" id="abandoned"/>
                                <label class="pl-2" for="abandoned">Abandoned</label>
                            </div>
                            <div class="flex flex-row">
                                <input @if(!is_null(request()->tags))@if (in_array('captured', request()->tags )) checked @endif @endif type="checkbox" name="tags[]" value="captured" id="captured"/>
                                <label class="pl-2" for="captured">Captured</label>
                            </div>
                        </div>
                    </div>
                    <div class="px-2 py-2">
                        <input
                            class="bg-sky-900 px-2 py-1 rounded-md text-white font-semibold tracking-wide cursor-pointer"
                            type="submit" value="Apply">
                    </div>
                </form>
            </div>
        </div>

        <div class="flex-auto rounded-lg px-2">
            <div>
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded overflow-hidden">
                        <table class="min-w-full leading-normal border-1">
                            <thead
                                class="border-b-2 bg-gray-100 text-left text-m font-semibold text-gray-600 uppercase tracking-wider">
                            <tr>
                                <th class="px-5 py-3">
                                    Side
                                </th>
                                <th
                                    class="px-5 py-3">
                                    Name
                                </th>
                                <th
                                    class="px-5 py-3">
                                    Category
                                </th>
                                <th
                                    class="px-5 py-3">
                                    Tags
                                </th>
                                <th
                                    class="px-5 py-3">
                                    Date
                                </th>
                                <th
                                    class="px-5 py-3">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($equipment as $eq)
                                <tr class="border-b border-gray-200 bg-white text-m">
                                    <td class="px-5 py-5">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                @if($eq->side_country == 10)
                                                    <span class="fi fi-ua"></span>
                                                @endif

                                                @if($eq->side_country == 20)
                                                    <span class="fi fi-ru"></span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $eq->name }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $eq->category->name }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            @foreach($eq->tags as $tag)
                                                {{ ucfirst($tag->name) }}
                                            @endforeach
                                        </p>
                                    </td>
                                    <td class="px-5 py-5">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $eq->date }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5">
                                        <a class="text-slate-800 whitespace-no-wrap"
                                           href="{{ route('singleEquipmentPage', [$eq->id]) }}">View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="px-3 py-3 bg-white flex flex-col items-center">
                            <div class="">
                                {{ $equipment->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
