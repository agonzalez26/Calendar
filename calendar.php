<?php
echo "<body>";
	session_start();
	echo "WELCOME BACK ".  $_SESSION['user'];

// Set your timezone!!
date_default_timezone_set("America/New_York");
$focus = 0;
// Get prev & next month
if (isset($_POST['ym'])) {
	$ym = $_POST['ym'];
	if(isset($_POST['focus']))
		$focus = $_POST['focus'];
	else $focus = 10;
} else {
	// This month and year
	$ym = date('Y-m');
}
//sets the current local time
$timestamp = strtotime($ym);
if ($timestamp === false) {
	$timestamp = time();
}
//echo $timestamp;
//todays date
$today = date("Y-m-j");
//$today = date('Y/m/d', mktime(0, 0, 0, date('m', $timestamp)+$focus, 1, date('Y', $timestamp)));
$html_title = date('m / Y', $timestamp);//display of the month and year
// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m-j', mktime(0, 0, 0, date('m', $timestamp)-1+$focus, 1, date('Y', $timestamp)));
$next = date('Y-m-j', mktime(0, 0, 0, date('m', $timestamp)+1+$focus, 1, date('Y', $timestamp)));
// Number of days in the month
$day_count = date('t', $timestamp);
// echo "number of days:" .$day_count. "<br> "; //works
// echo "next month: ". $next . "<br>"; //works
// echo "prev month: ". $prev . "<br>"; //works
// echo "todays month: ". $today . "<br>";
//echo $prev;
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
//echo $str;
// Create Calendar!!
$weeks = array();
$week = '';
// Add empty cell
$week .= str_repeat('<td></td>', $str);
for ($day = 1; $day <= $day_count; $day++, $str++) {//from the count of the months
	$date = $ym.'-'.$day. "  ";
	//$crap = $today == $date;
//	echo $today . "<br>";
	if ($today == $date) {
	//	echo "cheese"; //not working
		$week .= '<td class="today">'. $day . '</td>';
	} else {
		$week .= '<td>'. $day . "</td>";
	}
	$week;// .= '</td>';
	// End of the week OR End of the month
	if ($str % 7 == 6 || $day == $day_count) {
		if($day == $day_count) {
			// Add empty cell
			$week .= str_repeat('<td></td>', 6 - ($str % 7));
		}
		$weeks[] = '<tr>'.$week.'</tr>';//array of the weeks
		// Prepare for new week
		$week = '';
	}
}
?>
	<div id="contents1">
		<!--introduction to the calendar-->
  <h1 id="header">Welcome to the Calendar</h1>
	<div class="calendar">
		<!--to navigate the months-->
		<h3 id="navigation">
		<script>//ajax portion to change the months of the calendar
		 $(document).ready(function(){
			 	//to go to the previous month
         $("#idprev").click(function(){
           $.ajax({
             type:'POST',
             data: {
             	ym: '<?php echo $prev; ?>',//dislays previous month
             	focus: '<?php echo $focus; ?>'
             },
             url:"calendar.php",
             success: function(data){
               $("#contents").html(data);//displays the prev month on the page
             },
             error: function(data) {//if there is an error
             	alert('ERROR');
             }
           });
         });
				 //to go to the next month
         $("#idnext").click(function(){
           $.ajax({
             type:'POST',
             data: {
             	ym: '<?php echo $next; ?>',//displays the next month
             	focus: '<?php echo $focus; ?>'
             },
             url:"calendar.php",
             success: function(data){//displays the next month on the page
               $("#contents").html(data);
             },
             error: function(data) {//if there is an error
             	alert('ERROR');
             }
           });
         });
				//
	

        });

		</script><!--button that will open the calendar.php on the same page using ajax-->

		<br>
			<button id="idprev">&lt;</button> <?php echo $html_title; ?><button id="idnext">&gt;</button></h3>
		<br><table class="table"><!--displays the calendar-->
			<!--days of the month-->

			<tr><th>Sunday</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th></tr>
      <!--Will display the rows of the weeks for the month-->
			<?php
				foreach ($weeks as $week) {
					echo $week;
				}
			?>
		</table>
	</div>
</div>
			<div style="display:inline-block;text-alignleft;font-size:30px;"><a href="logout.php?logout">&nbsp;LOGOUT</a><div>
			</body>

<style>
.today{
	background-color: pink;
}
</style>
