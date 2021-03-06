<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135754439-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-135754439-3');
    </script>
    <link href="/StyleSheet.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    

    <title>CS5 Grutoring</title>
    <meta name="description" content="Online Grutoring page for Pitzer CS5">
    <meta name="keywords" content="Pitzer, College, Computer, Science, CS, Grutoring, CS5, 5, tutoring">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://www.cs.hmc.edu/twiki/pub/CS5/HMCCS5Skin/alien.png" />
    <?php
    session_start();
    $_SESSION["admin"] = 0;
    
    ?>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script type="text/javascript">
        chatboxDotted = '<ion-icon name="chatbox-ellipses-outline"></ion-icon>';
        chatbox = '<ion-icon name="chatbox-outline"></ion-icon>';

        //refresh() refreshed the data tables with the most updated information
        //  from the db
        function refresh() {
            $.get('/get.php', { noformat: 1}, 
            function(returnedData){
                $('#queue-table tbody').empty();
                returnedData = JSON.parse(returnedData);
                var arrayLength = returnedData.length;

                sectionHasData = false;//keeps track of if data present for selected section

                for (var i = 0; i < arrayLength; i++) {
                    //Do something
                    console.log(returnedData[i]);

                    if (returnedData[i].section == Number($("#sectionList").val())){
                        sectionHasData = true; //selected section has some data
                        if (returnedData[i].in_progress == "1"){
                            $("#queue-table tbody").append('<tr><td><p>'+ returnedData[i].name +'</p></td><td>'+ chatboxDotted +'</td></tr>');
                        }else{
                            $("#queue-table tbody").append('<tr><td><p>'+ returnedData[i].name +'</p></td><td>'+ chatbox +'</td></tr>');
                        }  
                    }
                }

                if (!sectionHasData){
                    $("#queue-table tbody").append('<tr><td><p>Empty!</p></td></tr>');
                }
            })


        }

        ///////// Refreshing timers and focus toggles \\\\\\\\\\\\\\\\

        //init var to true (implied)
        userIsHere=true;

        //When user focuses back on window, refresh and set var
        $(window).focus(function() {
            //refrest if just switched from another window
            userIsHere = true;
        });

        //When user stop focusing, set var
        $(window).blur(function() {
            userIsHere=false;
        });

        //REFRESH TIMER
        (function(){
        //TODO: Is there a way to do this ONLY when user is looking at page
            if (userIsHere){ //only refresh if user isn't here
                refresh(); 
            }
            
        setTimeout(arguments.callee, 10000); //TODO: Get time working
        })();

        
        function setSectionDetails(section){
            section = Number(section);
            if (section == 1){
                    $('#sectionList option[value=1]').attr('selected','selected');
                    $("#queueTitle").text("Pitzer CS5 Gold Queue");
                    $("#hours").html("Sunday, Monday, and Tuesday: 8-10pm PST");
            } else if (section == 2){
                    $('#sectionList option[value=2]').attr('selected','selected');
                    $("#hours").html("<a href='https://docs.google.com/document/d/1qf-CaakB0EPNQc0a8GWiwGvCGhDqbBwUgLe8pon4H_A/edit' target='_blank'>View Hours</a>");
                    $("#queueTitle").text("Mudd CS5 Black Queue");
            }
        };

        //things to do once elements are all loaded ( on submit form, on change course selector)
        $(document).ready(function () {

            //check to see if modal should be loaded
            if (Cookies.get("selectedSectionId") == undefined){
                //no section cookie stored, make user choose
                $("#selection-modal").css("visibility", "visible");
                $("#mainContent").css("filter","blur(5px)");

            }else {
                //section cookie stored, load it and don't show modal
                setSectionDetails(Cookies.get("selectedSectionId"))
                refresh();
                
            }



            $("#submitButton").click(function(event){
                event.preventDefault();
                // disabled the submit button
                $("#btnSubmit").prop("disabled", true);

                $.post("/addtoqueue.php", {name : $("#name").val(), link : $("#link").val(),email: $("#email").val(), section: Number($("#sectionList").val())}, function (data){
                    refresh();
                });
            });

            //refresh on changing of section selector
            $("#sectionList").change(function(test){
                refresh();

                section = Number($("#sectionList").val());

                //set cookie to reflect section change
                Cookies.set("selectedSectionId",section);


                setSectionDetails(section);
                
            })

            $(".mySelector").click(function(event){
                event.preventDefault();
                $("#mainContent").css("filter","");
                $("#selection-modal").css("visibility", "hidden")

                if (Cookies.get("selectedSectionId") == undefined){
                    Cookies.set("selectedSectionId",Number($(this).attr("sectionId")));
                    setSectionDetails(Cookies.get("selectedSectionId"));
                }
                refresh();
            })



        })

        

        

    </script>
    
