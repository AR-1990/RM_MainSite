<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8" />
    <title>Contact Us - Proty Real Estate</title>
    <meta name="description" content="Get in touch with Proty Real Estate. Contact us for property inquiries, viewings, and expert advice.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/sib-styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('icons/icomoon/style.css') }}" />
    <link rel="shortcut icon" href="{{ url('icons/favicon.svg') }}" />

    <style>
        .contact-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        
        .contact-hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .contact-hero p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .contact-section {
            padding: 80px 0;
            background: #f8f9fa;
        }
        
        .contact-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .contact-card .icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 2rem;
        }
        
        .contact-card h4 {
            color: #333;
            font-weight: 600;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .contact-card p {
            color: #666;
            text-align: center;
            line-height: 1.6;
        }
        
        .form-section {
            background: white;
            padding: 80px 0;
        }
        
        .form-container {
            background: white;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .form-title {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .form-title h2 {
            color: #333;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .form-title p {
            color: #666;
            font-size: 1.1rem;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-control.select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 18px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }
        
        .info-section {
            background: #2c3e50;
            color: white;
            padding: 60px 0;
        }
        
        .info-card {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .info-card .icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 20px;
        }
        
        .info-card h5 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .info-card p {
            opacity: 0.9;
            line-height: 1.6;
        }
        
        .map-section {
            padding: 80px 0;
            background: #f8f9fa;
        }
        
        .map-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .faq-section {
            padding: 80px 0;
            background: white;
        }
        
        .faq-item {
            background: #f8f9fa;
            border-radius: 15px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .faq-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .faq-question {
            background: white;
            padding: 25px 30px;
            cursor: pointer;
            border-bottom: 1px solid #e1e5e9;
            transition: all 0.3s ease;
        }
        
        .faq-question:hover {
            background: #667eea;
            color: white;
        }
        
        .faq-question h4 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .faq-answer {
            padding: 25px 30px;
            color: #666;
            line-height: 1.6;
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
            display: none;
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
            display: none;
        }
        
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @media (max-width: 768px) {
            .contact-hero h1 {
                font-size: 2.5rem;
            }
            
            .form-container {
                padding: 30px 20px;
            }
            
            .contact-card {
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body class="popup-loader">
    <div id="wrapper">
        <!-- .preload -->
        <div id="loading">
            <div id="loading-center">
                <div class="loader-container">
                    <div class="wrap-loader">
                        <div class="loader"></div>
                        <div class="icon">
                            <img src="{{ url('images/logo/loading.png') }}" alt="logo_icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- .header -->
        @include('layout.header')

        <!-- Hero Section -->
        <section class="contact-hero">
            <div class="tf-container xl">
                <div class="row">
                    <div class="col-12">
                        <h1>Get In Touch</h1>
                        <p>Ready to find your dream property? Our expert team is here to help you every step of the way. Contact us today and let's make your real estate dreams come true.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Information Cards -->
        <section class="contact-section">
            <div class="tf-container xl">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-card">
                            <div class="icon">
                                <i class="icon-location"></i>
                            </div>
                            <h4>Visit Our Office</h4>
                            <p>123 Real Estate Avenue<br>Downtown Business District<br>City, State 12345</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-card">
                            <div class="icon">
                                <i class="icon-phone"></i>
                            </div>
                            <h4>Call Us Today</h4>
                            <p>Mobile: 0333-1929762</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-card">
                            <div class="icon">
                                <i class="icon-email"></i>
                            </div>
                            <h4>Email Us</h4>
                            <p>Email: info@randhawamarketing.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section class="form-section">
            <div class="tf-container xl">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="form-container">
                            <div class="form-title">
                                <h2>Send Us a Message</h2>
                                <p>Have a question or ready to start your property journey? Fill out the form below and we'll get back to you within 24 hours.</p>
                            </div>

                            <form id="contactForm">
                                @csrf
                                <input type="hidden" name="source" value="contact_page">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Full Name *</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email Address *</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter your phone number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="subject">Subject *</label>
                                            <select id="subject" name="subject" class="form-control select" required>
                                                <option value="">Select a subject</option>
                                                <option value="Property Inquiry">Property Inquiry</option>
                                                <option value="Viewing Request">Viewing Request</option>
                                                <option value="Investment Advice">Investment Advice</option>
                                                <option value="Partnership Opportunity">Partnership Opportunity</option>
                                                <option value="General Question">General Question</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="message">Message *</label>
                                    <textarea id="message" name="message" rows="6" class="form-control" placeholder="Tell us more about your inquiry, property preferences, or any specific questions you have..." required></textarea>
                                </div>

                                <button type="submit" class="btn-submit" id="submitBtn">
                                    <span class="btn-text">Send Message</span>
                                    <span class="btn-loading" style="display: none;">
                                        <span class="loading-spinner"></span>Sending...
                                    </span>
                                </button>

                                <div class="success-message" id="formSuccess">
                                    <i class="icon-check" style="font-size: 2rem; color: #28a745;"></i>
                                    <h4 style="margin: 15px 0 10px;">Thank You!</h4>
                                    <p>Your message has been sent successfully. We'll get back to you within 24 hours.</p>
                                </div>

                                <div class="error-message" id="formError">
                                    <i class="icon-alert" style="font-size: 2rem; color: #dc3545;"></i>
                                    <h4 style="margin: 15px 0 10px;">Oops!</h4>
                                    <p>Something went wrong. Please try again or contact us directly.</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Additional Information -->
        <section class="info-section">
            <div class="tf-container xl">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="info-card">
                            <div class="icon">
                                <i class="icon-clock"></i>
                            </div>
                            <h5>Business Hours</h5>
                            <p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="info-card">
                            <div class="icon">
                                <i class="icon-users"></i>
                            </div>
                            <h5>Expert Team</h5>
                            <p>Our certified real estate professionals have over 15+ years of experience in the market.</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="info-card">
                            <div class="icon">
                                <i class="icon-home"></i>
                            </div>
                            <h5>Properties Available</h5>
                            <p>Browse through 500+ verified properties including residential, commercial, and investment opportunities.</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="info-card">
                            <div class="icon">
                                <i class="icon-star"></i>
                            </div>
                            <h5>Customer Satisfaction</h5>
                            <p>98% of our clients recommend us to friends and family. Your satisfaction is our priority.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="map-section">
            <div class="tf-container xl">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center mb-5">
                            <h2 style="color: #333; font-size: 2.5rem; font-weight: 700; margin-bottom: 15px;">Find Us on the Map</h2>
                            <p style="color: #666; font-size: 1.1rem;">Visit our office or get directions to our location</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="map-container">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c119b%3A0xc6c202a2b4b5a1f!2s150%20Park%20Row%2C%20New%20York%2C%20NY%2010007%2C%20USA!5e0!3m2!1sen!2s!4v1640995200000!5m2!1sen!2s" 
                                width="100%" 
                                height="450" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="tf-container xl">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center mb-5">
                            <h2 style="color: #333; font-size: 2.5rem; font-weight: 700; margin-bottom: 15px;">Frequently Asked Questions</h2>
                            <p style="color: #666; font-size: 1.1rem;">Find answers to common questions about our services</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFAQ(this)">
                                <h4>How quickly do you respond to inquiries?</h4>
                            </div>
                            <div class="faq-answer" style="display: none;">
                                <p>We typically respond to all inquiries within 24 hours during business days. For urgent matters, please call us directly at our emergency line. Our team is committed to providing timely and helpful responses to ensure you get the information you need when you need it.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFAQ(this)">
                                <h4>Do you offer virtual property tours?</h4>
                            </div>
                            <div class="faq-answer" style="display: none;">
                                <p>Yes, we offer comprehensive virtual tours for all our properties. You can schedule a virtual viewing through our website or by contacting us directly. Our virtual tours include 360-degree views, detailed walkthroughs, and the ability to ask questions in real-time with our agents.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFAQ(this)">
                                <h4>What areas do you serve?</h4>
                            </div>
                            <div class="faq-answer" style="display: none;">
                                <p>We serve the entire metropolitan area including downtown, suburbs, and surrounding communities. Our coverage extends to residential, commercial, and investment properties across multiple neighborhoods. Contact us to confirm coverage in your specific area and learn about our local market expertise.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFAQ(this)">
                                <h4>How can I schedule a property viewing?</h4>
                            </div>
                            <div class="faq-answer" style="display: none;">
                                <p>You can schedule a viewing through our website, by calling us, or by filling out the contact form above. We'll get back to you to confirm the appointment and provide all necessary details. We offer flexible scheduling including evenings and weekends to accommodate your busy lifestyle.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFAQ(this)">
                                <h4>What financing options do you offer?</h4>
                            </div>
                            <div class="faq-answer" style="display: none;">
                                <p>We work with multiple lenders and financial institutions to provide you with the best financing options. We offer conventional loans, FHA loans, VA loans, and specialized financing for first-time homebuyers. Our financial experts will help you find the right mortgage solution for your needs.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question" onclick="toggleFAQ(this)">
                                <h4>Do you handle property management services?</h4>
                            </div>
                            <div class="faq-answer" style="display: none;">
                                <p>Yes, we provide comprehensive property management services including tenant screening, rent collection, maintenance coordination, and property inspections. Our management team ensures your investment property is well-maintained and profitable while you focus on other priorities.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('layout.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="{{ url('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('js/main.js') }}"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // FAQ Toggle Function
        window.toggleFAQ = function(element) {
            const answer = element.nextElementSibling;
            const isVisible = answer.style.display !== 'none';
            
            // Hide all FAQ answers
            document.querySelectorAll('.faq-answer').forEach(ans => {
                ans.style.display = 'none';
            });
            
            // Remove active class from all questions
            document.querySelectorAll('.faq-question').forEach(q => {
                q.style.background = 'white';
                q.style.color = '#333';
            });
            
            // Show clicked answer and style question
            if (!isVisible) {
                answer.style.display = 'block';
                element.style.background = '#667eea';
                element.style.color = 'white';
            }
        };

        // Contact Form Submission
        const contactForm = document.getElementById('contactForm');
        
        if (contactForm) {
            const submitBtn = document.getElementById('submitBtn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');
            const formSuccess = document.getElementById('formSuccess');
            const formError = document.getElementById('formError');

            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Clear previous messages
                formSuccess.style.display = 'none';
                formError.style.display = 'none';

                // Show loading state
                btnText.style.display = 'none';
                btnLoading.style.display = 'inline-block';
                submitBtn.disabled = true;

                // Get form data
                const formData = new FormData(this);

                // Submit form
                fetch('/contact', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        formSuccess.style.display = 'block';
                        contactForm.reset();
                        // Scroll to success message
                        formSuccess.scrollIntoView({ behavior: 'smooth' });
                    } else {
                        if (data.errors) {
                            // Handle validation errors
                            Object.keys(data.errors).forEach(field => {
                                const input = document.getElementById(field);
                                if (input) {
                                    input.style.borderColor = '#dc3545';
                                    input.style.backgroundColor = '#fff5f5';
                                }
                            });
                        } else {
                            formError.style.display = 'block';
                        }
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    formError.style.display = 'block';
                })
                .finally(() => {
                    // Reset button state
                    btnText.style.display = 'inline-block';
                    btnLoading.style.display = 'none';
                    submitBtn.disabled = false;
                });
            });

            // Remove error styling on input
            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('input', function() {
                    this.style.borderColor = '#e1e5e9';
                    this.style.backgroundColor = '#f8f9fa';
                });
            });
        }
    });
    </script>
</body>
</html>
