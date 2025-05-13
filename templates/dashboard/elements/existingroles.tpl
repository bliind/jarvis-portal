{% $skip = []; %}
{% foreach ($config_roles as $role): %}
    <span class="existing-option" data-value="{% $role->value %}">{% $role->role_name %}</span>
    {% $skip[] = $role->role_id; %}
{% endforeach %}
