

	</main>

	<!-- footer -->
	<footer id='footer' role="contentinfo">
		<p>
		Copyright &copy; 2017 <a href='http://www.webbers.xyz'>Webbers Organization</a>  &nbsp; / &nbsp; 
		<?php 
		if($user->isLoggedin()) {
			// if user is logged in, show a logout link
			echo "<a href='{$config->urls->admin}login/logout/'>Logout ($user->FullName)</a>  &nbsp; |  &nbsp; ".
				 "<a href='{$config->urls->admin}'>Dashboard</a>";
			
		} else {
			// if user not logged in, show a login link
			echo "<a href='{$config->urls->admin}'>Dashboard Login</a>";
		}
		?>
		</p>
	</footer>

</body>
</html>
