{% extends "base.tpl" %}
{% block "body" %}
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Sign in with Discord</h1>
            <p>Your login has expired.</p>
            <center>
            <a class="button outline" href="https://discord.com/oauth2/authorize?client_id=1099168660871983166&response_type=code&redirect_uri=https%3A%2F%2Fsween.me%2Fjarvis%2Fdiscord-auth&scope=identify+guilds+guilds.channels.read">
            <img src="img/login.png" alt="Login with Discord">
            </a>
            </center>
        </div>
    </div>
</div>
{% endblock %}
