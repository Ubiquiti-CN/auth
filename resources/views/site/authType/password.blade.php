<div class="form-group">
	<label for="dbHost">密码</label>
	<input value="<?php if (is_array($config) && count($config) > 0) echo $config['dbHost']; ?>" type="text" class="form-control" id="dbHost" name="dbHost" placeholder="127.0.0.1">
</div>