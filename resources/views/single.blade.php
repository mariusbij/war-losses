<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Equipment Losses in War</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"
    />
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

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
<div class="px-4 py-4">
    <div class="text-l">
        <div class="px-2 pt-4">Country:
            @if($equipment->side_country == 10)
                <span class="fi fi-ua"></span> <b>Ukraine</b>
            @endif
            @if($equipment->side_country == 20)
                <span class="fi fi-ru"></span> <b>Russia</b>
            @endif
        </div>
        <div class="px-2 py-1">Name: <b>{{ $equipment->name }}</b></div>
        <div class="px-2 py-1">Category: <b>{{ $equipment->category->name }}</b></div>
        <div class="px-2 pb-4">Tags: @foreach($equipment->tags as $tag)
                <b>{{ ucfirst($tag->name) }}</b>
            @endforeach
        </div>
    </div>
    @if(str_contains($equipment->source_url, 'twitter.com'))
        <blockquote class="twitter-tweet">
            <a href="{{ $equipment->source_url }}"></a>
        </blockquote>
    @else
        <div class="py-4">
        <img class="w-8/12 h-96 rounded" src="{{ $equipment->source_url }}">
        </div>
    @endif
    @if($equipment->latitude != null && $equipment->longitude != null)
    <div class="w-8/12 h-96 rounded" id="map"></div>
    @endif
    @if($equipment->latitude == null && $equipment->longitude == null)
        <div class="w-4/12 bg-white rounded">
           <div class="px-2 py-2 text-l">The geolocation of equipment is not determined yet. <br>
               Feel free to submit.
           </div>

            <form class="" action="{{ route('updateLocation') }}" method="POST">
            <div class="py-2">
                <div class="py-2 px-2">
                    <input class="rounded bg-gray-100 w-48 px-2" type="text" id="latitude" name="latitude"
                           value="{{ old('latitude') }}" placeholder="Enter Latitude.."><br>
                </div>
                @error('latitude')
                <div class="alert alert-danger text-red-500 px-2 py-1">{{ $message }}</div>
                @enderror
                <div class="py-2 px-2">
                    <input class="rounded bg-gray-100 w-48 px-1" type="text" id="longitude" name="longitude"
                           value="{{ old('longitude') }}" placeholder="Enter Longitude.."><br>
                </div>
                @error('longitude')
                <div class="alert alert-danger text-red-500 px-2 py-1">{{ $message }}</div>
                @enderror
                @csrf
                <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">
            </div>
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
                <div class="py-2 px-2">
                    <input class="bg-sky-900 px-2 mr-6 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer"
                           type="submit" value="Submit">
                </div>
            </form>

        </div>
    @endif
</div>
</body>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6RfHoQQYXjebp1XrM2fQw-VfRn3uicE4&callback=initMap&v=weekly"
    defer
></script>
<script>
    // Initialize and add the map
    function initMap() {
        const pos = { lat: {{ $equipment->latitude }}, lng: {{ $equipment->longitude }} };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: pos,
        });
        const marker = new google.maps.Marker({
            position: pos,
            map: map,
        });
    }
    window.initMap = initMap;
</script>
