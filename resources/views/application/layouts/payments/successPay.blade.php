<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
</head>
<style>
    .success-message {
    text-align: center;
    max-width: 300px;
    width: 100%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    }

    .success-message__icon {
    max-width: 50px;
    }

    .success-message__title {
    color: #3DC480;
    transform: translateY(25px);
    opacity: 0;
    transition: all 200ms ease;
    }
    .active .success-message__title {
    transform: translateY(0);
    opacity: 1;
    }

    .success-message__content p{
        color: #898989;
        transform: translateY(25px);
        opacity: 0;
        transition: all 200ms ease;
        transition-delay: 50ms;
    }
    .button,
    .payment_text_msg{
        transform: translateY(25px);
        opacity: 0;
        transition: all 200ms ease;
    }
    .active .button,
    .active .success-message__content p{
    transform: translateY(0);
    opacity: 1;
    }

    .icon-checkmark circle {
    fill: #3DC480;
    transform-origin: 50% 50%;
    transform: scale(0);
    transition: transform 200ms cubic-bezier(0.22, 0.96, 0.38, 0.98);
    }
    .icon-checkmark path {
    transition: stroke-dashoffset 350ms ease;
    transition-delay: 100ms;
    }
    .active .icon-checkmark circle {
    transform: scale(1);
    }
    .success-message__content a button{
        border: 1px solid #3DC480;
        width: 100px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 700;
    }
    .success-message__content a button:hover{
        background-color: #3DC480;
        color: white;
    }
    .cred{
        border: 1px solid rgb(5, 198, 14);
        padding-top: 10px;
        padding-bottom: 10px;
        background-color: aliceblue;
        border-radius: 5px;
        font-weight: 700;
    }
    .cred p{
        margin: 0;
        padding: 0;
        font-size: 13px;
        padding-left: 10px;
    }
    .cred .heading{
        margin-bottom: 10px;
        color: black;
    }
</style>
<body>
    <div class="success-message">
        <svg viewBox="0 0 76 76" class="success-message__icon icon-checkmark">
            <circle cx="38" cy="38" r="36"/>
            <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7"/>
        </svg>
        <h1 class="success-message__title">Payment Success</h1>
        <div class="success-message__content">
             @if ($user == 'new')
            <div class="success-message__content cred">
                <p class="payment_text_msg heading">Your Login Credentials</p>
                <p style="text-align: left;" class="payment_text_msg">UserID: {{$email}}</p>
                <p style="text-align: left;" class="payment_text_msg">Password: {{$default_pass}}</p>
            </div>
            <p class="payment_text_msg">To View Your Order, Please Login your Auto Generated UserID and Default Password</p>
            @else
            <p class="payment_text_msg">Your Payment has been Successfull. Please Go to Dashboard to View Your Order</p>
            @endif
            
            @if ($user == 'loggedin')
            <a class="button" href="{{route('my.trainings')}}"><button>View Course</button></a>
            @elseif ($user == 'registered')
            <a class="button" href="{{route('login')}}"><button>Sign-In</button></a>
            @elseif ($user == 'new')
            <a class="button" href="{{route('my.trainings')}}"><button>View Course</button></a>
            @endif
        </div>
    </div>
</body>


<script>
    function PathLoader(el) {
        this.el = el;
        this.strokeLength = el.getTotalLength();

        // set dash offset to 0
        this.el.style.strokeDasharray = this.el.style.strokeDashoffset = this.strokeLength;
    }

    PathLoader.prototype._draw = function (val) {
        this.el.style.strokeDashoffset = this.strokeLength * (1 - val);
    };

    PathLoader.prototype.setProgress = function (val, cb) {
        this._draw(val);
        if (cb && typeof cb === "function") cb();
    };

    PathLoader.prototype.setProgressFn = function (fn) {
        if (typeof fn === "function") fn(this);
    };

    var body = document.body,
        svg = document.querySelector("svg path");

    if (svg !== null) {
        svg = new PathLoader(svg);

        setTimeout(function () {
            document.body.classList.add("active");
            svg.setProgress(1);
        }, 200);
    }

    // document.addEventListener("click", function () {
    //     if (document.body.classList.contains("active")) {
    //         document.body.classList.remove("active");
    //         svg.setProgress(0);
    //         return;
    //     }
    //     document.body.classList.add("active");
    //     svg.setProgress(1);
    // });

</script>
</html>