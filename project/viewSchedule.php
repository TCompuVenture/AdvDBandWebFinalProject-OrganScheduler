<?php 
//Start the session...
session_start();
//error reporting to aid in development
error_reporting(E_ALL);
ini_set('display_errors', 1);
//header.
//Need add footer eventually...
$page_title = 'It\'s Timothycated';

//navbar functionally useless for now :(. But, pointless CSS code in there now!
include('../includes_4both/header.php');

//Initial DB connection
require_once("../../mysqli_connect.php");

//Setting up the table to be filled with info.
$bg = '#eeeeee';
$mytime = 0000;
$userSelections = [];
echo '<table width="60%">
<thead>
<tr>
	<th align="left"><strong>Time</strong></th>
	<th align="left"><strong>Event</strong></th>
	<th align="left"><UserID associated with event>UserID</strong></th>
	<th align="left"><strong>Claim / request a time</strong></th>

</tr>
</thead>
<tbody>
';


#This GETS current events from database and adds them to the table.
$startTime = 0; // Time from midnight one to midnight 2.
$endTime = 1440; // 1440 minutes = 24 hours (midnight to midnight)

while ($startTime < $endTime) {
    //Time logic largerly provided by ChatGPT and vetted for accuracy and applicability by me
    $hours = floor($startTime / 60);
    $minutes = $startTime % 60;

    // Format time as HH:MM
    //%02d → Formats the number as a two-digit integer, adding a leading zero if needed.
    //sprintf allows for the formatting of the string nicely.
    $timeString = $timeString = sprintf("%02d:%02d", $hours, $minutes);

    //Selecting all events for organ1 ever for simplicity.
    //TODO: Only select events from TODAY.
    //TODO: Implement more than one organ.
    //$Testq = "SELECT eventTitle FROM eventskeeper WHERE eventID = 1";

    //Fetching based on event TIME..the SAFE WAY
    $q_old = mysqli_prepare($dbc, "SELECT eventTitle FROM eventskeeper WHERE start_time = ?");

    //Q2 does date
    $q = mysqli_prepare($dbc, "SELECT eventTitle, userID FROM eventskeeper WHERE start_time = ? AND eventDate = ?");

    if ($q === false) {
        die("Prepare failed: " . mysqli_error($dbc));
    }

    //Changed from "s" to "ss" to work with the new num of variables, added date
    $currentDate = date('Y-m-d');
    mysqli_stmt_bind_param($q, "ss", $timeString, $currentDate);

    //OLD
    //mysqli_stmt_bind_param($q, "s", $timeString);

    mysqli_stmt_execute($q);
    $r = mysqli_stmt_get_result($q);
    $num = @mysqli_num_rows($r);
    $event = 'Available';
    $userID = '-';

    //Date stored in DB as '2023-12-31'
    //if an event's time matches current time, insert into table.
    if ($num == 1) { // Match was made.
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            $event = $row['eventTitle'];
            $userID = $row['userID'];
        }
    }
    else {
        $event = 'Available';
    }
    //Switch grey / white rows in table
    $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
    //time is stored in DB as 13:05:00
    echo "
    <script>
    //1st iteration: select / save 1 time block for an event into DB at a time. CURRENTLY HERE.

    //2nd iteration:
    //This has gotta save value of 1st checkbox in var1, save value of 2nd in var2.
    //Set 1st checkbox start time, 2nd end. If end before start, error. 
    //If only one selected, set value of end time to half hour from start.
    //if more than 2 checkboxes selected, error (reset checkboxes / saved values would be great...
    //If all good, send values to form.
    //Code for future 2nd iteration:
    //  var cbox1;
    //var cbox2;
    //var whichBox = 0;
    //FUTURE DB problem: If event in between two checkboxes, DON'T overwrite, error.


    function saveIntoForm(checkbox) {
        let row = checkbox.closest('tr');
        let selectedTime = row.querySelector('.time');
        document.getElementById('userTimeSelection').value = selectedTime.textContent;
}
    </script> 
    <tr bgcolor=" . $bg . " id='time.$timeString'>
    	<td align='left' class='time'><p>$timeString</p>
        <td align='left'><p>$event</p>
        <td align='left'><p>$userID</p>
        <td align='left'><input type='checkbox' onclick='saveIntoForm(this)'>	
    </tr>
    ";
    $startTime+=30;
    mysqli_stmt_close($q);
}

//Need figure out where do this: mysqli_stmt_close($stmt);

