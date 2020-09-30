<?php $this->lang->load('settings'); ?>

<div class="container settings">

	<div class="row">
		<!-- Nav Start -->
		<div class="col-md-3">
			<ul class="nav flex-column settings-nav">
				<li class="nav-item">
					<a class="nav-link active" href="#"><?php printf($this->lang->line('settings_link_active')); ?></a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="#"><?php printf($this->lang->line('settings_link_radio_interfacest')); ?></a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="#"><?php printf($this->lang->line('settings_link_adif')); ?></a>
				</li>
			</ul>
		</div>
		<!-- Nav End -->

		<!-- Content -->
		<div class="col-md-9">
		<?php printf($this->lang->line('settings_number')); ?>
		</div>
	</div>

</div>