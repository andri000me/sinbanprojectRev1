<!DOCTYPE>
<html>
	<head>
		<!-- Memanggil Data Kebutuhan Metro-Bootstrap -->
		<?php $this->load->view('include/head');?>
		<title><?php echo $judul;?></title>
		<?php if ($mode_peta == TRUE) : ?>
			<?php echo $map['js']; ?>
		<?php endif ?>
	</head>
	<body class="metro">
		<div class="grid">
			<div class="row">
					<?php $this->load->view('include/menu');?>
			</div>
			<div class="row">
				<div class="container">
					<?php $this->load->view($view_utama);?>
				</div>
			</div>
			<div class="row">
				<?php $this->load->view('include/footer');?>
			</div>
		</div>
	</body>
<html>