<?php
/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
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
    new InputArgument('audio-file', InputArgument::REQUIRED, 'The audio file to transcribe'),
    new InputOption('model', null, InputOption::VALUE_REQUIRED, 'The model to use'),
    new InputOption('encoding', null, InputOption::VALUE_REQUIRED,
        'The encoding of the audio file. This is required if the encoding is ' .
        'unable to be determined. '
    )
]);

$application = new Application('Cloud Speech');
$application->add(new Command('transcribe'))
    ->setDefinition($inputDefinition)
    ->setDescription('Transcribe an audio file using Google Cloud Speech API')
    ->setHelp(<<<EOF
The <info>%command.name%</info> command transcribes audio from a file using the
Google Cloud Speech API.

<info>php %command.full_name% audio_file.wav</info>

EOF
    )
    ->setCode(function (InputInterface $input, OutputInterface $output) {
        $audioFile = $input->getArgument('audio-file');
	$outAudioFile = basename(substr($audioFile, 0, strrpos($audioFile, ".")));
	$path = "resources/$outAudioFile";
	shell_exec("rm -rf resources/$outAudioFile && mkdir resources/$outAudioFile");
	shell_exec("ffmpeg -i $audioFile -loglevel error -f segment -segment_time 10  -ac 1 $path/$outAudioFile"."_%02d.flac");
	$files = array_diff(scandir($path), array('.', '..'));
	foreach($files as $file) {
	  printf("%s \n", $file);
	  transcribe_sync("$path/$file");	
	}
    });

$application->run();
