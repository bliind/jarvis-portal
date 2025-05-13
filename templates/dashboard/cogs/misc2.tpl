<div class="col">
    <div class="group">
        <label>Moderator Roles</label>
        <div class="option-group group" data-key="moderator_roles">
            {% $skip = []; %}
            {% foreach ($configs['moderator_roles'] as $role): %}
            <span class="existing-option" data-value="{% $role->role_id %}">{% $role->role_name %}</span>
            {% $skip[] = $role->role_id; %}
            {% endforeach %}
            {% include "dashboard/elements/roleselect.tpl" %}
        </div>
    </div>

    <div class="group">
    <label>Developer Roles</label>
    <div class="option-group group" data-key="developer_roles">
        {% $skip = []; %}
        {% foreach ($configs['developer_roles'] as $role): %}
        <span class="existing-option" data-value="{% $role->role_id %}">{% $role->role_name %}</span>
        {% $skip[] = $role->role_id; %}
        {% endforeach %}
        {% include "dashboard/elements/roleselect.tpl" %}
    </div>
</div>
</div>
