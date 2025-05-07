{% extends "base.tpl" %}

{% block "body" %}
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Redirecting...</h1>
            <p>You will be redirected shortly.</p>
        </div>
    </div>
</div>
{% endblock %}

{% block "javascript" %}
    <script src="/jarvis/js/discord-auth.js"></script>
{% endblock %}
