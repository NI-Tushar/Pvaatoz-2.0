<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancel</title>
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
            max-width: 75px;
        }

        .success-message__title {
        color:rgb(224, 85, 50);
        transform: translateY(25px);
        opacity: 0;
        transition: all 200ms ease;
        }
        .active .success-message__title {
        transform: translateY(0);
        opacity: 1;
        }

        .error-message__icon {
            color: #B8BABB;
            transform: translateY(25px);
            opacity: 0;
            transition: all 200ms ease;
            transition-delay: 50ms;
            width: 60px;
            height: auto;
        }
        .active .error-message__icon {
            transform: translateY(0);
            opacity: 1;
        }
        .button,
        .payment_text_msg{
            transform: translateY(25px);
            opacity: 0;
            transition: all 200ms ease;
        }
        .active .button,
        .active .payment_text_msg{
            transform: translateY(0);
            opacity: 1;
        }
        
        .icon-cross circle {
        fill:rgb(224, 85, 50);
        transform-origin: 50% 50%;
        transform: scale(0);
        transition: transform 200ms cubic-bezier(0.22, 0.96, 0.38, 0.98);
        }
        .icon-cross path {
        transition: stroke-dashoffset 350ms ease;
        transition-delay: 100ms;
        }
        .active .icon-cross circle {
        transform: scale(1);
        }
        .error-message__text a button{
            border: 1px solid rgb(224, 85, 50);
            width: 100px;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 700;
        }
        .error-message__text a button:hover{
            background-color: rgb(224, 85, 50);
            color: white;
        }
        .error-message__text{
            width: 100%;
        }
        .error-message__text p{
            text-align: center;
        }
</style>
<body>
    <div class="success-message">
        <svg viewBox="0 0 76 76" class="error-message__icon icon-cross">
            <circle cx="38" cy="38" r="36" />
            <path 
                fill="none" 
                stroke="#FFFFFF" 
                stroke-width="5" 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                stroke-miterlimit="10" 
                d="M25 25 L51 51 M51 25 L25 51"
            />
        </svg>        
        <h1 class="success-message__title">Payment Cancel</h1>
        <div class="error-message__text">
            <p class="payment_text_msg">Your Payment has been Canceled</p>
            <a class="button" href="{{route('order.index')}}"><button>OK</button></a>
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
