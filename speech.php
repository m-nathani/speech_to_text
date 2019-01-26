<?php

namespace Google\Cloud\Samples\Speech;

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

$inputDefinition = new InputDefinition([
    new InputArgument('video-file', InputArgument::REQUIRED, 'The video file to transcribe'),
    new InputOption('language', null, InputOption::VALUE_REQUIRED, 'The language to transcribe'),
    new InputOption('encoding', null, InputOption::VALUE_REQUIRED,
        'The encoding of the audio file. This is required if the encoding is ' .
        'unable to be determined. '),
    new InputOption('brand-file', null, InputOption::VALUE_REQUIRED,
        'The brand names for speech context to transcribe')
]);

$application = new Application('Cloud Speech');
$application->add(new Command('transcribe'))
    ->setDefinition($inputDefinition)
    ->setDescription('Transcribe an vidoe file using Google Cloud Speech API')
    ->setHelp(<<<EOF
The <info>%command.name%</info> command transcribes video from a file using the
Google Cloud Speech API.

<info>php %command.full_name% video_file.mp4</info>

EOF
    )
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        $videoFile = $input->getArgument('video-file');
        $resourcesPath = dirname(__FILE__)."/resources";
        $brandFile = dirname(__FILE__)."/brands";
        $transcript = '';

        list($audioPath, $files) = transform_video($videoFile, $resourcesPath);
        foreach($files as $file) {
            printf('Audio File: %s' . PHP_EOL, $file);
            $transcript .= transcribe_sync("$audioPath/$file", $brandFile) . ' ';
        }
        printf("Complete transcript:  %s \n", $transcript);
    });

$application->run();
