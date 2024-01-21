<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Road Messages</title>
    <style>
         body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background-color: #3b5998;
            color: #fff;
            padding: 1em;
            width: 100%;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: stretch;
            margin-top: 20px;
        }

        .message-board {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 1em;
            width: 80%;
            overflow-y: auto;
            display: flex;
            flex-direction: column-reverse; /* New messages at the top */
        }

        .message-form {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 1em;
            width: 300px;
            margin-top: 20px;
        }

        .message {
            border-bottom: 1px solid #ddd;
            padding: 1em 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align text to the left */
        }

        .message p {
            margin: 0;
        }

        .message img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .message-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .like, .dislike {
            cursor: pointer;
            color: #3b5998;
        }

        .like:hover, .dislike:hover {
            text-decoration: underline;
        }

        button {
            background-color: #3b5998;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2d4373;
        }

        textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
        }

        input[type="file"] {
            display: none;
        }

        label {
            background-color: #3b5998;
            color: #fff;
            padding: 8px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        label:hover {
            background-color: #2d4373;
        }
        h3{
            position:absolute;
            top:5%;
            left:80%;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
    </style>
</head>
<body>
<?php 
$firstName=$_GET['fname'];
?>
    <header>
        <h1>Road Messages</h1>
        <h3><?php 
        echo $firstName;
        ?>
    </header>

    <div class="container">
        <div class="message-board" id="messageBoard">
            <!-- Messages will be displayed here dynamically -->
        </div>

        <div class="message-form">
            <h2>Add a Message</h2>
            <textarea id="newMessage" rows="4" placeholder="Type your message here"></textarea>
            <input type="file" id="imageInput" accept="image/*">
            <button  onclick="postMessage()">Post</button>
        </div>
    </div>

    <script>
        // Sample initial messages
        const initialMessages = [
            { user: 'User1', content: 'Traffic on Route A is terrible today!', likes: 5, dislikes: 2 },
            { user: 'User2', content: 'Bus on Route B is delayed by 15 minutes.', likes: 10, dislikes: 3 },
        ];

        function renderMessages() {
            const messageBoard = document.getElementById('messageBoard');
            messageBoard.innerHTML = '';

            initialMessages.forEach((message, index) => {
                const messageElement = document.createElement('div');
                messageElement.classList.add('message');
                messageElement.innerHTML = `
                    <p><strong>${message.user}</strong>: ${message.content}</p>
                    ${message.image ? `<img src="${message.image}" alt="Shared Image">` : ''}
                    <div class="message-actions">
                        <span class="like" onclick="likeMessage(${index})">Like (${message.likes})</span>
                        <span class="dislike" onclick="dislikeMessage(${index})">Dislike (${message.dislikes})</span>
                    </div>
                `;
                messageBoard.appendChild(messageElement);
            });
        }

        function postMessage() {
            const newMessageContent = document.getElementById('newMessage').value;
            const imageInput = document.getElementById('imageInput');
            const newMessageImage = imageInput.files[0];

            if (newMessageContent.trim() !== '' || newMessageImage) {
                const newMessage = {
                    user: 'NewUser',
                    content: newMessageContent,
                    likes: 0,
                    dislikes: 0,
                    image: newMessageImage ? URL.createObjectURL(newMessageImage) : null,
                };

                initialMessages.unshift(newMessage); // Add new message at the beginning
                renderMessages();
                document.getElementById('newMessage').value = ''; // Clear the input field
                imageInput.value = ''; // Clear the file input
            }
        }

        function likeMessage(index) {
            initialMessages[index].likes++;
            renderMessages();
        }

        function dislikeMessage(index) {
            initialMessages[index].dislikes++;
            renderMessages();
        }

        // Initial render
        renderMessages();
    </script>

</body>
</html>
