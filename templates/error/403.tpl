{% extends "base.tpl" %}
{% block "body" %}
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Sorry!</h1>
            <p>You are not approved to access this resource.</p>

            <p><a href="javascript:history.back()">Go back</a> or <a href="/">Go home</a></p>
        </div>
    </div>
</div>
{% endblock %}
