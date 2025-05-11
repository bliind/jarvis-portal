{% $uri = $request->getUri(); %}
{* <div class="container bg-primary nav-container"> *}
    {* <nav class="nav"> *}
        {* <ul> *}
            {* <li><a class="brand" href="#">JARVIS</a></li> *}
            {* <li><a href="/jarvis/"{% $uri == '/jarvis/' ? ' class="active"' : '' %}>Home</a></li> *}
            {* <li><a href="/jarvis/dashboard"{% $uri == '/jarvis/dashboard' ? ' class="active"' : '' %}>Dashboard</a></li> *}
        {* </ul> *}
        {* {% if (isset($user)): %} *}
            {* <ul class="nav-right"> *}
                {* <details class="dropdown"> *}
                    {* <summary class="bg-primary"> *}
                        {* <img src="https://cdn.discordapp.com/avatars/{% $user['discordID'] %}/{% $user['avatar'] %}.png" width="40" height="40"> *}
                        {* {% $user['global_name'] %} *}
                    {* </summary> *}
                    {* <ul> *}
                        {* <li><a href="/jarvis/logout">Logout</a></li> *}
                    {* </ul> *}
                {* </details> *}
            {* </ul> *}
        {* {% endif %} *}
    {* </nav> *}
{* </div> *}
<nav>
    <div class="container">
        <ul>
            <li class="brand"><a href="#">JARVIS</a></li>
            <li><a href="/jarvis/"{% $uri == '/jarvis/' ? ' class="active"' : '' %}>Home</a></li>
            <li><a href="/jarvis/dashboard"{% $uri == '/jarvis/dashboard' ? ' class="active"' : '' %}>Dashboard</a></li>
        </ul>

        {% if (isset($user)): %}
            <ul><li>
                <details class="dropdown">
                    <summary class="bg-primary">
                        <img src="https://cdn.discordapp.com/avatars/{% $user['discordID'] %}/{% $user['avatar'] %}.png" width="40" height="40">
                        {% $user['global_name'] %}
                    </summary>
                    <ul>
                        <li><a href="/jarvis/logout">Logout</a></li>
                    </ul>
                </details>
            </li></ul>
        {% endif %}
        <ul>
            <li>
                <div href="#" class="dropdown">
                    JohnQ &#x25be;
                    <div class="menu">
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <div class="hamburger">
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
