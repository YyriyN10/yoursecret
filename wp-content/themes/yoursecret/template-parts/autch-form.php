<?php

	if ( ! defined( 'ABSPATH' ) ) {
				exit;
			}
	?>
<form>
	<div class="mb-3">
		<label class="mb-2 login-form-label" for="emailInput">
      <?php echo esc_html( pll__( 'Email or username' ) ); ?>
    </label>
		<input
			class="form-control rounded-2 login-form-input"
			id="emailInput"
			type="text"
			placeholder="somemail@gmail.com"
			disabled
		/>
	</div>
	<div class="mb-3">
		<div class="d-flex justify-content-between align-items-center mb-2">
			<label class="login-form-label" for="passwordInput">
        <?php echo esc_html( pll__( 'Password' ) ); ?>
      </label>
			<a href="javascript:void(0)"
			   onclick="openEarlyAccessModal()" class="text-right text-decoration-none login-forgot-password">
        <?php echo esc_html( pll__( 'Forgot your password?' ) ); ?>
      </a>
		</div>
		<div class="position-relative">
			<input
				class="form-control rounded-2 login-form-input-with-icon"
				id="passwordInput"
				type="password"
				placeholder="Password"
				disabled
			/>
			<button
				type="button"
				class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3 ps-0 border-0"
				disabled
			>
				<i class="fa-solid fa-eye-slash" style="color: black"></i>
			</button>
		</div>
	</div>
	<div class="d-grid mt-4">
		<button
			class="rounded-pill fw-500 border-0 login-signin-button"
			type="submit"
			disabled
		>
      <?php echo esc_html( pll__( 'Sign in' ) ); ?>
		</button>
	</div>
	<div class="text-center" style="padding-top: 24px;">
		<a
			href="javascript:void(0)"
			onclick="openEarlyAccessModal()"
			class="text-primary text-decoration-none fw-500 login-create-account"
		>
      <?php echo esc_html( pll__( 'Create new account' ) ); ?>

		</a>
	</div>
</form>
