@php
    $config = $configer ?? \App\Models\Configer::latest()->first();
    $brandName = $config?->name ?? 'AccueVault';
    $defaultMsg = 'Hello ' . $brandName . ', I would like to inquire about your PVA accounts & services.';
    $encodedMsg = rawurlencode($defaultMsg);

    // Build social links list - only those that are configured
    $socialList = [];

    // Telegram
    $tgRaw = !empty($config?->telegram) ? trim($config->telegram) : null;
    if ($tgRaw && $tgRaw !== '#') {
        if (str_starts_with($tgRaw, 'http://') || str_starts_with($tgRaw, 'https://')) {
            $tgUrl = $tgRaw;
        } else {
            $tgUsername = ltrim($tgRaw, '@');
            $tgUrl = 'https://t.me/' . $tgUsername;
        }

        $socialList[] = [
            'name' => 'Telegram',
            'url' => $tgUrl,
            'icon' => 'fa-brands fa-telegram text-xl',
            'bg' => 'bg-[#229ED9] hover:bg-[#1e8ec3]',
            'shadow' => 'shadow-[#229ED9]/35',
            'border' => 'border-[#229ED9]/30',
            'tooltip' => 'Message on Telegram',
            'target' => '_blank',
        ];
    }

    // Discord
    $dcRaw = !empty($config?->discord) ? trim($config->discord) : null;
    if ($dcRaw && $dcRaw !== '#') {
        if (str_starts_with($dcRaw, 'http://') || str_starts_with($dcRaw, 'https://')) {
            $dcUrl = $dcRaw;
        } else {
            $dcUrl = 'https://discord.gg/' . ltrim($dcRaw, '/');
        }

        $socialList[] = [
            'name' => 'Discord',
            'url' => $dcUrl,
            'icon' => 'fa-brands fa-discord text-lg',
            'bg' => 'bg-[#5865F2] hover:bg-[#4752C4]',
            'shadow' => 'shadow-[#5865F2]/35',
            'border' => 'border-[#5865F2]/30',
            'tooltip' => 'Join our Discord',
            'target' => '_blank',
        ];
    }

    // Email / Gmail (Redirects to Contact Page)
    $emailRaw = !empty($config?->email) ? trim($config->email) : null;
    if ($emailRaw && $emailRaw !== '#') {
        $socialList[] = [
            'name' => 'Email / Gmail',
            'url' => route('contact'),
            'icon' => 'fa-solid fa-envelope text-lg',
            'bg' => 'bg-[#EA4335] hover:bg-[#d93025]',
            'shadow' => 'shadow-[#EA4335]/35',
            'border' => 'border-[#EA4335]/30',
            'tooltip' => 'Contact Us (' . $emailRaw . ')',
            'target' => '_self',
        ];
    }

    // WhatsApp (Only if explicitly provided in admin panel)
    $waRaw = !empty($config?->whatsapp) ? trim($config->whatsapp) : null;
    if ($waRaw && $waRaw !== '#') {
        if (str_starts_with($waRaw, 'http://') || str_starts_with($waRaw, 'https://')) {
            $waUrl = $waRaw;
            if (!str_contains($waUrl, 'text=')) {
                $waUrl .= (str_contains($waUrl, '?') ? '&' : '?') . 'text=' . $encodedMsg;
            }
        } else {
            $digits = preg_replace('/[^0-9]/', '', $waRaw);
            $waUrl = !empty($digits) ? "https://wa.me/{$digits}?text={$encodedMsg}" : null;
        }

        if ($waUrl) {
            $socialList[] = [
                'name' => 'WhatsApp',
                'url' => $waUrl,
                'icon' => 'fa-brands fa-whatsapp text-xl',
                'bg' => 'bg-[#25D366] hover:bg-[#20ba59]',
                'shadow' => 'shadow-[#25D366]/35',
                'border' => 'border-[#25D366]/30',
                'tooltip' => 'Chat on WhatsApp',
                'target' => '_blank',
            ];
        }
    }

    // Facebook
    $fbRaw = !empty($config?->facebook) ? trim($config->facebook) : null;
    if ($fbRaw && $fbRaw !== '#') {
        $socialList[] = [
            'name' => 'Facebook',
            'url' => $fbRaw,
            'icon' => 'fa-brands fa-facebook-f text-lg',
            'bg' => 'bg-[#1877F2] hover:bg-[#166fe5]',
            'shadow' => 'shadow-[#1877F2]/35',
            'border' => 'border-[#1877F2]/30',
            'tooltip' => 'Follow on Facebook',
            'target' => '_blank',
        ];
    }

    // Twitter / X
    $twRaw = !empty($config?->twitter) ? trim($config->twitter) : null;
    if ($twRaw && $twRaw !== '#') {
        $socialList[] = [
            'name' => 'X (Twitter)',
            'url' => $twRaw,
            'icon' => 'fa-brands fa-x-twitter text-lg',
            'bg' => 'bg-slate-900 hover:bg-black',
            'shadow' => 'shadow-black/50',
            'border' => 'border-slate-700',
            'tooltip' => 'Follow on X',
            'target' => '_blank',
        ];
    }

    // Instagram
    $igRaw = !empty($config?->instagram) ? trim($config->instagram) : null;
    if ($igRaw && $igRaw !== '#') {
        $socialList[] = [
            'name' => 'Instagram',
            'url' => $igRaw,
            'icon' => 'fa-brands fa-instagram text-xl',
            'bg' => 'bg-gradient-to-tr from-[#f09433] via-[#dc2743] to-[#bc1888] hover:brightness-110',
            'shadow' => 'shadow-pink-500/35',
            'border' => 'border-pink-500/30',
            'tooltip' => 'Follow on Instagram',
            'target' => '_blank',
        ];
    }

    // YouTube
    $ytRaw = !empty($config?->youtube) ? trim($config->youtube) : null;
    if ($ytRaw && $ytRaw !== '#') {
        $socialList[] = [
            'name' => 'YouTube',
            'url' => $ytRaw,
            'icon' => 'fa-brands fa-youtube text-lg',
            'bg' => 'bg-[#FF0000] hover:bg-[#e60000]',
            'shadow' => 'shadow-red-500/35',
            'border' => 'border-red-500/30',
            'tooltip' => 'Subscribe on YouTube',
            'target' => '_blank',
        ];
    }
