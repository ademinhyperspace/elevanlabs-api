<?php

namespace Shahinyanm\ElevenlabsApi\Dto\Elevenlabs\Converter;

use Shahinyanm\ElevenlabsApi\Dto\Dto;

class ElevenlabsConverterTextToSpeechRequestDto extends Dto
{
    /**
     * @param string $modelId
     * @param string $text
     * @param array|null $pronunciationDictionaryLocators
     * @param array|null $voiceSettings
     */
    public function __construct(
        private readonly string $modelId,
        private readonly string $text,
        private readonly ?array $voiceSettings,
        private readonly ?array $pronunciationDictionaryLocators = [],
    )
    {
    }

    /**
     * @return string
     */
    public function getModelId(): string
    {
        return $this->modelId;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return array|null
     */
    public function getPronunciationDictionaryLocators(): ?array
    {
        return $this->pronunciationDictionaryLocators;
    }

    /**
     * @return array|null
     */
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
            'model_id' => $this->getModelId(),
            'text' => $this->getText(),
            'pronunciation_dictionary_locators' => $this->getPronunciationDictionaryLocators(),
        ], $this->getVoiceSettings() ? ['voice_settings' => $this->getVoiceSettings(),] : []);
    }
}
