<div class="special-select">
    <label class="select">
        <select>
            <option value="" hidden>Select Role</option>
            {% foreach ($roles as $role): %}
                <option value="{% $role->role_id %}"{% if (isset($config_role) && $config_role->value == $role->role_id): %}selected{% endif %}>{% $role->role_name %}</option>
            {% endforeach %}
        </select>
    </label>
</div>
