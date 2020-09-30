<?php $this->lang->load('distances'); ?>

<div class="container">

    <br>

    <h2><?php echo $page_title; ?></h2>

    <div id="distances_div">
        <form class="form-inline">
            <label class="my-1 mr-2" for="gridsquare_bands"><?php printf($this->lang->line('distances_band')); ?></label>
            <select class="custom-select my-1 mr-sm-2"  id="distplot_bands">
                <option value="sat">SAT</option>
            </select>
            <button id="plot" type="button" name="plot" class="btn btn-success btn-primary" onclick="distPlot(this.form)"><?php printf($this->lang->line('distances_plot')); ?></button>
        </form>
    </div>

</div>
