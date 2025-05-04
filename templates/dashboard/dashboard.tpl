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
                        {% foreach ($configs['moderator_roles'] as $role): %}
                            <fieldset role="group">
                                <input type="text" name="moderator_roles[]" value="{% $role %}">
                                <button class="delete pico-background-red-500">Delete</button>
                                <button class="update pico-background-green-300">Update</button>
                            </fieldset>
                            {% endif %}
                        {% endforeach %}
                    </label>
                </fieldset>
            </form>
        </div>
    </div>
</div>
{% endblock %}
