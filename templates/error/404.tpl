{% extends "base.tpl" %}
{% block "body" %}
    <div class="container">
        <h1>Page Not Found</h1>
        <p>Well, this is embarrassing.</p>
        {* test *}
        <p><a href="javascript:history.back()">Go back</a> or <a href="/">Go home</a></p>
    </div>
{% endblock %}
