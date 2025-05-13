{% $skip = []; %}
{% foreach ($config_roles as $role): %}
    {% if (!is_null($role->role_color2)): %}
        {% if (!is_null($role->role_color3)): %}
            {% $color = 'linear-gradient(to left, #' . sprintf('%06s', $role->role_color1) . ', #' . sprintf('%06s', $role->role_color2) .', #' . sprintf('%06s', $role->role_color3) .')'; %}
        {% else: %}
            {% $color = 'linear-gradient(to left, #' . sprintf('%06s', $role->role_color1) . ', #' . sprintf('%06s', $role->role_color2) .')'; %}
        {% endif %}
    {% else: %}
        {% $color = '#' . sprintf('%06s', $role->role_color1); %}
    {% endif %}

    <span class="existing-option" style="background:{% $color %};color:#000" data-value="{% $role->value %}">{% $role->role_name %}</span>
    {% $skip[] = $role->role_id; %}
{% endforeach %}
