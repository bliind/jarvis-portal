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
                        {% endforeach %}
                    </label>
                    <label>
                        Caps Protection Percentage
                        <fieldset role="group">
                            <input type="text" name="caps_prot_percent" value="{% $configs['caps_prot_percent'][0] %}">
                            <button class="delete pico-background-red-500">Delete</button>
                            <button class="update pico-background-green-300">Update</button>
                        </fieldset>
                    </label>
                    <label>
                        Caps Protection Immune Channels
                        {% foreach ($configs['caps_prot_immune_channels'] as $channel): %}
                            <fieldset role="group">
                                <input type="text" name="caps_prot_immune_channels[]" value="{% $channel %}">
                                <button class="delete pico-background-red-500">Delete</button>
                                <button class="update pico-background-green-300">Update</button>
                            </fieldset>
                        {% endforeach %}
                    </label>
                </fieldset>
            </form>
        </div>
    </div>
</div>
{% endblock %}
