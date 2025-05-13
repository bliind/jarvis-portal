(function(document) {
    'use strict';

    function handleSelectChange(event) {
        const value = event.target.value;
        const label = event.target.options[event.target.selectedIndex].textContent;
        // find special-select
        const sselect = event.target.parentElement.parentElement;
        // option-group is above that
        const optgroup = sselect.parentElement;

        // create the new option tag
        const newOption = document.createElement('span');
        newOption.classList.add('existing-option');
        newOption.setAttribute('data-value', value);
        newOption.textContent = label;

        // insert before select
        optgroup.insertBefore(newOption, sselect);

        // mark the option hidden
        for (let opt of event.target.options) {
            if (opt.value == value) {
                opt.setAttribute('hidden', true);
                event.target.selectedIndex = 0;
            }
        }
    }
    
    function handleExistingOptionClick(event) {
        const value = event.target.getAttribute('data-value');
        const label = event.target.textContent;

        // find select in the parent
        const select = event.target.parentElement.querySelector('select');
        // unhide the option
        for (let opt of select.options) {
            if (opt.value == value) {
                opt.removeAttribute('hidden');
                event.target.selectedIndex = 0;
            }
        }

        // remove existing-option element
        event.target.remove();
    }

    function createPostData() {
        const optGroups = document.querySelectorAll('.option-group');
        const data = {};
        for (let optGroup of optGroups) {
            const key = optGroup.getAttribute('data-key');
            data[key] = [];
            const options = optGroup.querySelectorAll('.existing-option');
            for (let option of options) {
                data[key].push(option.getAttribute('data-value'));
            }
        }

        return data;
    }

    function saveChanges() {
        data = createPostData();
        console.log(JSON.stringify(data));
        // fetch to endpoint to receive data
    }

    function init() {
        // handle adding tags from the select boxes
        document.addEventListener('change', e => {
            if (e.target.classList.contains('special-option')) {
                handleSelectChange(e);
            }
        });

        // handle removing tags and re-enabling in select boxes
        document.addEventListener('click', e => {
            if (e.target.classList.contains('existing-option')) {
                handleExistingOptionClick(e);
            }
        });

        // save the data
        document.querySelector('#save').addEventListener('click', saveChanges);
    }

    document.addEventListener('DOMContentLoaded', init);
})(document);
