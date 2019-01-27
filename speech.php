<?php

require __DIR__ . '/vendor/autoload.php';

$application = new Silly\Application('Cloud Speech');
$application->command('transcribe video-file [-l|--language=] [-e|--encoding=] [-b|--brand-file=] [-r|--rate-hertz=]',
 function ($videoFile, $language='en-US', $encoding=2, $brandFile="brands", $rateHertz=48000) {

    $resourcesPath = dirname(__FILE__)."/resources";
    $transcript = '';

    list($audioPath, $audioFiles) = transform_video($videoFile, $resourcesPath);
    foreach($audioFiles as $file) {
        printf('Audio File: %s' . PHP_EOL, $file);
        $transcript .= transcribe_sync("$audioPath/$file", $brandFile, $language, $encoding, $rateHertz) . ' ';
    }
    printf("Complete transcript:  %s \n", $transcript);


})->descriptions('Transcribe an video file using Google Cloud Speech API'.
'
The <info>%command.name%</info> command transcribes video from a file using the
Google Cloud Speech API.

<info>php %command.full_name% video_file.mp4</info>', [
    'video-file'   => 'The video file to transcribe',
    '--language'   => 'The language to transcribe',
    '--encoding'   => 'The encoding of the audio file. This is required if the encoding is unable to be determined.',
    '--rate-hertz' => 'The sample rate (in Hertz) of the supplied video',
    '--brand-file' => 'The brand names for speech context to transcribe',
]);

$application->run();