//Time to check and process user input!
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Did the user supply ALL necessary values?
     if(isset($_POST['user_id'], $_POST['EventTitle'], $_POST['timeSelection'], $_POST['thedate']) &&
     !empty($_POST['user_id']) && 
     !empty($_POST['EventTitle']) && 
     !empty($_POST['timeSelection']) && 
     !empty($_POST['thedate'])) {
        echo "<p style='color: green'>Values all good</p>";
        
        //Prepared query THAT TAKES INTO ACCOUNT DATE AND START_TIME!!!!!
        $q = mysqli_prepare($dbc, "SELECT eventTitle FROM eventskeeper WHERE start_time = ? AND eventDate = ?");
        mysqli_stmt_bind_param($q, "ss", $_POST['timeSelection'], $_POST['thedate']);

        //prepare query
        //$q_old = mysqli_prepare($dbc, "SELECT eventTitle FROM eventskeeper WHERE start_time = ?");
        //mysqli_stmt_bind_param($q, "s", $_POST['timeSelection'], );

        if ($q === false) {
            die("Prepare failed: " . mysqli_error($dbc));
        }

        //NEED MOVE INTO CHECK IF EVENT ALREADY EXISTS!!!
        //Run it. SWAP FOR q2 if wanted!!!!
        mysqli_stmt_execute($q);
        $r = mysqli_stmt_get_result($q);
        $num = @mysqli_num_rows($r);
        if ($num == 1) { // Match was made.
            //For some reason, this no workie..?
            //class="styled-box-para"
            echo('<p style="color: red">Event already exists, buster.</p>');
        } 
        else{
            
        /*      $q = mysqli_prepare($dbc, "INSERT INTO eventskeeper (userID, eventTitle, start_time, end_time, recurrence_details, recurrence_type, organID, eventDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
            if ($q === false) {
                die("Prepare failed: " . mysqli_error($dbc));
            }
            //Need to figure out end time...how add default 30m from now by default?
            mysqli_stmt_bind_param($q, $_POST['user_id'], $_POST['EventTitle'], $_POST['timeSelection'], $_POST['timeSelection'], 'yes', 'one_time', '1', $_POST['thedate']); */
            
            // Prepare SQL statement, the safe way...
            $q = mysqli_prepare($dbc, "INSERT INTO eventskeeper 
                (userID, eventTitle, start_time, end_time, recurrence_details, recurrence_type, organID, eventDate) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?);");

            if ($q === false) {
                die("Prepare failed: " . mysqli_error($dbc));
            }
            //ALL for my above prepared query...
            //Chat did the hard work of assigning all these POSTS to variables so I didn't have to! Also did my magic time calculation. Thanks, chat!
            // Assuming $_POST['timeSelection'] is a time like '14:00'
            $user_id = $_POST['user_id'];
            $event_title = $_POST['EventTitle'];
            $start_time = $_POST['timeSelection'];
            $end_time = date("H:i", strtotime($start_time . " +30 minutes")); // Add 30 minutes. Temp fix till I account for multiple times.
            $recurrence_details = 'na'; //Temp, will be taken in from user in future iteration
            $recurrence_type = 'one_time'; //Temp, will be taken in from user in future iteration
            $organ_id = 1; // Integer, not string. Temp, will be taken in from previous organ selection screen in future iteration
            $event_date = $_POST['thedate']; // Assuming format like '2025-04-13'
            // Bind parameters: s = string, i = integer
            mysqli_stmt_bind_param($q, 'isssssis', 
                $user_id, 
                $event_title, 
                $start_time, 
                $end_time, 
                $recurrence_details, 
                $recurrence_type, 
                $organ_id, 
                $event_date
            );
            mysqli_stmt_execute($q);

            if (mysqli_stmt_affected_rows($q) > 0) { // Insert succesful
                echo("Success!!!! Refresh page to view reservation!");
            } 
            else {
                echo("here we go again...");
            }
            }
        }
    else{
        echo("Either you didn't fill something in or your coding has a little issue.");
    } 

}
?>

<!--Format + display today's date. !-->
<script>
    function formatAndDisplayDate() {
        //Yes, I know I have a TZ issue...
        var today=new Date();
        //Future: Careful with SYSTEM vs. SERVER time...
        var date=today.toISOString().slice(0, 10);
        // Strip last 14 characters, ISO format is like
        // 2012-12-30T17:41:49.027Z but we want
        // 2012-12-30
        return date;
    }
    //This ensures the script is run only AFTER page loads! So its changes are actually displayed.
    //Thanks, Chat...I was stumped.
    document.addEventListener("DOMContentLoaded", function() {
        var theDate = formatAndDisplayDate();
        
        document.getElementById("formDate").value = theDate;
        document.getElementById("datedeclaration").textContent = 'Viewing schedule for ' + theDate;
    });
</script>


<h2 id = 'datedeclaration'>Date will go here.</h2>

<h2>Fill in info, submit to claim a time!</h2>
<p class="styled-boxed-para">Select ONE checkbox.</p>   

<!--Form displayed to user!-->
<form action="" method="post">
    <!--Future: will hide userID slot, fill in from login screen...!-->
	<p>UserID: <input type="int" name="user_id" size="15" maxlength="20" value="<?php if (isset($_POST['user_id'])) echo $_POST['user_id']; ?>"></p>
	The time the user has selected shows up here. Future, will hide this.
    <p><input type="text" name="timeSelection" placeholder="automatic fillin" value="<?php if (isset($_POST['timeSelection'])) echo $_POST['timeSelection']; ?>" id="userTimeSelection"></p>
    <p><input type="text" name="thedate" placeholder="automatic fillin" id="formDate" value="2025-01-01" id="userTimeSelection"></p>
    <p><input type="text" name="EventTitle" placeholder="input_title" id="eventName"></p>
    <!--
    For future iteration:
    <p><input type="text" name="End Time" placeholder="noTime" value="" id="endTime"></p> 
    !-->
    <p><input type="submit" name="submit" value="Submit!!!"></p>
</form>

<!--I do not know why this appears above the form. Future problem!-->
<h1>Testing...in future, this should be BELOW table.</h1>

    </body>
</html>