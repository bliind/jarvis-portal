{% $uri = $request->getUri(); %}
<nav>
    <div class="container nav-container bg-blue">
        <ul>
            <li class="brand"><a href="#">JARVIS</a></li>
            <li><a href="/jarvis/"{% $uri == '/jarvis/' ? ' class="active"' : '' %}>Home</a></li>
            <li><a href="/jarvis/dashboard"{% $uri == '/jarvis/dashboard' ? ' class="active"' : '' %}>Dashboard</a></li>
        </ul>

        {% if (isset($user)): %}
        <ul class="pos-abs" style="right:1rem;top:1.1rem;"><li>
            <details class="dropdown">
                <summary class="bg-blue">
                    <img src="https://cdn.discordapp.com/avatars/{% $user['discordID'] %}/{% $user['avatar'] %}.png" width="40" height="40">
                    {% $user['global_name'] %}
                </summary>
                <ul>
                    <li><a href="/jarvis/logout">Logout</a></li>
                </ul>
            </details>
        </li></ul>
        {% endif %}
    </div>
    <div class="hamburger nav-container bg-blue">
        <input type="checkbox" id="hamburger-button">
        <label for="hamburger-button">
            &#9776;
            <span class="brand">JARVIS</span>
        </label>
        <div class="menu">
            <ul>
                <li><a href="/jarvis/"{% $uri == '/jarvis/' ? ' class="active"' : '' %}>Home</a></li>
                <li><a href="/jarvis/dashboard"{% $uri == '/jarvis/dashboard' ? ' class="active"' : '' %}>Dashboard</a></li>
            </ul>
        </div>
    </div>
</nav>
