<!--  
 * User: Sameer Gurung
 * Email: email@sameergurung.com.np
 * Website: www.sameergurung.com.np
 * Date: 8/4/15
 * Time: 1:15 PM
 -->
<?php 

if(isset($_POST['country'])!=""){
	
	echo "<h3>The submitted values are:</h3>";
	foreach ($_POST as $value) {
		if($value !="")
		echo $value."<br>";
	}
}else{
	echo "No values are selected !!!";
}
?>