# Google Cloud Speech API Samples

These samples show how to use the [Google Cloud Speech API][speech-api]
to transcribe audio files.

1. It takes mp4 files as argument
2. Converts it to audio in FLAC encoding (lossless encoding ) and Breaks the audio file into 10 secs clips
3. transcribes each 10 sec audio file and prints the speech to text result on console. 


##Prerequisite

0. Setup Google Cloud [Speech Project][speech-quickstart]
1. Install ffmpeg on your machine (linux)


## Installation

Install the dependencies for this library via [composer](https://getcomposer.org)

    $ cd /path/to/php-docs-samples/speech
    $ composer install

Configure your project using [Application Default Credentials]

    $ export GOOGLE_APPLICATION_CREDENTIALS=/path/to/credentials.json


## Usage

To run the Speech Samples:

    $ php speech.php

    Cloud Speech

    Usage:
      command [options] [arguments]

    Options:
      -h, --help            Display this help message
      -q, --quiet           Do not output any message
      -V, --version         Display this application version
          --ansi            Force ANSI output
          --no-ansi         Disable ANSI output
      -n, --no-interaction  Do not ask any interactive question
      -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

    Available commands:
      help                    Displays help for a command
      list                    Lists commands
      transcribe              Transcribe an audio file using Google Cloud Speech API

Once you have a speech sample in the proper format, send it through the speech
API using the transcribe command:

```sh
php speech.php transcribe [path to audiofile]

```


## Troubleshooting

If you get the following error, set the environment variable `GCLOUD_PROJECT` to your project ID:

```
[Google\Cloud\Core\Exception\GoogleException]
No project ID was provided, and we were unable to detect a default project ID.
```

[speech-api]: http://cloud.google.com/speech
[speech-quickstart]: https://cloud.google.com/speech-to-text/docs/quickstart-client-libraries
[google-cloud-php]: https://googlecloudplatform.github.io/google-cloud-php/
[choose-encoding]: https://cloud.google.com/speech/docs/best-practices#choosing_an_audio_encoding