@endphp

<!-- ================= STICKY RIGHT-SIDE SOCIAL ICONS ================= -->
@if(!empty($socialList))
<div id="sticky-social-panel" 
     class="fixed right-2.5 sm:right-4 top-1/2 -translate-y-1/2 z-40 flex flex-col gap-2.5 items-end select-none pointer-events-auto transition-opacity duration-300"
     aria-label="Social Media Channels">
    @foreach($socialList as $social)
        <div class="relative group flex items-center justify-end">
            <!-- Tooltip sliding out to the left -->
            <span class="absolute right-full mr-2.5 px-2.5 py-1 rounded-md text-xs font-semibold whitespace-nowrap bg-slate-950/90 text-white backdrop-blur border border-slate-700/80 shadow-xl opacity-0 translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 pointer-events-none transition-all duration-200 hidden sm:inline-block">
                {{ $social['tooltip'] }}
            </span>

            <!-- Social Button -->
            <a href="{{ $social['url'] }}" 
               target="{{ $social['target'] ?? '_blank' }}" 
               @if(($social['target'] ?? '_blank') === '_blank') rel="noopener noreferrer" @endif
               title="{{ $social['tooltip'] }}"
               aria-label="{{ $social['name'] }}"
               class="w-10 h-10 sm:w-11 sm:h-11 rounded-full {{ $social['bg'] }} text-white shadow-lg {{ $social['shadow'] }} border {{ $social['border'] }} flex items-center justify-center transition-all duration-200 transform group-hover:scale-110 group-hover:-translate-x-0.5 active:scale-95 focus:outline-none focus:ring-2 focus:ring-white/40">
                <i class="{{ $social['icon'] }} pointer-events-none transition-transform duration-200 group-hover:rotate-6"></i>
            </a>
        </div>
    @endforeach
</div>
@endif

<!-- ================= STICKY SCROLL TO TOP UP ARROW ================= -->
<button id="sticky-scroll-top-btn" 
        type="button" 
        aria-label="Scroll to top of page" 
        title="Scroll to top"
        class="fixed bottom-6 right-5 sm:right-6 z-40 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-gradient-to-tr from-emerald-600 via-teal-600 to-emerald-500 hover:from-emerald-500 hover:to-teal-400 text-white shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/50 border border-emerald-300/30 flex items-center justify-center transition-all duration-300 transform opacity-0 translate-y-6 pointer-events-none group focus:outline-none focus:ring-2 focus:ring-emerald-400/50 cursor-pointer">
    <i class="fa-solid fa-arrow-up text-sm sm:text-base transition-transform duration-300 group-hover:-translate-y-1"></i>
</button>

<!-- Scroll-to-top Behavior Script -->
<script>
    (function() {
        const topBtn = document.getElementById('sticky-scroll-top-btn');
        if (!topBtn) return;

        let isVisible = false;

        function toggleScrollBtn() {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
            if (currentScroll > 220) {
                if (!isVisible) {
                    topBtn.classList.remove('opacity-0', 'translate-y-6', 'pointer-events-none');
                    topBtn.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    isVisible = true;
                }
            } else {
                if (isVisible) {
                    topBtn.classList.add('opacity-0', 'translate-y-6', 'pointer-events-none');
                    topBtn.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                    isVisible = false;
                }
            }
        }

        window.addEventListener('scroll', toggleScrollBtn, { passive: true });
        // Initial check
        toggleScrollBtn();

        topBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    })();
</script>
