<div class="special-select">
    <label class="select">
        <select class="special-option">
            <option value="" hidden selected>Select One</option>
            {% foreach ($channels as $channel): %}
            {% if (isset($skip) && !in_array($channel->channel_id, $skip)): %}
            <option value="{% $channel->channel_id %}">
                {% if ($channel->type == 'TEXT'): %}#{% endif %}{% $channel->channel_name %}
            </option>
            {% endif %}
            {% endforeach %}
        </select>
    </label>
</div>
