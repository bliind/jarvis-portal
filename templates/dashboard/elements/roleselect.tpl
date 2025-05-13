<div class="special-select">
    <label class="select">
        <select class="special-option">
            <option value="" hidden selected>Select One</option>
            {% foreach ($roles as $role): %}
            <option value="{% $role->role_id %}">{% $role->role_name %}</option>
            {% endforeach %}
        </select>
    </label>
</div>
