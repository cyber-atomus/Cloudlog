<?php $this->lang->load('export'); ?>

<div id="container">
	<h2><?php echo $page_title; ?></h2>

	<p><?php printf($this->lang->line('export_info_paragraph')); ?></p>
	
	<h3><?php printf($this->lang->line('export_info_header')); ?></h3>
	
	<ul>
		<li><a href="<?php echo site_url('kml'); ?>"><?php printf($this->lang->line('export_export_kml')); ?></a></li>
		<li><a href="<?php echo site_url('adif/export'); ?>"><?php printf($this->lang->line('export_export_adif')); ?></a></li>
	</ul>
</div>
