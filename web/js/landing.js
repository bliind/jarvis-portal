(function(document) {
    'use strict';

    function init() {
        const serverBox = document.querySelector('#server');
        serverBox.addEventListener('change', event => {
            const url = `${window.location.protocol}//${window.location.host}/jarvis/dashboard/${serverBox.value}`;
            window.location.replace(url);
        });
    }

    document.addEventListener('DOMContentLoaded', init);
})(document)
