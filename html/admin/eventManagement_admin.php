<?php
    session_start();
    $_SESSION['del_event_id'] = "";
    $_SESSION['edit_event_id'] = "";

    if (isset($_POST['change']))
    {
        $del_event_id = $_POST['btn_delete'];
        $edit_event_id = $_POST['btn_edit'];
    }

?>

<html>

<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../../css/admin/eventManagement_admin.css" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body class="grey lighten-4">
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../../js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../../js/materialize.min.js"></script>



    <ul id="nav-mobile" class="side-nav fixed sideNav">
        <br>
        <br>
        <li class="bold"><a href="profile_admin.php" class="waves-effect waves-teal">Profile</a></li>
        <li class="bold"><a href="issueManagement_admin.php" class="waves-effect waves-teal">Issues</a></li>
        <li class="bold"><a href="groupManagement_admin.php" class="waves-effect waves-teal">Groups</a></li>
        <li class="bold"><a href="eventManagement_admin.php" class="waves-effect waves-teal">Events</a></li>
    </ul>



    <div class="mainContainer">
        <nav class="indigo darken-2 topNavBar">

            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="#!" class="breadcrumb">Admin</a>
                    <a href="#!" class="breadcrumb">Event Management</a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="sass.html">Home</a></li>
                        <li><a class="waves-effect waves-light btn">Logout</a></li>
                    </ul>
                </div>
            </div>


        </nav>

        <div id="page_title">
            <h4>Events</h4>
        </div>

        <div id="fab_add">
            <button class="btn-floating btn-large waves-effect waves-light red right" id="fab_add"><i class="material-icons">add</i></button>
        </div>

        <div class="formContainer card">

            <!-- hidden form to invoke delete action -->
            <form id="deleteIssueForm" method="post" action="deleteEvent.php">
                <input type="hidden" value="'.$issueID.'" name="issueID" />
            </form>

            <!-- hidden form to invoke edit action -->
            <form id="deleteIssueForm" method="post" action="editEvent.php">
                <input type="hidden" value="'.$issueID.'" name="issueID" />
            </form>

            <form class="col s12 l12 m6">

                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                            <th data-field="id">Name</th>
                            <th data-field="name">Status</th>
                            <th data-field="price">Date</th>
                            <th data-field="action"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                            $conn = new mysqli('localhost','ske','ske','skecomplaints');
                            if(! $conn)
                            {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "SELECT * FROM events";
                            $result = $conn->query($sql);

                            // output data of each row
                            while($row = $result->fetch_assoc()){
                                //Creates a loop to loop through results
                                $Event_ID = $row["Event_ID"];
                                $Event_Name = $row["Event_Name"];
                                $Start_Date = $row["Start_Date"];
                                $End_Date = $row["End_Date"];
                                $Locations	= $row["Locations"];
                                $Group_ID = $row["Group_ID"];
                                $Address_ID = $row["Address_ID"];
                                $User_ID = $row["User_ID"];
                                $Status = $row["Status"];

                                echo '
                                <tr id="'.$Event_ID.'">
                                    <form action = "../../php/del.php" method = "post">
                                        <input type = "hidden" value = "'.$Event_ID.'" />
                                    </form>
                                    <td>'.$Event_ID.'</td>
                                    <td>'.$Status.'</td>
                                    <td>'.$Start_Date.'</td>
                                    <td>
                                        <button class="btn-floating modal-trigger btn-small waves-effect waves-light blue btn_delete" type = "submit"><i class="material-icons">delete</i></button>
                                        <a class="btn-floating btn-small waves-effect waves-light red btn_edit"><i class="material-icons">mode_edit</i></a>
                                    </td>
                                </tr>
                                '; // echo end

                            }

                        ?>

                        <!-- <tr>
                            <td>Alvin</td>
                            <td>Setup</td>
                            <td>MM/DD/YY</td>
                            <td>
                                <a class="btn-floating btn-small waves-effect waves-light blue btn_delete"><i class="material-icons">delete</i></a>
                                <a class="btn-floating btn-small waves-effect waves-light red btn_edit"><i class="material-icons">mode_edit</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Alan</td>
                            <td>Setup</td>
                            <td>MM/DD/YY</td>
                            <td>
                                <a class="btn-floating btn-small waves-effect waves-light blue btn_delete"><i class="material-icons">delete</i></a>
                                <a class="btn-floating btn-small waves-effect waves-light red btn_edit"><i class="material-icons">mode_edit</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Jonathan</td>
                            <td>Closed</td>
                            <td>MM/DD/YY-MM/DD/YY</td>
                            <td>
                                <a class="btn-floating btn-small waves-effect waves-light blue btn_delete"><i class="material-icons">delete</i></a>
                                <a class="btn-floating btn-small waves-effect waves-light red btn_edit"><i class="material-icons">mode_edit</i></a>
                            </td>
                        </tr> -->
                    </tbody>
                </table>

            </form>
        </div>

        <!-- DELETE TILL HERE -->
    </div>
    <script>
        $(document).ready(function() {
            $('select').material_select();
        });

        // function to set ids of all <tr>, #btn_edit and #btn_delete
        $(function){
            $tr = $('tr');
            for (i=0;i<array.length;i++) {
                $tr.append($('<tr/>', {
                    id:    'tr'+i,
                    html:  array[i]
                }));
            }

            $btn_edit = $('.btn_edit');
            for (i=0;i<array.length;i++) {
                $btn_edit.append($('<a/>', {
                    id:    'btn_edit'+i,
                    html:  array[i]
                }));
            }

            $btn_delete = $('.btn_delete');
            for (i=0;i<array.length;i++) {
                $btn_delete.append($('<a/>', {
                    id:    'btn_delete'+i,
                    html:  array[i]
                }));
            }
        }

        $('.btn_edit').click(function(){
            // set user id to whatever is clicked and redirect to edit page
            $idClicked = e.target.id;
            $.post("eventManagement_admin.php", {change: $(edit_event_id).val()},
                function (data)
                {
                    if exists($_POST['edit_event_id']) {
                        $edit_event_id = $_POST['$idClicked'];

                        //change value in session variable
                        //redirect page
                    }
                });
            });

        $('.btn_delete').click(function(){
            // set user id to whatever is clicked and delete from database
            $idClicked = e.target.id;
            $.post("eventManagement_admin.php", {change: $(edit_event_id).val()},
                function (data)
                {
                    if exists($_POST['edit_event_id']) {
                        $edit_event_id = $_POST['$idClicked'];
                        //change value in session variable
                        //row from database
                    }
                });
        });

    </script>
</body>

</html>