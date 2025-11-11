<div>
    <!-- Lets Talk -->
    <section class="talk">
        <div class="container">
            <div class="talk-content">
                <div class="talk-header">
                    <h3 class="title">Let Us Know Each Other </h3>
                    <p class="sub-title">Leave your Name, email, and number so we can have a friendly chat sometime!</p>
                </div>
                <div class="talk-body">
                    <form action="{{ route('quickContactStore') }}" id="quickContact" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Full name" id="name">
                            <span class="error" id="name-error"></span>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="E-mail" id="email">
                            <span class="error" id="email-error"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Contact number" id="phone">
                            <span class="error" id="phone-error"></span>
                        </div>
                        <button class="btn" type="submit">Let's Talk</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Lets Talk end -->
</div>



@push('script')
    <!-- jQuery -->
    <script src="{{ asset("backend/plugins/jquery/jquery.min.js") }}"></script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#quickContact').submit(function(event) {
                event.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();

                if (validateForm(name, email, phone)) {
                    quickContactStore(name, email, phone);
                }
            });

            // Function to validate form fields
            function validateForm(name, email, phone) {
                let isValid = true;
                // Regular expression for email validation
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                // Reset previous error messages
                $('.error').text('');

                // Name validation
                if (name.trim() === '') {
                    $('#name-error').text('Please enter your name');
                    isValid = false;
                }

                // Email validation
                if (email.trim() === '') {
                    $('#email-error').text('Please enter your email');
                    isValid = false;
                } else if (!emailRegex.test(email)) {
                    $('#email-error').text('Please enter a valid email address');
                    isValid = false;
                }

                // Phone validation (you can add more specific validations)
                if (phone.trim() === '') {
                    $('#phone-error').text('Please enter your phone number');
                    isValid = false;
                }

                return isValid;
            }

            function quickContactStore(name, email, phone) {
                $.ajax({
                    url: '{{ route("quickContactStore") }}', // Update with correct route
                    type: 'POST',
                    data: { 
                        _token: '{{ csrf_token() }}',
                        name: name,
                        email: email, 
                        phone: phone,
                    },
                    success: function(data) {
                        console.log("Response Data:", data);
                        // Clear input fields after successful submission
                        $('#name').val('');
                        $('#email').val('');
                        $('#phone').val('');
                        
                        Swal.fire({
                            icon: data.icon,
                            title: data.title,
                            showConfirmButton: false,
                            timer: 1000
                        });

                        // console.log(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    }
                });
            }
        });
    </script>
@endpush

