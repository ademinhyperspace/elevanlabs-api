<?php

namespace Shahinyanm\ElevenlabsApi\Enums\Client\Elevenlabs;

enum ElevenlabsConfigEnum: string
{
    case TEXT_TO_SPEECH = 'text-to-speech';
    case TEXT_TO_SPEECH_STREAM = 'text-to-speech-stream';
    case SPEECH_TO_SPEECH = 'speech-to-speech';

    /**
     * @param array $args
     * @param array $options
     * @return array
     */
    public function options(array $args = [], array $options = []): array
    {
        return match ($this) {
            self::TEXT_TO_SPEECH => [
                'method' => 'post',
                'url' => "/text-to-speech/{$args['voice_id']}",
                'options' => $options,
            ],
            self::TEXT_TO_SPEECH_STREAM => [
                'method' => 'post',
                'url' => "/text-to-speech/{$args['voice_id']}/stream",
                'options' => $options,
            ],
            self::SPEECH_TO_SPEECH => [
                'method' => 'post',
                'url' => "/speech-to-speech/{$args['voice_id']}",
                'options' => $options,
            ],
        };
    }
}
