if (typeof user === 'undefined') {
    const userData = localStorage.getItem('jarvisuser');
    if (userData) {
        fetch(`${window.location.protocol}//${window.location.host}/jarvis/postUserData`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: userData
        }).then(() => {
            location.reload();
        });
    }
}
