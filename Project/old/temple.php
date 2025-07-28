<!DOCTYPE html>
<html lang="en">
<head>
    <title>Temple Inforamation</title>
    <meta charset="utf-8">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="temple.css">   
    <style>
        
        
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .card {
            animation: fadeIn 1s ease-in-out;
        }
        .input-box{
            animation: fadeIn 1s ease-in-out;
        }
    </style>
    
    <script>
        // JavaScript function to handle the search functionality
        function search() {
            var input, filter, cards, card, title, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            cards = document.getElementsByClassName("card");

            // Loop through all temple cards, hide those that do not match the search query
            for (i = 0; i < cards.length; i++) {
                card = cards[i];
                title = card.querySelector(".details h3");
                txtValue = title.textContent || title.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            }
        }

        
    </script>
</head>


<?php include("header.php");?>
<body id="bdt">

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center">
            <h1 class="display-4 text-white animated slideInDown mb-4">TEMPLES</h1>
            <!-- <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Our Team</li>
                </ol>
            </nav> -->
        </div>
    </div>    

    <br><br> <br><br>

        

   <!-- <div class="con2">
   <div class="input-box">
        <i class="uil uil-search"></i>
        <input type="text" id="searchInput" onkeyup="search()" placeholder="Search here...">
        <button class="button" onclick="search()">Search</button>
    </div> -->

        <br><br><br><br><br>
    <br>
    <form method="POST">
    <div class="cardst" >
        <!-- <a href="events.php"> -->
        <!-- <a href="t1.php"> -->
        <div class="card" id="cd1" >
        <!-- <a href="" target="temple" id="more">Read More..</a>  -->
        <a href="t1.php?Srikalahasti_Temple=<?php echo 'Temple Info';?>">
            <div class="container1">
                 <img src="im/3.jpg" alt="las vegas" id="img12"> 
            </div>
            </a>
            <div class="details">
                <h3 style="color:orangered">Srikalahasti Temple</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium dignissimos, minus aperiam adipisci exercitationem.🙏🙏 </p>
                <!-- <a href="t1.php" target="temple" id="rd">Read More...</a> -->
                
            </div>
        </div>
        <!-- </a> -->

        
        <div class="card" id="cd1">
            <a href="t1.php?Tirumala=<?php echo 'Temple Info';?>">
            <div class="container1">
                <img src="temple/Andhra Pradesh/tirumala venkateswara temple tirupati wallpaper/pxfuel (2).jpg" alt="New York" id="img12">
            </div>
            </a>
            <div class="details">
                <h3 style="color:orangered">Tirumala venkateswara temple tirupati</h3>
                <p>The Tirumala Venkateswara Temple, located in Tirupati, Andhra Pradesh, is a renowned Hindu pilgrimage site dedicated to Lord Venkateswara, attracting millions of devotees annually with its rich religious heritage and spiritual significance.🙏🏼🌟</p>
            </div>
        </div>

        <div class="card" id="cd1">
        <a href="t1.php?Parshuram=<?php echo 'Temple Info';?>">

            <div class="container1">
                <img src="temple/Arunachal Pradesh/Parshuram Kund/maxresdefault-1-17.webp" alt="Singapore" id="img12">
            </div>
        </a>    
            <div class="details">
                <h3 style="color:orangered">Parshuram Kund</h3>
                <p>Parshuram Kund is a sacred Hindu pilgrimage site located in the Lohit district of Arunachal Pradesh, India. It is believed to be the spot where the sage Parshuram washed away his sins in the waters of the Brahmaputra River. 🙏🏼💧</p>
            </div>
        </div>

        <div class="card" id="cd1">
        <a href="t1.php?Tawang=<?php echo 'Temple Info';?>">

            <div class="container1">
                <img src="Temple/Arunachal Pradesh/Tawang Monastery/360_F_308687224_dq18ksHywGwnNHApsaXYCp2St8toipgB.jpg" alt="Singapore" id="img12">
            </div>
        </a>
            <div class="details">
                <h3 style="color:orangered">Tawang Monastery</h3>
                <p>Tawang Monastery, also known as Galden Namgey Lhatse Monastery, is a renowned Buddhist sanctuary nestled in the Tawang district of Arunachal Pradesh, India.  Founded in 1680–1681 by Merak Lama Lodre Gyatso, the monastery bears the Tibetan name Gaden Namgyal Lhatse, signifying “the divine paradise of complete victory.” 🏔️🙏</p>
            </div>
        </div>
        

        <div class="card" id="cd1">
        <a href="t1.php?Shirdi=<?php echo 'Temple Info';?>">

            <div class="container1">
                <img src="temple/Maharastra/Shirdi Sai Baba Temple/sai-baba-temple-shirdi.jpg" alt="las vegas" id="img12">
            </div>
        </a>
            <div class="details">
                <h3 style="color:orangered">Shirdi Sai Baba Temple</h3>
                <p>The Shirdi Sai Baba Temple, located in Shirdi, Maharashtra, is a revered pilgrimage site dedicated to the renowned saint Sai Baba. Devotees from around the world visit the temple seeking blessings and spiritual solace from the compassionate and revered figure of Sai Baba.🙏🙏</p>
            </div>
        </div>

        <div class="card" id="cd1">
        <a href="t1.php?Siddhivinayak=<?php echo 'Temple Info';?>">

            <div class="container1">
                <img src="temple/Maharastra/Siddhivinayak Temple/955980594Mumbai_Siddivinayak_Temple_Main.jpg" alt="las vegas" id="img12">
            </div>
        </a>
            <div class="details">
                <h3 style="color:orangered">Siddhivinayak Temple</h3>
                <p>The Siddhivinayak Temple, located in Mumbai, India, is a revered Hindu shrine dedicated to Lord Ganesha, the remover of obstacles. It is one of the most prominent and visited temples in Mumbai, attracting devotees from all walks of life seeking blessings and prosperity.🙏🙏</p>
            </div>
        </div>

        
    </div>
  </div>
</form>

        <h2 class="apagesno" id="tppages">Page1</h2>
    <br><br>
    <div id="tppages">
    <a href="Temple.php"><button class="pagesno">1</button></a>
    <a href="Temple2.php"><button class="pagesno">2</button></a>
    
    
    </div>
    <br><br><br><br><br><br>
    
   
</body>
<?php include 'footer.php';?>



</html>