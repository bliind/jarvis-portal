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
            <form>
                <fieldset>
                    <label>
                        Moderator Roles
                        {% foreach ($configs as $config): %}
                            {% if ($config->key == 'moderator_roles'): %}
                            <input type="text" name="moderator_roles[]" value="{% $config->value %}">
                            {% endif %}
                        {% endforeach %}
                    </label>
                </fieldset>
            </form>
        </div>
    </div>
</div>
{% endblock %}
