<!DOCTYPE>
<html>
	<head>
		<!-- Memanggil Data Kebutuhan Metro-Bootstrap -->
		<?php $this->load->view('include/head');?>
		<title>Halaman Login Petugas</title>
	</head>
	<body class="metro">
		<div class="grid">
			<div class="row">
				<div class="span5 offset6 window flat shadow" style="padding:10px;">
			        <h3 class="text-center"><i class="icon icon-user-3"></i> Login Petugas</h3>
					<form action="<?php echo site_url();?>login" method="POST">
			            <fieldset>
			                <?php if (! empty($pesan)) : ?>
						        <p class="fg-red">
						            <?php echo $pesan; ?>
						        </p>
						    <?php endif ?>
			                <label>Username</label>
			                <div class="input-control text" data-role="input-control">
			                    <input type="text" placeholder="Masukan Username" name="username" autofocus>
			                    <button class="btn-clear" tabindex="-1"></button>
			                </div>
			                <?php echo form_error('username', '<p class="fg-red">', '</p>');?>
			                <label>Password</label>
			                <div class="input-control password" data-role="input-control">
			                    <input type="password" placeholder="Masukan Password" name="password">
			                    <button class="btn-reveal" tabindex="-1"></button>
			                </div>
			                <?php echo form_error('password', '<p class="fg-red">', '</p>');?>
		                    <div class="input-control radio default-style" data-role="input-control">
		                        <label>
		                            <input type="radio" name="status" value="admin" checked />
		                            <span class="check"></span>
		                            Administrator
		                        </label>
		                    </div>
		                    <div class="input-control radio  default-style" data-role="input-control">
		                        <label>
		                            <input type="radio" name="status" value="petugas" />
		                            <span class="check"></span>
		                            Petugas
		                        </label>
		                    </div>
			                <center><input type="submit" value="Login" class="text-center button large bg-cyan bg-hover-gray fg-white"></center>
			            </fieldset>
			        </form>
			    </div>
	        </div>
        </div>
	</body>
</html>