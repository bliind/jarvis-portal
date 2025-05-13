<div class="special-select">
    <label class="select">
        <select class="special-option">
            <option value="" hidden selected>Add Role</option>
            {% foreach ($roles as $role): %}
            {% if (!in_array($role->role_id, $skip)): %}
            <option value="{% $role->role_id %}">{% $role->role_name %}</option>
            {% endif %}
            {% endforeach %}
        </select>
    </label>
</div>
