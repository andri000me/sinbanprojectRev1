<div class="navigation-bar fixed-top">
    <div class="navigation-bar-content">
        <a class="element"><span class="icon-code"></span> Halaman Pengelola</a>
        <span class="element-divider"></span>
        <a class="element1 pull-menu" href="#"></a>
        <ul class="element-menu">
            <li>
                <a class="dropdown-toggle"  href="#"><i class="icon-user"></i> Hallo, <?php echo $this->session->userdata('username');?></a>
                <ul class="dropdown-menu lightBlue" data-role="dropdown">
                    <li><a href="#">Edit Password</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo site_url('logout'); ?>"><i class="icon-exit"></i> Keluar?</a></li>
                </ul>
            </li>
            <span class="element-divider"></span>
            <li>
                <a href="<?php echo site_url();?>administrator"><i class="icon-home"></i> Beranda</a>
            </li>
            <li>
                <a class="dropdown-toggle"  href="#"><i class="icon-cog"></i> Kelola</a>
                <ul class="dropdown-menu lightBlue" data-role="dropdown">
                    <li><a href="<?php echo site_url();?>administrator/daerah">Data Daerah Banjir</a></li>
                    <li><a href="<?php echo site_url('administrator/posko');?>">Data Posko Banjir</a></li>
                    <li><a href="<?php echo site_url('administrator/ketinggian_air');?>">Data Ketinggian Banjir</a></li>
                    <li><a href="#">Data Pengungsi</a></li>
                    <li><a href="#">Data Donatur</a></li>
                    <li><a href="#">Data Barang Donasi</a></li>
                    <li><a href="#">Data Informasi Banjir</a></li>
                    <?php if ($this->session->userdata('status') == 'admin') : ?>
                      <li><a href="#">Data Petugas</a></li>
                    <?php endif ?>
                </ul>
            </li>

            <li>
                <a class="dropdown-toggle"  href="#"><i class="icon-new"></i> Tambah</a>
                <ul class="dropdown-menu lightBlue" data-role="dropdown">
                    <li><a href="<?php echo site_url('administrator/daerah/tambah');?>">Data Daerah Banjir</a></li>
                    <li><a href="<?php echo site_url('administrator/posko/tambah');?>">Data Posko Banjir</a></li>
                    <li><a href="<?php echo site_url('administrator/ketinggian_air/tambah');?>">Data Ketinggian Banjir</a></li>
                    <li><a href="#">Data Pengungsi</a></li>
                    <li><a href="#">Data Donatur</a></li>
                    <li><a href="#">Data Barang Donasi</a></li>
                    <li><a href="#">Data Informasi Banjir</a></li>
                    <?php if ($this->session->userdata('status') == 'admin') : ?>
                      <li><a href="#">Data Petugas</a></li>
                    <?php endif ?>
                </ul>
            </li>
            <li>
                <a href="#"><i class="icon-floppy"></i> Print Laporan</a>
            </li>
        </ul>
    </div>
</div>
