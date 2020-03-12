<head>
    <link href="/StyleSheet.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Pitzer Grutoring</title>
    <meta name="description" content="Online Grutoring page for Pitzer CS5">
    <meta name="keywords" content="Pitzer, College, Computer, Science, CS, Grutoring, CS5, 5, tutoring">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://www.cs.hmc.edu/twiki/pub/CS5/HMCCS5Skin/alien.png" />
    <?php
    session_start();
    $_SESSION["admin"] = 0;
    
    ?>

    <script type="text/javascript">
        chatboxDotted = '<ion-icon name="chatbox-ellipses-outline"></ion-icon>';
        chatbox = '<ion-icon name="chatbox-outline"></ion-icon>';


        function refresh() {
            $.get('/get.php', { noformat: 1}, 
            function(returnedData){
                $('#queue-table tbody').empty();
                returnedData = JSON.parse(returnedData);
                
                var arrayLength = returnedData.length;

                for (var i = 0; i < arrayLength; i++) {
                    //Do something
                    console.log(returnedData[i]);

                    if (returnedData[i].section == Number($("#sectionList").val())){
                        if (returnedData[i].in_progress == "1"){
                            $("#queue-table tbody").append('<tr><td><p>'+ returnedData[i].name +'</p></td><td>'+ chatboxDotted +'</td></tr>');
                        }else{
                            $("#queue-table tbody").append('<tr><td><p>'+ returnedData[i].name +'</p></td><td>'+ chatbox +'</td></tr>');
                        }  
                    }
                }

                
            })
        }



        (function(){
        // do some stuff 
            refresh(); 
        setTimeout(arguments.callee, 10000); //TODO: Get time working
        })();


        $(document).ready(function () {
            $("#submitButton").click(function(event){
                event.preventDefault();
                // disabled the submit button
                $("#btnSubmit").prop("disabled", true);

                alert("Thing: " + Number($("#sectionList").val()));
                $.post("/addtoqueue.php", {name : $("#name").val(), link : $("#link").val(), section: Number($("#sectionList").val())}, function (data){
                    refresh();
                });
            });

            //refresh on changing of section selector
            $("#sectionList").change(function(test){
                refresh();

                section = Number($("#sectionList").val());
                if (section == 1){
                    $("#hours").html("Sunday, Monday, and Tuesday: 8-10pm PST")
                } else if (section == 2){
                    $("#hours").html("Funday, Shmursday: 8-10pm PST")
                }
                
            })

            $("close-help").on("click", function(){
                alert("test")
            })


        })

        

        

    </script>
    
</head>
<body>
    <div id="title">
        <h1>Pitzer CS5 Video Grutoring</h1>
        <img class="alien" style="width:80px; height:80px"; src="https://www.cs.hmc.edu/twiki/pub/CS5/HMCCS5Skin/alien.png" onmouseover="this.src='http://stmedia.stimg.co/ctyp_7911c9_spamcan.png?w=800';" onmouseout="this.src='https://www.cs.hmc.edu/twiki/pub/CS5/HMCCS5Skin/alien.png';">
    </div>
    <p id="hours">Sunday, Monday, and Tuesday: 8-10pm PST</p>
    

    <div id="queue">
            <select id = "sectionList">
               <option value = "1">Pitzer CS5 - Gold</option>
               <option value = "2">Mudd CS5 - Black</option>
             </select>
        <h2 class="header-row">Queue:</h2>

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
                <input class="myFormInput" type="text" id="link" name="link" placeholder="Link" required></input><br>
                <input class="myButton" type="submit" id="submitButton" value="Add to queue"/>
            </form>
        </div>

    </div>


    

    <div id="help-window" class="help-window">
            <h2>How to use</h2>
            <h3>1. Create</h3>
            <p>Create new google hangout (you may need an account)</p>
            <a href="https://hangouts.google.com/" target='_blank'>Click Here!</a>
            <br/>
            <h3>2. Link</h3>
            <p>Click "Copy Link to Share" to copy the link. Make sure that this is the 'share' link, it will be different than the url at the top of your browser window.</p>
            <img style="max-width: 50%" src="https://i.imgur.com/QwSDj6l.png"></img>
            <h3>3. Enter Queue</h3>
            <p>Enter your name(s) and paste in the hangout link</p>
            <h3>4. Wait!</h3>
            <p>Your name should now be visible at the end of the queue. When it is your turn, the grutor/prof will enter your google hangout call!</p>
    </div>

    <div id="tagline">
        <a href="http://harrismcc.github.io/">© 2020, Harris McCullers</a>
    </div>

    

    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</body>