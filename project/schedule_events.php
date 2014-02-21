<?
include_once 'db_access.php';
$DATE_FORMAT = "Y-m-d";
$EVENT_STATUS = array("unconfirmed","confirmed","cancelled","done","rejected");

if(isset ($_POST["date"])) {
    $dateTxt = $_POST["date"];
    $date = date_create_from_format($DATE_FORMAT, $dateTxt);
    
    $query="SELECT * FROM reservations WHERE rdate = '".$dateTxt."' ORDER BY status,date";
    $result=mysql_query($query);
    $num=mysql_numrows($result);
    mysql_close();
    
    if($num==0) {
?>
        <div class="head">
            You have <span class="highlight">no scheduled reservations</span> for <?echo date_format($date, "F j, Y")?>.
        </div>
<?  } else {  ?>
        <div class="head">
            <div id="eventDate" class="date"><?echo date_format($date, "F j, Y")?></div>
        </div>
        <div class="items table">
            <?for($i=0;$i<$num;$i++) { ?>
                <div class="row">
                    <?for($j=$i;$j<=$i+1;$j++) { ?>
                        <div class="cell">
                            <? if($j<$num) { 
                                $status = mysql_result($result,$j,"status");
                                $time = date("h:i A", strtotime(mysql_result($result,$j,"time")));
                                $postDate = mysql_result($result,$j,"date");
                                $venue = ucwords(mysql_result($result,$j,"venue"));
                                $persons = mysql_result($result,$j,"persons");
                                $fname = ucwords(mysql_result($result,$j,"fname"));
                                $lname = ucwords(mysql_result($result,$j,"lname"));
                                $mobile = mysql_result($result,$j,"mobile");
                                $email = mysql_result($result,$j,"email");
                            ?>
                                <div class="type color<?echo ucwords($EVENT_STATUS[$status])?>">
                                    <span class="time <?echo $EVENT_STATUS[$status]?>"><?echo $time?></span><?echo $EVENT_STATUS[$status]?>
                                    <span class="posted"><?echo $postDate?></span>
                                </div>
                                <div class="details">
                                    <b><?echo $venue.", ".$persons?> Guests</b><br />
                                    <?
                                        echo $fname." ".$lname."<br />";
                                        echo $mobile."<br />";
                                        echo $email;
                                    ?>
                                </div>
                            <? } ?>
                        </div>
                    <?} $i++; ?>
                </div>
            <? } ?>
        </div>
<?  }
} ?>
           