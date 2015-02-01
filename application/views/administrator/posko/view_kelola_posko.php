<?php $pesan_flash = $this->session->flashdata('pesan');?>
<?php if (! empty($pesan_flash)) : ?>
    <script>
	    $(function(){
	        $( document ).ready(function() {
	            $.Notify({
	            	style: {background: 'green', color: 'white'},
	                shadow: true,
	                position: 'bottom-right',
	                content: "<?php echo $pesan_flash; ?>"
	            });
	        });
	    });
	</script>
<?php endif ?>
<div class="row">
	<?php $this->load->view('include/side_bar');?>
	<div class="span8">
		<h3 class="text-right"><?php echo $breadcrumb;?></h3>
		<hr>
		<?php
			if (empty($hasildataposko)){
				echo br(2);
				echo "<center><h3>Maaf Belum Ada Data Di Database Silahkan <a href=".site_url('administrator/posko/tambah').">Tambahkan Data </a></h3></center>";
			}
			else
			{
		?>
			<table class="table hovered bordered">
				<thead>
					<tr class="bg-cyan fg-white">
						<th class="text-left">No.</th>
						<th class="text-left">Nama Daerah</th>
						<th class="text-left">Nama Posko</th>
						<th class="text-left">Alamat Posko</th>
						<th class="text-left">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = (int) $this->uri->segment(4);
						foreach ($hasildataposko as $data):
					?>
					<tr>
						<td><?php echo ++$no; ?></td>
						<td><?php echo $data->nama_daerah; ?></td>
						<td><?php echo $data->nama_posko; ?></td>
						<td><?php echo $data->alamat_posko; ?></td>
						<td>
						<a href="<?php echo site_url('administrator/posko/edit/'.$data->id_posko); ?>" class="button fg-hover-white bg-hover-cyan" data-hint="Klik Tombol Untuk Mengedit Data." data-hint-position="right"><i class="icon-pencil"></i></a>
						<a href="<?php echo site_url('administrator/posko/hapus/'.$data->id_posko); ?>" class="button fg-hover-white bg-hover-cyan" data-hint="Klik Tombol Untuk Hapus Data." data-hint-position="right"><i class="icon-remove"></i></a>
						</td>
					</tr>
					<?php endforeach; }?>
				</tbody>
			</table>
			<div class="pagination"> <?php echo $this->pagination->create_links(); ?> </div>
			<div id="cari">
				<form action="<?php echo site_url('administrator/posko/cari'); ?>" class="place-left" method="POST">
					<input  name="cari" type="text" placeholder="Cari nama posko" class="input-xlarge"/>
					<?php echo form_submit('submit','Cari') ?>
				</form>
				<div class="place-right">
					<a href="<?php echo site_url('administrator/posko');?>" class="button fg-hover-white bg-hover-cyan">TAMPILKAN SEMUA</a>
					<a href="<?php echo site_url('administrator/posko/tambah');?>" class="button fg-hover-white bg-hover-cyan">TAMBAH DATA</a>
				</div>
			</div>
		</div>
</div>