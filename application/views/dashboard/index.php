<?php $this->lang->load('dashboard'); ?>
<div class="container dashboard">
<?php if(($this->config->item('use_auth') && ($this->session->userdata('user_type') >= 2)) || $this->config->item('use_auth') === FALSE) { ?>

	<?php if($todays_qsos >= 1) { ?>
		<div class="alert alert-success" role="alert">
			  <?php sprintf($this->lang->line('dashboard_welcome_text_qsos', $today_qsos)); ?>
		</div>
	<?php } else { ?>
		<div class="alert alert-danger" role="alert">
			  <?php printf($this->lang->line('dashboard_welcome_text_noqso')); ?>
		</div>
	<?php } ?>

	<?php if($current_active == 0) { ?>
		<div class="alert alert-danger" role="alert">
		  <?php printf($this->lang->line('dashboard_alert_profile')); ?>
		</div>
	<?php } ?>

<?php } ?>
</div>

<!-- Map -->
<div id="map" style="width: 100%; height: 350px"></div>

<div style="padding-top: 0px; margin-top: 5px;" class="container dashboard">

<!-- Log Data -->
<div class="row logdata">
  <div class="col-sm-8">

  	<div class="table-responsive">
    	<table class="table table-striped table-hover">

    		<thead>
				<tr class="titles">
					<th><?php printf($this->lang->line('dashboard_date')); ?></th>

					<?php if(($this->config->item('use_auth') && ($this->session->userdata('user_type') >= 2)) || $this->config->item('use_auth') === FALSE || ($this->config->item('show_time'))) { ?>
					<th><?php printf($this->lang->line('dashboard_time')); ?></th>
					<?php } ?>
					<th><?php printf($this->lang->line('dashboard_callsign')); ?></th>
					<th><?php printf($this->lang->line('dashboard_mode')); ?></th>
					<th class="d-none d-sm-table-cell"><?php printf($this->lang->line('dashboard_report_in')); ?></th>
					<th class="d-none d-sm-table-cell"><?php printf($this->lang->line('dashboard_report_out')); ?></th>
					<th><?php printf($this->lang->line('dashboard_band')); ?></th>
				</tr>
			</thead>

			<?php 
			$i = 0; 
			foreach ($last_five_qsos->result() as $row) { ?>
				<?php  echo '<tr class="tr'.($i & 1).'">'; ?>

					<?php 

					// Get Date format
					if($this->session->userdata('user_date_format')) {
						// If Logged in and session exists
						$custom_date_format = $this->session->userdata('user_date_format');
					} else {
						// Get Default date format from /config/cloudlog.php
						$custom_date_format = $this->config->item('qso_date_format');
					}

					?>

					<td><?php $timestamp = strtotime($row->COL_TIME_ON); echo date($custom_date_format, $timestamp); ?></td>
					<?php if(($this->config->item('use_auth') && ($this->session->userdata('user_type') >= 2)) || $this->config->item('use_auth') === FALSE || ($this->config->item('show_time'))) { ?>
					<td><?php $timestamp = strtotime($row->COL_TIME_ON); echo date('H:i', $timestamp); ?></td>
					<?php } else { ?>
					<?php } ?>
					<td>
						<a data-fancybox data-type="iframe" data-width="800" data-height="520" data-src="<?php echo site_url('logbook/view')."/".$row->COL_PRIMARY_KEY; ?>" href="javascript:;">
							<?php echo str_replace("0","&Oslash;",strtoupper($row->COL_CALL)); ?>
						</a>
					</td>
					<td><?php echo $row->COL_SUBMODE==null?$row->COL_MODE:$row->COL_SUBMODE; ?></td>
					<td class="d-none d-sm-table-cell"><?php echo $row->COL_RST_SENT; ?> <?php if ($row->COL_STX_STRING) { ?><span class="label"><?php echo $row->COL_STX_STRING;?></span><?php } ?></td>
					<td  class="d-none d-sm-table-cell"><?php echo $row->COL_RST_RCVD; ?> <?php if ($row->COL_SRX_STRING) { ?><span class="label"><?php echo $row->COL_SRX_STRING;?></span><?php } ?></td>
					<?php if($row->COL_SAT_NAME != null) { ?>
					<td><?php echo $row->COL_SAT_NAME; ?></td>
					<?php } else { ?>
					<td><?php echo strtolower($row->COL_BAND); ?></td>
					<?php } ?>
				</tr>
			<?php $i++; } ?>
		</table>
	</div>
  </div>

  <div class="col-sm-4">
  	<div class="table-responsive">
    	<table class="table table-striped">
			<tr class="titles">
				<td colspan="2"><i class="fas fa-chart-bar"></i> <?php printf($this->lang->line('dashboard_qso_breakdown')); ?></td>
			</tr>
			
			<tr>
				<td><?php printf($this->lang->line('dashboard_qso_total')); ?></td>
				<td><?php echo $total_qsos; ?></td>
			</tr>
			
			<tr>
				<td><?php printf($this->lang->line('dashboard_qso_year')); ?></td>
				<td><?php echo $year_qsos; ?></td>
			</tr>

			<tr>
				<td><?php printf($this->lang->line('dashboard_qso_month')); ?></td>
				<td><?php echo $month_qsos; ?></td>
			</tr>
		</table>



		<table class="table table-striped">
			<tr class="titles">
				<td colspan="2"><i class="fas fa-globe-europe"></i><?php printf($this->lang->line('dashboard_country_breakdown')); ?></td>
			</tr>
			
			<tr>
				<td><?php printf($this->lang->line('dashboard_country_worked')); ?></td>
				<td><?php echo $total_countrys; ?></td>
			</tr>
			<tr>
				<td><a href="#" onclick="return false" data-original-title="QSL Cards / eQSL / LoTW" data-toggle="tooltip"><?php printf($this->lang->line('dashboard_country_confirmed')); ?></a></td>
				<td>
					<?php echo $total_countrys_confirmed_paper; ?> /
					<?php echo $total_countrys_confirmed_eqsl; ?> /
					<?php echo $total_countrys_confirmed_lotw; ?>	
				</td>
			</tr>
			
			<tr>
				<td><?php printf($this->lang->line('dashboard_country_needed')); ?></td>
				<td><?php $dxcc = 340 - $total_countrys; echo $dxcc; ?></td>
			</tr>
		</table>

		<?php if(($this->config->item('use_auth') && ($this->session->userdata('user_type') >= 2)) || $this->config->item('use_auth') === FALSE) { ?>
		<table class="table table-striped">	
			<tr class="titles">
				<td colspan="2"><i class="fas fa-envelope"></i><?php printf($this->lang->line('dashboard_qsl_breakdown')); ?></td>
			</tr>
			
			<tr>
				<td><?php printf($this->lang->line('dashboard_qsl_sent')); ?></td>
				<td><?php echo $total_qsl_sent; ?></td>
			</tr>
					
			<tr>
				<td><?php printf($this->lang->line('dashboard_qsl_received')); ?></td>
				<td><?php echo $total_qsl_recv; ?></td>
			</tr>
			
			<tr>
				<td><?php printf($this->lang->line('dashboard_qsl_requested')); ?></td>
				<td><?php echo $total_qsl_requested; ?></td>
			</tr>
		</table>
		<?php } ?>
	</div>
  </div>
</div>

</div>
