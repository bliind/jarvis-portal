<div class="special-select">
    <label class="select">
        <select class="special-option">
            <option value="" hidden selected>Select One</option>
            {% foreach ($channels as $channel): %}
            <option value="{% $channel->channel_id %}">{% $channel->channel_name %}</option>
            {% endforeach %}
        </select>
    </label>
</div>
