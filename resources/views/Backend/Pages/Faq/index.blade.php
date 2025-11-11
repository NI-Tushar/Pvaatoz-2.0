@extends("Backend.Layouts.master")
@push('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Educational Info')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Manage Frequently Ask Question</h5>
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


        <th>FAQ</th>
        @foreach ($faqInfos as $faq)
            <form action="{{route('admin.faq.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $faq->id }}">
            <p>Question #{{ $loop->index + 1 }}</p>
                <textarea name="question" class="form-control auto-grow" oninput="autoResize(this)">{{ $faq->question }}</textarea>
            <p>Answer</p>
                <textarea name="answer" class="form-control auto-grow" oninput="autoResize(this)">{{ $faq->answer }}</textarea>
                <div class="mt-2" style="display:flex; gap:4px;">
                    <p style="margin-top:auto;margin-bottom:auto;">Action</p>
                    <a href="{{ route('admin.faq.delete', $faq->id) }}">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </a>
                    <button type="submit" class="btn btn-success p-0 pl-3 pr-3" style="font-size: 14px;">Update</button>
                </div>
            </form>
        @endforeach
        
    <h5 class="fw-bolder mt-5">Add New F.A.Q</h5>
    <form action="{{route('admin.faq.index')}}" method="POST">
        @csrf
            <!-- ___________ blank input field start -->
            <p>Question</p>
            <textarea name="question" rows="4" class="form-control auto-grow"></textarea>
            <p>Answer</p>
            <textarea name="answer" rows="10" class="form-control auto-grow"></textarea>
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
@endsection
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


</script>
@endpush
