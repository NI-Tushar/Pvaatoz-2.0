@extends('layouts.app')
@section('title', 'About Us')
@section('app-content')

    <!-- Main Content -->

    <!-- ABOUT SECTION START -->
<div class="bg-white py-10 space-y-20">

  <!-- Section 1 -->
  <section class="max-w-6xl mx-auto px-4">
    <div class="grid md:grid-cols-2 gap-10 items-center">
      
      <div>
        <span class="block text-3xl text-teal-500 font-semibold mb-2">
          ➸ About Us
        </span>
        <span class="block text-sm text-gray-500 mb-4">
          We Provide 100% Verified PVA Accounts that can fulfill your goal.
        </span>
        <p class="leading-8 text-gray-700">
          We Provide 100% Verified PVA Accounts that can fulfill your goal. PVAATOZ is a trusted name in the industry with years of experience determined to deliver high-quality and highly secured accounts.
        </p>

        <div class="mt-6 flex gap-4">
          <a href="#OurMission"
            class="px-5 py-2 border border-teal-500 text-teal-500 rounded hover:bg-teal-500 hover:text-white transition">
            Our Mission
          </a>
          <a href="#"
            class="px-5 py-2 bg-gray-900 text-white rounded hover:bg-transparent hover:text-gray-900 hover:border hover:border-gray-900 transition">
            Know More
          </a>
        </div>
      </div>

      <div class="flex justify-center md:justify-end">
        <img src="{{ asset('resource/images/about/about1.png') }}"
             class="w-full md:w-4/5 shadow-lg rounded"
             alt="About Us">
      </div>

    </div>
  </section>

  <!-- Section 2 -->
  <section class="max-w-6xl mx-auto px-4">
    <div class="grid md:grid-cols-2 gap-10 items-center">
      
      <div>
        <span class="block text-3xl text-teal-500 font-semibold mb-2">
          ➸ About Service
        </span>
        <span class="block text-sm text-gray-500 mb-4">
          We offer completely verified PVA accounts tailored to help you achieve your goals.
        </span>
        <p class="leading-8 text-gray-700">
          At PVAATOZ, we offer 100% verified PVA accounts to help you achieve your goals. With years of industry experience, we have established ourselves as a trusted name.
        </p>

        <div class="mt-6 flex gap-4">
          <a href="#"
            class="px-5 py-2 border border-teal-500 text-teal-500 rounded hover:bg-teal-500 hover:text-white transition">
            Our Mission
          </a>
          <a href="#"
            class="px-5 py-2 bg-gray-900 text-white rounded hover:bg-transparent hover:text-gray-900 hover:border hover:border-gray-900 transition">
            Know More
          </a>
        </div>
      </div>

      <div class="flex justify-center md:justify-end">
        <img src="{{ asset('resource/images/about/about2.png') }}"
             class="w-full md:w-4/5 shadow-lg rounded"
             alt="About Service">
      </div>

    </div>
  </section>

  <!-- Section 3 -->
  <section class="max-w-6xl mx-auto px-4">
    <div class="grid md:grid-cols-2 gap-10 items-center">
      
      <div>
        <span class="block text-3xl text-teal-500 font-semibold mb-2">
          ➸ About Sustainability
        </span>
        <span class="block text-sm text-gray-500 mb-4">
          We supply fully verified PVA accounts designed to meet your needs.
        </span>
        <p class="leading-8 text-gray-700">
          PVAATOZ provides 100% verified PVA accounts designed to help you reach your objectives. With years of experience, we are a trusted name in the industry.
        </p>

        <div class="mt-6 flex gap-4">
          <a href="#"
            class="px-5 py-2 border border-teal-500 text-teal-500 rounded hover:bg-teal-500 hover:text-white transition">
            Our Mission
          </a>
          <a href="#"
            class="px-5 py-2 bg-gray-900 text-white rounded hover:bg-transparent hover:text-gray-900 hover:border hover:border-gray-900 transition">
            Know More
          </a>
        </div>
      </div>

      <div class="flex justify-center md:justify-end">
        <img src="{{ asset('resource/images/about/about3.png') }}"
             class="w-full md:w-4/5 shadow-lg rounded"
             alt="Sustainability">
      </div>

    </div>
  </section>

  <!-- Section 4 -->
  <section class="max-w-6xl mx-auto px-4">
    <div class="grid md:grid-cols-2 gap-10 items-center">
      
      <div>
        <span class="block text-3xl text-teal-500 font-semibold mb-2">
          ➸ Our Vision
        </span>
        <span class="block text-sm text-gray-500 mb-4">
          We deliver 100% verified PVA accounts that meet your objectives.
        </span>
        <p class="leading-8 text-gray-700">
          At PVAATOZ, we supply fully verified PVA accounts to support your goals. Our level of service is unmatched in today’s market.
        </p>

        <div class="mt-6 flex gap-4">
          <a href="#"
            class="px-5 py-2 border border-teal-500 text-teal-500 rounded hover:bg-teal-500 hover:text-white transition">
            Our Mission
          </a>
          <a href="#"
            class="px-5 py-2 bg-gray-900 text-white rounded hover:bg-transparent hover:text-gray-900 hover:border hover:border-gray-900 transition">
            Know More
          </a>
        </div>
      </div>

      <div class="flex justify-center md:justify-end">
        <img src="{{ asset('resource/images/about/about4.png') }}"
             class="w-full md:w-4/5 shadow-lg rounded"
             alt="Vision">
      </div>

    </div>
  </section>

</div>
<!-- ABOUT SECTION END -->

    <!-- Main Content end -->
@endsection
    