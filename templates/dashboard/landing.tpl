{% extends "base.tpl" %}
{% block "body" %}
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Dashboard!</h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <select name="server" id="server">
                <option value="" hidden selected>Select server</option>
                {% foreach ($servers as $server): %}
                    <option value="{% $server->server_id %}">{% $server->name %}</option>
                {% endforeach %}
            </select>
        </div>
    </div>
{% endblock %}

{% block "javascript" %}
    <script src="/jarvis/js/landing.js"></script>
{% endblock %}
