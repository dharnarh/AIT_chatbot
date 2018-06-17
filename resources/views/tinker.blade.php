<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Valdo Chatbot</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/css/main.css">

    <!-- Styles -->
    <style>
        .container {
            display: flex;
            margin-top: 70px;
            align-items: center;
            justify-content: center;
            overflow-x: auto;
        }

        .content {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="headsection">Chatbot<br>A chat bot with few functionality</div>
<div class="container">
    <div class="content" id="app">
        <botman-tinker api-endpoint="/botman"></botman-tinker>
    </div>
</div>

<script src="/js/app.js"></script>
</body>
</html>