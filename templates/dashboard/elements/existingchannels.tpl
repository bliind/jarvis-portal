{% $skip = []; %}
{% foreach ($config_channels as $channel): %}
    <span class="existing-option" data-value="{% $channel->value %}">
        {% if ($channel->type == 'TEXT'): %}#️⃣{% endif %}
        {% if ($channel->type == 'ANNOUNCEMENT'): %}📢{% endif %}
        {% if ($channel->type == 'FORUM'): %}🗯️{% endif %}
        {% if ($channel->type == 'VOICE'): %}🎤{% endif %}
        {% $channel->channel_name %}
    </span>
    {% $skip[] = $channel->channel_id; %}
{% endforeach %}
