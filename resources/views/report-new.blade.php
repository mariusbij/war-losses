<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Report New Equipment</title>
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
            <a href="{{ route('stats') }}"
               class="block mt-4 lg:inline-block lg:mt-0 text-sky-100 hover:text-white mr-4">
                Stats
            </a>
            <a href="{{ route('reportNewPage') }}"
               class="block mt-4 lg:inline-block lg:mt-0 text-sky-100 hover:text-white">
                Report New
            </a>
        </div>
    </div>
</nav>
<div class="py-4 px-8">
    @if (session('success'))
        <div class="alert bg-green-50 rounded py-2">
            <text class="px-2">{{ session('success') }}</text>
        </div>
    @endif
    @if (session('failure'))
        <div class="alert bg-red-50 rounded py-2">
            <text class="px-2">{{ session('failure') }}</text>
        </div>
    @endif
    @if (session('duplicateIds'))
        <div class="alert bg-yellow-50 rounded text-l py-2">
            <p class="px-2">It appears that the equipment you are trying to report may already be in our list.<br>
                Please review the following equipment report(s) and make sure that it is not a duplicate:<br>
                @foreach(session('duplicateIds') as $id)
                    <a class="text-red-500 text-l" target="_blank"
                       href="{{ route('singleEquipmentPage', [$id]) }}">Reported Equipment</a><br>
                @endforeach
            </p>
        </div>
        <input type="hidden" id="duplicates_shown" name="duplicates_shown" value="true">
    @endif
    <form class="" action="{{ route('storeNew') }}" method="POST">
        <div>
            <label class="font-semibold" for="name">Name*:</label><br>
            <input class="rounded bg-gray-100 w-48 px-1" type="search" id="name" name="name"
                   value="{{ old('name') }}" placeholder="Enter Name.."><br>
            @error('name')
            <div class="alert alert-danger text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="py-2">
            <label class="font-semibold" for="side_country">Side Country*:</label><br>
            <select class="rounded bg-gray-100 px-1 w-48" id="side_country" name="side_country">
                <option @if( old('side_country') == null) selected @endif value="">Select
                </option>
                <option @if( old('side_country') == 10) selected @endif value="10">Ukraine
                </option>
                <option @if( old('side_country') == 20) selected @endif value="20">Russia
                </option>
            </select>
            @error('side_country')
            <div class="alert alert-danger text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="py-2">
            <label class="font-semibold" for="category">Category*:</label><br>
            <select class="rounded bg-gray-100 px-1 overflow-x-scroll w-48" id="category" name="category_id">
                <option @if( old('category_id') == null) selected @endif value="">Select
                </option>
                @foreach($categories as $category)
                    <option @if( old('category_id') == $category->id) selected
                            @endif value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="alert alert-danger text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="py-2">
            <label class="font-semibold" for="date">Date*:</label><br>
            <input class="rounded bg-gray-100 w-48 px-1" type="date" id="date" name="date" value="{{ old('date') }}">
            @error('date')
            <div class="alert alert-danger text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="py-2">
            <label class="font-semibold" for="source_url">Source*:</label><br>
            <input class="rounded bg-gray-100 w-48 px-1" type="text" id="source_url" name="source_url"
                   value="{{ old('source_url') }}" placeholder="Enter Source Url.."><br>
            @error('source_url')
            <div class="alert alert-danger text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="py-2">
            <label class="font-semibold" for="geolocation">Geolocation:</label><br>
            <div class="py-2">
                <input class="rounded bg-gray-100 w-48 px-1" type="text" id="latitude" name="latitude"
                       value="{{ old('latitude') }}" placeholder="Enter Latitude.."><br>
            </div>
            @error('latitude')
            <div class="alert alert-danger text-red-500">{{ $message }}</div>
            @enderror
            <div class="py-2">
                <input class="rounded bg-gray-100 w-48 px-1" type="text" id="longitude" name="longitude"
                       value="{{ old('longitude') }}" placeholder="Enter Longitude.."><br>
            </div>
            @error('longitude')
            <div class="alert alert-danger text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="py-2">
            <label class="font-semibold" for="tags">Tags*:</label><br>
            <div id="tags">
                <div class="flex flex-row">
                    <input @if(!is_null(old('tags'))) @if(in_array('destroyed', old('tags'))) checked
                           @endif @endif type="checkbox" name="tags[]" value="destroyed" id="destroyed"/>
                    <label class="pl-2" for="destroyed">Destroyed</label>
                </div>
                <div class="flex flex-row">
                    <input @if(!is_null(old('tags'))) @if(in_array('damaged', old('tags'))) checked
                           @endif @endif type="checkbox" name="tags[]" value="damaged" id="damaged"/>
                    <label class="pl-2" for="damaged">Damaged</label>
                </div>
                <div class="flex flex-row">
                    <input @if(!is_null(old('tags'))) @if(in_array('abandoned', old('tags'))) checked
                           @endif @endif type="checkbox" name="tags[]" value="abandoned" id="abandoned"/>
                    <label class="pl-2" for="abandoned">Abandoned</label>
                </div>
                <div class="flex flex-row">
                    <input @if(!is_null(old('tags'))) @if(in_array('captured', old('tags'))) checked
                           @endif @endif type="checkbox" name="tags[]" value="captured" id="captured"/>
                    <label class="pl-2" for="captured">Captured</label>
                </div>
            </div>
            @error('tags')
            <div class="alert alert-danger text-red-500">{{ $message }}</div>
            @enderror
        </div>
        @csrf
        @if (session('duplicateIds'))
            <input type="hidden" id="duplicates_shown" name="duplicates_shown" value="true">
        @endif
        <div class="py-2">
            <input class="bg-sky-900 px-2 mr-6 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer"
                   type="submit" value="Report">
        </div>
    </form>
</div>
</body>

