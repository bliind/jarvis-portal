{% extends "base.tpl" %}
{% block "body" %}
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Welcome to the Dashboard!</h1>
            <p>
                Adjusting configuration options for
                <img src="https://cdn.discordapp.com/icons/{% $server->server_id %}/{% $server->icon %}.png" width="40" height="40">
                {% $server->name %}
            </p>
        </div>
    </div>

    <div class="row">
        {% include "dashboard/cogs/misc.tpl" %}
    </div>
</div>
{% endblock %}
