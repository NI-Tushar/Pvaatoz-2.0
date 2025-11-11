@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Consultant')
@section('master-content')
<style>
    .qualifications{   
        padding:10px;
        padding-top:2rem;
        padding-bottom:2rem;
        border-radius:10px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
    }
    .qualifications .heading{
        display:flex;
        gap:10px;
        padding-bottom:10px;
    }
    .qualifications .heading h3{
        font-size:18px;
        font-weight:600;
    }
    .qualifications .heading .part{
        width: 100%;
    }
    .qualifications .heading .add{
        display:flex;
        justify-content:end;
    }
    .qualifications .heading .add button{
        padding-left:35px;
        padding-right:35px;
        padding-top:5px;
        padding-bottom:5px;
        border-radius:6px;
        border:1px solid var(--primary-color);
        background-color:var(--primary-color);
        color:aliceblue;
        font-weight:600;
    }
    .qualifications .heading .add button:hover{
        background:transparent;
        color:var(--primary-color);
    }
    .qualifications .table_div{
        overflow-x: auto;
        white-space: nowrap;
    }
    .action_div a{
        margin-right:10px;
    }
    .action_div .delete:hover i{
        color:red;
    }
    .action_div i{
        font-size:18px;
        color:var(--primary-color);
    }
    .action_div i:hover{
        color:var(--primary-color-hover);
    }
    
    @media screen and (max-width: 512px) {
        .qualifications .heading {
            display:block;     
            text-align:center;   
        }
        .qualifications .heading .add a,
        .qualifications .heading .add button{
            width: 100%;
        }
    }
    </style>
    <div class="qualifications">
        <div class="heading">
            <div class="part">
                <h3>Your Experiences:</h3>
            </div>
            <div class="part add">
                <a href="{{ route('consultant.experience.add') }}"><button>Add</button></a>
            </div>
        </div>
        <div class="table_div">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">S/L</th>
                    <th scope="col">Organization Name</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Responsibility</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Languages</th>
                    <th scope="col">Documents</th>
                    <th scope="col">Resume Documents</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @php $sl = 1; @endphp
                    @foreach ($experience_data as $data)
                        <tr>
                            <th scope="row">{{ $sl++ }}</th>
                            <td>{{ $data->organization }}</td>
                            <td>{{ $data->designation }}</td>
                            <td>{{ $data->responsibilities }}</td>
                            <td>{{ $data->start_date }}</td>
                            <td>{{ $data->end_date }}</td>
                            <td>{{ $data->duration }}</td>
                            <td>{{ $data->other_language }}</td>
                            <td>{{ $data->documents }}</td>
                            <td>{{ $data->cv_documents }}</td>
                            <td>
                                <div class="action_div">
                                <a href="{{ route('consultant.experience.edit', $data->id) }}" class="text-blue-500">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>    
                                <a href="{{ route('consultant.experience.detete', $data->id) }}" class="delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($experience_data->isEmpty())
                <p style="color:crimson;font-weight:600; width:100%;text-align:center;">No experience data available.</p>
            @endif
        </div>
    </div>
@endsection

@push('script')
<script>

        // Convert Affiliator
        $('#convertAffiliator').click(function(event) {
            var affiliatorId = $(this).data("id");

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to convert this data into an Affiliator?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, convert it!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/create-affiliator/' + affiliatorId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(res) {
                            // Remove the specific row from the table
                            $(`tr[data-id="${affiliatorId}"]`).remove();

                            Swal.fire({
                                title: 'Success!',
                                text: 'This data has been successfully converted to an Affiliator.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        },
                        error: function(xhr, status, error) {
                            // Display the backend error message in SweetAlert
                            var errorMessage = xhr.responseJSON.error || 'Something went wrong. Please try again.';
                            Swal.fire({
                                title: 'Error!',
                                text: errorMessage,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        });

</script>
@endpush
