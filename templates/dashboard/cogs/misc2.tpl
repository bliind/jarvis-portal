<div class="col">
    <div class="group">
        <label>Moderator Roles</label>
        <div class="option-group group" data-key="moderator_roles">
            {% foreach ($configs['moderator_roles'] as $role): %}
            <span class="existing-option" data-value="{% $role['role_id'] %}">{% $role['role_name'] %}</span>
            {% endforeach %}
            {% include "dashboard/elements/roleselect.tpl" %}
        </div>
    </div>
</div>
