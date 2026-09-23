<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>Contact Us - Randhawa Marketing</title>
    <meta name="description" content="Get in touch with Randhawa Marketing for property inquiries, viewings, and expert advice.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/bootstrap.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/animate.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/swiper-bundle.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/sib-styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/styles.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/hero-redesign.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/footer-modern.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/contact.css')); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/icons/icomoon/style.css')); ?>" />
    <link rel="shortcut icon" href="<?php echo e(asset('/icons/favicon.svg')); ?>" />
</head>

<body class="popup-loader home-hero-redesign contact-page">
    <div id="wrapper">
        <div id="loading">
            <div id="loading-center">
                <div class="loader-container">
                    <div class="wrap-loader">
                        <div class="loader"></div>
                        <div class="icon">
                            <img src="<?php echo e(asset('/images/logo/loading.png')); ?>" alt="logo_icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main class="contact-main">
            <section class="contact-intro">
                <div class="tf-container">
                    <div class="contact-intro-inner">
                        <span class="contact-kicker">Contact</span>
                        <h1 class="contact-title">Get in touch</h1>
                        <p class="contact-lead">Ready to buy, sell, or rent? Reach Randhawa Marketing and we’ll guide the next step clearly.</p>
                    </div>
                </div>
            </section>

            <section class="contact-details">
                <div class="tf-container">
                    <div class="contact-detail-grid">
                        <article class="contact-detail">
                            <span class="contact-detail-icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </span>
                            <div>
                                <h2>Visit our office</h2>
                                <p>M38G+G5J, I-8 Markaz<br>I 8 Markaz I-8, Islamabad, 10370</p>
                            </div>
                        </article>

                        <article class="contact-detail">
                            <span class="contact-detail-icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                            </span>
                            <div>
                                <h2>Call us</h2>
                                <p><a href="tel:03331929762">0333-1929762</a><br>Available 9 AM – 6 PM</p>
                            </div>
                        </article>

                        <article class="contact-detail">
                            <span class="contact-detail-icon" aria-hidden="true">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                            </span>
                            <div>
                                <h2>Email us</h2>
                                <p><a href="mailto:info@randhawamarketing.com">info@randhawamarketing.com</a><br>We reply within 24 hours</p>
                            </div>
                        </article>
                    </div>
                </div>
            </section>

            <section class="contact-form-section">
                <div class="tf-container">
                    <div class="contact-form-shell">
                        <div class="contact-form-head">
                            <span class="contact-kicker">Message</span>
                            <h2>Send us a message</h2>
                            <p>Share your question or property goal — we’ll respond within 24 hours.</p>
                        </div>

                        <form id="contactForm" class="contact-form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="source" value="contact_page">

                            <div class="contact-form-grid">
                                <div class="contact-field">
                                    <label for="name">Full name</label>
                                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                                </div>
                                <div class="contact-field">
                                    <label for="email">Email address</label>
                                    <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                                </div>
                                <div class="contact-field">
                                    <label for="phone">Phone number</label>
                                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
                                </div>
                                <div class="contact-field">
                                    <label for="subject">Subject</label>
                                    <select id="subject" name="subject" required>
                                        <option value="">Select a subject</option>
                                        <option value="Property Inquiry">Property inquiry</option>
                                        <option value="Viewing Request">Viewing request</option>
                                        <option value="Investment Advice">Investment advice</option>
                                        <option value="Partnership Opportunity">Partnership opportunity</option>
                                        <option value="General Question">General question</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="contact-field">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" rows="6" placeholder="Tell us about your inquiry or property preferences..." required></textarea>
                            </div>

                            <button type="submit" class="contact-submit" id="submitBtn">
                                <span class="btn-text">Send message</span>
                                <span class="btn-loading" hidden>Sending…</span>
                            </button>

                            <div class="contact-alert is-success" id="formSuccess" hidden>
                                <strong>Thank you</strong>
                                <p>Your message was sent. We’ll get back to you within 24 hours.</p>
                            </div>
                            <div class="contact-alert is-error" id="formError" hidden>
                                <strong>Something went wrong</strong>
                                <p>Please try again or email us directly.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section class="contact-map-section">
                <div class="tf-container">
                    <div class="contact-section-head">
                        <span class="contact-kicker">Location</span>
                        <h2>Find us on the map</h2>
                    </div>
                    <div class="contact-map">
                        <iframe
                            src="https://www.google.com/maps?q=M38G%2BG5J%2C+I-8+Markaz+I+8+Markaz+I-8%2C+Islamabad%2C+10370&hl=en&z=17&output=embed"
                            width="100%"
                            height="420"
                            style="border:0;"
                            allowfullscreen=""
                            referrerpolicy="no-referrer-when-downgrade"
                            loading="lazy"
                            title="Randhawa Marketing — I-8 Markaz, Islamabad">
                        </iframe>
                    </div>
                </div>
            </section>

            <section class="contact-faq-section">
                <div class="tf-container">
                    <div class="contact-section-head">
                        <span class="contact-kicker">FAQ</span>
                        <h2>Frequently asked questions</h2>
                    </div>

                    <div class="contact-faq-list">
                        <div class="contact-faq-item">
                            <button type="button" class="contact-faq-q" onclick="toggleFAQ(this)">
                                <span>Our profile</span>
                                <span class="contact-faq-chevron" aria-hidden="true">+</span>
                            </button>
                            <div class="contact-faq-a">
                                <p>Randhawa Marketing is a trusted real estate company specializing in residential and commercial properties. We provide end-to-end services including buying, selling, renting, property management, and documentation support.</p>
                            </div>
                        </div>
                        <div class="contact-faq-item">
                            <button type="button" class="contact-faq-q" onclick="toggleFAQ(this)">
                                <span>Property portfolio</span>
                                <span class="contact-faq-chevron" aria-hidden="true">+</span>
                            </button>
                            <div class="contact-faq-a">
                                <p>We offer residential and commercial options across Pakistan — houses, apartments, villas, offices, shops, plazas, hotels, warehouses, and investment properties — carefully vetted for quality and market value.</p>
                            </div>
                        </div>
                        <div class="contact-faq-item">
                            <button type="button" class="contact-faq-q" onclick="toggleFAQ(this)">
                                <span>Our services</span>
                                <span class="contact-faq-chevron" aria-hidden="true">+</span>
                            </button>
                            <div class="contact-faq-a">
                                <p>From selection and market insight to documentation and closing, we manage marketing, negotiations, leases, and property oversight with a clear, professional process.</p>
                            </div>
                        </div>
                        <div class="contact-faq-item">
                            <button type="button" class="contact-faq-q" onclick="toggleFAQ(this)">
                                <span>Mutual respect</span>
                                <span class="contact-faq-chevron" aria-hidden="true">+</span>
                            </button>
                            <div class="contact-faq-a">
                                <p>We value your time and decisions. Honest communication on both sides keeps transactions smooth and expectations clear.</p>
                            </div>
                        </div>
                        <div class="contact-faq-item">
                            <button type="button" class="contact-faq-q" onclick="toggleFAQ(this)">
                                <span>Investment advisory</span>
                                <span class="contact-faq-chevron" aria-hidden="true">+</span>
                            </button>
                            <div class="contact-faq-a">
                                <p>We help clients weigh market trends, values, and local developments so investments match goals, risk, and long-term growth plans.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <script src="<?php echo e(asset('/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/main.js')); ?>"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        window.toggleFAQ = function (btn) {
            const item = btn.closest('.contact-faq-item');
            const answer = btn.nextElementSibling;
            const open = item.classList.contains('is-open');

            document.querySelectorAll('.contact-faq-item').forEach(function (el) {
                el.classList.remove('is-open');
                const a = el.querySelector('.contact-faq-a');
                if (a) a.hidden = true;
                const chev = el.querySelector('.contact-faq-chevron');
                if (chev) chev.textContent = '+';
            });

            if (!open) {
                item.classList.add('is-open');
                answer.hidden = false;
                const chev = btn.querySelector('.contact-faq-chevron');
                if (chev) chev.textContent = '−';
            }
        };

        document.querySelectorAll('.contact-faq-a').forEach(function (a) {
            a.hidden = true;
        });

        const contactForm = document.getElementById('contactForm');
        if (!contactForm) return;

        const submitBtn = document.getElementById('submitBtn');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        const formSuccess = document.getElementById('formSuccess');
        const formError = document.getElementById('formError');

        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
            formSuccess.hidden = true;
            formError.hidden = true;
            btnText.hidden = true;
            btnLoading.hidden = false;
            submitBtn.disabled = true;

            fetch('/contact', {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
                .then(function (response) { return response.json(); })
                .then(function (data) {
                    if (data.success) {
                        formSuccess.hidden = false;
                        contactForm.reset();
                        formSuccess.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    } else if (data.errors) {
                        Object.keys(data.errors).forEach(function (field) {
                            const input = document.getElementById(field);
                            if (input) input.classList.add('is-invalid');
                        });
                        formError.hidden = false;
                    } else {
                        formError.hidden = false;
                    }
                })
                .catch(function () {
                    formError.hidden = false;
                })
                .finally(function () {
                    btnText.hidden = false;
                    btnLoading.hidden = true;
                    submitBtn.disabled = false;
                });
        });

        contactForm.querySelectorAll('input, select, textarea').forEach(function (input) {
            input.addEventListener('input', function () {
                this.classList.remove('is-invalid');
            });
        });
    });
    </script>
</body>
</html>
<?php /**PATH C:\Users\AR\Desktop\RM_MainSite\resources\views/contact.blade.php ENDPATH**/ ?>