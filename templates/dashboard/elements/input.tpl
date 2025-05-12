<div class="btn-group">
    <input type="text" name="{% $name %}{% if (!isset($single)): %}[]{% endif %}" value="{% $value %}">
    <button class="btn-red"><i class="lni lni-xmark"></i></button>
    <button class="btn-green"><i class="lni lni-upload-1"></i></button>
</div>
