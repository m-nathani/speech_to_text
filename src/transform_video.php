<?php

/**
 * Transforms an video file using FFMPEG API
 * Example:
 * ```
 * transform_video('videofile.mp4', '/path/to/file');
 * ```.
 *
 * @param string $videoFile path to an video file.
 * @param string $path path to store the transformed audio files.
 * @param string $rateHertz sample rate (in Hertz) to transformed audio files.
 *
 * @return string the array of [ path to audio files, string (audio files names)] transformed
 */

function transform_video($videoFile, $path, $rateHertz) {
  $outAudioFile = basename(substr($videoFile, 0, strrpos($videoFile, ".")));
  $path = "$path/$outAudioFile";
  if (!file_exists($path)) {
    mkdir($path, 0777, true);
  }
	shell_exec("ffmpeg -i $videoFile -loglevel error -f segment -segment_time 10 -ac 1 -ar $rateHertz -ss 00:00:00 -to 00:00:59 $path/$outAudioFile"."_%02d.flac");
  return [ $path, array_diff(scandir($path), array('.', '..')) ];
}