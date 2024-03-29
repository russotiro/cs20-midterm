<!DOCTYPE html>
<html>

<head>
    <title>Reservations - Gus's Buses</title>
    <meta name="keywords" content="charter bus gus buy tickets purchase" />
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./favicon.ico" />
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="map.js"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        input[type=text],
        input[type=email]
        input[type=date] {
            width: 40%;
            padding: 12px 20px;
            margin-left: 30%;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 2vh;
        }

        input[type=radio] {
            padding: 12px 20px;
            margin-left: 30%;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 2vh;
        }

        input[type=button]:hover {
            background-color: hsl(37, 98%, 47%);
            cursor: pointer;
        }

        label {
            font-family: sans-serif;
            margin-top: 20vh;
            margin-left: 30%;
        }

        .rad {
            font-family: sans-serif;
            margin-top: 20vh;
            margin-left: 0%;
        }
    </style>
</head>

<body>

    <div class="small-header" style="margin:8px;">
        <a href="./index.html"><img src="./logo.png" alt="Logo for Gus's Buses"></a>
        <h1>Gus&rsquo;s Buses</h1>
    </div>
    <div class="nav-bar" style="margin:8px;">
        <a href="./about.html">
            <span class="nav-link">ABOUT</span></a> &#8226;
        <a href="./services.html">
            <span class="nav-link">SERVICES</span></a> &#8226;
        <a href="./fleet.html">
            <span class="nav-link">FLEET</span></a> &#8226;
        <span class="nav-link curr-page">RESERVATIONS</span> &#8226;
        <a href="./contact.html">
            <span class="nav-link">CONTACT</span></a>
        <a href="./login.html" />
            <img src="./profile.png" alt="profile icon" /></a>
    </div>

    <h2 style="text-align:center">Calculate a Reservation Cost Estimate</h2>
    <p style="text-align:center;margin-left:5%;margin-right:5%;">Enter your starting address and your destination address and let us know what kind of bus you'd like to enjoy and we'll provide an estimate for your ticket cost!</p>

    <div id="map"></div>
    <div id="cost"></div>
    <form name="ticketform" action="" method="GET">

        <label for="start">Starting Point:</label><br>
        <input type="text" id="start" name="start" value=""><br>
        <label for="end">Destination:</label><br>
        <input type="text" id="end" name="end" value=""><br>
        <label>Roundtrip? </label><br>
        <input type="radio" id="yes" name="roundtrip" value="Yes" checked="checked">
        <label for="yes" class="rad">Yes</label><br>
        <input type="radio" id="no" name="roundtrip" value="No">
        <label for="no" class="rad">No</label><br>
        <label for="depart">Departure Date</label><br>
        <input type="date" id="depart" name="depart"><br>
        <label for="return">Return Date</label><br>
        <input type="date" id="return" name="return"><br>


        <br>
        <input type="button" value="Submit" onClick="handleForm(this.form)">
    </form>
    <?php
        $conn = include 'connect.php';
        $sql = "SELECT * FROM Buses";
        $result = $conn->query($sql);
        $conn->close();

        $buses = array();
        while ($row = $result->fetch_assoc()) {
            $buses[] = $row;
        }

    ?>
    <script>

        var busStr = '<?php echo json_encode($buses); ?>'
		var buses = JSON.parse(busStr);
        console.log(buses[0]["type"]);
    </script>
    <p style="text-align:center; margin-left:5%; margin-right:5%;" id="purchasetxt"></p>
    <form name="buy" id="buy" action="">

    </form>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4_Y5ayP5RT00n6EINqjplYSEyQOtIQdI&v=weekly" async></script>
</body>

</html>
