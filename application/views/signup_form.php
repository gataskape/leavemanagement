<div class="ui top aligned grid" id="signup_form">
	<div class="column">
	<h2 class="ui teal image header">
      <div class="content">
        Create Your Account
      </div>
	</h2>
		<?php
			echo form_open('login/create_user', 'class="ui large form signupform"');
		?>
		<div class="ui stacked segment">
			<div class="field">
				<?=form_input('first_name', '', 'placeholder="First Name"');?>
			</div>
			<div class="field">
				<?=form_input('last_name', '', 'placeholder="Last Name"');?>
			</div>
			<div class="field">
				<?=form_input('email', '', 'placeholder="E-mail address"');?>
			</div>
			<div class="field">
				<?=form_password('password', '', 'placeholder="Password" ');?>
			</div>
				<?=form_submit('submit', 'signup', 'class="ui fluid large teal submit button"');?>
		</div>
		<div class="ui error message">
		</div>
		<?php
			echo form_close();
		?>
	</div>
</div>