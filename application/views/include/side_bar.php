<div class="span4 no-tablet-portrait no-phone text-center">
	
		<a href="<?php echo site_url('administrator/daerah');?>" class="tile bg-cyan" data-hint="Klik Tombol Untuk Kelola Data Daerah Banjir." data-hint-position="top">
		    <div class="tile-content icon">
		        <i class="icon-location"></i>
		    </div>
		    <div class="tile-status">
		        <span class="name">DAERAH</span>
		    </div>
		</a>

		<a href="<?php echo site_url('administrator/posko');?>" class="tile bg-lightPink" data-hint="Klik Tombol Untuk Kelola Data Posko Banjir." data-hint-position="top">
		    <div class="tile-content icon">
		        <i class="icon-flag-2"></i>
		    </div>
		    <div class="tile-status">
		        <span class="name">POSKO</span>
		    </div>
		</a>

		<a href="<?php echo site_url('administrator/ketinggian_air');?>" class="tile bg-indigo" data-hint="Klik Tombol Untuk Kelola Data Ketinggian Daerah Banjir." data-hint-position="top">
		    <div class="tile-content icon">
		        <i class="icon-stats-up"></i>
		    </div>
		    <div class="tile-status">
		        <span class="name">TINGGI AIR</span>
		    </div>
		</a>

		<a href="#" class="tile bg-emerald" data-hint="Klik Tombol Untuk Kelola Data Donatur Korban Banjir." data-hint-position="top">
		    <div class="tile-content icon">
		        <i class="icon-pie"></i>
		    </div>
		    <div class="tile-status">
		        <span class="name">DONATUR</span>
		    </div>
		</a>

		<a href="#" class="tile bg-lightOlive" data-hint="Klik Tombol Untuk Kelola Data Barang Bantuan/Donasi Banjir." data-hint-position="top">
		    <div class="tile-content icon">
		        <i class="icon-dollar"></i>
		    </div>
		    <div class="tile-status">
		        <span class="name">DONASI</span>
		    </div>
		</a>

		<a href="#" class="tile bg-darkBlue" data-hint="Klik Tombol Untuk Kelola Data Pengungsi dan Korban Banjir." data-hint-position="top">
		    <div class="tile-content icon">
		        <i class="icon-user"></i>
		    </div>
		    <div class="tile-status">
		        <span class="name">PENGUNGSI</span>
		    </div>
		</a>

		<?php if ($this->session->userdata('status') == 'admin') : ?>
			<a href="#" class="tile bg-darkPink" data-hint="Klik Tombol Untuk Kelola Petugas Pengelola Data Banjir." data-hint-position="top">
			    <div class="tile-content icon">
			        <i class="icon-user-3"></i>
			    </div>
			    <div class="tile-status">
			        <span class="name">PETUGAS</span>
			    </div>
			</a>
		<?php endif ?>

		<a href="#" class="tile bg-amber" data-hint="Klik Tombol Untuk Kelola Data Informasi Seputar Banjir." data-hint-position="top">
		    <div class="tile-content icon">
		        <i class="icon-info"></i>
		    </div>
		    <div class="tile-status">
		        <span class="name">INFO</span>
		    </div>
		</a>

		<a href="#" class="tile half bg-blue" data-hint="Klik Tombol Untuk Print Laporan." data-hint-position="top">
		    <div class="tile-content icon">
		        <i class="icon-floppy"></i>
		    </div>
		</a>

		<a href="<?php echo site_url();?>logout" class="tile half bg-lightRed" data-hint="Klik Tombol Untuk Keluar." data-hint-position="top">
		    <div class="tile-content icon">
		        <i class="icon-switch"></i>
		    </div>
		</a>
</div>