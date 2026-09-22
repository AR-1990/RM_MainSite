<!DOCTYPE html>
<html>
<head>
    <title>Test Contact Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Test Contact Form</h1>
    
    <form id="testForm">
        @csrf
        <input type="hidden" name="source" value="contact_page">
        
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="Test User" required>
        </div>
        
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="test@test.com" required>
        </div>
        
        <div>
            <label>Phone:</label>
            <input type="text" name="phone" value="1234567890">
        </div>
        
        <div>
            <label>Subject:</label>
            <select name="subject" required>
                <option value="General Inquiry">General Inquiry</option>
            </select>
        </div>
        
        <div>
            <label>Message:</label>
            <textarea name="message" required>This is a test message</textarea>
        </div>
        
        <button type="submit">Submit Test</button>
    </form>
    
    <div id="result"></div>
    
    <script>
        document.getElementById('testForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
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
                document.getElementById('result').innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
            })
            .catch(error => {
                document.getElementById('result').innerHTML = 'Error: ' + error.message;
            });
        });
    </script>
</body>
</html>
