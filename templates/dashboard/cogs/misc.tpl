<div class="col">
    <h2>Caps Protection</h2>
    <form>
        <fieldset>
            <label>
                Moderator Roles (Immune)
                {% foreach ($configs['moderator_roles'] as $role): %}
                    {% $name = 'moderator_roles'; %}
                    {% $value = $role %}
                    {% include "dashboard/elements/input.tpl" %}
                {% endforeach %}
            </label>
            <label>
                Immune Channels
                {% foreach ($configs['caps_prot_immune_channels'] as $channel): %}
                    {% $name = 'caps_prot_immune_channels'; %}
                    {% $value = $channel %}
                    {% include "dashboard/elements/input.tpl" %}
                {% endforeach %}
            </label>
            <label>
                Immune Roles
                {% foreach ($configs['caps_prot_immune_roles'] as $role): %}
                    {% $name = 'caps_prot_immune_roles'; %}
                    {% $value = $role %}
                    {% include "dashboard/elements/input.tpl" %}
                {% endforeach %}
            </label>
            <label>
                Caps% of Message to Trigger at
                {% foreach ($configs['caps_prot_percent'] as $percent): %}
                    {% $name = 'caps_prot_percent'; %}
                    {% $value = $percent %}
                    {% $single = true %}
                    {% include "dashboard/elements/input.tpl" %}
                {% endforeach %}
            </label>
            <label>
                Message to Send on Trigger
                {% foreach ($configs['caps_prot_message'] as $message): %}
                    {% $name = 'caps_prot_message'; %}
                    {% $value = $message %}
                    {% include "dashboard/elements/input.tpl" %}
                    {% $single = false %}
                {% endforeach %}
            </label>
        </fieldset>
    </form>
</div>
{* moderator_roles *}
{* caps_prot_immune_channels *}
{* caps_prot_immune_roles *}
{* caps_prot_message *}
{* caps_prot_percent *}
{* auto_publish_channels *}
