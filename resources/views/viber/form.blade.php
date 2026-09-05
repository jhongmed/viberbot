<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viber Message Sender</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        button {
            background-color: #6d4aff;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #5a3de6;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            display: none;
        }
        .result.success {
            background-color: #d4edda;
            color: #155724;
            display: block;
        }
        .result.error {
            background-color: #f8d7da;
            color: #721c24;
            display: block;
        }
    </style>
</head>
<body>
    <h1>Viber Message Sender</h1>
    
    <form id="messageForm">
        <div class="form-group">
            <label for="number">Viber User ID:</label>
            <input type="text" id="number" name="number" placeholder="Enter Viber User ID (e.g. 01234567890abcdef=)" required>
        </div>
        
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" placeholder="Enter your message" required></textarea>
        </div>
        
        <button type="submit">Send Message</button>
    </form>
    
    <div id="result" class="result"></div>
    
    <script>
        document.getElementById('messageForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const number = document.getElementById('number').value;
            const message = document.getElementById('message').value;
            const resultDiv = document.getElementById('result');
            
            resultDiv.style.display = 'none';
            resultDiv.className = 'result';
            
            try {
                const response = await fetch('/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ number, message })
                });
                
                const data = await response.json();
                
                if (data.status === 'success') {
                    resultDiv.textContent = 'Message sent successfully!';
                    resultDiv.classList.add('success');
                } else {
                    resultDiv.textContent = 'Error: ' + (data.message || 'Failed to send message');
                    resultDiv.classList.add('error');
                }
            } catch (error) {
                resultDiv.textContent = 'Error: ' + error.message;
                resultDiv.classList.add('error');
            }
        });
    </script>
</body>
</html>
