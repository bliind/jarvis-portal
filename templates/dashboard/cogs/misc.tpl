<div class="col">
    <p>Caps Protection</p>
    <form>
        <fieldset>
            <label>
                Moderator Roles
                {% foreach ($configs['moderator_roles'] as $role): %}
                    {% $name = 'moderator_roles'; %}
                    {% $value = $role %}
                    {% include "dashboard/elements/input.tpl" %}
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
