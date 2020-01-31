<?php
	$myName = "Taavi Lepiko";
	$fullTimeNow = date("d.m.Y H:i:s");
	//<p>Lehe avamise hetkel oli: <strong>31.01.2020 11:32:07</strong></p>
	$timeHTML = "\n <p>Lehe avamise hetkel oli: <strong>" .$fullTimeNow ."</strong></p> \n";
	$hourNow = date("H");
	$partOfDay = "hägune aeg";

	if($hourNow < 10) {
		$partOfDay = "hommik";
	}
	if($hourNow > 10 and $hourNow < 18) {
		$partOfDay = "aeg aktiivselt tegutseda!";
	}
	if($hourNow > 18) {
		$partOfDay = "õhtune rahulik aeg!";
	}
	$partOfDayHTML = "<p>Käes on " .$partOfDay ."!</p> \n";

	//info semestri kulgemise kohta
	$semesterStart = new DateTime("2020-01-27");
	$semesterEnd = new DateTime("2020-06-22");
	$semesterDuration = $semesterStart->diff($semesterEnd);
	// var_dump($semesterDuration);
	$today = new DateTime("now");
	$fromSemesterStart = $semesterStart->diff($today);

	//<p>Semester on hoos: <meter value="" min="0" max=""></meter></p>
	$semesterProgressHTML = '<p>Semester on hoos: <meter min="0" max="';
	$semesterProgressHTML .= $semesterDuration->format("%r%a"); //%r on miinusmärk vajadusel, %a annab kogu päevade arvu
	$semesterProgressHTML .= '" value="';
	$semesterProgressHTML .= $fromSemesterStart->format("%r%a");
	$semesterProgressHTML .= '"></meter>.</p>' . "\n";

	//loen ette antud kataloogist pildifailid
	$picsDir = "../../pics/";
	$photoTypesAllowed = ["image/jpeg", "image/png"]; //muutuja selle jaoks, millist tüüpi failid on lubatud
	$photoList = []; //tühi list, kuhu tüübikontrolli läbinud failid paigutatakse
	$allFiles = array_slice(scandir($picsDir), 2); //ilma array_slice käsuta näitab massiivis ka kausta nime kus failid asuvad, kui ka eelmise kausta nime
	foreach($allFiles as $file) {
		$fileInfo = getimagesize($picsDir .$file);
		if(in_array($fileInfo["mime"], $photoTypesAllowed) == true) {
			array_push($photoList, $file);
		}
	}

	$photoCount = count($photoList); // loeb mitu pilti on massiivis
	$photoNum = mt_rand(0, $photoCount - 1); // juhuslik number vahemikus 0 kuni fotode arv - 1, sest listi indeks algab 0
	$randomImageHTML = '<img src="' .$picsDir .$photoList[$photoNum] .'" alt="juhuslik pilt Haapsalust">' ."\n";
?>

<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Veebirakendused ja nende loomine 2020</title>
</head>
<body>
	<h1><?php echo $myName; ?></h1>
	<p>See leht on valminud õppetöö raames!</p>
	<?php
		echo $timeHTML;
		echo $partOfDayHTML;
		echo $semesterProgressHTML;
		echo $randomImageHTML;
	?>
</body>
</html>