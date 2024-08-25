<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
/*            background-color: #f0f0f0;*/
            background-image: url('https://img.freepik.com/free-vector/gorgeous-clouds-background-with-blue-sky-design_1017-25501.jpg');
            background-repeat: no-repeat;
            background-size: 300vh 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 600px; /* Enlarged width */
            padding: 40px; /* Increased padding */
            text-align: center;
            background: #fff;
            border-radius: 10px; /* Increased border radius */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Slightly darker shadow */
        }

        h1 {
            font-size: 2.5rem; /* Larger font size */
            margin-bottom: 20px;
            color: darkblue;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 15px; /* Larger padding */
            border: 2px solid #007bff; /* Border color matching the button */
            border-radius: 5px;
            width: 80%; /* Wider input field */
            font-size: 1.1rem; /* Larger text */
            margin-bottom: 20px;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #0056b3; /* Darker border on focus */
            box-shadow: 0 0 5px rgba(0, 91, 187, 0.5); /* Slight shadow on focus */
        }

        button {
            padding: 15px 25px; /* Larger padding */
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 1.2rem; /* Larger font size */
            cursor: pointer;
            transition: background-color 0.3s ease; /* Smooth transition */
        }

        button:hover {
            background-color: #0056b3; /* Darker background on hover */
        }

    </style>
</head>
<body>
    <div class="container">
        <h1 class="display-4 text-center text-primary mb-4 custom-heading">Smart WeatherSync Tracker</h1>

        <form action="index.php" method="post">
            <input type="text" name="location" placeholder="Enter city name" style="border: 5px double darkgreen;" required>
            <button type="submit" name="submit">Get Weather</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="reset" name="reset" style="background-color: red;"><a href="index.php" style="text-decoration: none; color: white;">Reset</a></button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $location = htmlspecialchars($_POST['location']);
            $apiKey = 'd4565d4bc2f14d94b65124141240908'; // Your WeatherAPI key
            $apiUrl = "http://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$location}&aqi=no";

            $weatherData = file_get_contents($apiUrl);
            $weatherArray = json_decode($weatherData, true);

            // Check if location is found in the response
            if (isset($weatherArray['location'])) {
                $city = $weatherArray['location']['name'];
                $country = $weatherArray['location']['country'];
                $temp = $weatherArray['current']['temp_c'];
                $condition = $weatherArray['current']['condition']['text'];
                $icon = $weatherArray['current']['condition']['icon'];

                echo "<h2>Weather in {$city}, {$country}</h2>";
                echo "<p><img src=\"{$icon}\" alt=\"Weather Icon\"> {$condition}</p>";
                echo "<p>Temperature: {$temp}°C</p>";
            } else {
                echo "<p>Location not found. Please try again.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
