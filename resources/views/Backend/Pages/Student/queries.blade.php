@extends("Backend.Layouts.master")
@push('css')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
@endpush
@section('title', 'Educational Info')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Student Queries</h5>
            <!-- @canAny(['isAdmin', 'isEditor'])
             <a href="{{ route('admin.trianingInfo.create') }}" class="btn btn-md btn-outline-primary"><i class="mr-1 fa-solid fa-plus"></i> Add New</a>
            @endcanAny -->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered">
              <thead>
                @if (Session::has('success_message'))
                        <p style="color:aliceblue;font-weight:700;background-color:green; padding:5px; text-align:center;border-radius:3px;">{{ Session::get('success_message') }}</p>
                @endif
                @if (Session::has('error_message'))
                        <p style="color:aliceblue;font-weight:700;background-color:red; padding:5px; text-align:center;border-radius:3px;">{{ Session::get('success_message') }}</p>
                @endif
                <tr>
                  <th style="width: 20px">Sl</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Last Education</th>
                  <th>Result</th>
                  <th>Ielts</th>
                  <th>Preferred Subject</th>
                  <th>Preferred Country</th>
                  <th>Budget</th>
                  <th>Note/Message</th>
                  <th>Query Date</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($student_query as $data)
                <tr>
                    <td>@if(\Carbon\Carbon::parse($data->created_at)->greaterThan(\Carbon\Carbon::now()->subMinutes(5)))
                        <div>
                            <span class="bg-success"
                            style="font-size:12px;font-weight:600;padding:3px 5px;border-radius:4px;"
                            >New</span>
                        </div>
                        @endif
                        {{$loop-> index + 1 }}
                    </td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->phone}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->last_edu_title}}</td>
                    <td>{{$data->last_edu_result}}</td>
                    <td>{{$data->ielts_score}}</td>
                    <td>{{$data->interest_for}}</td>
                    <td>{{$data->preferred_country}}</td>
                    <td>{{$data->budget}}</td>
                    <td>{{$data->note}}</td>
                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-F Y') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
</div>

@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
@endpush
