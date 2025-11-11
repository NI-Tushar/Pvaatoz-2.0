@php
  $contact = App\Models\Contact::get();
  $slider = App\Models\Slider::get();

  $configer = App\Models\Configer::latest()->first();
@endphp
@extends('Backend.Layouts.master')
@section('title', 'Dashboard')
@section('master-content')
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $contact->count() }}</h3>

          <p>Message Request</p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-envelope-open-text mr-1" aria-hidden="true"></i>
        </div>
        <a href="{{ route('admin.contactContent') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>0<sup style="font-size: 20px"></sup></h3>

          <p>Testimonials</p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-handshake mr-1"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>0</h3>

          <p>Services</p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-briefcase mr-1" aria-hidden="true"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>0</h3>

          <p>Portfolios</p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-address-card mr-1" aria-hidden="true"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>0</h3>

          <p>All Blogs</p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-blog mr-1" aria-hidden="true"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>0<sup style="font-size: 20px"></sup></h3>

          <p>All Brands</p>
        </div>
        <div class="icon">
          <i class="fa-brands fa-artstation mr-1"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>0</h3>

          <p>Teams</p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-user-group mr-1" aria-hidden="true"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $slider->count() }}</h3>

          <p>All Slider</p>
        </div>
        <div class="icon">
          <i class="fa-brands fa-slideshare mr-1" aria-hidden="true"></i>
        </div>
        <a href="{{ route('admin.slider.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Contact Request
            </div>
            <div class="card-body">
                <canvas id="contactChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Testimonials
            </div>
            <div class="card-body">
                <canvas id="testimonialChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Contact Chart
    const contactCtx = document.getElementById('contactChart');
    const contactData = @json($contactData);

    new Chart(contactCtx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Contact Request',
                data: contactData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>
@endpush
