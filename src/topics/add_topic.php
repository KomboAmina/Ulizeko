<form method="post">

    <label for="topic"><?php echo (isset($t)) ?($t+1):"Topic";?></label>

    <input type="text" name="topic" id="topic" class="form-control input-monospace" required/>

    <button type="submit" name="act" class="btn btn-primary" value="add topic">Add Topic</button>

</form>
