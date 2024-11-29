<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore - About Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Montserrat", sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            color: #333;
        }

        header {
            position: relative;
            text-align: center;
            height: 60vh;
            overflow: hidden;
        }

        .join__bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(70%);
        }

        .join__data {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }

        .join__title {
            margin: 0;
            padding: 10px;
            font-family: "Playfair Display", serif;
            font-size: 3rem;
            color: #fff;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
        }

        section {
            padding: 40px 20px;
            margin: 20px auto;
            max-width: 800px;
            text-align: center;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        section h2 {
            font-size: 2rem;
            font-family: "Playfair Display", serif;
            margin-bottom: 15px;
        }

        section h2::after {
            content: "";
            display: block;
            width: 80px;
            height: 4px;
            background-color: #0078d7;
            margin: 10px auto 20px auto;
        }

        section p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #666;
        }

        section p b {
            color: #0078d7;
        }
    </style>
</head>

<body>

    <header>
        <img src="assets/img/aboutUS_header.jpg" alt="Welcome to Our Bookstore" class="join__bg">
        <div class="join__data">
            <h1 class="join__title">
                Welcome to Our Bookstore <br>
                Discover the Joy of Reading!
            </h1>
        </div>
    </header>

    <section>
        <h2>About Us</h2>
        <p>
            We are passionate about books and believe in the power of literature to inspire and transform lives.
        </p>
    </section>

    <section>
        <h2>Our Mission</h2>
        <p>
            Our mission is to promote a culture of reading and lifelong learning.
        </p>
    </section>

    <section>
        <h2>Contact Us</h2>
        <p>
            Visit us at <b>No. 215/4 Colombo, Sri Lanka</b>, call us at <b>0123456789</b>, or email us at <b>e.book@email.com</b>.
        </p>
    </section>

</body>

</html>
