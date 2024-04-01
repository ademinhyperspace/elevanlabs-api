<?php

namespace Shahinyanm\ElevenlabsApi\Services\Elevenlabs;

use Exception;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Shahinyanm\ElevenlabsApi\Client\Elevenlabs\v1\Convert\ElevenlabsConvertClient;
use Shahinyanm\ElevenlabsApi\Dto\Elevenlabs\Converter\ElevenlabsConverterSpeechToSpeechRequestDto;
use Shahinyanm\ElevenlabsApi\Dto\Elevenlabs\Converter\ElevenlabsConverterTextToSpeechRequestDto;
use Shahinyanm\ElevenlabsApi\Dto\Elevenlabs\Converter\ElevenlabsConverterTextToSpeechStreamRequestDto;

class ElevenlabsConvertService
{
    CONST FILE_EXTENSION = '.mpeg';

    /**
     * @var ElevenlabsConvertClient
     */
    private ElevenlabsConvertClient $client;

    public function __construct()
    {
        $this->client = new ElevenlabsConvertClient();
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
        $fileName = Str::random(12) . self::FILE_EXTENSION;
        $this->client->textToSpeechConvertRequest(
            $voiceId,
            new ElevenlabsConverterTextToSpeechRequestDto(
                $modelId,
                $text,
                $pronunciationDictionaryLocators,
                $voiceSettings,
            ),
            $fileName,
        );
        Storage::disk('public')->put('envelope/text-to-speech', new File($fileName));
        return Storage::disk('public')->url("envelope/text-to-speech/$fileName");
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
        $fileName = Str::random(12) . self::FILE_EXTENSION;
        $this->client->streamTextToSpeechConvertRequest(
            $voiceId,
            new ElevenlabsConverterTextToSpeechStreamRequestDto(
                $modelId,
                $text,
                $pronunciationDictionaryLocators,
                $voiceSettings,
            ),
            $fileName,
        );
        Storage::disk('public')->put('envelope/text-to-speech-stream', new File($fileName));
        return Storage::disk('public')->url("envelope/text-to-speech/$fileName");
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
        $fileName = Str::random(12) . self::FILE_EXTENSION;
        $this->client->speechToSpeechConvertRequest(
            $voiceId,
            new ElevenlabsConverterSpeechToSpeechRequestDto(
                $audio,
                $modelId,
                $voiceSettings,
            ),
            $fileName,
        );
        Storage::disk('public')->put('envelope/speech-to-speech-stream', new File($fileName));
        return Storage::disk('public')->url("envelope/speech-to-speech/$fileName");
    }

}
