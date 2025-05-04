
const fragment = new URLSearchParams(window.location.hash.slice(1));
const [accessToken, tokenType, expiresIn] = [fragment.get('access_token'), fragment.get('token_type'), fragment.get('expires_in')];

if (!accessToken) {
    window.location.href = '/jarvis';
}

function handleResponse(response) {
    const expiresAt = Math.floor(Date.now() / 1000) + parseInt(expiresIn);

    const user = {
        discordID: response.id,
        username: response.username,
        global_name: response.global_name,
        avatar: response.avatar,
        accessToken: accessToken,
        tokenType: tokenType,
        expiresAt: expiresAt
    }

    localStorage.setItem('jarvisuser', JSON.stringify(user));

    fetch(`${window.location.protocol}//${window.location.host}/jarvis/postUserData`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(user)
    }).then(response => {
        setTimeout(() => {
            window.location.replace(`${window.location.protocol}//${window.location.host}/jarvis/dashboard`)
        }, 500);
    });


}

fetch('https://discord.com/api/users/@me', {
    headers: {
        Authorization: `${tokenType} ${accessToken}`
    }
})
.then(result => result.json())
.then(handleResponse);
