<?php
session_start();
mb_internal_encoding("UTF-8");

function loadClass($class)
{
	if(preg_match('/Controller$/', $class))
	{
		require("controller/" . $class . ".php");
	}
	else
	{
		require("model/" . $class . ".php");
	}
}

spl_autoload_register("loadClass");

$emailcontroller = new EmailController();
$emailcontroller->send();
?>

<!DOCTYPE html>
<html lang="cs-cz">

	<head>
		<meta charset="utf-8" />
		<meta name="author" content="Bc. Tomáš Horák" />
		<meta name="description" content="Osobní web PHP a Nette programátora Tomáše Horáka" />
		<meta name="keywords" content="PHP programátor, Nette programátor" />
		<link rel="stylesheet" href="style.css" type="text/css" />
		<title>Tomáš Horák - PHP a Nette programátor</title>
	</head>
	
	<body>
		<header>
			<div class="wrapper">
					<nav>
						<ul>
							<li><a href="#omne">O MĚ</a></li>
							<li><a href="#kontakt">KONTAKT</a></li>
						</ul>
					</nav>
			</div>
		</header>
		
		<article>
			<div class="wrapper">
				<h1>Bc. Tomáš Horák</h1>
				<?php include("view/omne.phtml"); ?>
				<br />
				<h2 id="kontakt">Kontakt</h2>
				<?php
				$emailcontroller->getForm();
				?>
			</div>	
		</article>
		<footer></footer>
	</body>
</html>