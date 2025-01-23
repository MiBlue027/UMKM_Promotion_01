<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Information </title>

    <!--    Google Font ----------------------------------------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        #informationActionWrapper{
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            display: none;
            justify-content: center;
            align-items: center;
            background-color: transparent;
            backdrop-filter: blur(12px);
            z-index: 999;
        }
        #informationActionContainer{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 45em;
            background-color: #edf1f6;
            box-shadow: 0 0 10px rgba(12, 13, 21, 0.45);
            padding: 4em 4em;
            border-radius: 10px;
        }
        #informationActionTitle{
            font-size: 3em;
            margin: .2em;
            color: #509ae4;
        }
        #informationActionMessage{
            font-size: 1.5em;
            text-align: center;
            margin: .5em;
        }
        #informationActionButton{
            font-size: 1.2em;
            font-weight: 500;
            padding: .7em 3em;
            margin-top: 3em;
            border: none;
            background-color: #509ae4;
            color: #ffffff;
            border-radius: 10px;
            cursor: pointer;
            transition: .4s;
        }
        #informationActionButton:hover{
            background-color: #7ebdf1;
            box-shadow: 0 0 10px #98c3e6;
        }
    </style>

</head>
<body>
    <div id="informationActionWrapper">
        <div id="informationActionContainer">
            <h1 id="informationActionTitle"> </h1>
            <p id="informationActionMessage">  </p>
            <button id="informationActionButton" onclick="hideIA()"> Ok </button>
        </div>
    </div>

    <script>
        const informationActionWrapper = document.getElementById('informationActionWrapper');
        const informationActionTitle = document.getElementById('informationActionTitle');
        const informationActionMessage = document.getElementById('informationActionMessage');
        function showIA(title, message){
            informationActionWrapper.style.display = 'flex';
            informationActionTitle.innerHTML = title;
            informationActionMessage.innerHTML = message;
        }
        function hideIA(){
            informationActionWrapper.style.display = 'none';
        }
    </script>
</body>
</html>