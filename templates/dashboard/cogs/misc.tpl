<div class="col">
    <details name="configs">
        <summary>Auto Publish</summary>
        <label class="group">
            Channels to Auto-Publish
            {% foreach ($configs['auto_publish_channels'] as $channel): %}
                {% $name = 'auto_publish_channels'; %}
                {% $value = $channel %}
                {% include "dashboard/elements/input.tpl" %}
            {% endforeach %}
        </label>
    </details>

    <details name="configs">
        <summary>Caps Protection</summary>
        <label class="group">
            Moderator Roles (Immune)
            {% foreach ($configs['moderator_roles'] as $role): %}
                {% $name = 'moderator_roles'; %}
                {% $value = $role %}
                {% include "dashboard/elements/input.tpl" %}
            {% endforeach %}
        </label>
        <label class="group">
            Immune Channels
            {% foreach ($configs['caps_prot_immune_channels'] as $channel): %}
                {% $name = 'caps_prot_immune_channels'; %}
                {% $value = $channel %}
                {% include "dashboard/elements/input.tpl" %}
            {% endforeach %}
        </label>
        <label class="group">
            Immune Roles
            {% foreach ($configs['caps_prot_immune_roles'] as $role): %}
                {% $name = 'caps_prot_immune_roles'; %}
                {% $value = $role %}
                {% include "dashboard/elements/input.tpl" %}
            {% endforeach %}
        </label>
        <label class="group">
            Caps% of Message to Trigger at
            {% foreach ($configs['caps_prot_percent'] as $percent): %}
                {% $name = 'caps_prot_percent'; %}
                {% $value = $percent %}
                {% $single = true %}
                {% include "dashboard/elements/input.tpl" %}
            {% endforeach %}
        </label>
        <label class="group">
            Message to Send on Trigger
            {% foreach ($configs['caps_prot_message'] as $message): %}
                {% $name = 'caps_prot_message'; %}
                {% $value = $message %}
                {% include "dashboard/elements/input.tpl" %}
                {% $single = false %}
            {% endforeach %}
        </label>
    </details>
</div>
