<div class="special-select">
    <label class="select">
        <select>
            <option value="" hidden>Select One</option>
            {% foreach ($channels as $category => $chans): %}
                <optgroup label="{% $category %}">
                {% foreach ($chans as $channel): %}
                    <option value="{% $channel->channel_id %}"{% if (isset($config_channel) && $config_channel['value'] == $channel->channel_id): %} selected{% endif %}>
                        {% if ($channel->type == 'TEXT'): %}#️⃣{% endif %}
                        {% if ($channel->type == 'ANNOUNCEMENT'): %}📢{% endif %}
                        {% if ($channel->type == 'FORUM'): %}🗯️{% endif %}
                        {% if ($channel->type == 'VOICE'): %}🎤{% endif %}
                        {% $channel->channel_name %}
                    </option>
                {% endforeach %}
                </optgroup>
            {% endforeach %}
        </select>
    </label>
</div>
