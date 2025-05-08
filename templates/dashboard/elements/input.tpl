<fieldset role="group">
    <input type="text" name="{% $name %}{% if (!isset($single)): %}[]{% endif %}" value="{% $value %}">
    <button class="delete button-del"><i class="lni lni-trash-1"></i></button>
    <button class="update button-upd"><i class="lni lni-upload-1"></i></button>
</fieldset>
