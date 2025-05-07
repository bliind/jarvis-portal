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
                {% foreach ($servers as $server): %}
                    <option value="{$server['id']}">{$server['name']}</option>
                {% endforeach %}
            </select>
        </div>
    </div>
{% endblock %}
