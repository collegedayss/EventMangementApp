<!-- Includes JQuery AJAX Code - INCLUDE BELOW JQuery Library -->

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body mx-3">
				<div class="md-form mb-5">
					<i class="fas fa-envelope prefix grey-text"></i>
					<input type="email" id="user" class="form-control validate">
					<label data-error="wrong" data-success="right" for="user">Your username</label>
				</div>

				<div class="md-form mb-4">
					<i class="fas fa-lock prefix grey-text"></i>
					<input type="password" id="pass" class="form-control validate">
					<label data-error="wrong" data-success="right" for="pass">Your password</label>
				</div>
				<div id='loginError' class='text-danger' style='font-style:italic; font-size:.7em'></div>
			</div>
			<div class="modal-footer d-flex justify-content-center">
				<button class="btn btn-primary" id='login'>Login</button>

			</div>

		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		$("#login").click(function() {
			//alert($("#user").val());
			$.ajax({
				type: "POST",
				url: "scripts/loginScript.php",
				data: {
					user: $("#user").val(),
					pass: $("#pass").val()
				},
				success: function(response) {
					//alert(response);
					if (response != 0) {
						//close modal
						$("#modalLoginForm").modal("hide");

						//redirect users based on level
						//reloading the index page is not ideal, but negates the need
						//for DOM work, which we have not done yet.

						if (response == "admin") window.location.href = "admin.php";
						else window.location.href = "employee.php";



					} else
						$("#loginError").text("Login Error.  Your username or password is not correct.");
				},
				error: function() {
					$("#loginError").text("Connection Error.  Please contact your system administrator.");

				}
			}); //end ajax
		}); //end login click

	}); //end ready
</script>