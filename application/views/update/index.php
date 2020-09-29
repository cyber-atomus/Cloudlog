<?php $this->lang->load('update'); ?>

<div class="container">
	<h2><?php echo $page_title; ?></h2>

	<?php if(!extension_loaded('xml')) { ?>

	<div class="alert alert-danger" role="alert">
	  <?php printf($this->lang->line('update_alert_xml')); ?>
	</div>

	<?php } else { ?>

		<input type="submit" id="btn_update_dxcc" value=<?php printf($this->lang->line('update_button_dxcc')); ?> />

		<div id="dxcc_update_status"><?php printf($this->lang->line('update_status')); ?></br></div>
			
		<br/>
		    
		<a href="<?php echo site_url('update/check_missing_dxcc');?>"><?php printf($this->lang->line('update_button_missing_dxcc')); ?></a>
		<a href="<?php echo site_url('update/check_missing_dxcc/all');?>"><?php printf($this->lang->line('update_check_missing')); ?></a>

		<style>
			#dxcc_update_status{
			   display: None;
			}
		</style>
	<?php } ?>
</div>


