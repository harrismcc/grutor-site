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
    
    

    <?php
        session_start();
        if (!$_SESSION["admin"]){
            header("Location: http://" . $_SERVER['HTTP_HOST'] . "/login.php");
        }
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

                    //handle potential lack of "http://"
                    if (returnedData[i].link.indexOf("http://") == -1 && returnedData[i].link.indexOf("https://") == -1){
                        link = "http://" + returnedData[i].link
                    } else{
                        link = returnedData[i].link
                    }
                    
                    goLink = "<a class='myButton goButton' href='" + link +"' request-id='" + returnedData[i].id + "' target='_blank'>Go</a>";
                    completeLink  = "<a class='myButton completeButton' request-id='"+ returnedData[i].id +"'>Complete</a> ";
                    
                    email = returnedData[i].email;
                    if (email == null){
                        email = "None"
                    }
                    if (returnedData[i].section == Number($("#sectionList").val())){
                        if (returnedData[i].in_progress == "1"){
                            $("#queue-table tbody").append('<tr><td><p>'+ returnedData[i].name +'</p></td><td><p>'+ email +'</p></td><td>'+ chatboxDotted + '</td><td>'+ goLink + '</td><td>'+ completeLink +'</td></tr>');
                        }else{
                            $("#queue-table tbody").append('<tr><td><p>'+ returnedData[i].name +'</p></td><td><p>'+ email +'</p></td><td>'+ chatbox +'</td><td>'+ goLink +'</td><td>'+ completeLink +'</td></tr>');
                        }  
                    }
                }

                //Complete button listner
                $(".completeButton").click(function(){
                    event.preventDefault();
                    $.get("/complete.php", {id : $(this).attr("request-id")}, function (data){
                        refresh();
                    })
                })

                //goto button listner
                $(".goButton").click(function(){
                    //event.preventDefault();
                    $.get("/gotolink.php", {id : $(this).attr("request-id")}, function (data){
                        refresh()
                    })
                })

                
            })
        }



        (function(){
        // do some stuff 
            refresh(); 
        setTimeout(arguments.callee, 5000); //TODO: Get time working
        })();


        $(document).ready(function () {
            $("#submitButton").click(function(event){
                event.preventDefault();

                // disabled the submit button
                $("#btnSubmit").prop("disabled", true);

                $.post("/addtoqueue.php", {name : $("#name").val(), link : $("#link").val()}, function (data){
                    refresh();
                });
            });

            //refresh on changing of section selector
            $("#sectionList").change(function(){
                section = Number($("#sectionList").val());
                if (section == 1){
                    $("#queueTitle").text("Pitzer CS5 Gold Queue")
                } else if (section == 2){
                    $("#queueTitle").text("Mudd CS5 Black Queue")
                }
                refresh();
            })

            
        })

        

    </script>
    
</head>
<body>
    
    <div id="title">
            <h1>CS5 Video Grutoring - Grutor Portal</h1>
    </div>
    <div style="max-width:70%">
        <p>Please connect to the student at the top of the queue by clicking Go.  Wait until the connection is established and then click Complete to remove the student from the queue.</p>
    
    </div>
    <div id="queue">

            <select id = "sectionList">
               <option value = "1">Pitzer CS5 - Gold</option>
               <option value = "2">Mudd CS5 - Black</option>
             </select>


        <h2 id="queueTitle" class="header-row">Pitzer CS5 Gold Queue</h2>
        <table id="queue-table" class="queue-table">
            <thead>
                <tr>
                    <th><h3>Name</h3></th>
                    <th><h3>Email</h3></th>
                    <th><h3>In Progress</h3></th>
                    <th><h3>Go</h3></th>
                    <th><h3>Complete</h3></th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            
        </table>
    </div>


    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</body>