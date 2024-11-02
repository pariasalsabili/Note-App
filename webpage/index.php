<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note App</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
</head>
<body>
    <header>
        <a href="#" class="logo">NoteMaster</a>
        
        <nav>
            <a href="#home" class="active">Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>
    <section id="home">
        <div class="container">
            <div class="info">
                <h1>Welcome To NoteMaster!</h1>
                <h3>Your ultimate digital notebook designed to help you capture and organize your thoughts effortlessly. Whether you're a student, professional, or creative, NoteMaster provides a seamless and inuitive experience to manage your notes. Start your journy towards better productivity and organization with NoteMaster Today.</h3>
                
                <button ><a href="../auth/register.php">Sign In / Sign Up</a></button>
            </div>
            
        </div>
    </section>
    <section id="about">
        <div class="container2">
            <h1>  About Us </h1>
            <p>At NoteMaster, we believe that great ideas deserve to be rememberes and organized. Founded by a team of passionate individuals who understand the power of effective note-taking, we have crafted a platform that caters to your every need.<br><br> Our mission is to help you capture, organaize, and prioritize you thoughts and tasks with ease. With a focus on simplicity and user experience, we strive to make your note-taking process as smooth and efficient as possible. <br><br> Join us on our journey to revolutionize the way you take notes and enhance your productivity.</p>
        </div>
    </section>
    <section id="services">
        <div class="container3">
            <div class="box">
                <h2>01</h2>
                <h3>Easy Note Creation</h3>
                <p>NoteMaster allows you to quickly create and manage notes with a user-friendly interface. Whether you're jotting down a quick idea or planning a detailed project, our platform makes it simple and intuitive.</p>
            </div>
            <div class="box">
                <h2>02</h2>
                <h3>organized Note Management</h3>
                <p>You can keep all your notes neatly organized with customizable categories and tags. Our powerful search and filter options ensure you can find exactly what you need when you need it.</p>
            </div>
            <div class="box">
                <h2>03</h2>
                <h3>Cloud Synchronization</h3>
                <p>Keep all your notes anytime, anywhere with our cloud Synchronization feature. Your notes are securely stored and can be accessed from any device, ensuring you never lose track of your important information.</p>
            </div>
        </div>
    </section>
    <section id="contact">
        <div class="container4">
            <div class="contact_info">
                <div><i class="fas fa-map-marker-alt"></i>Address, City, Country</div>
                <div><i class="fas fa-envelope"></i>contact@email.com</div>
                <div><i class="fas fa-phone"></i>+00 0000 000 000</div>
                <div><i class="fas fa-clock"></i>Mon - Fri 8:00 AM to 5:00 PM</div>
            </div>
            <div class="contact_form">
                <h2>Contact Us</h2>
                <form class="contact" action="" method="post"></form>
                <input type="text" name="name" class="text_box" placeholder="Your Name" required>
                <input type="email" name="email" class="text_box" placeholder="Your Email" required>
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <input type="submit" name="submit" class="send_btn" value="Send">
            </div>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>