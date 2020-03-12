<head>
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
                    //Do something
                    console.log(returnedData[i]);
                    goLink = "<a class='myButton' href='/gotolink.php?link=" + returnedData[i].link +"&id=" + returnedData[i].id + "' target='_blank'>Go</a>";
                    completeLink = $complete = "<a class='myButton' href='/complete.php?id=" + returnedData[i].id + "' id='complete-"+ returnedData[i].id +"'>Complete</a> ";
                    if (returnedData[i].section == Number($("#sectionList").val())){
                        if (returnedData[i].in_progress == "1"){
                            $("#queue-table tbody").append('<tr><td><p>'+ returnedData[i].name +'</p></td><td>'+ chatboxDotted + '</td><td>'+ goLink + '</td><td>'+ completeLink +'</td></tr>');
                        }else{
                            $("#queue-table tbody").append('<tr><td><hp>'+ returnedData[i].name +'</p></td><td>'+ chatbox +'</td><td>'+ goLink +'</td><td>'+ completeLink +'</td></tr>');
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

                $.post("/addtoqueue.php", {name : $("#name").val(), link : $("#link").val()}, function (data){
                    refresh();
                });
            });

            //refresh on changing of section selector
            $("#sectionList").change(function(){
                refresh();
            })
        })

        

    </script>
    
</head>
<body>
    
    <div id="title">
            <h1>Pitzer CS5 Video Grutoring</h1>
    </div>
    <div id="queue">

            <select id = "sectionList">
               <option value = "1">Pitzer CS5 - Gold</option>
               <option value = "2">Mudd CS5 - Black</option>
             </select>


        <h2 class="header-row">Queue:</h2>
        <table id="queue-table" class="queue-table">
            <thead>
                <tr>
                    <th><h3>Name</h3></th>
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