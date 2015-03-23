<div class="form-group">
	<label for="dbHost">密码</label>
	<input value="<?php if (is_array($config) && isset($config['password']) > 0) echo $config['password']; ?>" type="text" class="form-control" id="password" name="password" placeholder="">
</div>