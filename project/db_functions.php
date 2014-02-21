<?
include_once 'db_access.php';
$SCHEDULE_MONTH_RANGE = 4;

if(isset ($_POST["request"])) {
    $request = $_POST["request"];
    
    switch($request) {
        case "get_schedule":
            if(isset ($_POST["date"])) getSchedule($_POST["date"]);
            break;
    }
}

function getSchedule($dateTxt) {
    global $SCHEDULE_MONTH_RANGE;
    $format = "Y-m-d";
    $firstDayFormat = "Y-m-01";
    $range = round($SCHEDULE_MONTH_RANGE / 2);
    
    $startMonth = date_create_from_format($format, $dateTxt);
    $endMonth = date_create_from_format($format, $dateTxt);
    date_sub($startMonth, date_interval_create_from_date_string($range.' months'));
    date_add($endMonth, date_interval_create_from_date_string(($range + 1).' months'));
    date_sub($endMonth, date_interval_create_from_date_string('1 days'));
    $startMonthTxt = date_format($startMonth, $format);
    $endMonthTxt = date_format($endMonth, $format);
    
    $query="SELECT * FROM reservations WHERE rdate BETWEEN '".$startMonthTxt."' AND '".$endMonthTxt."' ORDER BY rdate,status";
    $result=mysql_query($query);
    $num=mysql_numrows($result);
    mysql_close();
    
    echo '{';
    echo '"start":"'.$startMonthTxt.'",';
    echo '"end":"'.$endMonthTxt.'",';
    echo '"events":[';
    
    $loopMonth = $startMonth;
    $prevEventDateTxt = "";
    $prevStatus = -1;
    $isCloseMonth = false;
    $isCloseDates = false;
    
    for($i=0; $i<$num; $i++){
        $rdate = mysql_result($result,$i,"rdate");
        $status = mysql_result($result,$i,"status");
        
        $eventDate = date_create_from_format($format, $rdate);
        $eventDateTxt = date_format($eventDate, $format);
        if($prevEventDateTxt!=$eventDateTxt) {
            if($eventDate>=$loopMonth) {
                $monthTxt = date_format($loopMonth, $format);
                date_add($loopMonth, date_interval_create_from_date_string('1 months'));
                
                if($eventDate<$loopMonth){
                    if($isCloseMonth) {
                        echo "]";
                        echo "},";
                        echo "]";
                        echo "},";
                    }
                    echo "{";
                    echo '"month":"'.$monthTxt.'",';
                    echo '"dates":[';
                    $isCloseMonth = true;
                    $isCloseDates = false;
                }
                else {
                    $i--;
                    continue;
                }
            }
        
            if($isCloseDates) {
                echo "]";
                echo "},";
            }
            echo "{";
            echo '"date":'.date_format($eventDate, "j").',';
            echo '"items":[';
            $isCloseDates = true;
            $prevEventDateTxt = $eventDateTxt;
            $prevStatus = -1;
        }
        if($prevStatus!=$status) {
            $prevStatus = $status;
            echo '{"status":'.$status.'},';
        }
        if($num>0 && $i==$num-1) {
            echo "]";
            echo "}";
            echo "]";
            echo "}";
        }
    }
    echo ']';
    echo '}';
    
//    for($i=0; $i<$num; $i++){
//        $rdate = mysql_result($result,$i,"rdate");
//        $status = mysql_result($result,$i,"status");
//        
//        $eventDate = date_create_from_format($format, $rdate);
//        $eventDateTxt = date_format($eventDate, $format);
//        if($prevEventDateTxt!=$eventDateTxt) {
//            if($eventDate>=$loopMonth) {
//                $monthTxt = date_format($loopMonth, $format);
//                date_add($loopMonth, date_interval_create_from_date_string('1 months'));
//                
//                if($eventDate<$loopMonth){
//                    if($isCloseMonth) {
//                        echo "]";
//                        echo "},";
//                        echo "<br/>&nbsp;]";
//                        echo "},";
//                    }
//                    echo "<br/>&nbsp;{";
//                    echo '"month":"'.$monthTxt.'",';
//                    echo '"dates":[';
//                    $isCloseMonth = true;
//                    $isCloseDates = false;
//                }
//                else {
//                    $i--;
//                    continue;
//                }
//            }
//        
//            if($isCloseDates) {
//                echo "]";
//                echo "},";
//            }
//            echo "<br/>&nbsp;&nbsp;{";
//            echo '"date":"'.date_format($eventDate, "Y-m-j").'",';
//            echo '"items":[';
//            $isCloseDates = true;
//            $prevEventDateTxt = $eventDateTxt;
//            $prevStatus = -1;
//        }
//        if($prevStatus!=$status) {
//            $prevStatus = $status;
//            echo '{"status":'.$status.'},';
//        }
//        if($num>0 && $i==$num-1) {
//            echo "]";
//            echo "}";
//            echo "<br/>&nbsp;]";
//            echo "}";
//        }
//    }
//    echo '<br/>]';
//    echo '}';
}
?>