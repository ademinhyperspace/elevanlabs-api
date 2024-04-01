<?php

namespace Shahinyanm\ElevenlabsApi\Client\Elevenlabs\v1;


use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Shahinyanm\ElevenlabsApi\Dto\Elevenlabs\Converter\ElevenlabsConverterSpeechToSpeechRequestDto;
use Shahinyanm\ElevenlabsApi\Enums\Client\Elevenlabs\ElevenlabsConfigEnum;

abstract class ElevenlabsClient
{
    const VERSION = '/v1';

    protected PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::asJson()->withHeaders(
            [
                'xi-api-key' => config('elevenlabs-api.api_key'),
                "Content-Type" => "application/json",
            ]
        )->baseUrl(config('elevenlabs-api.base_url') . self::VERSION);
    }

    protected function convertingRequestWithVoiceId(
        ElevenlabsConfigEnum $elevenlabsConfig,
        string $voiceId,
        string $jsonBody,
        string $filePath,
    ): Response {
        return $this->client->sink($filePath)->send(
            ...$elevenlabsConfig->options([
            'voice_id' => $voiceId
        ], [
                'body' => $jsonBody,
            ]
        ));
    }
}
