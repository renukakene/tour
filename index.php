<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventour</title>
    <link rel="icon" href="./assets/files/logo.png">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/reg.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/nav.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="./assets/css/chat.css">
</head>

<body>

    <!-- Background Video & Header -->

    <div class="banner">
        <video src="./assets/files/bgvid.mp4" type="video/mp4" autoplay muted loop></video>

        <!-- Header -->
        

        <div class="content" id="home">
            <?php
            session_start();
            ?>
            <!-- At the top of your file -->
            
            <!-- Then update the navigation -->
  
            <?php include 'includes/navbar.php'; ?>

            <div class="title">
                <h1>ADVENTOUR</h1>
                <br><br>
                <p>See the World for Less! Explore Amazing Destinations with Our Budget-Friendly Packages.  </p>

               
                      <br><br>
                       
                        <br><br>
                
            
            </div>
        </div>
    </div>

   

    <!-- Packages -->

    <section class="package" id="package">
        <div class="package-title">
            <h2>Packages</h2>
        </div>

        <div class="package-content">
            <div class="text-block">
                <h4>MAKE YOUR CHOICE</h4>
            </div>

            <a href="india.php">
                <div class="box">
                    <div class="image">
                        <img src="./assets/files/tajmahal.jpg" alt="">
                        <h4>Indian Tours</h4>
                    </div>
                </div>
            </a>

            <a href="global.php">
                <div class="box">
                    <div class="image">
                        <img src="./assets/files/paris.jpg" alt="">
                        <h4>Global Tours</h4>
                    </div>
                </div>
            </a>


        </div>
    </section>
      <!-- Services -->

    <section class="container">
        <div class="text">
            <h2>We have the best services available for you!</h2>
        </div>
        <div class="rowitems">

            <div class="container-box">
                <div class="container-image">
                    <img src="./assets/files/1a.jpg" alt="Flight Services">
                </div>
                <h4>Flight Services</h4>
                <p>Arrival and Departure</p>
            </div>

            <div class="container-box">
                <div class="container-image">
                    <img src="./assets/files/2a.jpg" alt="Food Services">
                </div>
                <h4>Food Services</h4>
                <p>Catering</p>
            </div>

            <div class="container-box">
                <div class="container-image">
                    <img src="./assets/files/3a.jpg" alt="Travel Services">
                </div>
                <h4>Travel Services</h4>
                <p>Pick-up/drop</p>
            </div>

            <div class="container-box">
                <div class="container-image">
                    <img src="./assets/files/4a.jpg" alt="Hotel Services">
                </div>
                <h4>Hotel Services</h4>
                <p>Check-in/out</p>
            </div>
        </div>
    </section>


   

    <!-- Locations -->

    <section class="locations" id="locations">
        <div class="package-title">
            <h2>Top Destinations</h2>
        </div>

        <div class="location-content">
            <a href="./locations.html">
                <div class="col-content">
                    <img src="./assets/files/l1.jpg" alt="">
                    <h5>India</h5>
                    <p>Kashmir</p>
                </div>
            </a>

            <a href="./locations.html#istanbul">
                <div class="col-content">
                    <img src="./assets/files/l2.jpg" alt="">
                    <h5>Turkey</h5>
                    <p>Istanbul</p>
                </div>
            </a>

            <a href="./locations.html#paris">
                <div class="col-content">
                    <img src="./assets/files/l3.jpg" alt="">
                    <h5>France</h5>
                    <p>Paris</p>
                </div>
            </a>

            <a href="./locations.html#bali">
                <div class="col-content">
                    <img src="./assets/files/l4.jpg" alt="">
                    <h5>Indonesia</h5>
                    <p>Bali</p>
                </div>
            </a>

            <a href="./locations.html#dubai">
                <div class="col-content">
                    <img src="./assets/files/l5.jpg" alt="">
                    <h5>United Arab Emirates</h5>
                    <p>Dubai</p>
                </div>
            </a>

            <a href="./locations.html#geneva">
                <div class="col-content">
                    <img src="./assets/files/l6.jpg" alt="">
                    <h5>Switzerland</h5>
                    <p>Geneva</p>
                </div>
            </a>

            <a href="./locations.html#port-blair">
                <div class="col-content">

            <!-- Chatbot Interface -->
           
                    <img src="./assets/files/l7.jpg" alt="">
                    <h5>Andaman & Nicobar</h5>
                    <p>Port Blair</p>
                </div>
            </a>

            <a href="./locations.html#port-blair">
                <div class="col-content">
                    <img src="./assets/files/london.jpeg" alt="">
                    <h5>United Kingdom</h5>
                    <p>London</p>
                </div>
            </a>

            <a href="./locations.html#port-blair">
                <div class="col-content">
                    <img src="./assets/files/newyork.jpeg" alt="">
                    <h5>United States</h5>
                    <p>New York</p>
                </div>
            </a>
        </div>
    </section><br><hr>

   <!-- Destinations -->

  <section><br>
        <div class="destination-title">
            <h2>Best Destinations to Visit in India</h2>
        </div>
         <div class="container1">
            <style>
                .destination-title {
                    text-align: center;
                }

                .container1 {
                    display: grid;
                    position: relative;
                    grid-template-columns: auto auto auto;
                    background: color #f6f1f1;
                    padding: 48px;
                    font-size: 12px;
                    gap: 10px;
                    margin-top: 5px;
                    margin-left: 100px;
                    margin-right: 100px;
                    margin-bottom: 1px;

                    .loc-detail li {
                        font-size: 10px;
                        color: black;
                        margin-left: 15px;
                        margin-bottom: 2px;
                        list-style-type: circle;
                    }

                    .box {
                        background: inherit;
                        color: black;
                        box-shadow: 5px 5px 10px #3b3737;
                        padding: 5px;
                        border-radius: 15px;
                    }
                }
            </style>

            <div class="box">
                <h1>Goa</h1>
                <p>The unofficial party place of India, Goa is more than that. It has a great legacy, history and
                    culture that are yet to be explored. But if beaches are what you are looking for, then the state
                    has that too. And that's why, India tours to Goa are a great option to explore the place,
                    according to your interests. Goa holiday packages are also popular because Goa is one of the top
                    places in the world when it comes to nightlife. Find several exciting tour packages and other
                    India holiday packages that let you try Goa's melange of watersports and other fun activities.
                    <br>
                    <br><b>Best time to visit :</b> November to February <br>

                    <br> <b>Best places to visit:</b>
                <ul class="loc-detail">
                    <li>Calangute</li>
                    <li>Baga</li>
                    <li>Anjuna</li>
                    <li> Miramar</li>
                    <li> Palolem</li>
                    <li> Panjim</li>
                </ul>

                <br> You can also include the offbeat Patnem Beach in your holiday tour packages, since it was
                listed amongst one of Asia's top 20 beaches.
                </p>
            </div>

            <div class="box">
                <h1>
                    Kerala
                </h1>
                <p>God's own country, Kerala has been a popular tourist destination in India. You can explore it all
                    with India tours to this marvellous destination. With suitable tour packages, you can discover
                    scenic seaside destinations and hill stations in Kerala. <br>
                    <br> <b>Best time to visit:</b> September to March <br>

                    <br> <b>Best places to visit:</b>
                <ul class="loc-detail">
                    <li>Sree Padmanabhaswamy Temple</li>
                    <li> Francis CSI Church</li>
                    <li> Paradesi Synagogue</li>
                    <li> Eravikulam National Park
                        Varkala Beach</li>
                    <li>Athirappilly Waterfalls</li>
                </ul>
                <br>

                <br>
                If you are planning India holiday packages in the state, then you must not miss out on its
                lip-smacking cuisine as well. Check your holiday tour packages and book accordingly.</p>

            </div>

            <div class="box">
                <h1>Kashmir</h1>
                <p>
                    For decades, the Kashmir valley has attracted tourists from all over the world. If you can't
                    plan a vacation on your own, you should check out India tours for Kashmir to help you with an
                    unforgettable holiday. With the right all India tour packages, you can discover lush green
                    valleys, snow-covered peaks and gorgeous wildlife. Your trip packages must include the Chenab,
                    Sindh and Lidder valleys. Don't forget to buy a world-famous Kashmiri shawl and one-of-a-kind
                    handicrafts for your loved ones. <br>
                    <br> <b> Best Time to Visit:</b> March to August <br>

                    <br> Best Places to Visit: <br>
                <ul class="loc-detail">
                    <li>Gulmarg</li>
                    <li> Srinagar</li>
                    <li> Dal Lake</li>
                    <li> Sonamarg</li>
                    <li> Indira Gandhi Tulip Garden</li>
                </ul>
                <br>
                <br> These places should be included in the best tour packages for Kashmir. Find travel packages to
                suit all needs and you can also find exquisite honeymoon packages, since Kashmir is an ethereal
                destination for a picture-perfect Indian honeymoon.</p>
            </div>

            <div class="box">
                <h1>Sikkim</h1>
                <p>If you are looking for an Indian destination that is fit for a world tour package, then look no
                    further than Sikkim. You can plan amazing India tours to this mountain marvel, which is home to
                    the country's highest peak, Kanchenjunga. It is certainly a great destination for quality
                    international tour packages. Check out Sikkim tour packages for a trip to this charming Indian
                    state. <br>
                    <br> <b>Best Time to Visit:</b> March to May <br>

                    <br> Best Places to Visit:
                <ul class="loc-detail">
                    <li> Gangtok</li>
                    <li> Nathu La Pass</li>
                    <li> Tsomgo Lake</li>
                    <li> Rumtek Monastery</li>
                </ul>
                </p>
            </div>

            <div class="box">
                <h1>Shimla</h1>
                <p> Shimla, the Queen of the Hills, is the stuff that dreamy India tours are made of! Shimla is a
                    great
                    destination for international honeymoon packages, with its pristine landscape, mountains,
                    greenery
                    and romantic weather. A Shimla tour also means checking out the delightful cafes and eateries
                    here. <br>

                    <br> <b>Best Time to Visit:</b> May to June/December to January <br>

                    <br> Best Places to Visit:
                <ul class="loc-detail">
                    <li>The Ridge</li>
                    <li> Green Valley</li>
                    <li> Mall Road</li>
                    <li> Jakhoo Hill</li>
                </ul>
                </p>
            </div>

            <div class="box">
                <h1> Uttarakhand</h1>
                <p> There are many India tours which keep Uttarakhand at the forefront and why not? The state is
                    blessed with unmatched natural beauty. Find Uttarakhand tour packages covering several popular
                    destinations. The state offers the right mix of spirituality, trekking, adventure, beautiful
                    mountain landscapes and welcoming locals. <br>

                    <br> <b> Best time to visit:</b> March to April/September to October <br>

                    <br> Best places to visit:
                <ul class="loc-detail">
                    <li> Dehradun</li>
                    <li> Mussoorie</li>
                    <li> Nainital</li>
                    <li> Auli</li>
                    <li> Rishikesh</li>
                </ul>
                </p>

            </div>
        </div>
  </section>
  <div class="chatbot-container">
                <div class="chat-icon" onclick="toggleChat()">
                    <i class='bx bx-message-dots'></i>
                </div>
                <div class="chat-modal" id="chatModal">
                    <div class="chat-header">
                        <h4>Travel Assistant</h4>
                        <button onclick="toggleChat()"><i class='bx bx-x'></i></button>
                    </div>
                    <div class="chat-messages" id="chatMessages">
                        <div class="message bot">
                            <p>Hello! How can I help you plan your perfect trip?</p>
                        </div>
                    </div>
                </div>
            </div>

        <style>
            .chatbot-container {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
            }

            .chat-icon {
                background: #47addd;
                width: 60px;
                height: 60px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                transition: transform 0.3s ease;
            }

            .chat-icon:hover {
                transform: scale(1.1);
            }

            .chat-icon i {
                color: white;
                font-size: 30px;
            }

            .chat-modal {
                position: fixed;
                bottom: 100px;
                right: 20px;
                width: 300px;
                background: white;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                display: none;
                overflow: hidden;
            }

            .chat-header {
                background: #47addd;
                color: white;
                padding: 15px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .chat-header h4 {
                margin: 0;
                font-size: 16px;
            }

            .chat-header button {
                background: none;
                border: none;
                color: white;
                cursor: pointer;
                font-size: 20px;
            }

            .chat-messages {
                padding: 15px;
                height: 300px;
                overflow-y: auto;
            }

            .message {
                margin-bottom: 10px;
                max-width: 80%;
            }

            .message.bot {
                background: #f0f0f0;
                padding: 10px;
                border-radius: 10px;
            }

            .message.bot p {
                margin: 0;
                color: #333;
            }
            </style>

            <script>
            function toggleChat() {
                const modal = document.getElementById('chatModal');
                modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
            }
            </script>
  

   <!-- Footer -->
   <?php include 'includes/footer.php'; ?>

 
     <SCRIPT type="text/javascript">
        function JavaBlink() {
           var blinks = document.getElementsByTagName('JavaBlink');
           for (var i = blinks.length - 1; i >= 0; i--) {
              var s = blinks[i];
              s.style.visibility = (s.style.visibility === 'visible') ? 'hidden' : 'visible';
           }
           window.setTimeout(JavaBlink, 500);
        }
        if (document.addEventListener) document.addEventListener("DOMContentLoaded", JavaBlink, false);
        else if (window.addEventListener) window.addEventListener("load", JavaBlink, false);
        else if (window.attachEvent) window.attachEvent("onload", JavaBlink);
        else window.onload = JavaBlink;
     </SCRIPT>
    <script src="./assets/js/chat.js"></script>
</body>

</html>
