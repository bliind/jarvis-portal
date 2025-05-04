{% extends "base.tpl" %}
{% block "body" %}
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Dashboard!</h1>
            <p>In the future, this will have stuff on it for you to change configs.</p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h3>Oh, you don't believe me?</h3>
            <p>Here's a little taste...</p>
            <ul>
                {% foreach ($configs as $config): %}
                <li>{% $config->key %} = {% $config->value %}</li>
                {% endforeach %}
            </ul>
        </div>
    </div>
</div>
{% endblock %}
