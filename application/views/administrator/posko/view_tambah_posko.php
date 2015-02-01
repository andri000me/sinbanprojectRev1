<div class="row">
	<?php $this->load->view('include/side_bar');?>
	<div class="span8">
		<?php echo form_open_multipart(site_url('administrator/posko/tambah')); ?>
	        <fieldset>
	            <legend>FORM MASUKAN DATA POSKO</legend>
	            <?php if (! empty($pesan)) : ?>
			        <p class="fg-red">
			            <?php echo $pesan; ?>
			        </p>
			    <?php endif ?>
	            <label>Nama Daerah</label>
	            <div class="input-control select" name="id_daerah">
				    <select name="id_daerah">
						<?php 
							if (empty($hasildaerah)) {
	        					echo "<option value=''>Tidak Ada Daerah</option>";
							}else{
								foreach ($hasildaerah as $data):
						?>
						<option value="<?php echo $data->id_daerah;?>"><?php echo $data->nama_daerah;?></option>
						<?php endforeach; }?>
					</select>
				</div>
	            <?php echo form_error('id_daerah', '<p class="fg-red">', '</p>');?>
	            <?php if (empty($hasildaerah)) : ?>
			        <p class="fg-red">
			            Data Daerah Kosong, Silahkan Tambahkan Daerah Terlebih Dahulu
			        </p>
			    <?php endif ?>
	            <label>Nama Posko</label>
	            <div class="input-control text" data-role="input-control">
	                <input type="text" placeholder="Masukan Nama Posko" name="nama_posko">
	                <button class="btn-clear" tabindex="-1"></button>
	            </div>
	            <?php echo form_error('nama_posko', '<p class="fg-red">', '</p>');?>

	            <label>Alamat Posko</label>
	            <div class="input-control text" data-role="input-control">
	                <textarea placeholder="Masukan Alamat Lengkap Posko (Maks. 50 Karakter)" name="alamat_posko" cols="50%" rows="3px"></textarea>
	            </div>
	            <br><br>
	            <?php echo form_error('alamat_posko', '<p class="fg-red">', '</p>');?>
	            <?php echo form_submit('submit','SIMPAN') ?>
	        </fieldset>
	    </form>
	</div>
</div>