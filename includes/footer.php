<footer id = 'footerhide' class='bg-primary text-light'>
	<div class='lead py-3' style='text-align:center'><i class='fa fa-copyright' style='color:white'></i> Magma Events 2020</div>
</footer>

	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
<?php include("includes/loginModal.php"); ?>
<script>
	//log out code	
	$(document).ready(function(){
		$("#logout").click(function(){
			$.ajax({
				type:"POST",
				url:"scripts/logoutScript.php",
				success:function(response){
					location.href='index.php';
				},
				error:function(){
					alert("connection error.");
				}
			});//end ajax
		});//end logout click
	});//end ready
</script>
</html>
	