<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JARVIS{% @$title ? ' | ' . $title : '' %}</title>
    <link rel="icon" type="image/x-icon" href="/jarvis/favicon.ico">
    {* <link rel="stylesheet" href="https://unpkg.com/chota@latest"> *}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="/jarvis/css/style.css">
    {% block "stylesheets" %}
    {% endblock %}
</head>
<body>
    {% include "nav.tpl" %}
    {% block "body" %}
    {% endblock %}

    <script>
        if (window.matchMedia &&
            window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.body.classList.add('dark');
        }
    </script>

    {% if (isset($user)): %}
    <script>
        const user = {
            {% foreach ($user as $key => $value): %}
            "{% $key %}": "{% $value %}",
            {% endforeach %}
        }
    </script>
    {% endif %}

    {% if (!isset($logout)): %}
    <script src="/jarvis/js/postUserData.js"></script>
    {% endif %}
    {% block "javascript" %}
    {% endblock %}
</body>
</html>
