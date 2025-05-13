<div class="col">
    <div class="group">
        <h3>Moderator Roles</h3>
        <div class="option-group group" data-key="moderator_roles">
            {% $skip = []; %}
            {% foreach ($configs['moderator_roles'] as $role): %}
            <span class="existing-option" data-value="{% $role->value %}">{% $role->role_name %}</span>
            {% $skip[] = $role->role_id; %}
            {% endforeach %}
            {% include "dashboard/elements/roleselect.tpl" %}
        </div>
    </div>

    <div class="group">
        <h3>Developer Roles</h3>
        <div class="option-group group" data-key="developer_roles">
            {% $skip = []; %}
            {% foreach ($configs['developer_roles'] as $role): %}
            <span class="existing-option" data-value="{% $role->value %}">{% $role->role_name %}</span>
            {% $skip[] = $role->role_id; %}
            {% endforeach %}
            {% include "dashboard/elements/roleselect.tpl" %}
        </div>
    </div>

    <details>
        <summary class="text-big">Caps Protection</summary>
        <div class="group">
            <h4>Immune Roles</h4>
            <div class="option-group group" data-key="caps_prot_immune_roles">
                {% $skip = []; %}
                {% foreach ($configs['caps_prot_immune_roles'] as $role): %}
                <span class="existing-option" data-value="{% $role->value %}">{% $role->role_name %}</span>
                {% $skip[] = $role->role_id; %}
                {% endforeach %}
                {% include "dashboard/elements/roleselect.tpl" %}
            </div>
        </div>

        <div class="group">
            <h4>Immune Channels</h4>
            <div class="option-group group" data-key="caps_prot_immune_channels">
                {% $skip = []; %}
                {% foreach ($configs['caps_prot_immune_channels'] as $channel): %}
                <span class="existing-option" data-value="{% $channel->value %}">#{% $channel->channel_name %}</span>
                {% $skip[] = $channel->channel_id; %}
                {% endforeach %}
                {% include "dashboard/elements/channelselect.tpl" %}
            </div>
        </div>
    </details>
</div>
