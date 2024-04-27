@extends('layouts.header')
@section('content')

    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/starability-all.css') }}" />
    </head>
    <fieldset class="starability-basic" onchange="logRating()">
        <legend>First rating:</legend>
        <input type="radio" id="no-rate" class="input-no-rate" name="rating" value="0" checked
            aria-label="No rating." />
        <input type="radio" id="first-rate1" name="rating" value="1" />
        <label for="first-rate1" title="Terrible">1 star</label>
        <input type="radio" id="first-rate2" name="rating" value="2" />
        <label for="first-rate2" title="Not good">2 stars</label>
        <input type="radio" id="first-rate3" name="rating" value="3" />
        <label for="first-rate3" title="Average">3 stars</label>
        <input type="radio" id="first-rate4" name="rating" value="4" />
        <label for="first-rate4" title="Very good">4 stars</label>
        <input type="radio" id="first-rate5" name="rating" value="5" />
        <label for="first-rate5" title="Amazing">5 stars</label>
    </fieldset>

    <script>
        function logRating() {
            // Get the selected radio button value
            var selectedValue = document.querySelector('input[name="rating"]:checked').value;

            // Log the value to the console
            console.log("Selected Rating: " + selectedValue);
        }
    </script>
@endsection
