{% extends "base.tpl" %}
{% block "body" %}
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Welcome to JARVIS HQ!</h1>
            <div class="card">
                <header>
                    <h4>What is JARVIS?</h4>
                </header>
                <p>JARVIS is a Discord bot with a handful of utilities, specially crafted for the MARVEL SNAP server.</p>
            </div>
            <br>
            {% if (isset($user)): %}
            <p><a href="/jarvis/dashboard">Go to the Dashboard</a></p>
            {% else: %}
            <p>Have a server with JARVIS? <a href="https://discord.com/oauth2/authorize?client_id=1099168660871983166&response_type=code&redirect_uri=https%3A%2F%2Fsween.me%2Fjarvis%2Fdiscord-auth&scope=identify+guilds+guilds.channels.read">Login with Discord</a> to get started.</p>
            {% endif %}
        </div>
    </div>
</div>
{% endblock %}
