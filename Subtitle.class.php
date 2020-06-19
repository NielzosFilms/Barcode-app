<?php
class Subtitle
{
    private $subtitles = array();

    public function __construct($filepath)
    {
        $handle = fopen($filepath, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line_noSpace = trim($line);
                array_push($this->subtitles, $line_noSpace);
            }

            fclose($handle);
        } else {
            echo "ERROR: File not found!";
        }
    }

    public function getSubtitles()
    {
        return $this->subtitles;
    }

    public function searchSubtitles($key)
    {
        return array_search($key, $this->subtitles);
    }

    public function getStartTime($time_line_i)
    {
        $time_line = $this->subtitles[$time_line_i];
        $times = explode(" --> ", $time_line);
        return $times[0];
    }

    public function getEndTime($time_line_i)
    {
        $time_line = $this->subtitles[$time_line_i];
        $times = explode(" --> ", $time_line);
        return $times[1];
    }

    public function getLine($index)
    {
        return $this->subtitles[$index];
    }

    public function getTimeInSec($time)
    {
        $arr = explode(":", $time);
        $hours = $arr[0];
        $min = $arr[1];
        $sec = explode(".", $arr[2]);

        $final = 0;

        $final += $hours*60*60;
        $final += $min*60;
        $final += $sec[0];

        return $final;
    }
}