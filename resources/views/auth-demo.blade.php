<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Forms Demo - Real Estate Theme</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        .demo-section {
            margin: 2rem 0;
            padding: 2rem;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
        }
        
        .demo-section h3 {
            color: #2d3748;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .demo-nav {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        
        .demo-nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .demo-nav h1 {
            color: white;
            margin: 0;
            font-size: 1.5rem;
        }
        
        .demo-nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .demo-nav a:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
        }
        
        .form-preview {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }
        
        .form-preview h4 {
            color: #4a5568;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .form-preview .btn {
            margin: 0.5rem;
        }
    </style>
</head>
<body>
    <nav class="demo-nav">
        <div class="container">
                            <h1>🏠 Randhawa Marketing - Authentication Forms Demo</h1>
                <div>
                    <a href="{{ route('login') }}">Live Login</a>
                    <a href="{{ route('index') }}">Back to Home</a>
                </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="demo-section">
                    <h3>🎨 New Authentication Form Styling</h3>
                    <p class="text-center mb-4">
                        We've completely redesigned all authentication forms with a beautiful, modern real estate theme. 
                        The new design features gradient backgrounds, glassmorphism effects, smooth animations, and responsive design.
                    </p>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-preview">
                                <h4>✨ Key Features</h4>
                                <ul>
                                    <li>Gradient backgrounds with subtle patterns</li>
                                    <li>Glassmorphism card effects</li>
                                    <li>Smooth hover animations</li>
                                    <li>Real estate themed icons (🏠)</li>
                                    <li>Responsive design for all devices</li>
                                    <li>Modern form styling with focus effects</li>
                                    <li>Beautiful button animations</li>
                                    <li>Professional color scheme</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-preview">
                                <h4>🎯 Forms Updated</h4>
                                <ul>
                                    <li>Login Form</li>
                                    <li>Password Reset Request</li>
                                    <li>Password Reset Form</li>
                                    <li>Password Confirmation</li>
                                    <li>Email Verification</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="demo-section">
                    <h3>🔐 Login Form Preview</h3>
                    <div class="auth-login-container" style="min-height: auto; background: none;">
                        <div class="auth-card card">
                            <div class="card-header">
                                <h2>Welcome Back</h2>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="demo-email">Email Address</label>
                                    <input id="demo-email" type="email" class="form-control" placeholder="Enter your email address" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="demo-password">Password</label>
                                    <input id="demo-password" type="password" class="form-control" placeholder="Enter your password" disabled>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="demo-remember" disabled>
                                        <label class="form-check-label" for="demo-remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary w-100" disabled>Sign In</button>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('login') }}" class="btn btn-link">View Live Form</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="demo-section">
                    <h3>🚀 Try the Live Forms</h3>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">Login Form</a>
                        <a href="{{ route('password.request') }}" class="btn btn-primary btn-lg me-3">Password Reset</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
