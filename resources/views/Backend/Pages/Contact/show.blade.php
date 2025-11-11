@extends("Backend.Layouts.master")
@section('title', 'Contact/Show')
@section('master-content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder">Request By - {{ $contact->name }}</h5>
            <a href="{{ route('admin.contactContent') }}" class="btn btn-md btn-outline-success"><i class="fa-solid fa-reply"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 com-sm-12">
                <div class="m-2 card">
                    <div class="card-header">
                        <h6>User Informations</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="title" class="form-label">Name</label>
                                <input type="text" name="name" type="text" class="form-control char-count" value="{{ $contact->name }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="title" class="form-label">Email</label>
                                <input type="text" name="designation" type="text" class="form-control char-count" value="{{ $contact->email }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="title" class="form-label">Phone</label>
                                <input type="text" name="designation" type="text" class="form-control char-count" value="{{ $contact->phone }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="title" class="form-label">City</label>
                                <input type="text" name="designation" type="text" class="form-control char-count" value="{{ $contact->city }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="title" class="form-label">Subject</label>
                                <input type="text" name="designation" type="text" class="form-control char-count" value="{{ $contact->subject }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 com-sm-12">
                <div class="m-2 card">
                    <div class="card-header">
                        <h6>Message</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <textarea name="description" class="form-control char-count" rows="17" disabled>{{ strip_tags($contact->message) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

