
@push('css')
    <link rel="stylesheet" href="{{ asset('Frontend') }}/assets/css/country_info.css">
@endpush

<div class="country_info_section" style="background-image: url(home_bg.png)">
    <div class="center_country_info">
        <div class="heading">
            <h1>{{ __('message.country_headline') }}</h1>
            <p>{{ __('message.country_desc') }}</p>
        </div>
            <div class="cards">
                <!--  -->
                @if ($country_info->isNotEmpty())
                    @foreach ($country_info as $data)
                    <div class="card">
                        <a href="{{ route('eduInfo.detail', ['id' => $data->id]) }}">
                            <div class="card-header">
                                <img src="{{ asset($data->card_banner ? $data->card_banner : 'img-preview.png') }}" alt="Travel Image">
                            </div>
                            <div class="card-body">
                                <h4 title="{{ $data->title}}"><span class="name me-1">{{$data->country}}:</span>{{ $data->title ? Str::limit($data->title, 50) : 'Not Provided' }}</h4>
                                <p class="p-0 m-0">{{ $data->description ? Str::limit($data->description, 180) : 'Not Provided' }}</p>
                                <div class="button_sec">
                                    <p>Studey in</p>
                                    <button><span class="me-2">Studey in</span>{{$data->country}} <i class="fa-solid fa-plane"></i></button>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @endif
                <!--  -->
        </div>
    </div>
</div>