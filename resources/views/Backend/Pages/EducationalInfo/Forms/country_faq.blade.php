
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h6>Educational Information for <span style="font-weight:600;">{{$existInfo->country}}</span></h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">


        <th>F.A.Q</th>
        @foreach ($country_faq as $faq)
            <form action="{{route('admin.countryFaq.update')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $faq->id }}">
            <p>Question #{{ $loop->index + 1 }}</p>
                <textarea name="question" class="form-control auto-grow" oninput="autoResize(this)">{{ $faq->question }}</textarea>
            <p>Answer</p>
                <textarea name="answer" class="form-control auto-grow" oninput="autoResize(this)">{{ $faq->answer }}</textarea>
                <div class="mt-2" style="display:flex; gap:4px;">
                    <p style="margin-top:auto;margin-bottom:auto;">Action</p>
                    <a href="{{ route('admin.countryFaq.delete', $faq->id) }}">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </a>
                    <button type="submit" class="btn btn-success p-0 pl-3 pr-3" style="font-size: 14px;">Update</button>
                </div>
            </form>
        @endforeach
        
    <h5 class="fw-bolder mt-5">Add New F.A.Q</h5>
    <form action="{{route('admin.countryFaq.create')}}" method="POST">
        @csrf
            <!-- ___________ blank input field start -->
            <p>Question</p>
            <input type="hidden" name="info_id" value="{{ $existInfo->id }}">
            <textarea name="question" rows="4" class="form-control auto-grow"></textarea>
            <p>Answer</p>
            <textarea name="answer" rows="10" class="form-control auto-grow"></textarea>
            <!-- ___________ blank input field start -->
        <button type="submit" class="btn btn-success mt-5">Save</button>
    </form>

          </div>
    </div>
</div>

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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>



