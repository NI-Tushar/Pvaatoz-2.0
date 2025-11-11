@push('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Why Choose This County For <span style="font-weight:600;">{{$existInfo->country}}</span></h5>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('faild'))
            <div class="alert alert-success">
                {{ session('faild') }}
            </div>
        @endif

    </div>
    <div class="card-body">
        <div class="table-responsive">

        @foreach ($why_this_country as $country)
            <form action="{{route('admin.whyThisCountry.update')}}" method="POST">
            @csrf
            @if(isset($existInfo))
                <input type="hidden" name="info_id" value="{{ $existInfo->id }}">
            @endif
            <p>Why Choose This County (Bulet Point) #{{ $loop->index + 1 }}</p>
                <textarea name="point" class="form-control auto-grow" oninput="autoResize(this)">{{ $country->point }}</textarea>
            <p>Point Details</p>
                <textarea name="point_detail" class="form-control auto-grow" oninput="autoResize(this)">{{ $country->point_detail }}</textarea>
                <div class="mt-2" style="display:flex; gap:4px;">
                    <p style="margin-top:auto;margin-bottom:auto;">Action</p>
                    <a href="{{ route('admin.whyThisCountry.delete', $country->id) }}">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </a>
                    <button type="submit" class="btn btn-success p-0 pl-3 pr-3" style="font-size: 14px;">Update</button>
                </div>
            </form>
        @endforeach
        
    <h5 class="fw-bolder mt-5">Add New Point</h5>
    <form action="{{route('admin.whyThisCountry.create')}}" method="POST">
        @csrf
            @if(isset($existInfo))
                <input type="hidden" name="info_id" value="{{ $existInfo->id }}">
            @endif
            <!-- ___________ blank input field start -->
            <p>Why Choose This County (Bulet Point)</p>
            <textarea name="point" rows="4" class="form-control auto-grow"></textarea>
            <p>Point Details</p>
            <textarea name="point_detail" rows="10" class="form-control auto-grow"></textarea>
            <!-- ___________ blank input field start -->
        <button type="submit" class="btn btn-success mt-5">Save</button>
    </form>

<style>
    form p{
        font-weight:700;
        margin:0;
        padding:0;
        margin-top:15px
    }
    .auto-height-input {
        height: auto !important;
        padding: 4px 8px;
        line-height: 1.4;
    }
    </style>

    <script>
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.auto-grow').forEach(function (textarea) {
            autoResize(textarea);
        });
    });
</script>

          </div>
    </div>
</div>

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    var deleteUrl = "{{ url('trianingInfo-deleted') }}";

    $('.show_confirm').click(function(event) {
        var countryId = $(this).data('id');
        event.preventDefault();

        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = deleteUrl + '/' + countryId;
            }
        });
    });
</script>

@endpush
