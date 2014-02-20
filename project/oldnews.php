

<?php 

include 'header.php';
mysql_connect("127.0.0.1","root","");
mysql_select_db("grille");

$per_page = 2;


$pages_query = "SELECT COUNT('id) from news";
$pages = ceil(mysql_result($pages_query,0)/$per_page);



if (!isset($_GET['page'])) {
 header("location: news.php?page=1");
}
else
{
 $page = $_GET['page'];
}
$start = (($page - 1)*$per_page);
$query = mysql_query("SELECT * FROM news LIMIT $start,$per_page ");
while($row = mysql_fetch_assoc($query))
{
$x = $row['descrition'];
echo "$x<br>";
}
for($number=1; $number <= $pages; $number++)
{
echo '<a href="?page='.$number.'">'.$number.'</a>';
}
echo "<br> Current Page: $page";
?>
			
						
        </div>
		
        </center>
    </body>
</html>