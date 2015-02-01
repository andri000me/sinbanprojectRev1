<div class="row">
	<?php $this->load->view('include/side_bar');?>
	<div class="span8">
		<?php echo form_open_multipart(site_url('administrator/ketinggian_air/tambah')); ?>
	        <fieldset>
	            <legend>FORM MASUKAN DATA KETINGGIAN AIR</legend>
	            <?php if (! empty($pesan)) : ?>
			        <p class="fg-red">
			            <?php echo $pesan; ?>
			        </p>
			    <?php endif ?>
	            <label>Nama Daerah<div class="place-right">Tanggal : <?php date_default_timezone_set('asia/jakarta'); echo date('Y-m-d H:i:s'); ?></div></label>
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
	            <label>Ketinggian Air</label>
	            <div class="input-control text" data-role="input-control">
	                <input type="text" placeholder="Masukan Ketinggian Air Dalam CM" name="ketinggian_air">
	                <button class="btn-clear" tabindex="-1"></button>
	            </div>
	            <?php echo form_error('ketinggian_air', '<p class="fg-red">', '</p>');?>

	            <label>Radius</label>
	            <div class="input-control text" data-role="input-control">
	                <input type="text" placeholder="Masukan Radius Daerah Genangan dalam Meter" name="radius_daerah">
	            </div>
	            <br><br>
	            <?php echo form_error('radius_daerah', '<p class="fg-red">', '</p>');?>
	            <?php echo form_submit('submit','SIMPAN') ?>
	        </fieldset>
	    </form>
	</div>
</div>