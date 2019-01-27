<?php

# [START speech_transcribe_sync]
use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\SpeechContext;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;

/**
 * Transcribe an audio file using Google Cloud Speech API
 * Example:
 * ```
 * transcribe_sync('/path/to/audiofile.flac', '/path/to/brands');
 * ```.
 *
 * @param string $audioFile path to an audio file.
 * @param string $brandFile path to an brand file.
 * @param string $language language to an audio file.
 * @param string $encoding path to an audio file.
 * @param string $rateHertz path to an audio file.

 *
 * @return string the text transcription
 */
function transcribe_sync($audioFile, $brandFile, $language, $encoding, $rateHertz) {
    $brands = explode("\n", file_get_contents($brandFile));

    // change these variables
    $encoding = $encoding;
    $sampleRateHertz = $rateHertz;
    $languageCode = $language;
    $speechContext = new SpeechContext(['phrases'=>$brands]);

    // get contents of a file into a string
    $content = file_get_contents($audioFile);

    // set string as audio content
    $audio = (new RecognitionAudio())
        ->setContent($content);

    // set config
    $config = (new RecognitionConfig())
        ->setEncoding($encoding)
        ->setSampleRateHertz($sampleRateHertz)
        ->setLanguageCode($languageCode)
        ->setSpeechContexts(array($speechContext));

    // create the speech client
    $client = new SpeechClient();
    $transcript = '';

    try {
        $response = $client->recognize($config, $audio);
        foreach ($response->getResults() as $result) {
            $alternatives = $result->getAlternatives();
            $mostLikely = $alternatives[0];
            $transcript = $mostLikely->getTranscript();
            $confidence = $mostLikely->getConfidence();
            printf('Transcript: %s' . PHP_EOL, $transcript);
            printf('Confidence: %s' . PHP_EOL, $confidence);
        }
        return $transcript;
    } finally {
        $client->close();
    }
}
# [END speech_transcribe_sync]
