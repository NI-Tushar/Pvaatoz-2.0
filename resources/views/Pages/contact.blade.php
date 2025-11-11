@extends('Frontend.app')
@section('title', 'Contact Us')
@section('app-content')

<link rel="stylesheet" href="{{ url('Frontend/assets/css/contact_us.css') }}">
<section class="contact_section">

    <div class="center_contact">
        <div class="page_heading">
            <h3>{{ __('message.page_heading') }}</h3>
        </div>
        <div class="contact_option">
            <div class="option_part">
                <a href="tel:+1234567890">
                    <i class="fa-solid fa-phone"></i>
                    <p>{{ __('message.call_us') }}</p>
                </a>
            </div>
            <div class="option_part">
                <a href="tel:+1234567890">
                    <i class="fa-brands fa-whatsapp"></i>
                    <p>{{ __('message.message_us') }}</p>
                </a>
            </div>
            <div class="option_part">
                <a href="mailto:support@example.com">
                    <i class="fa-solid fa-envelope"></i>
                    <p>{{ __('message.email_us') }}</p>
                </a>
            </div>
        </div>
        <div class="div_part">
            <div class="poster_part">
                <div class="img_text">
                    <img src="{{ asset('Frontend') }}/assets/img/contact/contact-04.jpg" alt="">
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. A saepe, culpa, quam delectus aperiam
                        earum neque natus, eligendi laboriosam officia dignissimos cumque praesentium aliquam eveniet
                        impedit maiores sed mollitia error.</p>
                </div>
            </div>
            <form class="my-form">
                <div class="container">
                    <h1>{{ __('message.send_email') }}</h1>
                    <ul>

                        <li>
                            <div class="grid grid-2">
                                <select>
                                    <option selected disabled>{{ __('message.form_select') }}</option>
                                    <option>{{ __('message.form_option1') }}</option>
                                    <option>{{ __('message.form_option2') }}</option>
                                    <option>Other</option>
                                </select>
                                <input type="text" placeholder="{{ __('message.form_name') }}" required>
                            </div>
                        </li>
                        <li>
                            <div class="grid grid-2">
                                <input type="tel" placeholder="{{ __('message.form_phone') }}">
                                <input type="email" placeholder="{{ __('message.form_email') }}" required>
                            </div>
                        </li>
                        <li>
                            <textarea placeholder="{{ __('message.form_message') }}"></textarea>
                        </li>
                        <li>
                            <div class="grid grid-3">
                                <button class="btn-grid" type="submit">
                                    <span class="back">
                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/email-icon.svg"
                                            alt="">
                                    </span>
                                    <span class="front">{{ __('message.send_btn') }}</span>
                                </button>
                            </div>
                        </li>
                    </ul>
            </form>
        </div>

    </div>
    <div class="map_section">
        <h3>{{ __('message.find_map') }}</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3046.5692448137693!2d90.41059887439367!3d23.812208586402495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7007a8a065b%3A0xc736bf6b1228538a!2sFleek%20Bangladesh!5e1!3m2!1sen!2sbd!4v1745060034206!5m2!1sen!2sbd"
            height="450" width="100%" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

</section>
@endsection





<script>
    const checkbox = document.querySelector('.my-form input[type="checkbox"]');
    const label = document.querySelector(".my-form label");
    const btns = document.querySelectorAll(".my-form button");

    checkbox.addEvenListener("change", function () {
        const checked = this.checked;
        for (const btn of btns) {
            checked ? (btn.disabled = false) : (btn.disabled = true);
        }
    });

</script>