<form method="get" action="<?php echo URL;?>search/">

<input type="search" class="form-control Header-input" name="key" id="key"
<?php if(isset($_GET['key'])){?>value="<?php echo urldecode($_GET['key']);?>"<?php }?>
/>
<button class="btn btn-primary">Search</button>

</form>
