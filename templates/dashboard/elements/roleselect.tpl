<div class="special-select">
    <label class="select">
        <select class="special-option">
            <option value="" hidden selected>Select One</option>
            {% foreach ($roles as $role): %}
            {% if (isset($skip) && !in_array($role->role_id, $skip)): %}
            <option value="{% $role->role_id %}">{% $role->role_name %}</option>
            {% endif %}
            {% endforeach %}
        </select>
    </label>
</div>
