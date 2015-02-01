<div class="row">
	<?php $this->load->view('include/side_bar');?>
	<div class="span6">
		<?php echo form_open(site_url('administrator/daerah/edit/'.$tampildaerah->id_daerah)); ?>
	        <fieldset>
	            <legend>FORM MASUKAN DATA DAERAH</legend>
	            <?php if (! empty($pesan)) : ?>
			        <p class="fg-red">
			            <?php echo $pesan; ?>
			        </p>
			    <?php endif ?>
	            <label>Nama Daerah</label>
	            <div class="input-control text" data-role="input-control">
	                <input type="text" placeholder="Masukan Nama Daerah" name="nama_daerah" value="<?php echo $tampildaerah->nama_daerah; ?>" autofocus>
	                <button class="btn-clear" tabindex="-1"></button>
	            </div>
	            <?php echo form_error('nama_daerah', '<p class="fg-red">', '</p>');?>

	            <label>Latitude</label>
	            <div class="input-control text" data-role="input-control">
	                <input type="text" placeholder="Masukan Kordinat Latitude" name="latitude" id="latitude" value="<?php echo $tampildaerah->latitude; ?>">
	                <button class="btn-clear" tabindex="-1"></button>
	            </div>
	            <?php echo form_error('latitude', '<p class="fg-red">', '</p>');?>

	            <label>Longitude</label>
	            <div class="input-control text" data-role="input-control">
	                <input type="text" placeholder="Masukan Kordinat Longitude" name="longitude" id="longitude" value="<?php echo $tampildaerah->longitude; ?>">
	                <button class="btn-clear" tabindex="-1"></button>
	            </div>
	            <?php echo form_error('longitude', '<p class="fg-red">', '</p>');?>
	            
	            <br>
	            <?php echo form_submit('submit','SIMPAN') ?>
	        </fieldset>
	    </form>
	</div>
	<div class="span4" data-hint="Tekan Tanda <i class='icon-location fg-red'></i> lalu Taruh Untuk Mendapatkan Kordinat Yang Tepat" data-hint-position="top">
	    	<?php echo $map['html']; ?>
    </div>
</div>