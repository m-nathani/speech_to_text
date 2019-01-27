# Google Cloud Speech
These samples show how to use the [Google Cloud Speech API][speech-api]
to transcribe audio files.

1. It takes mp4 files as argument
2. Converts it to audio in FLAC encoding (lossless encoding ) and Breaks the audio file into 10 secs clips
3. transcribes each 10 sec audio file and prints the speech to text result on console. 


## Prerequisite

0. Setup Google Cloud [Speech Project][speech-quickstart]
1. Install ffmpeg on your machine (linux)


## Installation

Install the dependencies for this library via [composer](https://getcomposer.org)

    $ cd /path/to/speech_to_text
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
      transcribe              Transcribe an video file using Google Cloud Speech API


## Help

      $ php speech.php transcribe --help

    Usage:
        transcribe [options] [--] <video-file>

    Arguments:
        video-file                   The video file to transcribe

    Options:
        -l, --language=LANGUAGE      The language to transcribe [default: "en-US"]
        -e, --encoding=ENCODING      The encoding of the audio file. This is required if the encoding is unable to be determined. [default: 2]
        -b, --brand-file=BRAND-FILE  The brand names for speech context to transcribe [default: "brands"]
        -r, --rate-hertz=RATE-HERTZ  The sample rate (in Hertz) of the supplied video [default: 48000]
        -h, --help                   Display this help message
        -q, --quiet                  Do not output any message
        -V, --version                Display this application version
            --ansi                   Force ANSI output
            --no-ansi                Disable ANSI output
        -n, --no-interaction         Do not ask any interactive question
        -v|vv|vvv, --verbose         Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

    Help:
        Transcribe an video file using Google Cloud Speech API
        The transcribe command transcribes video from a file using the
        Google Cloud Speech API.
        
        php speech.php transcribe video_file.mp4


Just send the speech sample, send it through the speech
API using the transcribe command:

```sh
php speech.php transcribe [path to audio/video file]

```

[speech-api]: http://cloud.google.com/speech
[speech-quickstart]: https://cloud.google.com/speech-to-text/docs/quickstart-client-libraries
[google-cloud-php]: https://googlecloudplatform.github.io/google-cloud-php/
[choose-encoding]: https://cloud.google.com/speech/docs/best-practices#choosing_an_audio_encoding
