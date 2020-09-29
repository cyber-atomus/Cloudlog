<?php $this->lang->load('qsos'); ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title><?php printf($this->lang->line('qsos_title')); ?></title>
	<style type="text/css" media="screen">
		body {
			font-family: Arial, "MS Trebuchet", sans-serif;
		}
		.titles td {
			font-weight: bold;
		}
	</style>
</head>

<body>
	   <table width="100%" class="zebra-striped">
			<tr class="titles">
				<td><?php printf($this->lang->line('qsos_sate')); ?></td>
				<td><?php printf($this->lang->line('qsos_time')); ?></td>
				<td><?php printf($this->lang->line('qsos_call')); ?></td>
				<td><?php printf($this->lang->line('qsos_mode')); ?></td>
				<td><?php printf($this->lang->line('qsos_sent')); ?></td>
				<td><?php printf($this->lang->line('qsos_recv')); ?></td>
				<td><?php printf($this->lang->line('qsos_band')); ?></td>
			</tr>

			<?php $i = 0; 
			foreach ($last_five_qsos->result() as $row) { ?>
				<?php  echo '<tr class="tr'.($i & 1).'">'; ?>
					<td><?php $timestamp = strtotime($row->COL_TIME_ON); echo date('d/m/y', $timestamp); ?></td>
					<td><?php $timestamp = strtotime($row->COL_TIME_ON); echo date('H:i', $timestamp); ?></td>
					<td><a class="qsobox" href="<?php echo site_url('logbook/view')."/".$row->COL_PRIMARY_KEY; ?>"><?php echo str_replace("0","&Oslash;",strtoupper($row->COL_CALL)); ?></a></td>
					<td><?php echo $row->COL_SUBMODE==null?$row->COL_MODE:$row->COL_SUBMODE; ?></td>
					<td><?php echo $row->COL_RST_SENT; ?> <?php if ($row->COL_STX_STRING) { ?>(<?php echo $row->COL_STX_STRING;?>)<?php } ?></td>
					<td><?php echo $row->COL_RST_RCVD; ?> <?php if ($row->COL_SRX_STRING) { ?>(<?php echo $row->COL_SRX_STRING;?>)<?php } ?></td>
					<?php if($row->COL_SAT_NAME != null) { ?>
					<td><?php echo $row->COL_SAT_NAME; ?></td>
					<?php } else { ?>
					<td><?php echo $row->COL_BAND; ?></td>
					<?php } ?>
				</tr>
			<?php $i++; } ?>
		</table>
</body>

</html>