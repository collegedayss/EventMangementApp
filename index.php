<?php session_start(); ?>
<?php
//handle error codes
//err=rights -> user rights issue
if (isset($_GET['err']) && $_GET['err'] == "rights")
	echo "<script>alert('You do not have rights to see that page.  Either log in or contact your system admin.');</script>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Jekyll v3.8.6">
	<title>Magma Events</title>

	<?php include("includes/head.php"); ?>

	<style>
		/* Page styles used for sections and internal anchors */
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}

		.anchor {
			display: block;
			height: 60px;
			/*same height as header*/
			margin-top: -60px;
			/*same height as header*/
			visibility: hidden;
		}
	</style>
</head>

<body>
	<header>
		<?php include("includes/nav.php"); ?>
	</header>


	<main role="main" class="container">

		<h1>Magma Events Center</h1>
		<img class="img-fluid" src="https://images.unsplash.com/photo-1527529482837-4698179dc6ce?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=750&amp;q=80%20750w">

		<br></br>
	</main>
	<?php include("includes/footer.php"); ?>

</html>