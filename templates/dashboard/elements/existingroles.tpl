{% $skip = []; %}
{% foreach ($config_roles as $role): %}
    {% if (!is_null($role->role_color2)): %}
        {% if (!is_null($role->role_color3)): %}
            {% $color = 'linear-gradient(#' . $role->role_color1 . ', #' . $role->role_color2 .', #' . $role->role_color3 .')'; %}
        {% else: %}
            {% $color = 'linear-gradient(#' . $role->role_color1 . ', #' . $role->role_color2 .')'; %}
        {% endif %}
    {% else: %}
        {% $color = '#' . $role->role_color1; %}
    {% endif %}

    <span class="existing-option" style="background:{% $color %}" data-value="{% $role->value %}">{% $role->role_name %}</span>
    {% $skip[] = $role->role_id; %}
{% endforeach %}
