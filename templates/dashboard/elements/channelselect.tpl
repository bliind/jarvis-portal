<div class="special-select">
    <label class="select">
        <select class="special-option">
            <option value="" hidden selected>Select One</option>
            {% foreach ($channels as $category => $chans): %}
                <optgroup label="{% $category %}">
                {% foreach ($chans as $channel): %}
                    {% if (!in_array($channel->channel_id, $skip)): %}
                    <option value="{% $channel->channel_id %}">
                        {% if ($channel->type == 'TEXT'): %}#️⃣{% endif %}
                        {% if ($channel->type == 'ANNOUNCEMENT'): %}📢{% endif %}
                        {% if ($channel->type == 'FORUM'): %}🗯️{% endif %}
                        {% if ($channel->type == 'VOICE'): %}🎤{% endif %}
                        {% $channel->channel_name %}
                    </option>
                    {% endif %}
                {% endforeach %}
                </optgroup>
            {% endforeach %}
        </select>
    </label>
</div>
