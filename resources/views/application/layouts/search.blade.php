<link rel="stylesheet" href="{{ asset('Frontend') }}/assets/css/search.css">

<div class="search_box">
    <form action="{{ route('search.keyword') }}" method="GET">
        <div class="border">
            <div class="search_field">
                <input type="search" name="keyword" id="input_field" placeholder="Search with your preferred Subject">
                <button type="submit" class="icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
        <div class="autocomplete-suggestions" id="countrySuggestions"></div>
    </form>
</div>


@push('script')
<script src="{{ asset('Frontend') }}/./assets/js/country.js"></script>
@endpush
@stack('script')