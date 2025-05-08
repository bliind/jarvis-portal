{% $uri = $request->getUri(); %}
<div class="container bg-primary nav-container">
    <nav class="nav">
        <ul>
            <li><a class="brand" href="#">JARVIS</a></li>
            <li><a href="/jarvis/"{% $uri == '/jarvis/' ? ' class="active"' : '' %}>Home</a></li>
            <li><a href="/jarvis/dashboard"{% $uri == '/jarvis/dashboard' ? ' class="active"' : '' %}>Dashboard</a></li>
        </ul>
        {% if (isset($user)): %}
            <ul class="nav-right">
                <details class="dropdown">
                    <summary class="bg-primary">
                        <img src="https://cdn.discordapp.com/avatars/{% $user['discordID'] %}/{% $user['avatar'] %}.png" width="40" height="40">
                        {% $user['global_name'] %}
                    </summary>
                    <ul>
                        <li><a href="/jarvis/logout">Logout</a></li>
                    </ul>
                </details>
            </ul>
        {% endif %}
    </nav>
</div>