</head>
<body>

    <div id="selection-modal" style="visibility: hidden" class="modal-window">
  
        <h1>Chose Your Section</h1>

        <p>Welcome to the online CS5 grutoring queue! To start, please select which section of CS5 you are enrolled in.</p>
        
        <div class="selectorContainer">
            <p>I am in:</p>
            <div style="display:inline-block">
                <a class="mySelector mySelectorLeft" sectionId="1">Pitzer CS5 Gold</a>
            </div>
            <div style="display:inline-block">
                <a class="mySelector mySelectorRight" sectionId="2">Mudd CS5 Black</a>
            </div>
        </div>
        
        
    </div>

    <div id="mainContent">
        <div id="title">
            <h1>CS5 Video Grutoring</h1>
            <img class="alien" style="width:80px; height:80px"; src="https://www.cs.hmc.edu/twiki/pub/CS5/HMCCS5Skin/alien.png" onmouseover="this.src='http://stmedia.stimg.co/ctyp_7911c9_spamcan.png?w=800';" onmouseout="this.src='https://www.cs.hmc.edu/twiki/pub/CS5/HMCCS5Skin/alien.png';">
        </div>
        <p id="openStatus"></p>
        <p id="hours">Sunday, Monday, and Tuesday: 8-10pm PST</p>
        

        <div id="queue">
                <select id = "sectionList">
                <option value = "1">Pitzer CS5 - Gold</option>
                <option value = "2">Mudd CS5 - Black</option>
                </select>
                <input type="hidden" id="alt-section" value="<?php if (isset($_GET['section'])){echo($_GET["section"]);}?>" />
            <h2 id="queueTitle" class="header-row">Queue:</h2>

                <table id="queue-table" class="queue-table">
                    <thead>
                    <tr>
                        <th><h3> Name </h3></th>
                        <th><h3> Status </h3></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                    
                </table>    

            <div id="submit-new">
                <form>
                    <input class="myFormInput" type="text" id="name" name="name" placeholder="Name" required></input><br>
                    <input class="myFormInput" type="text" id="email" name="email" placeholder="Email (optional)"></input><br>
                    <input class="myFormInput" type="text" id="link" name="link" placeholder="Link" required></input><br>
                    <input class="myButton" type="submit" id="submitButton" value="Add to queue"/>
                </form>
            </div>

        </div>


        

        <div id="help-window" class="help-window">
                <h2>How to use</h2>
                <h3>1. Create</h3>
                <p>Create new google hangout (you may need an account)</p>
                <a href="https://hangouts.google.com/start" target='_blank'>Click Here!</a>
                <br/>
                <h3>2. Link</h3>
                <p>Click "Copy Link to Share" to copy the link.</p>
                <img style="max-width: 50%" src="https://i.imgur.com/QwSDj6l.png"></img>
                <h3>3. Enter Queue</h3>
                <p>Enter your name(s) and paste in the hangout link</p>
                <h3>4. Wait!</h3>
                <p>Your name should now be visible at the end of the queue. When it is your turn, the grutor/prof will enter your google hangout call!</p>
        </div>

        <div id="tagline">
            <p>
                <a href="http://harrismcc.github.io/">© 2020, Harris McCullers</a>
                - Need help? Email
                <a href="mailto:help@grutoring.com">help@grutoring.com</a>
                - Instructors and Grutors:
                <a href="http://grutoring.com/admin.php">Admin Page</a>
            </p>
        </div>
    </div>

    

    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</body>