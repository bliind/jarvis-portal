<div class="col">
    <details name="configs" open="">
        <summary class="text-big">Main</summary>
        <div class="group">
            <h3>Moderator Roles</h3>
            <p class="text-sm">Immune to caps protection. Flags ask-the-team posts on reply.</p>
            <div class="option-group group" data-key="moderator_roles">
                {% $config_roles = $configs['moderator_roles']; %}
                {% include "dashboard/elements/existingroles.tpl" %}
                {% include "dashboard/elements/roleselect.tpl" %}
            </div>
        </div>
    </details>

    <details name="configs">
        <summary class="text-big">Team Answers</summary>
        <div class="group">
            <h3>Developer Roles</h3>
            <div class="option-group group" data-key="developer_roles">
                {% $config_roles = $configs['developer_roles']; %}
                {% include "dashboard/elements/existingroles.tpl" %}
                {% include "dashboard/elements/roleselect.tpl" %}
            </div>
        </div>
        <div class="group">
            <h3>Team Questions Channels</h3>
            <div class="option-group group" data-key="team_question_channels">
                {% $config_channels = $configs['team_question_channels']; %}
                {% include "dashboard/elements/existingchannels.tpl" %}
                {% include "dashboard/elements/channelselect.tpl" %}
            </div>
        </div>
        <div class="group">
            <h3>Team Answers Channel</h3>
            <div class="option-group group" data-key="team_answer_channel">
                {% $config_channel = $configs['team_answer_channel']; %}
                {% include "dashboard/elements/singlechannel.tpl" %}
            </div>
        </div>
    </details>

    <details name="configs">
        <summary class="text-big">Caps Protection</summary>
        <div class="group">
            <h3>Immune Roles</h3>
            <div class="option-group group" data-key="caps_prot_immune_roles">
                {% $config_roles = $configs['caps_prot_immune_roles']; %}
                {% include "dashboard/elements/existingroles.tpl" %}
                {% include "dashboard/elements/roleselect.tpl" %}
            </div>
        </div>

        <div class="group">
            <h3>Immune Channels</h3>
            <div class="option-group group" data-key="caps_prot_immune_channels">
                {% $config_channels = $configs['caps_prot_immune_channels']; %}
                {% include "dashboard/elements/existingchannels.tpl" %}
                {% include "dashboard/elements/channelselect.tpl" %}
            </div>
        </div>
    </details>
</div>
