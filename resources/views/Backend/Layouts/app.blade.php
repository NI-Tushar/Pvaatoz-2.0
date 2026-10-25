<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | @yield('title', 'This is Default Title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('Backend') }}/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    [x-cloak] { display: none !important; }
  </style>
  @php
    $appConfiger = App\Models\Configer::latest()->first();
    $adminFavicon = $appConfiger?->logo_two 
        ? (str_starts_with($appConfiger->logo_two, 'http') || str_starts_with($appConfiger->logo_two, 'storage/') ? asset($appConfiger->logo_two) : asset('storage/' . $appConfiger->logo_two))
        : asset('small-logo.png');
  @endphp
  <link rel="icon" type="image/x-icon" href="{{ $adminFavicon }}">
  <link rel="shortcut icon" href="{{ $adminFavicon }}">
  @stack('css')
</head>
<body>
<!-- ./wrapper -->
    @yield('app-content')
<!-- ./wrapper end-->

<!-- DataTables  & Plugins -->

<script>
    // DOM Elements
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleBtn");
    const navItems = document.querySelectorAll(".nav-item");

    // Toggle sidebar
    if (toggleBtn && sidebar) {
      toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
      });

      // Mobile menu toggle
      if (window.innerWidth <= 768) {
        toggleBtn.addEventListener("click", () => {
          sidebar.classList.toggle("active");
        });
      }
    }

    // Animate stats on load
    window.addEventListener("load", () => {
      const statValues = document.querySelectorAll(".stat-value");

      statValues.forEach((stat) => {
        const finalValue = stat.textContent;
        const isNumber = !finalValue.includes("$") && !finalValue.includes("%");

        if (isNumber) {
          let current = 0;
          const target = parseInt(finalValue.replace(/,/g, ""));
          const increment = target / 50;

          const counter = setInterval(() => {
            current += increment;
            if (current >= target) {
              stat.textContent = finalValue;
              clearInterval(counter);
            } else {
              stat.textContent = Math.floor(current).toLocaleString();
            }
          }, 20);
        }
      });
    });

    // Animate progress bars
    const progressFills = document.querySelectorAll(".progress-fill");
    progressFills.forEach((fill) => {
      const width = fill.style.width;
      fill.style.width = "0%";
      setTimeout(() => {
        fill.style.width = width;
      }, 500);
    });

    // Notification button animation
    const notificationBtn = document.querySelector(".notification-btn");
    if (notificationBtn) {
      notificationBtn.addEventListener("click", () => {
        const badge = notificationBtn.querySelector(".badge");
        if (badge) {
          badge.style.animation = "ping 0.5s ease";
          setTimeout(() => {
            badge.style.animation = "";
          }, 500);
        }
      });
    }

    // Add ping animation
    const style = document.createElement("style");
    style.textContent = `
      @keyframes ping {
        0%, 100% {
          transform: scale(1);
          opacity: 1;
        }
        50% {
          transform: scale(1.5);
          opacity: 0.5;
        }
      }
    `;
    document.head.appendChild(style);

    // Dark mode toggle (placeholder)
    const darkModeBtn = document.querySelector(
      ".top-bar-actions .icon-btn:nth-child(3)"
    );
    if (darkModeBtn) {
      darkModeBtn.addEventListener("click", () => {
        console.log("Dark mode toggle clicked (feature to be implemented)");
      });
    }

    // Handle window resize
    let resizeTimer;
    window.addEventListener("resize", () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        if (window.innerWidth > 768) {
          sidebar.classList.remove("active");
        }
      }, 250);
    });

    // Smooth scroll for activity items
    const activityItems = document.querySelectorAll(".activity-item");
    activityItems.forEach((item, index) => {
      item.style.opacity = "0";
      item.style.transform = "translateY(20px)";

      setTimeout(() => {
        item.style.transition = "all 0.5s ease";
        item.style.opacity = "1";
        item.style.transform = "translateY(0)";
      }, index * 100);
    });
</script>
@stack('script')
@stack('scripts')
@stack('js')
</body>
</html>
