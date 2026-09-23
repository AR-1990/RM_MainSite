<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/footer-modern.css')); ?>" />

<footer id="footer" class="footer-modern">
    <div class="fm-cta" style="--fm-cta-image: url('<?php echo e(asset('/images/dream-home/villa-night.jpg')); ?>');">
        <div class="fm-cta-inner">
            <h2 class="fm-cta-title">
                Start Your Journey to Smarter
                <em>Living</em>
            </h2>
            <p class="fm-cta-text">From modern apartments to luxury estates — your perfect home awaits.</p>
            <a href="<?php echo e(route('properties.index')); ?>" class="fm-btn">
                Explore Homes
            </a>
        </div>
    </div>

    <div class="fm-body">
        <div class="fm-container">
            <div class="fm-top">
                <div class="fm-brand-col">
                    <a href="<?php echo e(route('index')); ?>" class="fm-logo" aria-label="Randhawa Marketing">
                        <img src="<?php echo e(asset('/images/logo/logo@2x.png')); ?>" alt="Randhawa Marketing">
                    </a>
                    <div class="fm-email-block">
                        <span class="fm-label">// Shoot us an email</span>
                        <a href="mailto:info@randhawamarketing.com" class="fm-email">info@randhawamarketing.com</a>
                    </div>
                </div>

                <div class="fm-cols">
                    <div class="fm-col">
                        <span class="fm-label"><span class="fm-dot"></span> Navigation</span>
                        <ul>
                            <li><a href="<?php echo e(route('index')); ?>">Home</a></li>
                            <li><a href="<?php echo e(route('properties.index')); ?>">Listings</a></li>
                            <li><a href="<?php echo e(route('about')); ?>">About</a></li>
                            <li><a href="<?php echo e(route('contact')); ?>">Contact</a></li>
                        </ul>
                    </div>
                    <div class="fm-col">
                        <span class="fm-label"><span class="fm-dot"></span> Socials</span>
                        <ul>
                            <li><a href="#" target="_blank" rel="noopener">Twitter</a></li>
                            <li><a href="#" target="_blank" rel="noopener">LinkedIn</a></li>
                            <li><a href="#" target="_blank" rel="noopener">Instagram</a></li>
                            <li><a href="#" target="_blank" rel="noopener">Facebook</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="fm-newsletter">
                <div class="fm-newsletter-meta">
                    <span class="fm-label"><span class="fm-dot"></span> Newsletter</span>
                    <span class="fm-label fm-label-soft">// Receive updates and news from us</span>
                </div>
                <form id="newsletter-form" class="fm-newsletter-form" method="POST" action="<?php echo e(route('subscribe.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="source" value="newsletter">
                    <input
                        class="fm-input"
                        type="email"
                        id="email"
                        name="email"
                        autocomplete="email"
                        placeholder="Your email address"
                        required
                    >
                    <button class="fm-btn fm-btn-submit" type="submit" id="subscribe-btn">
                        <span id="subscribe-text">Submit</span>
                        <span aria-hidden="true">→</span>
                    </button>
                </form>
                <div id="fm-newsletter-msg" class="fm-newsletter-msg" hidden></div>
            </div>

            <div class="fm-mega" aria-hidden="true">
                <span class="fm-corner fm-corner-tl"></span>
                <span class="fm-corner fm-corner-tr"></span>
                <span class="fm-corner fm-corner-bl"></span>
                <span class="fm-corner fm-corner-br"></span>
                <span class="fm-mega-word">Randhawa Marketing</span>
            </div>

            <div class="fm-legal">
                <p>© <?php echo e(date('Y')); ?> Randhawa Marketing // All rights reserved</p>
                <p><a href="<?php echo e(route('contact')); ?>">We respect your <u>privacy</u></a></p>
                <p>Designed and developed by <u>Meer Saad Marri</u></p>
            </div>
        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const newsletterForm = document.getElementById('newsletter-form');
    const subscribeBtn = document.getElementById('subscribe-btn');
    const subscribeText = document.getElementById('subscribe-text');
    const emailInput = document.getElementById('email');
    const msgBox = document.getElementById('fm-newsletter-msg');

    if (!newsletterForm) return;

    function showMessage(message, type) {
        if (!msgBox) {
            alert(message);
            return;
        }
        msgBox.hidden = false;
        msgBox.textContent = message;
        msgBox.className = 'fm-newsletter-msg is-' + type;
    }

    newsletterForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const email = (emailInput.value || '').trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email) {
            showMessage('Please enter your email address.', 'error');
            emailInput.focus();
            return;
        }
        if (!emailRegex.test(email)) {
            showMessage('Please enter a valid email address.', 'error');
            emailInput.focus();
            return;
        }

        const csrfToken = newsletterForm.querySelector('input[name="_token"]')?.value;
        if (!csrfToken) {
            showMessage('Security token not found. Please refresh the page.', 'error');
            return;
        }

        subscribeBtn.disabled = true;
        subscribeText.textContent = 'Sending…';

        fetch('<?php echo e(route("subscribe.store")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email: email, source: 'newsletter' })
        })
            .then(function (response) {
                if (!response.ok) throw new Error('HTTP ' + response.status);
                return response.json();
            })
            .then(function (data) {
                if (data.success) {
                    showMessage(data.message || 'Subscribed successfully.', 'success');
                    newsletterForm.reset();
                } else {
                    showMessage(data.message || 'Something went wrong. Please try again.', 'error');
                }
            })
            .catch(function () {
                showMessage('Network error. Please try again.', 'error');
            })
            .finally(function () {
                subscribeBtn.disabled = false;
                subscribeText.textContent = 'Submit';
            });
    });
});
</script>
<?php /**PATH C:\Users\AR\Desktop\RM_MainSite\resources\views/layout/footer.blade.php ENDPATH**/ ?>