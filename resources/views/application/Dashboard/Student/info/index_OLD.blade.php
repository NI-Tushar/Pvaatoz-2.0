@extends('Frontend.Dashboard.Layouts.master')
@section('title', 'Information')
@section('breadcrumb', 'Information')
@section('previous-menu', 'Documents')
@section('active-menu', 'Information')
@section('master-content')
    <div class="card p-3">
        <div class="d-flex justify-content-end w-full mb-3">
            <a href="{{ route('student.info.add') }}" class="btn btn-outline-primary">Add New</a>
        </div>
        <div class="info_table" style="overflow-x: auto; white-space: nowrap;">
                <table class="table table-bordered">
                    <thead>
                <tr>
                    <th>SL</th>
                    <th>Academic Status</th>
                    <th>HSC</th>
                    <th>SSC</th>
                    <th>O Lavel</th>
                    <th>A Lavel</th>
                    <th>Alim</th>
                    <th>Dakhil</th>
                    <th>IELTS</th>
                    <th>country</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php $sl = 1; @endphp
                    @foreach ($info_data as $data)
                        <tr>
                            <th scope="row">{{ $sl++ }}</th>
                            <td>{{ $data->academic_type }}</td>

                            <!-- _______ -->
                            <td>
                                <span>{{ $data->hsc_result }}</span>
                                <br>
                                <span class="d-flex justify-content-center align-content-center">
                                    @if ($data->hsc_certificate)
                                    <a target="_blank" href="{{ asset($data->hsc_certificate) }}"><i class="fa-regular fa-file-lines" style="font-size: 25px"></i></a>
                                    @endif
                                </span>
                            </td>
                            <!-- _______ -->


                            <!-- _______ -->
                            <td>
                                <span>{{ $data->ssc_result }}</span>
                                <span class="d-flex justify-content-center align-content-center">
                                    @if ($data->hsc_certificate)
                                    <a target="_blank" href="{{ asset($data->ssc_certificate) }}"><i class="fa-regular fa-file-lines" style="font-size: 25px"></i></a>
                                    @endif
                                </span>
                            </td>
                            <!-- _______ -->


                            <!-- _______ -->
                            <td>
                                <span>Result: {{ $data->a_lavel_result }}</span>
                                <span class="d-flex justify-content-center align-content-center">
                                    @if ($data->a_lavel_certificate)
                                    <a target="_blank" href="{{ asset($data->a_lavel_certificate) }}"><i class="fa-regular fa-file-lines" style="font-size: 25px"></i></a>
                                    @endif
                                </span>
                            </td>
                            <!-- _______ -->


                            <!-- _______ -->
                            <td>
                                <span>{{ $data->o_lavel_result }}</span>
                                <span class="d-flex justify-content-center align-content-center">
                                    @if ($data->o_lavel_certificate)
                                    <a target="_blank" href="{{ asset($data->o_lavel_certificate) }}"><i class="fa-regular fa-file-lines" style="font-size: 25px"></i></a>
                                    @endif
                                </span>
                            </td>
                            <!-- _______ -->


                            <!-- _______ -->
                            <td>
                                <span>{{ $data->alim_result }}</span>
                                <span class="d-flex justify-content-center align-content-center">
                                    @if ($data->alim_certificate)
                                    <a target="_blank" href="{{ asset($data->alim_certificate) }}"><i class="fa-regular fa-file-lines" style="font-size: 25px"></i></a>
                                    @endif
                                </span>
                            </td>
                            <!-- _______ -->


                            <!-- _______ -->
                            <td>
                                <span>{{ $data->dakhil_result }}</span>
                                <span class="d-flex justify-content-center align-content-center">
                                    @if ($data->dakhil_certificate)
                                    <a target="_blank" href="{{ asset($data->dakhil_certificate) }}"><i class="fa-regular fa-file-lines" style="font-size: 25px"></i></a>
                                    @endif
                                </span>
                            </td>
                            <!-- _______ -->


                            <!-- _______ -->
                            <td>
                                <span>{{ $data->ielts_score }}</span>
                                <span class="d-flex justify-content-center align-content-center">
                                    @if ($data->ielts_certificate)
                                    <a target="_blank" href="{{ asset($data->ielts_certificate) }}"><i class="fa-regular fa-file-lines" style="font-size: 25px"></i></a>
                                    @endif
                                </span>
                            </td>
                            <!-- _______ -->


                            <td>{{ $data->country }}</td>

                            <td>
                                <div class="d-flex gap-2">
                                <a href="" class="btn btn-sm btn-outline-secondary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="" class="delete show_confirm btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($info_data->isEmpty())
            <p style="color:crimson;font-weight:600; width:100%;text-align:center;">No Qualification Documents available.</p>
        @endif
    </div>
    @endsection
    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            event.preventDefault(); // Prevent form submission

            var form = $(this).closest("form"); // Get the closest form

            Swal.fire({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                customClass: {
                    confirmButton: 'text-white',
                    cancelButton: 'btn btn-secondary'
                },
                dangerMode: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit the form if the user confirms
                }
            });
        });


    </script>
@endpush
