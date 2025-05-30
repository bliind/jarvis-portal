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

    <div class="row configs">
        {% include "dashboard/cogs/misc2.tpl" %}
    </div>

    <div class="row">
        <div class="col">
            <div class="group">
                <button class="btn-green" id="save">Save Changes</button>
            </div>
        </div>
    </div>
</div>
{% endblock %}

{% block "javascript" %}
    <script>
        const all_roles = JSON.parse('{% echo(json_encode($roles)); %}');
        function roleById(roleID) {
            return all_roles.find(r => r['role_id'] == roleID);
        }
    </script>
    <script src="/jarvis/js/tagSelect.js"></script>
{% endblock %}
