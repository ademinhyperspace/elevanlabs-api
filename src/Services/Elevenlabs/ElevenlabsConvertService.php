<?php

namespace Shahinyanm\ElevenlabsApi\Services\Elevenlabs;

use Exception;
use Illuminate\Support\Str;
use Shahinyanm\ElevenlabsApi\Client\Elevenlabs\v1\Convert\ElevenlabsConvertClient;
use Shahinyanm\ElevenlabsApi\Dto\Elevenlabs\Converter\ElevenlabsConverterSpeechToSpeechRequestDto;
use Shahinyanm\ElevenlabsApi\Dto\Elevenlabs\Converter\ElevenlabsConverterTextToSpeechRequestDto;
use Shahinyanm\ElevenlabsApi\Dto\Elevenlabs\Converter\ElevenlabsConverterTextToSpeechStreamRequestDto;
use Shahinyanm\ElevenlabsApi\Traits\FileSystem\HasFileMethod;

class ElevenlabsConvertService
{
    use HasFileMethod;

    CONST FILE_EXTENSION = '.mpeg';

    /**
     * @var ElevenlabsConvertClient
     */
    private ElevenlabsConvertClient $client;

    /**
     * @var string
     */
    private string $fileName;

    public function __construct()
    {
        $this->client = new ElevenlabsConvertClient();
        $this->fileName = Str::random(12) . self::FILE_EXTENSION;
    }

    /**
     * @param string $voiceId
     * @param string $modelId
     * @param string $text
     * @param array|null $voiceSettings
     * @param array|null $pronunciationDictionaryLocators
     * @return string
     * @throws Exception
     */
    public function convertTextToSpeech(
        string $voiceId,
        string $modelId,
        string $text,
        ?array $voiceSettings = null,
        ?array $pronunciationDictionaryLocators = [],
    ): string
    {
        $this->client->textToSpeechConvertRequest(
            $voiceId,
            new ElevenlabsConverterTextToSpeechRequestDto(
                $modelId,
                $text,
                $pronunciationDictionaryLocators,
                $voiceSettings,
            ),
            $this->fileName,
        );
        return $this->saveConvertedFile(config('elevenlabs-api.storage.path.textToSpeech'), $this->fileName);
    }

    /**
     * @param string $voiceId
     * @param string $modelId
     * @param string $text
     * @param array|null $voiceSettings
     * @param array|null $pronunciationDictionaryLocators
     * @return string
     * @throws Exception
     */
    public function streamTextToSpeechConvert(
        string $voiceId,
        string $modelId,
        string $text,
        ?array $voiceSettings = null,
        ?array $pronunciationDictionaryLocators = [],
    ): string {
        $this->client->streamTextToSpeechConvertRequest(
            $voiceId,
            new ElevenlabsConverterTextToSpeechStreamRequestDto(
                $modelId,
                $text,
                $pronunciationDictionaryLocators,
                $voiceSettings,
            ),
            $this->fileName,
        );
        return $this->saveConvertedFile(config('elevenlabs-api.storage.path.textToSpeechStream'), $this->fileName);
    }

    /**
     * @param string $voiceId
     * @param string $audio
     * @param string|null $modelId
     * @param array|null $voiceSettings
     * @return string
     * @throws Exception
     */
    public function convertSpeechToSpeech(
        string $voiceId,
        string $audio,
        ?string $modelId = null,
        ?array $voiceSettings = null,
    ): string {
        $this->client->speechToSpeechConvertRequest(
            $voiceId,
            new ElevenlabsConverterSpeechToSpeechRequestDto(
                $audio,
                $modelId,
                $voiceSettings,
            ),
            $this->fileName,
        );
        return $this->saveConvertedFile(config('elevenlabs-api.storage.path.speechToSpeech'), $this->fileName);
    }

}
