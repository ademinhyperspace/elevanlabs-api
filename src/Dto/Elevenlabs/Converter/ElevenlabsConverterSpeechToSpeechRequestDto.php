<?php

namespace Shahinyanm\ElevenlabsApi\Dto\Elevenlabs\Converter;

use Shahinyanm\ElevenlabsApi\Dto\Dto;

class ElevenlabsConverterSpeechToSpeechRequestDto extends Dto
{
    /**
     * @param string $audio
     * @param string|null $modelId
     * @param array|null $voiceSettings
     */
    public function __construct(
        private readonly string $audio,
        private readonly ?string $modelId,
        private readonly ?array $voiceSettings,
    )
    {
    }

    public function getAudio(): string
    {
        return $this->audio;
    }

    public function getModelId(): ?string
    {
        return $this->modelId;
    }

    public function getVoiceSettings(): ?array
    {
        return $this->voiceSettings;
    }

    /**
     * @return array
     */
    function toArray(): array
    {
        return array_merge([
            'audio' => $this->getAudio(),
            'model_id' => $this->getModelId(),
        ], $this->getVoiceSettings() ? ['voice_settings' => $this->getVoiceSettings(),] : []);
    }
}
